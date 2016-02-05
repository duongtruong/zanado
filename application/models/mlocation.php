<?php
class Mlocation extends MY_Model
{
    protected $_table = 'province';
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
    }

    public function getItems($type = 1, $parentId = '0') {
        $this->db->select();
        if ($type == 2) { /*Quan/Huyen*/
            $this->_table = 'district';
            $this->db->where(array('provinceid' => $parentId));
        }
        elseif ($type == 3) { /*Xa/Phuong*/
            $this->_table = 'ward';
            $this->db->where(array('districtid' => $parentId));
        }

        $query = $this->db->get($this->_table);
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