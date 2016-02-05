<?php
class Mcontact extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
    }

    public function insertItem($data) {
        $result = $this->db->insert('contact', $data);
        $id = $this->db->insert_id();
        if($id)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
}