<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once(APPPATH.'core/MY_Email.php');
class User_mail extends MY_Email{
    
    protected $CI;     	
    public $templatePath;
    private $_vars = array();
    private $_ext = '.phtml';
    
    function __construct(){
       parent::__construct();
    }
    
    function sendEmailActive($username, $email, $link, $fullname){
        
        if(!$username || !$email|| !$link || !$fullname){
            return false;
        }
        
        $data =  array(
            'fullname' => $fullname,
            'link' => $link,
            'username' => $username,
            'email' => $email
        );
        
        $subject       = "Yêu cầu kích hoạt tài khoản DongKyORG";
        $this->ci      = & get_instance();
        $template      = ROOT_PATH.'/application/modules/home/views/email/verify';       
        $temp          = $this->render($template, $data);
        /*$from_sender   = "tatashop.net@gmail.com";
        $name_sender   = "tatashop";
        $from_reply_to = "duongvantruongdk@gmail.com";*/
        $mail = array(
            "to_receiver"   => $email,
            "message"       => $temp,
            "subject_sender" => $subject,
            /*"from_sender" => $from_sender,
            "name_sender" => $name_sender,
            "from_reply_to" => $from_reply_to,*/
        );
        
        $this->config($mail);        
        $this->sendmail();
     }
     
     
    public function render($file, $vars = null) {
        if (is_array($vars)) {
                $this->assign($vars);			
        }

        return $this->_render($file);
    }   
     
    public function assign($var, $value = null) {
        if (is_string($var)) {
                if ($var == '') {
                        return false;
                }
                $this->_vars[$var] = $value;
                return true;
        }
        else if (is_array($var)) {
                $this->_vars = array_merge($this->_vars, $var);
                return true;
        }

    }
        
    private function _render($file) {
        if (!file_exists($temFile = $this->templatePath .$file .$this->_ext)) {
                return FALSE;
        }

        extract($this->_vars, EXTR_SKIP);						
        ob_start();
        include $temFile;
        $ouput = ob_get_clean();
        return $ouput;		
    }
    
    
}