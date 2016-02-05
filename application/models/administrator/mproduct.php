<?php
class Mproduct extends CI_Model
{
    public $temp;
    public $type;
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
    }
    
    public function count_all(){
        return $this->db->count_all('item'); 
    }
    
    public function count_all_search($page, $value, $currentUrl = ''){
        
        if($page == 'news')
        {
            $this->db->select('id');
            $this->db->where("(title like '%$value%' OR sort_description LIKE '%$value%')");
            $query =  $this->db->get('news');
        }
        elseif($page == 'orders')
        {
            $this->db->select('id');
            $this->db->where("(ComposerName like '%$value%')");
            $query =  $this->db->get('composers');
        }
        else
        {
            $this->db->select('id');
            if (strpos($currentUrl, '&o=0') !== FALSE) {
                $this->db->where('type', 0);
            }
            elseif (strpos($currentUrl, '&o=1') !== FALSE) {
                $this->db->where('type', 1);
            }
            $this->db->where("(title like '%$value%')");
            $query =  $this->db->get('item');
        }
         
        if($query->num_rows() >= 1)
        {
            return $query->num_rows();
        }
        else
        {
            return 0;
        } 
    }
    
    public function count_all_item_category($id){
        $this->db->select('item.id');
        $this->db->like('item.category_id', $id);
        $query =  $this->db->get('item'); 
        if($query->num_rows() >= 1)
        {
            return $query->num_rows();
        }
        else
        {
            return 0;
        }
    }
    
    
    public function list_all($number, $offset){ 
        $this->db->select('item.*');
        
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
    
    public function list_all_item_category($number, $offset, $id){ 
        $this->db->select('item.*');
        $this->db->like('item.category_id', $id);
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
        
    public function insertItem($data)
    {
        $this->db->db_debug = FALSE;
        $this->db->set($data);
        $this->db->insert('item', $data);
        return $this->db->insert_id();
    }
    
    public function update_filename_item($data, $itemId)
    {
        $result = $this->db->query('UPDATE item SET images = CONCAT(images, "|'.$data.'") where id ='.(int)$itemId);
        //die(var_dump($this->db->last_query())); 
        if($result->num_rows() >= 1)
        {
            return $result->result_array();
        }
        else
        {
            return 0;
        }
    }
    
    public function updateItem($data, $itemId)
    {
        if (isset($data['images'])) {
            $this->update_filename_item($data['images'], $itemId);
            unset($data['images']);
        }

        if(empty($data)) {
            return FALSE;
        }

        $this->db->where('id', $itemId);
        $result = $this->db->update('item', $data); //die(var_dump($this->db->last_query())); 
        if($result)
            return true;
        else
            return false;
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
    
    public function deleteItem($id)
    {
        if($this->db->delete('item', array('id' => $id)))
        {
            $this->session->unset_userdata('total_item');
            return true;
        } 
        else
        {
            return false;
        }
    }
    
    public function check_name_unique($name)
    {
        $query = $this->db->get_where('item',array('item.title' => $name));
        
        if($query->num_rows() >= 1)
        {
            $result = $query->result_array();
            return $result[0]['id'];
        }
    }
    
    public function delete_file_item($imgName, $itemId)
    {
        $targetDir = IMAGE_UPLOAD_PATH . '/products/';
        $this->db->select('images');
        $query     = $this->db->get_where('item',array('id'=>$itemId));
        if($query->num_rows() >= 1)
        {
            $result = $this->db->query('UPDATE item SET images = REPLACE(images, "|'.$imgName.'", "") where id ='.(int)$itemId);

            if ($this->db->affected_rows()) {
                /*Delete files ?*/
                $infos = pathinfo($imgName);
                $files = glob($targetDir.$infos['dirname'].'/*'.$infos['filename'].'*');
                foreach ($files as $key => $link) {
                    unlink($link);
                }
                return TRUE;
            }
            else {
                return FALSE;
            }
        }
        else {
            return FALSE;
        }
    }

    public function insertTemps($temp, $type) {
        if ($temp) {
            $result = array();
            foreach ($temp as $t) {
                if (trim($t)) {
                    $t = trim($t);
                    $dt = array (
                        't_value' => $t,
                        't_type'  => $type
                    );

                    $this->db->where(array('t_value' => $t, 't_type' => $type));
                    $c = $this->db->get('temp');
                    if ($c->num_rows() >= 1) {
                        $r = $c->result_array();
                        $result[] = $r[0]['id'];
                    }
                    else {
                        if (!is_numeric($t)) {
                            $this->db->set($dt);
                            $this->db->insert('temp', $data);
                            $result[] = $this->db->insert_id();
                        }
                    }
                }
            }
            return $result;
        }
        return FALSE;
    }
}
