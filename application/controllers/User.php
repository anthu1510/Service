<?php
/**
 * Created by PhpStorm.
 * User: Attract-01
 * Date: 12/8/2017
 * Time: 1:42 PM
 */
require_once (APPPATH.'libraries/ssp.customized.class.php');

class User extends CI_Controller
{
    var $log_detail;
    var $date;

    public function __construct()
    {
        parent:: __construct();

        date_default_timezone_set('Asia/Kolkata');
        $this->date = date('Y-m-d H:i:s');

        $this->log_detail = $this->session->userdata('user_detail');

        if(!isset($this->log_detail->u_id))
        {
            redirect('welcome/');
        }
    }

    public function index()
    {
        $data = array(
            'title' => 'Engineer Dashboard',
            'name' => $this->log_detail->u_name
        );

        $this->load->view('dashboard_engineer',$data);
    }

    public function NextDayList()
    {
        $data = array(
            'title' => 'Engineer Next Day',
            'name' => $this->log_detail->u_name,
            'message' => '',
        );

        $this->load->view('nextday_engineer_list',$data);
    }

    public function AllortmentList()
    {
        $data = array(
            'title' => 'Engineer Allotmant',
            'name' => $this->log_detail->u_name,
            'message' => '',
        );
        $this->load->view('allotmant_engineer_list',$data);
    }

    public function ScheduledList()
    {
        $data = array(
            'title' => 'Engineer Sheduled',
            'name' => $this->log_detail->u_name,
            'message' => '',
        );
        $this->load->view('schedule_engineer_list',$data);
    }

    public function ServiceReport()
    {
        $data = array(
            'title' => 'Engineer Service Entry',
            'name' => $this->log_detail->u_name,
            'message' => '',
        );
        $this->load->view('service_entry_engineer_list',$data);
    }

    public function ServiceHistoryList()
    {
        $data = array(
            'title' => 'Engineer Sheduled',
            'name' => $this->log_detail->u_name,
            'message' => '',
        );
        $this->load->view('schedule_engineer_list',$data);
    }

    public function CustomerCloser()
    {
        $data = array(
            'title' => 'Engineer Service History',
            'name' => $this->log_detail->u_name,
            'message' => '',
        );
        $this->load->view('customer_engineer_closer',$data);
    }

    public function CustomerView()
    {
        $id = $this->input->post('id');

        $res = $this->customer_model->EditCustomer($id);

        $val = (array) $res[0];

        echo json_encode($val);

    }

