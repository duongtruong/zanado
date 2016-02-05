<?php
class Mlogin extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function check_login($username, $password, $db)
    {
        $this->db_custom = $this->load->database('default', TRUE);
        $this->load->library('PasswordHash', array('iteration_count_log2' => 8, 'portable_hashes' => FALSE));
        
        $result = $this->db_custom->query('Select fullname, id, level, password from admin where (username = "'.$username.'" OR email = "'.$username.'") AND banned < 1');
        if($result->num_rows() == 1)
        {
            $adm = $result->result_array();
            if (!$this->passwordhash->CheckPassword($password, $adm[0]['password'])) {
                return 0;
            }
            return $adm;
        }
        else
        {
            return 0;
        }
    }
}
