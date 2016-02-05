<?php
class Mcategory extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
    }

    public function getAllTemp() {
        $temp     = $this->db->get('temp');
        $category = $this->db->get('item_category');

        $result = array();
        if($temp->num_rows() >= 1)
        {
            $result['temp'] = $temp->result_array();
        }
        if($category->num_rows() >= 1)
        {
            $result['category'] = $category->result_array();
        }

        return $result;
    }

    public function add_category($data)
    {
        $this->db->db_debug = TRUE;
        $result = $this->db->insert('item_category', $data); 
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

    public function update_category($id, $data)
    {
        $this->db->where('id', $id);
        $result = $this->db->update('item_category', $data);
        if($result)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }
    
    public function delete_category_by_id($id)
    {
        $this->db->db_debug = TRUE;
        if($this->db->delete('item_category', array('id' => $id)))
        {
            return true;
        } 
        else
        {
            return false;
        }
    }
    
    public function get_category()
    {
        $query =  $this->db->get('item_category'); 
        if($query->num_rows() >= 1)
        {
            return $query->result_array();
        }
        else
        {
            return 0;
        } 
    }
    
    public function getCategoryNameById($ids)
    {
        if ($ids) {
            $item_category = '';
            $c_id = explode(',', $ids);
            $i = 0;
            foreach ($c_id as $c) {
                if ($c) {
                    $c_text = '- ';
                    $c1_id = explode('|', $c);
                    foreach ($c1_id as $c1) {
                        if ($c1) {
                            foreach ($this->temp['category'] as $category) {
                                if ($c1 == $category['id']) {
                                    $c_text .= $c_text == '' ? $category['title'] : ' <i class="btn-icon-only icon-chevron-right"> </i> '.$category['title'];
                                }
                            }
                        }
                    }
                    $item_category .= $c_text."<br>";
                    $i++;
                }
            }
            return $item_category;
        }
        return false;
    }
    
    public function getNodeLevel($id)
    {
        $result = $this->db->query('Select level from item_category WHERE id ='.(int)$id);
        if($result->num_rows() >= 1)
        {
            $result = $result->result_array();
            $return = 1;
            foreach($result as $k=>$v)
            {
                $return += $v['level'];
            } 
            return $return;
        }
        else
        {
            return false;
        }
    }
    
    public function get_categoryname_by_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('item_category'); 
        if($query->num_rows() >= 1)
        {
            return $query->result_array();
        }
        else
        {
            return 0;
        } 
    }

    public function check_item_category_active($item_category)
    {
        $Where = '';
        $item_category_EX = explode(',', $item_category);
        $i = 0;
        foreach($item_category_EX as $CategoryName) {
            $Where .= ($i == 0) ? '' : trim($CategoryName) ? ' OR' : '';
            $Where .= trim($CategoryName) ? ' CategoryName = "'.trim($CategoryName).'"' : '';
            $i++;
        }
        $query = $this->db->query('SELECT * FROM (`item_category`) WHERE '.$Where); 
        if($query->num_rows() >= 1)
        {
            $result = $query->result_array();
            foreach ($result as $r) {
                if($r['status'] != 2) {
                    return TRUE;
                }
            }
            return FALSE;
        }
        else
        {
            return TRUE;
        } 
    }

    public function get_details($id)
    {
        $this->db->where('id', $id);
        $query =  $this->db->get('item_category'); 
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