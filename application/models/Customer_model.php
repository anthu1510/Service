<?php
/**
 * Created by PhpStorm.
 * User: Attract-01
 * Date: 11/24/2017
 * Time: 4:26 PM
 */

class Customer_model extends CI_Model
{
    public function SaveCustomer($data)
    {
        $qry = $this->db->insert("customer",$data);
        return $qry;
    }

    public function EditCustomer($id)
    {
        $qry = $this->db->get_where("customer", array('cus_id' => $id));
        return $qry->result();
    }

    public function UpdateCustomer($data,$id)
    {
        $qry = $this->db->update('customer'.$data, array('cus_id' => $id));
        return $qry;
    }
}
?>