<?php
/**
 * Created by PhpStorm.
 * User: Attract-01
 * Date: 12/9/2017
 * Time: 10:59 AM
 */

class Company_model extends CI_Model
{
    public function SaveCompany($data)
    {
        $qry = $this->db->insert("company", $data);
        return $qry;
    }

    public function GetById($id)
    {
        $qry = $this->db->get_where("company", array('comp_id' => $id));
        return $qry->result();
    }

    public function UpdateCompany($id,$data)
    {
        $qry = $this->db->update("company", $data, array('comp_id' => $id));
        return $qry;
    }

    public function SaveUser($data)
    {
        $qry = $this->db->insert("users",$data);
        return $qry;
    }

    public function UpdateUser($id,$data)
    {
        $qry = $this->db->insert("users",$data, array('u_id' => $id));
        return $qry;
    }

    public function UserGetById($id)
    {
        $qry = $this->db->get_where("users", array('u_id' => $id));
        return $qry->result();
    }

    public function DeleteUser($id)
    {
        $qry = $this->db->delete("users", array('u_id' => $id));
        return $qry;
    }

    public function ChangeUserPassword($id,$pass)
    {
        $qry = $this->db->query("UPDATE `users` SET u_password = md5($pass) WHERE u_id = '$id'");
        return $qry;
    }
}
?>