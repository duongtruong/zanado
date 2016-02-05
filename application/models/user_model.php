<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * This is an EXAMPLE user model, edit to match your implementation
 * OR use the adapter model for easy integration with an existing model
 */
class User_model extends MY_Model {
    
    // database table name
    protected $table = 'users'; 
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    /**
     * Add a user, password will be hashed
     * 
     * @param array user
     * @return int id
     */
    public function insert($user) {
        
        $user['password'] = $this->hash($user['password']);
        $user['registered'] = time();
                       
        return $this->_insert($user); 
    }
    
    /**
     * Update a user, password will be hashed
     * 
     * @param int id
     * @param array user
     * @return int id
     */
    public function update($id, $user) {
        // prevent overwriting with a blank password
        if (isset($user['password']) && $user['password']) {
            $user['password'] = $this->hash($user['password']);
        } else {
            unset($user['password']);
        }
        $this->db->where('id', $id);
        
        $this->_update($user);
        return $id;         
    }
    
    /**
     * Delete a user
     * 
     * @param string where
     * @param int value
     * @param string identification field
     */
    public function delete($where, $value = FALSE) {
        if (!$value) {
            $value = $where;
            $where = 'id';
        }
        $this->db->where($where, $value)->delete($this->table);

    }
    
    /**
     * Retrieve a user
     * 
     * @param string where
     * @param int value
     * @param string identification field
     */
    public function get($where, $value = FALSE) {
        if (!$value) {
            $value = $where;
            $where = 'id';
        }
        
        /*if (strpos($value, '@') !== false) {
            $this->db->where('usertype', 0);
        }*/
        
        $user = $this->db->where($where, $value)->get($this->table)->row_array(); /*die(var_dump($this->db->last_query()));*/
        return $user;
    }
    
    /**
     * Get a list of users with pagination options
     * 
     * @param int limit
     * @param int offset
     * @return array users
     */
    public function get_list($limit = FALSE, $offset = FALSE) {
        if ($limit) {
            return $this->db->order_by("username")->limit($limit, $offset)->get($this->table)->result_array();
        } else {
            return $this->db->order_by("username")->get($this->table)->result_array();
        }
    }
    
    /**
     * Check if a user exists
     * 
     * @param string where
     * @param int value
     * @param string identification field
     */
    
    public function exists($where, $value = FALSE) {
        if (!$value) {
            $value = $where;
            $where = 'id';
        }
        
        return $this->db->where($where, $value)->count_all_results($this->table);
    }
    
    /**
     * Password hashing function
     * 
     * @param string $password
     */
    public function hash($password) {
        $this->load->library('PasswordHash', array('iteration_count_log2' => 8, 'portable_hashes' => FALSE));
        
        // hash password
        return $this->passwordhash->HashPassword($password);
    }
    
    /**
     * Compare user input password to stored hash
     * 
     * @param string $password
     * @param string $stored_hash
     */
    public function check_password($password, $stored_hash) {
        $this->load->library('PasswordHash', array('iteration_count_log2' => 8, 'portable_hashes' => FALSE));
        
        // check password
        return $this->passwordhash->CheckPassword($password, $stored_hash);
    }
    
    public function retrieveEmail($email){
        $user = $this->db->get_where($this->table, array('email' => $email));
        if ($user) {             
                    return TRUE;
                }else{
                    return FALSE;
                }
    }
    
    public function get_where($table, $where = array()){
        return $this->db->get_where($table, $where); 
    }

        protected function _beforeSave() {
        parent::_beforeSave();
    }
    protected function _afterSave() {
        parent::_afterSave();
    }
    protected function _beforeDelete() {
        parent::_beforeDelete();
    }
    protected function _afterDelete() {
        parent::_afterDelete();
    }

    public function getNews($number, $offset, $where) {
        $this->db->select('news.id, news.updated_at, news.title, news.slug, news.icon');
        $this->db->where($where);
        $this->db->order_by("news.updated_at", "desc"); 
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
    
}