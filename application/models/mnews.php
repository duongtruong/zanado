<?php
class Mnews extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
    }

    public function count_all($pId){
    	$this->db->select('id');
    	if ($pId) {
    		$this->db->where(array('type' => $pId));
    	}
        $this->db->where(array('status' => 1, 'published_at <' => time()));
        $query = $this->db->get('news');
        if($query->num_rows() >= 1)
        {
            return $query->num_rows();
        }
        else
        {
            return 0;
        }
    }

    public function list_all($number, $offset, $pId){ 
        $this->db->select('id, title, slug, icon, views, sort_description');
        if ($pId) {
    		$this->db->where(array('type' => $pId));
    	}
        $this->db->where(array('status' => 1, 'published_at <' => time()));
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
        	$result = $query->result_array();
            return $result[0];
        }
        else
        {
            return 0;
        } 
    }

    public function _updateViews($id) {
    	$this->db->set('views', '`views`+1', FALSE);
    	$this->db->where('id', $id);
        $this->db->update('news');
    }
}