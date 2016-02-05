<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Moderator extends MY_Controller
{
    public $data;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('administrator/Mmoderator');
        $this->data['modes'] = array('1' => 'Admin', '2' => 'Moderator', '3' => 'Nhóm đăng bài - SEO', '4' => 'Nhóm bán hàng - MARKETER');
    }
    
    public function index()
	{
        $this->load->library('pagination');
	    $data['title'] = 'Moderator page - Administrator Manager';
        $data['subnav'] = '4';

        if($this->input->post(NULL, TRUE))
        {
           $data_request = $this->input->post(NULL, TRUE);
           foreach($data_request['vl_check'] as $k=>$v)
           {
               $this->Mmoderator->deleteItem($v);
           }
           $data['success'] = 1;
        }
        
        if(isset($_GET['g']) && $_GET['g'] == 1)
        {
            $data['success'] = 1;
        }

        // Cấu hình phân trang
        if (count($_GET) > 0) $config['suffix']      = '?' . http_build_query($_GET, '', "&");
        $config['base_url']    = base_url('index.php/administrator/moderator/manager/page');
        $config['first_url']   = $config['base_url'].'/0'.http_build_query($_GET);
        $config['total_rows']  = $this->Mmoderator->count_all();
        $config['per_page']    = 30;
        $config['uri_segment'] = 5;
        
        $this->pagination->initialize($config); 
        $data['list_item']     = $this->Mmoderator->list_all($config['per_page'], $this->uri->segment(5));
        
        $data['modes']         = $this->data['modes'];
        $data['page']          ='administrator/pages/moderator/manager';
	    $this->load->view('administrator/layout', $data);
	}
    
    public function addItem()
    {
        $data['title'] = 'Add new Moderator - Administrator Manager';
        $data['subnav'] = '4';
        if($this->input->post(NULL, TRUE))
        {
            $data_request = $this->input->post(NULL, TRUE);
            foreach ($data_request as $key => $value) {
                $data_request[$key] = is_string($value) ? trim($value) : $value;
            }

            if ($data_request['fullname'] && $data_request['email'] && $data_request['username'] && $data_request['password'] && ($data_request['password'] === $data_request['repassword'])) {
                $dt = array(
					'fullname' => $data_request['fullname'],
					'email'    => $data_request['email'],
					'username' => $data_request['username'],
					'password' => $data_request['password'],
					'avatar'   => $data_request['icon'],
					'level'    => $data_request['level']
                );

                $result = $this->Mmoderator->insertItem($dt);
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
                $data['predata'] = $data_request;
                $data['warning'] = 1;
            }
        }

        $data['modes'] = $this->data['modes'];
        $data['page']  ='administrator/pages/moderator/add';
	    $this->load->view('administrator/layout', $data);
    }
    public function updateItem($id)
    {
        $id = (int)$id;
        $data['title'] = 'Update Moderator - Administrator Manager';
        $data['subnav'] = '4';

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
                    'avatar'   => $data_request['icon'],
                    'level'    => $data_request['level']
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
        $data['page']    ='administrator/pages/moderator/update';
        $this->load->view('administrator/layout',$data);
    } 

    # Function update Active of Category
    public function publish($itemId, $active)
    {
        $dt = array('banned' => $active);

        # Valid data
        if(is_numeric($itemId) && $itemId > 0 && ($active == 0 || $active == 1)) {
            $this->Mmoderator->updateItem($dt, $itemId);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
        else {
            show_404();
        }
    }
}