<?php
/**
 * Created by PhpStorm.
 * User: Ravi
 * Date: 27-11-2017
 * Time: 12:48
 */
require_once(APPPATH."models/SMS.php");
class Service_model extends CI_Model
{

    public function getComplinetById($id)
    {
        //$qry=$this->db->get_where('complient',array('id'=>$id));
        $this->db->select('*');
        $this->db->from('complient');
        $this->db->join('customer','complient.cus_id=customer.cus_id');
        $this->db->where(array('complient.id'=>$id)); // mention only fields not table
        $qry=$this->db->get();

        return $qry->result();

    }

    public function GetByStateName($name)
    {
        $qry = $this->db->get_where("state",array("name" => $name ));
        return $qry->result();
    }

    public function getStatus()
    {

        $qry=$this->db->get("service_status");
        return $qry->result();
    }

    public function CompliantSave($data)
    {
        $qry = $this->db->insert("complient", $data);
        $id= $this->db->insert_id();
        SMS::ComplientRegistration($id);
        return $qry;
    }

    public function CompliantUpdate($id,$data)
    {
        $qry = $this->db->update("complient",$data, array('id' => $id));
        return $qry;
    }

    public function Status_Update($id,$status)
    {
       $data= array('complient_status'=>$status);
        $this->db->where('id',$id);
        $this->db->update('complient',$data);
    }

    public function LoadEngineer()
    {
        $qry=$this->db->get("ser_engineer");
        return $qry->result();
    }

    public  function AllocateEngineer($enginner_id,$coplient_list)
    {
        $a = explode(",",$coplient_list);
        $count = count($a);
        $message = "Admin Allortted '$count' calls for you.. check your login";

        $data= array('engineer_id'=>$enginner_id,'complient_status'=>'Allocated');
        //print_r(split(",",$coplient_list),0);exit;
        $this->db->where_in('id', explode(",",$coplient_list),0);
        $qry = $this->db->update('complient',$data);

        if($qry == 1)
        {
            $res = SMS::GetEngineerById($enginner_id);
            SMS::sendSMS($res[0]->mobile,$message);
        }

        //echo $this->db->last_query();exit;

    }

    public function ServiceHistory($id)
    {
        $qry = $this->db->query(
            "SELECT
                  co.complient_title,
                  co.complient_desc,
                  co.ser_date,
                  co.close_date,
                  ser_en.ser_title,
                  ser_en.ser_desc,
                  ser_eng.name,
                  ser_en.ser_id
                  FROM service_entry AS ser_en
                  LEFT JOIN complient AS  co ON (ser_en.comp_id = co.id)
                  LEFT JOIN ser_engineer AS ser_eng ON (co.engineer_id = ser_eng.id)
                  WHERE ser_en.comp_id = '$id'"
        );

        return $qry->result();
    }

   public function HistoryImages($id)
   {
       $qry = $this->db->get_where("service_entry_images",array('ser_id' => $id));
       return $qry->result();
   }


}