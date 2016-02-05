<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    include_once (dirname(__FILE__) . "/application.php");
    class User extends Application{        
        
        public $data;
        
        public function __construct(){
            parent::__construct();
            $this->load->model('user_model');
            $this->load->library('session');
            $this->data['title']="Thông tin tài khoản | eShop";           
        }
       
        public function index(){
            if(!$this->auth->loggedin()){
                $this->public_class->redirect('/404');
            }        
            if($this->public_class->isPostRequest()){
                $ajax      = new AjaxResponse();
                $data      = $this->input->post(NULL, TRUE);
                $dt_update = array(
                    'nickname'  => $data['fullname'],
                    'telephone' => $data['telephone'],
                    'address'   => $data['addr']
                );
                $changepass = FALSE;
                $changed    = FALSE;

                if ($data['current_password']) {
                    $changepass = TRUE;
                    /*Check CurrentPass*/
                    $r_check = $this->user_model->check_password($data['current_password'], $this->data['logger']['password']);
                    /*Set new password if pass*/
                    if ($r_check) {
                        if ($data['password'] === $data['confirmation'] && strlen($data['password']) >= 6) {
                            $dt_update['password'] = $data['password'];
                            $changed = TRUE;
                        }
                    }
                }

                $result = $this->user_model->update($this->data['logger']['id'], $dt_update);

                if($result && $result > 0){
                    $ajax->type = AjaxResponse::SUCCESS;               
                    $ajax->message = 'Cập nhật thông tin thành công';

                    if ($changepass) {
                    
                        if ($changed) {
                            $ajax->type_changepass = 1;
                            $ajax->message_changepass = 'Đã đổi <b>MẬT KHẨU</b>';
                        }else {
                            $ajax->type_changepass = 0;
                            $ajax->message_changepass = 'Quý khách nhập <b>SAI</b> mật khẩu hoặc mật khẩu mới <b>KHÔNG KHỚP</b>';
                        }
                        
                    }

                    $ajax->toString();
                    exit($ajax->toString());
                }else{
                    $ajax->type = AjaxResponse::ERROR;               
                    $ajax->message = 'Có lỗi xảy ra. Vui lòng nhập đúng thông tin!';
                    exit($ajax->toString());
                }
            }
            $this->load->view('frontend/user/index', $this->data);
        }

        public function order() {
            if(!$this->auth->loggedin()){
                $this->public_class->redirect('/404');
            }
            $this->load->model('Morders');
            $this->data['list_item'] = $this->Morders->getAll($this->data['logger']['id']);
            $this->load->view('frontend/user/order', $this->data);
        }

        public function view_order($order_id, $phone) {
            $this->data['title']="Chi tiết đơn hàng | eShop";
            $this->load->model('Morders');
            if ($this->data['detail'] = $this->Morders->getOrder($order_id, $phone)) {

            }
            else {
                $this->public_class->redirect('/404');
            }

            $this->data['template'] = 'frontend/user/detail-order';
            $this->load->view('frontend/layout', $this->data);
        }
    }