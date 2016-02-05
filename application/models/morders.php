<?php
class Morders extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
    }

    public function insertOrder($order) {
        $result = $this->db->insert('`orders`', $order);
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

    public function insertOrderItem($order_items) {
        $this->db->set($order_items);
        $result = $this->db->insert('`order_item`', $order_items);
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

    public function getAll($userId) {
        $this->db->select();
        if ($userId) {
            $this->db->where(array('o.buyer_id' => $userId, 'o.is_delete' => 0));
        }
        else {
            return 0;
        }
        $this->db->join('order_item ot', 'ot.order_id = o.id');
        $this->db->order_by("o.id", "desc");
        $query = $this->db->get('orders o'); /*die(var_dump($this->db->last_query()));*/
        if($query->num_rows() >= 1)
        {
            $result = $query->result_array();
            $x = array();
            foreach ($result as $key => $value) {
                if ($value['status'] == 4) {
                    $result[$key]['status'] = 'Đã hoàn tất';
                }
                else {
                    $result[$key]['status'] = 'Chờ xử lý';
                }
                $result[$key]['id'] = $result[$key]['order_id'];

                $k = array_search($value['order_id'], $x);
                if (!$k) {
                    $x[] = $value['order_id'];
                }
                else {
                    $result[$k]['item_title'] .= '<br><br>' . $result[$key]['item_title'];
                    unset($result[$key]);
                }
            }
            return array_values($result);
        }
        else
        {
            return 0;
        }
    }

    public function getOrder($order_id, $phone) {
        $this->db->select();
        if ($order_id && $phone) {
            $this->db->where(array('o.id' => $order_id, 'o.buyer_phone' => $phone, 'o.is_delete' => 0));
        }
        else {
            return 0;
        }

        $this->db->join('order_item ot', 'ot.order_id = o.id');
        $this->db->order_by("ot.id", "desc");
        $query = $this->db->get('orders o');
        if($query->num_rows() >= 1)
        {
            $result = $query->result_array();
            $x = array();
            foreach ($result as $key => $value) {
                if ($value['status'] == 4) {
                    $result[$key]['status'] = 'Đã hoàn tất';
                }
                else {
                    $result[$key]['status'] = 'Chờ xử lý';
                }
                $result[$key]['id'] = $result[$key]['order_id'];
            }
            return $result;
        }
        else
        {
            return 0;
        }
    }
}