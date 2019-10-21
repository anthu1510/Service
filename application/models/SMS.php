<?php
/**
 * Created by PhpStorm.
 * User: Ravi
 * Date: 06-12-2017
 * Time: 10:06
 */

class SMS extends CI_Model
{

    var $number;
    var $message;
    var $url;

    public function  __construct()
    {
        $this->url="http://smsbulk.attractsoftware.com/api/sendmsg.php?user=oom&pass=cravindr76612&sender=ORANGE&phone=#NUMBER#&text=#MESSAGE#&priority=ndnd&stype=normal";
    }

    public  static  function sendSMS($number,$message)
    {
        $ins=new self();
        $ins->number=$number;
        $ins->message=urlencode($message);
        $ins->url=str_replace("#NUMBER#",$ins->number,$ins->url);
        $ins->url=str_replace("#MESSAGE#",$ins->message,$ins->url);

        //$response = file_get_contents($ins->url);
        $response =$ins->url_get_contents($ins->url);

        if( $response)
        {
            return "success";
        }

    }

    public   function Send()
    {

        $this->url=str_replace("#NUMBER#",$this->number,$this->url);
        $message=urlencode($this->message);
        $this->url=str_replace("#MESSAGE#",$message,$this->url);
        $response = file_get_contents($this->url);
        //return $response;
        if( $response)
        {
            return "success";
        }

    }


    public function url_get_contents ($Url) {
        if (!function_exists('curl_init')){
            die('CURL is not installed!');
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $Url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }


    public static function ComplientRegistration($complientId)
    {
        $ins=new self();

        $qry=$ins->db->query("SELECT  cu.cus_mobile1 AS `mobile`,cu.cus_name AS `name` FROM complient co JOIN customer cu ON (cu.cus_id=co.cus_id)
                              WHERE co.id='$complientId'");
        $res=$qry->result();

        $mobile=$res[0]->mobile;
        $name=$res[0]->name;

        $qry=$ins->db->get("sms");
        $res=$qry->result();
        $message=$res[0]->reg_client;
        $ins->sendSMS($mobile,$message);

    }

    public static function ClientServiceAlert($complientId)
    {
        $ins=new self();

        $qry=$ins->db->query("SELECT  cu.cus_mobile1 AS `mobile`,cu.cus_name AS `name` FROM complient co JOIN customer cu ON (cu.cus_id=co.cus_id)
                              WHERE co.id='$complientId'");
        $res=$qry->result();
        $mobile=$res[0]->mobile;
        $name=$res[0]->name;

        $qry=$ins->db->get("sms");
        $res=$qry->result();
        $message=$res[0]->service_alert_client;
        $ins->sendSMS($mobile,$message);

    }
    public static function ClientServiceCloser($complientId)
    {
        $ins=new self();

        $qry=$ins->db->query("SELECT  cu.cus_mobile1 AS `mobile`,cu.cus_name AS `name` FROM complient co JOIN customer cu ON (cu.cus_id=co.cus_id)
                              WHERE co.id='$complientId'");
        $res=$qry->result();
        $mobile=$res[0]->mobile;
        $name=$res[0]->name;

        $qry=$ins->db->get("sms");
        $res=$qry->result();
        $message=$res[0]->service_closer_client;
        $ins->sendSMS($mobile,$message);

    }

    public static function CompliantAlloted($complientId)
    {
        $ins=new self();

        $qry=$ins->db->query("SELECT  cu.cus_mobile1 AS `mobile`,cu.cus_name AS `name`, ser.mobile FROM complient co JOIN customer cu ON (cu.cus_id=co.cus_id) 
                              JOIN ser_engineer AS ser ON (ser.id = co.engineer_id)
                              WHERE co.id='$complientId'");
        $res=$qry->result();
        $mobile=$res[0]->mobile;
        $name=$res[0]->name;

        $qry=$ins->db->get("sms");
        $res=$qry->result();
        $message=$res[0]->service_alert_engineer;
        $ins->sendSMS($mobile,$message);

    }

    public static function GetEngineerById($id)
    {
        $ins = new self();

        $qry = $ins->db->get_where("ser_engineer",array('id' => $id));
        return $qry->result();

    }




}