<?php
class Mreview extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
    }

    public function insertItem($data) {
        $result = $this->db->insert('item_review', $data);
        $itemId = $this->db->insert_id();
        if($itemId)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function rate($point, $itemId) {
        $this->db->select('rateCount, ratePoint');
        $this->db->where(array('id' => $itemId));
        $query = $this->db->get('item');
        
        if ($query->num_rows() == 1) {
            $params   = $query->result_array();
            $oldpoint = floatval($params[0]['ratePoint']);
            $oldcount = intval($params[0]['rateCount']);
            $count    = $oldcount + 1;
            $dt = array(
                'rateCount' => $count,
                'ratePoint' => (($oldcount*$oldpoint) + $point)/$count
            );

            $this->db->where('id', $itemId);
            $result = $this->db->update('item', $dt);
        }
    }

    public function getItem($itemId)
    {
        $this->db->order_by('created_at', 'desc');
        $this->db->where('item_id', $itemId);
        $query =  $this->db->get('item_review'); 
        if($query->num_rows() >= 1)
        {
            $result = $query->result_array();
            return $result[0];
        }
        else
        {
            return 0;
        } 
    }
}