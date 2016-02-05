<?php
class Mproduct extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
    }

    public function count_all($pId, $where, $like){
        $this->db->select('id');
        if ($where) {
            $this->db->where($where);
        }
        if ($like) {
            $this->db->like($like);
        }

        $this->db->where(array('status' => 1));
        $query = $this->db->get('item');
        if($query->num_rows() >= 1)
        {
            return $query->num_rows();
        }
        else
        {
            return 0;
        }
    }

    public function getItems($where, $like,  $number, $offset) { 
        $this->db->select('id, title, is_hot, deal, buy_price, images, rateCount, ratePoint, type');
        if ($like) {
            $this->db->like($like);
        }
        if ($where) {
            $this->db->where($where);
        }
        $this->db->order_by("item.id", "desc"); 
        $this->db->group_by("item.id"); 
        $query = $this->db->get('item', $number, $offset);
        if($query->num_rows() >= 1)
        {
            return $query->result_array();
        }
        else
        {
            return 0;
        } 
    }

    public function getItemsRelated($where, $related,  $number, $offset) { 
        $this->db->select('id, title, is_hot, deal, buy_price, images, rateCount, ratePoint, type');
        if (is_array($related) && !empty($related)) {
            
        }
        if ($where) {
            $this->db->where($where);
        }
        $this->db->order_by("item.id", "desc"); 
        $this->db->group_by("item.id"); 
        $query = $this->db->get('item', $number, $offset);
        if($query->num_rows() >= 1)
        {
            return $query->result_array();
        }
        else
        {
            return 0;
        } 
    }
    
    public function list_all_item_category($number, $offset, $id, $sort, $where, $like){ 
        $this->db->select('item.*');
        if ($like) {
            $this->db->like($like);
        }
        if ($where) {
            $this->db->where($where);
        }
        $this->db->where(array('status' => 1));
        $this->db->order_by($sort);
        $this->db->group_by("item.id"); 
        $query = $this->db->get('item', $number, $offset);/* echo (var_dump($this->db->last_query()));*/
        if($query->num_rows() >= 1)
        {
            return $query->result_array();
        }
        else
        {
            return 0;
        }
    } 
    
    public function list_all_search($number, $offset, $page, $value, $currentUrl = ''){ 
        
        if($page == 'news')
        {
            $this->db->select();
            $this->db->where('id >1');
            $this->db->where("(title like '%$value%' OR sort_description LIKE '%$value%')");
            $this->db->order_by("news.id", "desc"); 
            $query = $this->db->get('news',$number,$offset); 
        }
        elseif($page == 'composer')
        {
            $this->db->select();
            $this->db->where('ComposerId >1');
            $this->db->where('ComposerName like"%'.$value.'%"');
            $this->db->order_by("composers.ComposerId", "desc"); 
            $query = $this->db->get('composers',$number,$offset); 
        }
        else
        {
            $this->db->select('item.*');
            $this->db->where('item.title like"%'.$value.'%"');
            if (strpos($currentUrl, '&o=0') !== FALSE) {
                $this->db->where('type', 0);
            }
            elseif (strpos($currentUrl, '&o=1') !== FALSE) {
                $this->db->where('type', 1);
            }
            $this->db->order_by("item.id", "desc"); 
            $this->db->group_by("item.id"); 
            $query = $this->db->get('item',$number,$offset); 
        }
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
        $this->db->select('item.*');
        $query = $this->db->get_where('item',array('item.id'=>$id));
        if($query->num_rows() >= 1)
        {
            return $query->result_array();
        }
        else
        {
            return 0;
        }
    }

    public function getReviews($id)
    {
        $this->db->select('item_review.*');
        $this->db->order_by('item_review.id', 'desc');
        $query = $this->db->get_where('item_review',array('item_review.item_id'=>$id));
        if($query->num_rows() >= 1)
        {
            return $query->result_array();
        }
        else
        {
            return 0;
        }
    }

    public function _updateViews($id) {
        $this->db->set('view_num', '`view_num`+1', FALSE);
        $this->db->where('id', $id);
        $this->db->update('item');
    }

    public function _updateAmout($id, $type, $qty) {
        if ($type == 1) { /*Up*/
            $this->db->set('amount', '`amount`+'.$qty, FALSE);
        }
        else { /*Down*/
            $this->db->set('amount', '`amount`-'.$qty, FALSE);
        }
        
        $this->db->where('id', $id);
        $this->db->update('item');
    }
}
