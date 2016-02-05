<?php
class Morders extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
    }

    public function updateItem($data, $id)
    {
        $this->db->where('id', $id);
        $result = $this->db->update('orders', $data);
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
        if($this->db->delete('orders', array('id' => $id)))
        {
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
            $query = $this->db->get('orders');
            return $query->num_rows();
        }
        else {
            return $this->db->count_all('orders');
        }
    }

    public function list_all($number, $offset, $where){ 
        $this->db->select();
        $this->db->where($where);
        $this->db->order_by("orders.id", "desc"); 
        $this->db->group_by("orders.id"); 
        $query = $this->db->get('orders', $number, $offset);
        if($query->num_rows() >= 1)
        {
            $rs = $query->result_array();
            foreach ($rs as $key => $value) {
                if ($value['status'] == 1) {
                    $this->db->select('fullname');
                    $this->db->where('id', $value['mod_view']);
                    $mod = $this->db->get('admin');

                    if ($mod->num_rows() == 1) {
                        $r = $mod->result_array();
                        $rs[$key]['mod_view'] = $r[0]['fullname'];
                    }
                }

                $this->db->select('fullname');
                $this->db->where('id', $value['mod_id']);
                $mod = $this->db->get('admin');

                if ($mod->num_rows() == 1) {
                    $r = $mod->result_array();
                    $rs[$key]['mod_name'] = $r[0]['fullname'];
                }
            }
            return $rs;
        }
        else
        {
            return 0;
        } 
    } 

    public function getItem($id)
    {
        $this->db->join('order_item ot', 'ot.order_id = o.id');
        $this->db->order_by("o.id", "desc");
        $this->db->where('o.id', $id);
        $query =  $this->db->get('orders o');
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