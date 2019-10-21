<?php
/**
 * Created by PhpStorm.
 * User: Attract-01
 * Date: 11/23/2017
 * Time: 11:42 AM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

require_once (APPPATH.'libraries/ssp.class.php');
require_once (APPPATH.'controllers/Welcome.php');

class Customer extends welcome
{
    var $log_detail;
    var $date;

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Kolkata');
        $this->date = date('Y-m-d H:i:s');

        $this->log_detail = $this->session->userdata("user_detail");

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

        $this->load->model(array("customer_model","service_model"));
    }

    public function CustomerSave()
    {
        $data = array(

            'cus_name' => $this->input->post('cus_name'),
            'cus_compnay_name' => $this->input->post('cus_comp_name'),
            'cus_email' => $this->input->post('cus_email'),
            'cus_mobile1' => $this->input->post('cus_mobile'),
            'cus_mobile2' => $this->input->post('cus_mobile2'),
            'cus_phone' => $this->input->post('cus_phone'),
            'cus_address1' => $this->input->post('cus_address1'),
            'cus_address2' => $this->input->post('cus_address2'),
            'cus_place' => $this->input->post('cus_place'),
            'cus_city' => $this->input->post('cus_city'),
            'cus_state' => $this->input->post('cus_state'),
            'cus_state_code' => $this->input->post('cus_state_code'),
            'cus_country' => $this->input->post('cus_country'),
            'cus_pin_code' => $this->input->post('cus_pin_code'),
            'cus_website' => $this->input->post('cus_website'),
            'cus_gstin_no' => $this->input->post('cus_gstin_code'),
            'cus_cdate' => $this->date,
            'status' => 'active'
        );

            $result = $this->customer_model->SaveCustomer($data);

                if($result == "1")
                {
                    $this->session->set_userdata("customer","saved");
                    redirect("customer/CustomerList");
                }
                else
                {
                    $this->session->set_userdata("customer","unsaved");
                    redirect("customer/CustomerList");
                }
    }

    public function CustomerEdit()
    {
        $id = $this->input->post('id');

        $res = $this->customer_model->EditCustomer($id);

        $val = (array) $res[0];

        echo json_encode($val);
    }

    public function CustomerUpdate()
    {
        $data = array(

            'cus_name' => $this->input->post('cus_name'),
            'cus_compnay_name' => $this->input->post('cus_comp_name'),
            'cus_email' => $this->input->post('cus_email'),
            'cus_mobile1' => $this->input->post('cus_mobile'),
            'cus_mobile2' => $this->input->post('cus_mobile2'),
            'cus_phone' => $this->input->post('cus_phone'),
            'cus_address1' => $this->input->post('cus_address1'),
            'cus_address2' => $this->input->post('cus_address2'),
            'cus_place' => $this->input->post('cus_place'),
            'cus_city' => $this->input->post('cus_city'),
            'cus_state' => $this->input->post('cus_state'),
            'cus_state_code' => $this->input->post('cus_state_code'),
            'cus_country' => $this->input->post('cus_country'),
            'cus_pin_code' => $this->input->post('cus_pin_code'),
            'cus_website' => $this->input->post('cus_website'),
            'cus_gstin_no' => $this->input->post('cus_gstin_code'),
            'status' => 'active'
        );

        $id = $this->input->post('cus_id');

        $result = $this->customer_model->UpdateCustomer($data,$id);

        if($result == "1")
        {
            $this->session->set_userdata("customer","updated");
            redirect("customer/CustomerList");
        }
        else
        {
            $this->session->set_userdata("customer","unupdated");
            redirect("customer/CustomerList");
        }
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

    public function CustomerView()
    {
        $id = $this->input->post('id');

        $res = $this->customer_model->EditCustomer($id);

        $val = (array) $res[0];

        echo json_encode($val);

    }

    public function CustomerList()
    {
        $mes = $this->session->userdata("customer");

        if(isset($mes))
        {
            $data = array(
                'title' => 'Customer List || Dashboard',
                'message' => $this->Message($mes),
                'name' => $this->log_detail->u_name,
                'stateload' => $this->LoadState()
            );
        }
        else
        {
            $data = array(
                'title' => 'Customer List || Dashboard',
                'message' => '',
                'name' => $this->log_detail->u_name,
                'stateload' => $this->LoadState()
            );
        }

        $this->load->view('customer_list',$data);
        $this->session->unset_userdata("customer");
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

    public function CustomerCloser()
    {
        $mes = $this->session->userdata("customer");

        if(isset($mes))
        {
            $data = array(
                'title' => 'Customer List || Dashboard',
                'message' => $this->Message($mes),
                'name' => $this->log_detail->u_name,
                'stateload' => $this->LoadState()
            );
        }
        else
        {
            $data = array(
                'title' => 'Customer List || Dashboard',
                'message' => '',
                'name' => $this->log_detail->u_name,
                'stateload' => $this->LoadState()
            );
        }

        $this->load->view('customer_closer',$data);
        $this->session->unset_userdata("customer");
    }

    public function CustomerRaiseCompliantSave()
    {
        $data = array(
            'cus_id' => $this->input->post('compliant_id'),
            'reg_date' => $this->date,
            'ser_date' => $this->input->post('ser_date'),
            'complient_title' => $this->input->post('complient_title'),
            'complient_desc' => $this->input->post('complient_desc'),
            'complient_status' => 'Registered',
            'close_date' => $this->input->post(''),
            'status' => 'active'
        );

        $result = $this->service_model->CompliantSave($data);

        if($result == "1")
        {
            $this->session->set_userdata("customer","ComplientSaved");
            redirect('Customer/CustomerList');
        }
        else
        {
            $this->session->set_userdata("customer","ComplientUnSaved");
            redirect('Customer/CustomerList');
        }
    }

    public function CustomerServerSide()
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
                   return '<button type="button" id="btnraise" class="btn btn-warning btn-xs" title="Raise"><i class="fa fa-comments-o" aria-hidden="true"></i> Raise</button>';
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

    private function Message($message)
    {
        if($message == 'saved')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong>&nbsp;&nbsp;Customer Record Inserted Successfully...</div>';
        }
        elseif ($message == 'unsaved')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp;&nbsp;Customer Record Does not Inserted Try again...</div>';
        }
        elseif ($message == 'updated')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong>&nbsp;&nbsp;Customer Record Updated Successfully...</div>';
        }
        elseif ($message == 'unupdated')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp;&nbsp;Customer Record Does not Updated Try again...</div>';
        }
        elseif ($message == 'ComplientSaved')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong>&nbsp;&nbsp;Customer Compliant Saved Successfully...</div>';
        }
        elseif ($message == 'ComplientUnSaved')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp;&nbsp;Customer Compliant Does not Saved.. Try again...</div>';
        }
        elseif ($message == 'ComplientUpdated')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong>&nbsp;&nbsp;Customer Compliant Updated Successfully...</div>';
        }
        elseif ($message == 'ComplientUnUpdated')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp;&nbsp;Customer Compliant Does not Updated.. Try again...</div>';
        }

        return $mess;
    }
}
?>