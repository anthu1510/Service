<?php
/**
 * Created by PhpStorm.
 * User: Ravi
 * Date: 11/14/2017
 * Time: 1:50 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

require_once (APPPATH.'libraries/ssp.class.php');

class Dashboard extends CI_Controller
{
    var $log_detail;
    public function __construct()
    {
        parent::__construct();

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

    public function index()
    {
        $data = array(
            'title' => 'Dashboard',
            'name' => $this->log_detail->u_name,
        );

        $this->load->view('dashboard',$data);

    }

}
?>