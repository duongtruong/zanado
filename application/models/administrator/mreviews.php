<?php
class Mreviews extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
    }

    public function insertItem($data) {
        $result = $this->db->insert('item_review', $data);
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
        $result = $this->db->update('item_review', $data);
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
        if($this->db->delete('item_review', array('id' => $id)))
        {
            $this->db->delete('item_review', array('parent_id' => $id));
            return true;
        }
        else
        {
            return false;
        }
    }

    public function count_all($where = NULL){
        if ($where) {
            $this->db->select('id');
            $this->db->where($where);
            $query = $this->db->get('item_review');
            return $query->num_rows();
        }
        else {
            return $this->db->count_all('item_review');
        }
    }

    public function list_all($number, $offset, $where){ 
        $this->db->select();
        $this->db->where($where);
        $this->db->order_by("item_review.id", "desc"); 
        $this->db->group_by("item_review.id"); 
        $query = $this->db->get('item_review', $number, $offset);
        if($query->num_rows() >= 1)
        {
            $rs = $query->result_array();
            return $rs;
        }
        else
        {
            return 0;
        } 
    } 

    public function getItem($id)
    {
        $this->db->where('i_r.id', $id);
        $query =  $this->db->get('item_review i_r');
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