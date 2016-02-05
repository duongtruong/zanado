<?php
class Mnews extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
    }

    public function insertItem($data) {
    	$result = $this->db->insert('news', $data);
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
        $this->db->where('id', $id);
        $result = $this->db->update('news', $data);
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
        if($this->db->delete('news', array('id' => $id)))
        {
            return true;
        } 
        else
        {
            return false;
        }
    }

    public function count_all(){
        return $this->db->count_all('news'); 
    }

    public function list_all($number, $offset){ 
        $this->db->select();
        
        $this->db->order_by("news.id", "desc"); 
        $this->db->group_by("news.id"); 
        $query = $this->db->get('news', $number, $offset);
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
        $this->db->where('id', $id);
        $query =  $this->db->get('news'); 
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