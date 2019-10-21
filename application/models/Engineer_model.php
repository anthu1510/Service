<?php
/**
 * Created by PhpStorm.
 * User: Attract-01
 * Date: 12/2/2017
 * Time: 6:28 PM
 */

class Engineer_model extends CI_Model
{
    public function SaveEngineer($data)
    {
        $qry = $this->db->insert("ser_engineer",$data);
        return $qry;
    }

    public function GetById($id)
    {
        $qry = $this->db->get_where("ser_engineer",array('id' => $id));
        return $qry->result();
    }

    public function UpdateEngineer($id,$data)
    {
        $qry = $this->db->update("ser_engineer",$data, array('id' => $id));
        return $qry;
    }
}
?>