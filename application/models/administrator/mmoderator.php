<?php
class Mmoderator extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
    }

    public function insertItem($data) {
    	$this->load->library('PasswordHash', array('iteration_count_log2' => 8, 'portable_hashes' => FALSE));
    	$data['password'] = $this->passwordhash->HashPassword($data['password']);
    	$result = $this->db->insert('admin', $data);
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
        if (isset($data['password']) && $data['password']) {
            $this->load->library('PasswordHash', array('iteration_count_log2' => 8, 'portable_hashes' => FALSE));
            $data['password'] = $this->passwordhash->HashPassword($data['password']);
        }

        $this->db->where('id', $id);
        $result = $this->db->update('admin', $data);
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
        if($this->db->delete('admin', array('id' => $id)))
        {
            return true;
        } 
        else
        {
            return false;
        }
    }

    public function count_all(){
        return $this->db->count_all('admin'); 
    }

    public function list_all($number, $offset){ 
        $this->db->select();
        
        $this->db->order_by("admin.id", "desc"); 
        $this->db->group_by("admin.id"); 
        $query = $this->db->get('admin', $number, $offset);
        if($query->num_rows() >= 1)
        {
            return $query->result_array();
        }
        else
        {
            return 0;
        } 
    } 

    public function list_mods($level){ 
        $this->db->select();
        $this->db->where('level', $level);
        $this->db->order_by("admin.id", "desc"); 
        $this->db->group_by("admin.id"); 
        $query = $this->db->get('admin');
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
        $query =  $this->db->get('admin'); 
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