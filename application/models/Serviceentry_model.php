<?php
/**
 * Created by PhpStorm.
 * User: Attract-01
 * Date: 11/30/2017
 * Time: 6:24 PM
 */

class Serviceentry_model extends CI_Model
{
    public function InsertServiceEntry($data)
    {
        $qry = $this->db->insert('service_entry', $data);

        if($qry == 1)
        {
            return $this->db->insert_id();
        }
        else
        {
            return 0;
        }

    }

    public function InsertServiceEntryGallery($data)
    {
        $qry = $this->db->insert('service_entry_images', $data);
        return $qry;
    }

    public function UpdateCloseDateCompliant($id,$data)
    {
        $qry = $this->db->update("complient", $data, array('id' => $id));
        return $qry;
    }
}
?>