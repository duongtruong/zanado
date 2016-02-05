<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    include_once (dirname(__FILE__) . "/application.php");
    class Register extends Application{        
        
        public $data;
        
        public function __construct(){            
            
            parent::__construct();
            $this->load->model('user_model');
            $this->data['title']="Đăng ký | eShop";
            
       }                     

        public function index(){              
            if($this->auth->loggedin()){
                $this->public_class->redirBack('');
            }        
            if($this->public_class->isPostRequest()){
                return $this->register();
            }
            $this->public_class->redirBack('');
        }
       
        public function register(){            
            if($this->input->is_ajax_request()){
                $data = $this->input->post();
                $ajax = new AjaxResponse();
                if(Public_class::isValidEmail($data['email']) != 1){
                    $ajax->type = AjaxResponse::ERROR;
                    $ajax->element = 'error-email';
                    $ajax->message = 'Email không hợp lệ!';
                    exit($ajax->toString());                   
                }

                $user = $this->db->get_where('users', array('email' => $data['email']));             
                if($user->num_rows() > 0)
                {
                    $ajax->type = AjaxResponse::ERROR;
                    $ajax->element = 'error-email';
                    $ajax->message = 'Email đã tồn tại!';
                    exit($ajax->toString());
                }

                if (Public_class::isValidUsername($data['username']) != 1) {
                    $ajax->type = AjaxResponse::ERROR;
                    $ajax->element = 'error-username';
                    $ajax->message = 'Tên đăng nhập từ 3-15 ký tự và không chứa ký tự đặc biệt!';
                    exit($ajax->toString());
                }
                
                if ($this->_inValidUsername($data['username']) != 1) {
                    $ajax->type = AjaxResponse::ERROR;
                    $ajax->element = 'error-username';
                    $ajax->message = 'Tên đăng nhập này không được sử dụng!';
                    exit($ajax->toString());
                }
                
                $user = $this->db->get_where('users', array('username' => $data['username']));             
                if($user->num_rows() > 0)
                {
                    $ajax->type = AjaxResponse::ERROR;
                    $ajax->element = 'error-username';
                    $ajax->message = 'Tên đăng nhập này đã tồn tại!';
                    exit($ajax->toString());
                }
                if (strlen($data['password']) < 6) {
                    $ajax->type = AjaxResponse::ERROR;
                    $ajax->element = 'error-password';
                    $ajax->message = 'Mật khẩu từ 6 ký tự trở lên!';
                    exit($ajax->toString());
                }                
                if ($data['password'] != $data['repassword']) {
                    $ajax->type = AjaxResponse::ERROR;
                    $ajax->element = 'error-repassword';
                    $ajax->message = 'Mật khẩu xác nhận không khớp!';
                    exit($ajax->toString());
                }                                  
                unset($data['repassword']);
                $data['username'] = strtolower($data['username']);
                
                $id_log = $this->_save($data);
                if($id_log > 0 ){                                      
                    $this->auth->login($id_log, FALSE);              
                    $ajax->type = AjaxResponse::SUCCESS;
                    $ajax->element = 'success';
                    $ajax->message = 'Trong 3-5 phút tới bạn sẽ nhận được một email tới ' . $data['email'] . ' Vui lòng kiểm tra hòm mail để kích hoạt tài khoản. 
                    Rất có thể mail đã bị gửi vào mục Spam/Junk Mail, hãy kiểm tra 2 mục này nếu bạn không thấy mail của chúng tôi. Xin cảm ơn!';
                    exit($ajax->toString());
                }
                
                $ajax->type = AjaxResponse::WARNING;
                $ajax->element = 'WARNING';
                $ajax->message = 'Hiện tại không thể đăng ký, vui lòng liên hệ với bộ phận CSKH để được giúp đỡ!';
                exit($ajax->toString());
            }else {
                exit('Invalid request!') ;
            }
        }
        
        private function _save( $data = array() ){

            unset($data['csrf_test_name']);
            $user = $this->user_model->insert($data);
            $id = $this->db->insert_id();
               if($user){
                return $id;
            }
            return FALSE;
        }

        private function _inValidUsername($username){

            if(!$username || $username==''){
                return false;
            }
            $ban_username = array();

            $ban_username = require_once(FCPATH.'/public/assets/files/ban_username.php');

            if(empty($ban_username)){
                return false;
            }
            
            if(in_array($username,$ban_username)){
                return false;
            }

            return true;
        }
        
        public function check_username(){
            
            if($this->input->is_ajax_request()){
                
                $ajax = new AjaxResponse();
                $nameUser = strtolower($this->input->post('username'));
                
                if ($this->_inValidUsername($nameUser) != true) {
                    $ajax->type = AjaxResponse::ERROR;
                    $ajax->element = 'error-username';
                    $ajax->message = 'Tên đăng nhập này không được sử dụng!';
                    exit($ajax->toString());
                }

                if (Public_class::isValidUsername($nameUser) != 1) {
                    $ajax->type = AjaxResponse::ERROR;
                    $ajax->element = 'error-username';
                    $ajax->message = 'Tên đăng nhập từ 3-15 ký tự và không chứa ký tự đặc biệt!';
                    exit($ajax->toString());                        
                }

                $user = $this->db->get_where('users', array('username' => trim($nameUser))); 

                if($user->num_rows() > 0){
                    $ajax->type = AjaxResponse::ERROR;
                    $ajax->element = 'error-username';
                    $ajax->message = 'Tên đăng nhập này đã tồn tại!';
                    exit($ajax->toString());
                }
                    $ajax->type = AjaxResponse::SUCCESS;                        
                    $ajax->message = 'Tên đăng nhập hợp lệ!';
                    exit($ajax->toString());
            }else{
                exit('Invalid request!') ;
            }
        }                
            
        
    }