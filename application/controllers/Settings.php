<?php
/**
 * Created by PhpStorm.
 * User: Attract-01
 * Date: 11/15/2017
 * Time: 11:54 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller
{
    var $log_detail;
    var $date;

    public function __construct()
    {
        parent::__construct();

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
    }


    public function Save()
    {
        $country=$this->input->post('country');
        $states=$this->input->post('state');



        $giogroupname=$this->input->post('giogroupname');
        $giogroupdesc=$this->input->post('giogroupdesc');

        $dataGioZone=array(
            'name'=>$giogroupname,
            'description'=>$giogroupdesc,
            'date_added'=>date('Y-m-d h:i:s'),
            'date_modified'=>date('Y-m-d h:i:s')

        );
        $this->load->model('zone_model');
       $giozoneid= $this->zone_model->InsertGioZone($dataGioZone);


        foreach ($states as $state)
        {
            $data=array('country_id'=>$country,
                'zone_id'=>$state,
                'geo_zone_id'=>$giozoneid,
                'date_added'=>date('Y-m-d h:i:s'),
                'date_modified'=>date('Y-m-d h:i:s')

                );
            $this->zone_model->InsertZoneToGioZone($data);


        }
    }


    public function TaxSave()
    {
        $tax_name= $this->input->post('tax_name');
        $tax_value=$this->input->post('tax_value');
        $tax_type=$this->input->post('tax_type');
        $tax_cdate=date("Y-m-d h:i:s");
        $data=array(
            'tax_name'=>$tax_name,
            'tax_value'=>$tax_value,
            'tax_type'=>$tax_type,
            'tax_cdate'=>$tax_cdate);
        $this->load->model('tax_model');
        $res=$this->tax_model->savetax($data);


        if($res == 1)
        {
            $this->session->set_userdata("setting","Tax saved");
            redirect('settings/tax');
        }
        else
        {
            $this->session->set_userdata("setting","Tax unsaved");
            redirect('settings/tax');
        }
    }


    public function Message($message)
    {
        if($message == 'Tax saved')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong>Company Record Inserted Successfully...</div>';
        }
        elseif ($message == 'Tax unsaved')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>Company Record Does not Inserted Try again...</div>';
        }

        return $mess;
    }




}
?>