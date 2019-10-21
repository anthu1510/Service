<?php
/**
 * Created by PhpStorm.
 * User: Ravi
 * Date: 11/14/2017
 * Time: 12:04 PM
 */

class Zone_model extends CI_Model
{
    public function loadState()
    {
        $qry = $this->db->get('state');
        return $qry->result();
    }

    public function GetByStateName($name)
    {
        $qry = $this->db->get_where("state",array("name" => $name ));
        return $qry->result();
    }
}
?>