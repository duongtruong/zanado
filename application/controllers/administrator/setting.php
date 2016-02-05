<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Setting extends MY_Controller
{
    public $data;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('administrator/Mmoderator');
        $this->data['modes'] = array('0' => 'Administrator','1' => 'Admin', '2' => 'Moderator', '3' => 'Nhóm đăng bài - SEO', '4' => 'Nhóm bán hàng - MARKETER');
    }

    public function index() {
        $data['title'] = 'Update Moderator - Administrator Manager';
        $data['subnav'] = '4';

        $id = intval($this->temp['adm_logged']['admin_id']);

        if (!$id) {
        	show_404();
        	return;
        }
        
        if($this->input->post(NULL, TRUE))
        {
            $data_request = $this->input->post(NULL, TRUE);
            foreach ($data_request as $key => $value) {
                $data_request[$key] = is_string($value) ? trim($value) : $value;
            }

            if ($data_request['fullname'] && $data_request['email'] && $data_request['username']) {
                $dt = array(
                    'fullname' => $data_request['fullname'],
                    'email'    => $data_request['email'],
                    'username' => $data_request['username'],
                    'avatar'   => $data_request['icon']
                );

                if ($data_request['password'] && $data_request['password'] === $data_request['repassword']) {
                    $dt['password'] = $data_request['password'];
                }

                $result = $this->Mmoderator->updateItem($dt, $id);
                if($result)
                {
                    $data['success'] = 1;
                }
                else
                {
                    $data['warning'] = 1;
                }
            }
            else {
                $data['warning'] = 1;
            }
        }


        $data['details'] = $this->Mmoderator->getItem($id);
        $data['details'] = $data['details'][0];
        $data['modes']   = $this->data['modes'];
        $data['page']    ='administrator/pages/moderator/setting';
        $this->load->view('administrator/layout',$data);
    }
}