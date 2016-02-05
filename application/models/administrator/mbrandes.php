<?php
class Mbrandes extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
    }

    public function insertItem($data) {
    	$result = $this->db->insert('temp', $data);
    	$id = $this->db->insert_id();
        if($id)
        {
            return $id;
        }
        else
        {
            return false;
        }
    }

    public function updateItem($data, $id)
    {
        $this->db->where('t_type', T_BRANDE);
        $this->db->where('id', $id);
        $result = $this->db->update('temp', $data);
        if($result)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function deleteItem($id)
    {
        $this->db->db_debug = TRUE;
        if($this->db->delete('temp', array('id' => $id)))
        {
            return true;
        } 
        else
        {
            return false;
        }
    }

    public function count_all(){
        $this->db->select('id');
        $this->db->where('t_type', T_BRANDE);
        $query = $this->db->get('temp');
        return $query->num_rows(); 
    }

    public function list_all($number, $offset){ 
        $this->db->select();
        $this->db->where('t_type', T_BRANDE);
        $this->db->order_by("temp.t_value", "asc");
        $query = $this->db->get('temp', $number, $offset);
        if($query->num_rows() >= 1)
        {
            return $query->result_array();
        }
        else
        {
            return 0;
        } 
    }

    public function getItem($id)
    {
        $this->db->where('t_type', T_BRANDE);
        $this->db->where('id', $id);
        $query =  $this->db->get('temp'); 
        if($query->num_rows() >= 1)
        {
            return $query->result_array();
        }
        else
        {
            return 0;
        } 
    }
}