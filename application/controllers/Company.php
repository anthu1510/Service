<?php
/**
 * Created by PhpStorm.
 * User: Attract-01
 * Date: 11/20/2017
 * Time: 12:36 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

require_once ('Welcome.php');
require_once (APPPATH.'libraries/ssp.class.php');

class Company extends Welcome
{
    var $date;
    var $log_detail;

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Kolkata');
        $this->date = date('Y-m-d H:i:s');

        $this->load->helper(array('file','form'));

        $this->load->model(array('company_model','user_model'));

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

    }

    public function AddCompany()
    {
        $mes = $this->session->userdata("company");

            if(isset($mes))
            {
                $data = array(
                    'title' => 'Add Company || Dashboard',
                    'message' => $this->Message($mes),
                    'name' => $this->log_detail->u_name,
                    'comp_count' => $this->CompanyCount(),
                    'state' => $this->LoadState()
                );
            }
            else
            {
                $data = array(
                    'title' => 'Add Company || Dashboard',
                    'message' => '',
                    'name' => $this->log_detail->u_name,
                    'comp_count' => $this->CompanyCount(),
                    'state' => $this->LoadState()
                );
            }

        $this->load->view('add_company',$data);
       $this->session->unset_userdata("company");
    }

    public function CompanyUpdate()
    {
        $id = $this->input->post('comp_id');

        $img = $this->ImageUpload('comp_logo');
        $data = array(
            'comp_name' => $this->input->post('comp_name'),
            'comp_email' => $this->input->post('comp_email'),
            'comp_mobile1' => $this->input->post('comp_mobile'),
            'comp_mobile2' => $this->input->post('comp_mobile2'),
            'comp_phone' => $this->input->post('comp_phone'),
            'comp_address1' => $this->input->post('comp_address1'),
            'comp_address2' => $this->input->post('comp_address2'),
            'comp_place' => $this->input->post('comp_place'),
            'comp_city' => $this->input->post('comp_city'),
            'comp_state' => $this->input->post('comp_state'),
            'comp_state_code' => $this->input->post('comp_state_Code'),
            'comp_country' => $this->input->post('comp_country'),
            'comp_pin_code' => $this->input->post('comp_pin_code'),
            'comp_website' => $this->input->post('comp_website'),
            'comp_gstin_code' => $this->input->post('comp_gstin_code'),
            'comp_cdate' => $this->date,
            'comp_logo' => $img['upload_data']['file_name'],
            'status' => 'active'
        );

        $result = $this->company_model->UpdateCompany($id,$data);

        if($result == 1)
        {
            $this->session->set_userdata("company","company updated");
            redirect('company/AddCompany');
        }
        else
        {
            $this->session->set_userdata("company","company unupdated");
            redirect('company/AddCompany');
        }
    }

    public function CompanySave()
    {
        $img = $this->ImageUpload('comp_logo');
        $data = array(
            'comp_name' => $this->input->post('comp_name'),
            'comp_email' => $this->input->post('comp_email'),
            'comp_mobile1' => $this->input->post('comp_mobile'),
            'comp_mobile2' => $this->input->post('comp_mobile2'),
            'comp_phone' => $this->input->post('comp_phone'),
            'comp_address1' => $this->input->post('comp_address1'),
            'comp_address2' => $this->input->post('comp_address2'),
            'comp_place' => $this->input->post('comp_place'),
            'comp_city' => $this->input->post('comp_city'),
            'comp_state' => $this->input->post('comp_state'),
            'comp_state_code' => $this->input->post('comp_state_Code'),
            'comp_country' => $this->input->post('comp_country'),
            'comp_pin_code' => $this->input->post('comp_pin_code'),
            'comp_website' => $this->input->post('comp_website'),
            'comp_gstin_code' => $this->input->post('comp_gstin_code'),
            'comp_cdate' => $this->date,
            'comp_logo' => $img['upload_data']['file_name'],
            'status' => 'active'
        );

        $result = $this->company_model->SaveCompany($data);

        if($result == 1)
        {
            $this->session->set_userdata("company","company saved");
            redirect('company/AddCompany');
        }
        else
        {
            $this->session->set_userdata("company","company unsaved");
            redirect('company/AddCompany');
        }
    }

    public function ImageUpload($file)
    {
        $this->load->library('upload', $this->set_upload_options());

        if ( ! $this->upload->do_upload($file))
        {
            return $error = array('error' => $this->upload->display_errors());
        }
        else
        {
            return $data = array('upload_data' => $this->upload->data());
        }
    }

    private function set_upload_options()
    {
        //upload an image options
        $config['upload_path']          = './images/company/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg|bmp';
        $config['overwrite']            = TRUE;
        //$config['file_name'] = date('Ymd').time().(microtime()*10000000);

        return $config;
    }

    public function CompanyCount()
    {
        $id = "1";
        $result = $this->company_model->GetById($id);

        if(empty($result))
        {
            return 0;
        }
        else
        {
            return 1;
        }
    }

    public function CompanyEdit()
    {
        //$id = $this->input->post('id');
        $id = 1;
        $result = $this->company_model->getbyid($id);
        echo json_encode($result[0]);

    }

    public function UserList()
    {
        $mes = $this->session->userdata("newuser");

        if(isset($mes))
        {
            $data = array(
                'title' => 'User List || Dashboard',
                'message' => $this->Message($mes),
                'name' => $this->log_detail->u_name
            );
        }
        else
        {
            $data = array(
                'title' => 'User List || Dashboard',
                'message' => '',
                'name' => $this->log_detail->u_name
            );
        }

        $this->load->view('user_list',$data);
        $this->session->unset_userdata("newuser");
    }

    public function newUser()
    {
        $mes = $this->session->userdata("newuser");

        if(isset($mes))
        {
            $data = array(
                'title' => 'Add User || Dashboard',
                'message' => $this->Message($mes),
                'name' => $this->log_detail->u_name
            );
        }
        else
        {
            $data = array(
                'title' => 'Add User || Dashboard',
                'message' => '',
                'name' => $this->log_detail->u_name
            );
        }

        $this->load->view('newuser',$data);
        $this->session->unset_userdata("newuser");
    }

    public function UserSave()
    {
        $data = array(
            'eng_id' => $this->input->post('eng_id'),
            'u_name' => $this->input->post('username'),
            'u_email' => $this->input->post('useremail'),
            'u_password' => md5($this->input->post('userpass')),
            'u_mobile' => $this->input->post('usermobile'),
            'u_role' => $this->input->post('user_roll'),
            'u_cdate' => $this->date,
            'status' => 'active',
        );

        $res = $this->company_model->SaveUser($data);

            if($res == 1)
            {
                $this->session->set_userdata("newuser","usersaved");
                redirect('company/newuser');
            }
            else
            {
                $this->session->set_userdata("newuser","userunsaved");
                redirect('company/newuser');
            }
    }

    public function UserUpdate()
    {
        $id = $this->input->post('u_id');

        $data = array(
            'eng_id' => $this->input->post('eng_id'),
            'u_name' => $this->input->post('username'),
            'u_email' => $this->input->post('useremail'),
            'u_mobile' => $this->input->post('usermobile'),
            'u_role' => $this->input->post('user_roll'),
            'u_udate' => $this->date,
            'status' => 'active',
        );

        $res = $this->company_model->UpdateUser($id,$data);

        if($res == 1)
        {
            $this->session->set_userdata("newuser","userupdated");
            redirect('company/userlist');
        }
        else
        {
            $this->session->set_userdata("newuser","userunupdated");
            redirect('company/userlist');
        }
    }

    public function UserEdit()
    {
        $id = $this->input->post('id');
        $result = $this->company_model->UserGetById($id);
        echo json_encode($result[0]);
    }

    public function UserServerSide()
    {
        // DB table to use
        $table = 'users';

        // Table's primary key
        $primaryKey = 'u_id';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes

        $columns = array(
            array( 'db' => 'u_id', 'dt' => 0 ),
            array( 'db' => 'eng_id',  'dt' => 1 ),
            array( 'db' => 'u_name',   'dt' => 2 ),
            array( 'db' => 'u_email',     'dt' => 3 ),
            array( 'db' => 'u_mobile',     'dt' => 4 ),
            array( 'db' => 'u_role',     'dt' => 5 ),

            array(
                'db'        => 'status',
                'dt'        => 6,
                'formatter' => function( $d, $row ) {
                    if($d == 'active')
                    {
                        $style = "btn btn-success";
                    }
                    else
                    {
                        $style = "btn btn-danger";
                    }
                    return '<button id="btnstatus" class="btn '.$style.' btn-xs" title="Status">'.$d.'</button>';
                }
            ),

            array(
                'db'        => 'status',
                'dt'        => 7,
                'formatter' => function( $d, $row ) {
                    return '<button type="button" id="btnview" class="btn btn-success btn-xs" title="View"><i class="fa fa-eye" aria-hidden="true"></i></button>
                    &nbsp;<button type="button" id="btnedit" class="btn btn-primary btn-xs" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                    &nbsp;<button type="button" id="btnpwd" class="btn btn-warning btn-xs" title="Password Change"><i class="fa fa-paste" aria-hidden="true"></i></button>';
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

    public function UserPasswordChange()
    {
        $uid = $this->input->post('user_id');

        $password = $this->input->post('newpassword');

        $result = $this->company_model->ChangeUserPassword($uid,$password);

            if($result == 1)
            {
                $this->session->set_userdata("newuser","passwordupdated");
                redirect('company/userlist');
            }
            else
            {
                $this->session->set_userdata("newuser","passwordunupdated");
                redirect('company/userlist');
            }

    }

    public function StatusUpdate($id)
    {
        $result = $this->user_model->UpdateStatus($id);

        if($result == 1)
        {
            $this->session->set_userdata("newuser","statusupdated");
            redirect('company/userlist');
        }
        else
        {
            $this->session->set_userdata("newuser","statusunupdated");
            redirect('company/userlist');
        }
    }

    private function Message($message)
    {
        if($message == 'company saved')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong>&nbsp;Company Record Inserted Successfully...</div>';
        }
        elseif ($message == 'company unsaved')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp;Company Record Does not Inserted Try again...</div>';
        }
        elseif ($message == 'company updated')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong>&nbsp;Company Record Updated Successfully...</div>';
        }
        elseif ($message == 'company unupdated')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp;Company Record Does not Updated Try again...</div>';
        }
        elseif($message == 'usersaved')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong>&nbsp;User Record Created Successfully...</div>';
        }
        elseif ($message == 'userunsaved')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp;Company Record Does not Created.... Try again...</div>';
        }
        elseif($message == 'userupdated')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong>&nbsp;User Record Updated Successfully...</div>';
        }
        elseif ($message == 'userunupdated')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp;Company Record Does not Updated.... Try again...</div>';
        }
        elseif($message == 'passwordupdated')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong>&nbsp;User Record Password Updated Successfully...</div>';
        }
        elseif ($message == 'passwordunupdated')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp;Company Record Password Does not Updated.... Try again...</div>';
        }
        elseif($message == 'statusupdated')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong> &nbsp; Status Updated Successfully...</div>';
        }
        elseif ($message == 'statusunupdated')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp; Status Does not Updated... Try again...</div>';
        }

        return $mess;
    }
}
?>