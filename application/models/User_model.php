<?php
/**
 * Created by PhpStorm.
 * User: Ravi
 * Date: 11/14/2017
 * Time: 11:26 AM
 */

class User_model extends CI_Model
{
    public function Login($data)
    {
        $uname = $data['username'];
        $upass = $data['password'];

            $this->db->select('u_id,eng_id,u_name,u_email,u_mobile,u_role,u_cdate,u_udate,status');
            $this->db->from('users');
            $this->db->where('u_email', $uname);
            $this->db->where('u_password', md5($upass));
            $this->db->where('status', 'active');
            $qry = $this->db->get();

        if($qry->num_rows()==1)
        {
            return $qry->result();
        }
        else
        {
            return 0;
        }
    }

    public function UpdateProfile($data,$id)
    {
        $this->db->set('u_name', $data['u_name']);
        $this->db->set('u_email', $data['u_name']);
        $this->db->where('u_id',$id);
        $qry = $this->db->update("users");
        return $qry;
    }

    public function VerifyPassword($pass)
    {
       $qry = $this->db->query("SELECT * FROM `users` WHERE `u_password` = md5('$pass')");

        if($qry->num_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function ChangePassword($pass,$id)
    {
        $this->db->set('u_password',md5($pass));
        $this->db->where('u_id',$id);
        $qry = $this->db->update("users");
        return $qry;
    }

    public function UpdateStatus($id)
    {
        $qry1 = $this->db->get_where("users", array('u_id' => $id));
        $res1 = $qry1->result();

        if($res1[0]->status == 'active')
        {
           return $qry = $this->db->query("UPDATE `users` SET `status` = 'inactive' WHERE `u_id` = '$id'");
        }
        else
        {
            return $qry = $this->db->query("UPDATE `users` SET `status` = 'active' WHERE `u_id` = '$id'");
        }
    }
}
?>