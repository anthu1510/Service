<?php
/**
 * Created by PhpStorm.
 * User: Attract-01
 * Date: 12/2/2017
 * Time: 11:38 AM
 */
require_once (APPPATH.'libraries/ssp.class.php');
require_once (APPPATH.'controllers/Welcome.php');

class Engineers extends Welcome
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

        $this->load->model("engineer_model");
    }

    public function index()
    {
        $mes = $this->session->userdata("engineer");

        if(isset($mes))
        {
            $data = array(
                'title' => 'Service Engineer || Dashboard',
                'message' => $this->Message($mes),
                'name' => $this->log_detail->u_name,
                'stateload' => $this->LoadState()
            );
        }
        else
        {
            $data = array(
                'title' => 'Service Engineer || Dashboard',
                'message' => '',
                'name' => $this->log_detail->u_name,
                'stateload' => $this->LoadState()
            );
        }

        $this->load->view('engineers_list',$data);
        $this->session->unset_userdata("engineer");
    }

    public function EngineerSave()
    {
        $data = array(
            'name' => $this->input->post('eng_name'),
            'mobile' => $this->input->post('eng_mobile'),
            'mobile2' => $this->input->post('eng_mobile2'),
            'email' => $this->input->post('eng_email'),
            'street' => $this->input->post('eng_street'),
            'place' => $this->input->post('eng_place'),
            'city' => $this->input->post('eng_city'),
            'pin' => $this->input->post('eng_pin'),
            'state' => $this->input->post('eng_state'),
            'status' => 'active'
        );

        $result = $this->engineer_model->SaveEngineer($data);

            if($result == 1)
            {
                $this->session->set_userdata("engineer","engineersave");
                redirect('engineers/');
            }
            else
            {
                $this->session->set_userdata("engineer","engineerunsave");
                redirect('engineers/');
            }
    }

    public function EngineerUpdate()
    {
        $id = $this->input->post('ser_id');

        $data = array(
            'name' => $this->input->post('eng_name'),
            'mobile' => $this->input->post('eng_mobile'),
            'mobile2' => $this->input->post('eng_mobile2'),
            'email' => $this->input->post('eng_email'),
            'street' => $this->input->post('eng_street'),
            'place' => $this->input->post('eng_place'),
            'city' => $this->input->post('eng_city'),
            'pin' => $this->input->post('eng_pin'),
            'state' => $this->input->post('eng_state'),
            'status' => $this->input->post('eng_status')
        );

        $result = $this->engineer_model->UpdateEngineer($id,$data);

        if($result == 1)
        {
            $this->session->set_userdata("engineer","engineerupdate");
            redirect('engineers/');
        }
        else
        {
            $this->session->set_userdata("engineer","engineerunupdate");
            redirect('engineers/');
        }
    }

    public function EngineerServerSide()
    {
        // DB table to use
        $table = 'ser_engineer';

        // Table's primary key
        $primaryKey = 'id';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes

        $columns = array(
            array( 'db' => 'id', 'dt' => 0 ),
            array( 'db' => 'name',  'dt' => 1 ),
            array( 'db' => 'mobile',   'dt' => 2 ),
            array( 'db' => 'mobile2',     'dt' => 3 ),
            array( 'db' => 'email',     'dt' => 4 ),
            array( 'db' => 'place',     'dt' => 5 ),
            array( 'db' => 'city',     'dt' => 6 ),

            array(
                'db'        => 'status',
                'dt'        => 7,
                'formatter' => function( $d ) {
                    if($d == 'active')
                    {
                        $lab = "label-success";
                    }
                    else
                    {
                        $lab = "label-danger";
                    }
                    return '<label class="label '.$lab.'">'.$d.'</label>';
                }
            ),

            array(
                'db'        => 'city',
                'dt'        => 8,
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

    public function EngineerEdit()
    {
        $id = $this->input->post('id');
        $res = $this->engineer_model->GetById($id);
        $ar = (array) $res[0];
        echo json_encode($ar);
    }

    private function Message($message)
    {
        if($message == 'engineersave')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong>&nbsp; Engineer Record Inserted Successfully...</div>';
        }
        elseif ($message == 'engineerunsave')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp; Engineer Record Does not Inserted Try again...</div>';
        }
        if($message == 'engineerupdate')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong>&nbsp; Engineer Record Updated Successfully...</div>';
        }
        elseif ($message == 'engineerunupdate')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp; Engineer Record Does not Updated Try again...</div>';
        }

        return $mess;
    }
}
?>