    public function ServiceHistory()
    {
        $id = $this->input->post('id');
        $res  = $this->service_model->ServiceHistory($id);
        $ser_id = $res[0]->ser_id;
        $resimg = $this->service_model->HistoryImages($ser_id);

        foreach ($resimg as $v)
        {
            $img[] = $v->img_url;
        }

        $data = array(
            'complient_title' => $res[0]->complient_title,
            'complient_desc' => $res[0]->complient_desc,
            'ser_date' => $res[0]->ser_date,
            'close_date' => $res[0]->close_date,
            'ser_title' => $res[0]->ser_title,
            'ser_desc' => $res[0]->ser_desc,
            'name' => $res[0]->name,
            'img' => $img
        );

        echo json_encode($data);
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

            $config['upload_path'] = './images/service-entry-images/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '2000000';

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

    public function ViewComplient()
    {

        $id = $this->input->post('id');

        $this->load->model('service_model');
        $res=  $this->service_model->getComplinetById($id);
        $val=$res[0];
        echo json_encode($val);

    }

    public function CustomerCallCloserServerSide()
    {
        // DB table to use
        $table = 'customer';

        // Table's primary key
        $primaryKey = 'cus_id';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes

        $columns = array(
            array( 'db' => 'cus_id', 'dt' => 0 ),
            array( 'db' => 'cus_name',  'dt' => 1 ),
            array( 'db' => 'cus_compnay_name',   'dt' => 2 ),
            array( 'db' => 'cus_mobile1',     'dt' => 3 ),
            array( 'db' => 'cus_place',     'dt' => 4 ),
            array( 'db' => 'cus_city',     'dt' => 5 ),

            array(
                'db'        => 'cus_city',
                'dt'        => 6,
                'formatter' => function( $d, $row ) {
                    return '<button type="button" id="btncompleintlist" class="btn btn-warning btn-xs" title="Complient List"><i class="fa fa-comments-o" aria-hidden="true"></i> Complient List</button>';
                }
            ),

            array(
                'db'        => 'cus_city',
                'dt'        => 7,
                'formatter' => function( $d, $row ) {
                    return '<button type="button" id="btnview" class="btn btn-success btn-xs" title="View"><i class="fa fa-eye" aria-hidden="true"></i></button>&nbsp;<button type="button" id="btnedit" class="btn btn-primary btn-xs" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>';
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


        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * If you just want to use the basic configuration for DataTables with PHP
         * server-side, there is no need to edit below this line.
         */

        echo json_encode(
            SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
        );
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

    public function ClientComplientList($cus_comp_id)
    {
        //echo $cus_comp_id; exit;
        $mes = $this->session->userdata("customer");

        if(isset($mes))
        {
            $data = array(
                'title' => 'Client Compliant List || Dashboard',
                'message' => $this->Message($mes),
                'name' => $this->log_detail->u_name,
                'comp_cus_id' => $cus_comp_id,
                'stateload' => $this->LoadState()
            );
        }
        else
        {
            $data = array(
                'title' => 'Client Compliant List || Dashboard',
                'message' => '',
                'name' => $this->log_detail->u_name,
                'comp_cus_id' => $cus_comp_id,
                'stateload' => $this->LoadState()
            );
        }

        $this->load->view('clientcompliant_list',$data);
        $this->session->unset_userdata("customer");
    }

    public function ClientCompliantServerSide($cus_id)
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
            array( 'db' => '`co`.`id`', 'dt' => 0,'field' => 'id'),

            array( 'db' => '`cu`.`cus_name`',  'dt' => 1,'field' => 'cus_name'  ),
            array( 'db' => '`cu`.`cus_compnay_name`',   'dt' => 2,'field' => 'cus_compnay_name'  ),
            array( 'db' => '`cu`.`cus_mobile1`',     'dt' => 3,'field' => 'cus_mobile1'  ),
            array( 'db' => '`cu`.`cus_place`',     'dt' => 4,'field' => 'cus_place'  ),
            array( 'db' => '`cu`.`cus_city`',     'dt' => 5,'field' => 'cus_city'  ),

            array(
                'db'        => '`co`.`complient_status`',
                'dt'        => 6,
                'field' => 'complient_status',
                'formatter' => function( $d, $row ) {
                    return '<button type="button" id="servhis" class="btn btn-warning btn-xs" title="History">History</button>';

                }
            ),

            array(
                'db'        => '`cu`.`cus_city`',
                'dt'        => 7,
                'field' => 'cus_city',
                'formatter' => function( $d, $row ) {
                    return '<button type="button" id="btnview" class="btn btn-success btn-xs" title="View"><i class="fa fa-eye" aria-hidden="true"></i></button>';
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

        $joinQuery = "FROM `complient` AS `co` JOIN `customer` AS `cu` ON (`co`.`cus_id` = `cu`.`cus_id`)";
        $extraWhere = "co.cus_id = '$cus_id'";
        $groupBy = "";
        $having = "";

        echo json_encode(
            SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having )
        );

    }

    public function AllotmentmentServerSide()
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
            array( 'db' => '`co`.`reg_date`',     'dt' => 2,'field' => 'reg_date'  ),
            array( 'db' => '`cu`.`cus_name`',  'dt' => 3,'field' => 'cus_name'  ),
            array( 'db' => '`cu`.`cus_compnay_name`',   'dt' => 4,'field' => 'cus_compnay_name'  ),
            array( 'db' => '`cu`.`cus_mobile1`',     'dt' => 5,'field' => 'cus_mobile1'  ),
            array( 'db' => '`cu`.`cus_place`',     'dt' => 6,'field' => 'cus_place'  ),
            array( 'db' => '`ser`.`name`',     'dt' => 7,'field' => 'name'  ),

            array(
                'db'        => '`co`.`complient_status`',
                'dt'        => 8,
                'field' => 'complient_status',
                'formatter' => function( $d, $row ) {
                    return '<button type="button" id="btnstatus" class="btn btn-success btn-xs" title="Allocated"> '.$d. '</button>';

                }
            ),

            array(
                'db'        => '`cu`.`cus_city`',
                'dt'        => 9,
                'field' => 'cus_city',
                'formatter' => function( $d, $row ) {
                    return '<button type="button" id="btnview" class="btn btn-success btn-xs" title="View"><i class="fa fa-eye" aria-hidden="true"></i>
                                        </button>&nbsp;<button type="button" id="btnedit" class="btn btn-primary btn-xs" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>';
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

        $eng_id = $this->log_detail->eng_id;

        $joinQuery = "FROM complient AS  co LEFT JOIN customer AS cu ON (cu.cus_id = co.cus_id)
                            INNER JOIN ser_engineer as ser ON (co.engineer_id = ser.id)";

        $extraWhere = "co.complient_status = 'Allocated' AND co.engineer_id = '$eng_id'";
        $groupBy = "";
        $having = "";

        echo json_encode(
            SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having )
        );

    }

    public function NextDayserverside()
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
            array( 'db' => '`co`.`reg_date`',  'dt' => 2,'field' => 'reg_date'  ),
            array( 'db' => '`cu`.`cus_name`',  'dt' => 3,'field' => 'cus_name'  ),
            array( 'db' => '`cu`.`cus_compnay_name`',   'dt' => 4,'field' => 'cus_compnay_name'  ),
            array( 'db' => '`cu`.`cus_mobile1`',     'dt' => 5,'field' => 'cus_mobile1'  ),
            array( 'db' => '`cu`.`cus_place`',     'dt' => 6,'field' => 'cus_place'  ),
            array( 'db' => '`cu`.`cus_city`',     'dt' => 7,'field' => 'cus_city'  ),
            array( 'db' => '`ser`.`name`',     'dt' => 8,'field' => 'name'  ),

            array(
                'db'        => '`co`.`complient_status`',
                'dt'        => 9,
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

                    return '<button type="button" id="btnstatus" class="btn btn-default btn-xs" style="background-color: '.$color.';border-color: gray;" title="Registered"> '.$d. '</button>';

                }
            ),

            array(
                'db'        => '`cu`.`cus_city`',
                'dt'        => 10,
                'field' => 'cus_city',
                'formatter' => function( $d, $row ) {
                    return '<button type="button" id="btnview" class="btn btn-success btn-xs" title="View"><i class="fa fa-eye" aria-hidden="true"></i>
                            </button>&nbsp;<button type="button" id="btnedit" class="btn btn-primary btn-xs" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>';
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

        $eng_id = $this->log_detail->eng_id;

        $joinQuery = "FROM complient AS  co LEFT JOIN customer AS cu ON (cu.cus_id = co.cus_id)
                                LEFT JOIN ser_engineer as ser ON (co.engineer_id = ser.id)";

        $extraWhere = "co.ser_date IN (CURDATE()+ INTERVAL 1 DAY, CURDATE() + INTERVAL 1 DAY) AND co.engineer_id = '$eng_id' AND co.engineer_id = '$eng_id'";
        $groupBy = "";
        $having = "";

        echo json_encode(
            SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having )
        );

    }

    public function SccheduleServerside()
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

                    return '<button disabled type="button" id="btnstatus" class="btn btn-default btn-xs" style="background-color: '.$color.';border-color: gray;" title="Registered"> '.$d. '</button>';

                }
            ),

            array(
                'db'        => '`cu`.`cus_city`',
                'dt'        => 9,
                'field' => 'cus_city',
                'formatter' => function( $d, $row ) {
                    return '<button type="button" id="btnview" class="btn btn-success btn-xs" title="View"><i class="fa fa-eye" aria-hidden="true"></i>
                            </button>';
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

        $eng_id = $this->log_detail->eng_id;

        $joinQuery = "FROM complient AS  co LEFT JOIN customer AS cu ON (cu.cus_id = co.cus_id)
                                LEFT JOIN ser_engineer as ser ON (co.engineer_id = ser.id)";

        $extraWhere = "co.ser_date IN (CURDATE(), CURDATE()) AND co.engineer_id = '$eng_id' AND co.engineer_id = '$eng_id' ";
        $groupBy = "";
        $having = "";

        echo json_encode(
            SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having )
        );

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