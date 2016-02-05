<?php

/**
 * @property CI_DB_active_record $db
 *
 */
class MY_model extends CI_Model {

    protected $table = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();        
    }

    public function _insert($data){
        $this->_open();
        
        try {
            $this->_beforeSave();
            $status = $this->db->insert($this->table, $data);        
            $this->_afterSave();
            return $this->db->insert_id();
        }
        catch (\Exception $e) {
            $this->_rollback();
            throw $e;
        }                        
    }

    public function _update($data, $condition = array())
    {
        $this->_open();
        if (!empty($condition) && is_array($condition))
            foreach ($condition as $key => $value)
                if (is_numeric($key))
                    $this->db->where($value);
                else
                    $this->db->where($key, $value);
                
                try {
                    $this->_beforeSave();
                    $this->db->update($this->table, $data);
                    $this->_afterSave();
                    return true;
                }
                catch (\Exception $e) {
                    $this->_rollback();
                    throw $e;
                }                        
    }

    public function _delete($condition)
    {
        $this->_open();
        if (!empty($condition) && is_array($condition))
            foreach ($condition as $key => $value)
                if (is_numeric($key))
                    $this->db->where($value);
                else
                    $this->db->where($key, $value);
                
        try {
            $this->_beforeDelete();
            $this->db->delete($this->table);
            $this->_afterDelete();  
            return true;
        }
        catch (\Exception $e) {
            $this->_rollback();
            throw $e;
        }       
        
    }

    public function _excuteQuery($sql)
    {
        $this->_open();
        $r = $this->db->query($sql);
        if (empty($r) || !is_object($r))
        {
            return NULL;
        }
        return $r->result_array();
    }
    
    private $isConnected = false;

    public function _open()
    {
        if ($this->isConnected)
        {
            if (empty($this->db))
            {
                $CI = & get_instance();
                $CI->load->database();
                $this->db = $CI->db;
            }
            return;
        }
        
        $this->isConnected = true;
        $CI = & get_instance();
        if (empty($CI->db))
        {
            $CI->load->database();
            $this->db = $CI->db;
        }
        
        $this->table = $this->_dbprefix($this->table);
    }

    public function _close()
    {
        if (!empty($this->db))
            $this->db->close();
        $this->isConnected = false;
    }

    public function _dbprefix($table) {
        if (!$this->isConnected)
            $this->_open();
        if (empty($this->db->dbprefix) || startsWith($table, $this->db->dbprefix))
            return $table;
        return $this->db->dbprefix($table);
    }

    public function _beginTransaction()
    {
        $this->db->trans_begin();
    }
    
    public function _finishTransaction()
    {
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
        }
        else
        {
            $this->db->trans_commit();
        }        
    }
    
    public function _commit()
    {
        $this->db->trans_commit(); 
    }
    
    public function _rollback()
    {
        $this->db->trans_rollback();
    }
    
    protected function _beforeSave() {
       
    }
    protected function _afterSave() {
       
    }
    protected function _beforeDelete() {
        
    }
    protected function _afterDelete() {
       
    }
}