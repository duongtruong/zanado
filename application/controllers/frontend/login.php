<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    include_once (dirname(__FILE__) . "/application.php");
    class Login extends Application{        
        
        public $data;
        
        public function __construct(){
            parent::__construct();
            $this->load->model('user_model');
            $this->load->library('session');
            $this->data['title']="Đăng nhập | eShop";           
        }
       
        public function index(){
            if($this->auth->loggedin()){
                $this->public_class->redirect('');
            }        
            if($this->public_class->isPostRequest()){
                return $this->signin();                
            }     
            $this->data['template'] = 'login/default';
            $this->load->view('layout/layout',$this->data);
        }
        
        public function signin(){

            if($this->input->is_ajax_request()){
                $data = $this->input->post(NULL, TRUE);
                $ajax = new AjaxResponse();
                $credential = $data['credential'];
                $password = $data['password'];
                $remember = (!empty($data['remember']))?TRUE:FALSE;
                                                      
                $result = $this->auth->_authenticate($credential, $password, $remember);
                 
                if($result && $result > 0){
                    $ajax->type = AjaxResponse::SUCCESS;               
                    $ajax->message = 'Đăng nhập thành công!';
                    $ajax->toString();
                    exit($ajax->toString());
                }else{
                    $ajax->type = AjaxResponse::ERROR;               
                    $ajax->message = 'Email hoặc mật khẩu không chính xác!';
                    exit($ajax->toString());
                }                                     
            }
        }

        public function signout(){
            $this->auth->logout();
            $this->session->sess_destroy();
            $this->public_class->redirect('/');
        }

        ############# Login with Social: Facebook, Google+, Tweet ... ##############
        
        public function loginSocial($social) {
            $social = trim($social);
            /*If loggin with facebook account*/
            if ($social == 'facebook') {
                if ($this->facebook->getUser()) {
                    $profiles = $this->facebook->api('/me/');

                    /*Save auth with Auth libaries {Note: default password with facebook account is ''}*/

                    $result = $this->auth->_authenticate_nopass($profiles['email'], FALSE);

                    if($result && $result > 0){
                        $dkProfiles = array(
                            'username'   => $profiles['id'],
                            'nickname'   => $profiles['first_name'].' '.$profiles['last_name'],
                            'active'     => 1,
                            'usertype'   => 1
                        );
                        $this->user_model->update($result, $dkProfiles);
                    }
                    else {
                        /*Save profiles to db if in db not have this facebook user*/
                        $dkProfiles = array(
                            'username'   => $profiles['id'],
                            'nickname'   => $profiles['first_name'].' '.$profiles['last_name'],
                            'email'      => $profiles['email'],
                            'password'   => '',
                            'registered' => time(),
                            'active'     => 1,
                            'usertype'   => 1,
                            'gender'     => $profiles['gender'] === 'male' ? 0 : 1,
                            'avatar'     => 'http://graph.facebook.com/'.$profiles['id'].'/picture?type=square'
                        );
                        $this->user_model->insert($dkProfiles);

                        /*Save auth*/
                        $this->auth->_authenticate_nopass($profiles['email'], FALSE);
                    }

                    /*Redirect to homepage after login successfully (default)*/
                    $this->public_class->redirect('/');
                }
            }
            elseif ($social == 's') {
                die(json_encode($this->data['logger']));
            }
            $this->public_class->redirect('/');
        }

        public function lostpass() {
            if($this->input->is_ajax_request()){
                $result     = 0; 
                $data       = $this->input->post(NULL, TRUE);
                $ajax       = new AjaxResponse();
                $credential = $data['credential'];
                /*GET user with email*/
                $user       = $this->user_model->get('email', $credential);
                if (!empty($user)) {

                    /*SET NEW PASSWORD*/
                    $newPass = $this->generateRandomString(10);

                    /*SEND MAIL WITH SMTP*/
                    $config = Array(
                        'protocol' => 'smtp',
                        'smtp_host' => 'ssl://smtp.googlemail.com',
                        'smtp_port' => 465,
                        'smtp_user' => 'fanclubcf@gmail.com',
                        'smtp_pass' => 'jechoicena',
                        'mailtype'  => 'html', 
                        'charset'   => 'utf-8'
                    );
                    $this->load->library('email', $config);
                    $this->email->set_newline("\r\n");

                    // Set to, from, message, etc.
                    $this->email->from('fanclubcf@gmail.com', 'ESHOP SUPPORT');
                    $this->email->to($credential); 

                    $this->email->subject('Reset mật khẩu - '.$user['nickname'].' - '.$user['email']);
                    $this->email->message('Mật khẩu mới của quý khách là: <b>'.$newPass.'</b> <br><br> Cảm ơn quý khách đã sử dụng ESHOP <br><br> Website: ' . base_url('/'));
                    $result = $this->email->send();

                    if ($result) {
                        /*UPDATE PASSWORD FOR THIS USER*/
                        $data_update_user = array('password' => $newPass);
                        $this->user_model->update($user['id'], $data_update_user);
                    }
                }

                
                if($result && $result > 0){
                    $ajax->type = AjaxResponse::SUCCESS;               
                    $ajax->message = 'Vui lòng kiểm tra hộp thư email <b>'.$credential.'</b>. Xin cám ơn!';
                    $ajax->toString();
                    exit($ajax->toString());
                }else{
                    $ajax->type = AjaxResponse::ERROR;               
                    $ajax->message = 'Không tìm thấy thông tin email <b>'.$credential.'</b>. Xin cám ơn!';
                    exit($ajax->toString());
                }                                     
            }
        }
    }