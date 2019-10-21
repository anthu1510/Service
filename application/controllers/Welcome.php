<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    var $log_detail;

	public function __construct()
    {
        parent::__construct();

        $this->log_detail = $this->session->userdata("user_detail");

        $this->load->model(array('zone_model','user_model'));
    }

    public function index()
    {
        $mes = $this->session->userdata("profile");
        if(isset($mes))
        {
            $data = array(
                'message' => '',
                'title' => 'Login',
                'message' => $this->Message($mes)
            );

        }
        else
        {
            $data = array(
                'message' => '',
                'title' => 'Login',
                'message' => ''
            );
        }
        $this->load->view('welcome',$data);
        $this->session->unset_userdata("profile");
    }

    public function LoadState()
    {
        $result = $this->zone_model->loadState();
        return $result;
    }

    public function GetStateCode()
    {
        $state = $this->input->post('state');
        $result = $this->zone_model->GetByStateName($state);
        $val = $result[0]->statecode;
        echo $val;
    }

    public function Login()
    {
        $this->load->model('user_model');

       $data = array(
           'username' => $this->input->post('username'),
           'password' => $this->input->post('password')
       );

       $result =  $this->user_model->login($data);

        if($result == 0)
        {
            redirect('welcome/');
        }
        else
        {
            $this->session->set_userdata('user_detail',$result[0]);
            redirect('dashboard/');
        }
    }

    public function EditProfile()
    {
        $mes = $this->session->userdata("profile");
        if(isset($mes))
        {
            $data = array(
                'title' => 'Profile Edit || Dashboard',
                'message' => $this->Message($mes),
                'name' => $this->log_detail->u_name,
                'pname' => $this->log_detail->u_name,
                'pemailid' => $this->log_detail->u_email
            );

        }
        else
        {
            $data = array(
                'title' => 'Profile Edit || Dashboard',
                'message' => '',
                'name' => $this->log_detail->u_name,
                'pname' => $this->log_detail->u_name,
                'pemailid' => $this->log_detail->u_email
            );
        }

        $this->load->view('profile_edit',$data);
        $this->session->unset_userdata("profile");
    }

    public function UpdateProfile()
    {
        $data = array(
            'u_name' => $this->input->post('name'),
            'u_email' => $this->input->post('email')
        );

        $result = $this->user_model->UpdateProfile($data,$this->log_detail->u_id);

            if($result == 1)
            {
                $this->session->set_userdata("profile","changeprofile");
                $this->Logout();
            }
            else
            {
                $this->session->set_userdata("profile","unchangeprofile");
                redirect('welcome/editprofile');
            }
    }

    public function ChangePassword()
    {
        $mes = $this->session->userdata("profile");
        if(isset($mes))
        {
            $data = array(
                'title' => 'Change Pasword || Dashboard',
                'message' => $this->Message($mes),
                'name' => $this->log_detail->u_name
            );

        }
        else
        {
            $data = array(
                'title' => 'Change Pasword || Dashboard',
                'message' => '',
                'name' => $this->log_detail->u_name
            );
        }

        $this->load->view('profile_changepassword',$data);
        $this->session->unset_userdata("profile");
    }

    public function PasswordUpdate()
    {
        $data = array(
            'oldpassword' => $this->input->post('oldpassword'),
            'newpassword' => $this->input->post('conpassword')
        );

        $res = $this->user_model->VerifyPassword($data['oldpassword']);

            if($res == true)
            {
                $result = $this->user_model->ChangePassword($data['newpassword'],$this->log_detail->u_id);

                    if($result == 1)
                    {
                        $this->session->set_userdata("profile","passwordchanged");
                        $this->Logout();
                    }
                    else
                    {
                        $this->session->set_userdata("profile","passwordunchanged");
                        redirect('welcome/changepassword');
                    }
            }
            else
            {
                $this->session->set_userdata("profile","oldpasswordwrong");
                redirect('welcome/changepassword');
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

    public function Logout()
    {
        $this->session->unset_userdata('user_detail');

        redirect('welcome/');
    }

    private function Message($message)
    {
        if($message == 'saved')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong>Customer Record Inserted Successfully...</div>';
        }
        elseif ($message == 'unsaved')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>Customer Record Does not Inserted Try again...</div>';
        }
        elseif ($message == 'oldpasswordwrong')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>Old Password Does not Matched... Try again...</div>';
        }
        if($message == 'passwordchanged')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong> &nbsp; Your Password Changed Successfully...</div>';
        }
        elseif ($message == 'passwordunchanged')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>Your Password Cannot Changed... Try again...</div>';
        }
        elseif($message == 'changeprofile')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong> &nbsp; Profile Updated Successfully...</div>';
        }
        elseif ($message == 'unchangeprofile')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp; Profile Does not Updated... Try again...</div>';
        }


        return $mess;
    }

}
