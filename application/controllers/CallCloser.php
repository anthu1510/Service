<?php
/**
 * Created by PhpStorm.
 * User: Attract-01
 * Date: 11/30/2017
 * Time: 12:16 PM
 */
require_once (APPPATH.'libraries/ssp.customized.class.php');
require_once (APPPATH.'controllers/Service.php');

class CallCloser extends Service
{
    var $log_detail;
    var $date;

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Kolkata');
        $this->date = date('Y-m-d H:i:s');

        $this->log_detail = $this->session->userdata('user_detail');

        if(!isset($this->log_detail->u_id))
        {
            redirect('welcome/');
        }
        else
        {
            if($this->log_detail->u_role == 'Engineer')
            {
                redirect("user/");
            }
        }

        $this->load->helper('form');
        $this->load->model(array("customer_model","service_model","serviceentry_model"));
    }

    public function ServiceReport()
    {
        $mes = $this->session->userdata("callcloser");

        if(isset($mes))
        {
            $data = array(
                'title' => 'Service Entry || Dashboard',
                'message' => $this->Message($mes),
                'comp_status' => $this->LoadStatus(),
                'name' => $this->log_detail->u_name
            );
        }
        else
        {
            $data = array(
                'title' => 'Service Entry || Dashboard',
                'message' => '',
                'comp_status' => $this->LoadStatus(),
                'name' => $this->log_detail->u_name
            );
        }

        $this->load->view('service_entry_list',$data);
        $this->session->unset_userdata("callcloser");

    }

    public function ServiceHistoryList()
    {
        $mes = $this->session->userdata("callcloser");

        if(isset($mes))
        {
            $data = array(
                'title' => 'Service History || Dashboard',
                'message' => $this->Message($mes),
                'comp_status' => $this->LoadStatus(),
                'name' => $this->log_detail->u_name
            );
        }
        else
        {
            $data = array(
                'title' => 'Service History || Dashboard',
                'message' => '',
                'comp_status' => $this->LoadStatus(),
                'name' => $this->log_detail->u_name
            );
        }

        $this->load->view('service_entry_list',$data);
        $this->session->unset_userdata("callcloser");
    }

    public function ServiceEntrySave()
    {
        $comp_id = $this->input->post('comp_id');
        $comp_result = $this->service_model->getComplinetById($comp_id);

            $data = array(
                'cus_id' => $comp_result[0]->cus_id,
                'comp_id' => $comp_id,
                'eng_id' => $comp_result[0]->engineer_id,
                'ser_title' => $this->input->post('serviceentry_title'),
                'ser_desc' => $this->input->post('serviceentry_desc')
            );

         $data1['close_date'] = $this->input->post('close_date');


            $result1 = $this->serviceentry_model->InsertServiceEntry($data);
            //print_r($result1); exit;

                    if(!$result1 == 0)
                    {
                        $res = $this->serviceentry_model->UpdateCloseDateCompliant($comp_id,$data1);

                           if($res == 1)
                            {
                                $images = $this->ImageUpload($_FILES);

                                foreach ($images as $img)
                                {
                                    $data1 = array(
                                        'ser_id' => $result1,
                                        'img_url' => $img['file_name']
                                    );

                                    $result = $this->serviceentry_model->InsertServiceEntryGallery($data1);
                                }

                                if($result == 1)
                                {
                                    $this->session->set_userdata("callcloser","serviceentrySaved");
                                    redirect('CallCloser/ServiceEntryList');
                                }
                                else
                                {
                                    $this->session->set_userdata("callcloser","serviceentryUnSaved");
                                    redirect('CallCloser/ServiceEntryList');
                                }
                            }
                    }


    }

    public function ServiceEntryServerSide()
    {
        // DB table to use
        $table = 'complient';

        // Table's primary key
        $primaryKey = 'id';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes

        $columns = array(
                            array( 'db' => '`co`.`id`', 'dt' => 1,'field' => 'id'  ),

                            array( 'db' => '`cu`.`cus_name`',  'dt' => 2,'field' => 'cus_name'  ),
                            array( 'db' => '`cu`.`cus_compnay_name`',   'dt' => 3,'field' => 'cus_compnay_name'  ),
                            array( 'db' => '`cu`.`cus_mobile1`',     'dt' => 4,'field' => 'cus_mobile1'  ),
                            array( 'db' => '`cu`.`cus_place`',     'dt' => 5,'field' => 'cus_place'  ),
                            array( 'db' => '`cu`.`cus_city`',     'dt' => 6,'field' => 'cus_city'  ),
                            array( 'db' => '`ser`.`name`',     'dt' => 7,'field' => 'name'  ),

                            array(
                                'db'        => '`co`.`complient_status`',
                                'dt'        => 8,
                                'field' => 'complient_status',
                                'formatter' => function( $d, $row ) {
                                    if($d == "Registered")
                                    {
                                        $color = "#c6c311";
                                    }
                                    elseif ($d == "Allocated")
                                    {
                                        $color = "#44c611";
                                    }
                                    elseif ($d == "Processing")
                                    {
                                        $color = "#e2950f";
                                    }
                                    elseif ($d == "Parts Ordered")
                                    {
                                        $color = "#0ee2be";
                                    }
                                    elseif ($d == "Closed")
                                    {
                                        $color = "#0d11e2;color:white";
                                    }
                                    elseif ($d == "Reopen")
                                    {
                                        $color = "#e2170c;color:white";
                                    }
                                    elseif ($d == "Customer Test")
                                    {
                                        $color = "#e20b8c;color:white";
                                    }

                                    return '<button type="button" id="btnstatus" class="btn btn-default btn-xs" style="background-color: '.$color.';border-color: gray;" title="'.$d.'"> '.$d. '</button>';

                                }
                            ),
                            array(
                                'db'        => '`co`.`complient_status`',
                                'dt'        => 9,
                                'field' => 'complient_status',
                                'formatter' => function( $d, $row ) {
                                    return '<button type="button" id="btnentry" class="btn btn-success" title="Service Entry">New Entry</button>';
                                }
                            )
                        );

                // SQL server connection information
                $sql_details = array(
                    'user' => $this->db->username,
                    'pass' => $this->db->password,
                    'db'   => $this->db->database,
                    'host' => $this->db->hostname
                );


            $joinQuery = "FROM complient AS co LEFT JOIN customer AS cu ON (cu.cus_id = co.cus_id)
                                LEFT JOIN ser_engineer as ser ON (co.engineer_id = ser.id)";

            $extraWhere = "co.ser_date IN (CURDATE())";
            $groupBy = "";
            $having = "";

            echo json_encode(
                SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having )
            );
    }

    public function ImageUpload($file)
    {
        $files = $file;
        $count = count($_FILES['service_entry_images']['name']);
        for($i=0; $i<$count; $i++)
        {
            $_FILES['service_entry_images']['name'] = $files['service_entry_images']['name'][$i];
            $_FILES['service_entry_images']['type'] = $files['service_entry_images']['type'][$i];
            $_FILES['service_entry_images']['tmp_name'] = $files['service_entry_images']['tmp_name'][$i];
            $_FILES['service_entry_images']['error'] = $files['service_entry_images']['error'][$i];
            $_FILES['service_entry_images']['size'] = $files['service_entry_images']['size'][$i];

            $this->load->library('upload',$this->set_upload_options());
            $this->upload->initialize($this->set_upload_options());
            $this->upload->do_upload('service_entry_images');
            $data[] = $this->upload->data();
        }
        return $data;
    }

    private function set_upload_options()
    {
        //upload an image options
        $config['upload_path']          = './images/service-entry-images/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg|bmp';
        $config['overwrite']            = TRUE;
        //$config['file_name'] = date('Ymd').time().(microtime()*10000000);

        return $config;
    }

    private function Message($message)
    {
        if($message == 'serviceentrySaved')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong>Service Entry Record Inserted Successfully...</div>';
        }
        elseif ($message == 'serviceentryUnSaved')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>Service Entry Record Does not Inserted Try again...</div>';
        }

        return $mess;
    }
}
?>