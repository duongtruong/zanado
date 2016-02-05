<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Brandes extends MY_Controller
{
    public $data;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('administrator/Mbrandes');
    }
    
    public function index()
	{
        $this->load->library('pagination');
	    $data['title'] = 'Brandes page - Administrator Manager';
        $data['subnav'] = '8';

        if($this->input->post(NULL, TRUE))
        {
           $data_request = $this->input->post(NULL, TRUE);
           foreach($data_request['vl_check'] as $k=>$v)
           {
               $this->Mbrandes->deleteItem($v);
           }
           $data['success'] = 1;
        }
        
        if(isset($_GET['g']) && $_GET['g'] == 1)
        {
            $data['success'] = 1;
        }

        // Cấu hình phân trang
        if (count($_GET) > 0) $config['suffix']      = '?' . http_build_query($_GET, '', "&");
        $config['base_url']    = base_url('index.php/administrator/brandes/manager/page');
        $config['first_url']   = $config['base_url'].'/0'.http_build_query($_GET);
        $config['total_rows']  = $this->Mbrandes->count_all();
        $config['per_page']    = 50;
        $config['uri_segment'] = 5;
        
        $this->pagination->initialize($config); 
        $data['list_item']     = $this->Mbrandes->list_all($config['per_page'], $this->uri->segment(5));
        
        $data['modes']         = $this->data['modes'];
        $data['page']          ='administrator/pages/brandes/manager';
	    $this->load->view('administrator/layout', $data);
	}
    
    public function addItem()
    {
        $data['title'] = 'Add new Brande - Administrator Manager';
        $data['subnav'] = '8';
        if($this->input->post(NULL, TRUE))
        {
            $data_request = $this->input->post(NULL, TRUE);
            foreach ($data_request as $key => $value) {
                $data_request[$key] = is_string($value) ? trim($value) : $value;
            }

            if ($data_request['t_value']) {
                $dt = array(
					't_value' => $data_request['t_value'],
					't_type'    => T_BRANDE
                );

                $result = $this->Mbrandes->insertItem($dt);
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
        $data['page']  ='administrator/pages/brandes/add';
	    $this->load->view('administrator/layout', $data);
    }
    public function updateItem($id)
    {
        $id = (int)$id;
        $data['title'] = 'Update Moderator - Administrator Manager';
        $data['subnav'] = '8';

        if($this->input->post(NULL, TRUE))
        {
            $data_request = $this->input->post(NULL, TRUE);
            foreach ($data_request as $key => $value) {
                $data_request[$key] = is_string($value) ? trim($value) : $value;
            }

            if ($data_request['t_value']) {
                $dt = array(
                    't_value' => $data_request['t_value'],
                    't_type'    => T_BRANDE
                );

                $result = $this->Mbrandes->updateItem($dt, $id);
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


        $data['details'] = $this->Mbrandes->getItem($id);
        $data['details'] = $data['details'][0];
        $data['page']    ='administrator/pages/brandes/update';
        $this->load->view('administrator/layout',$data);
    }
}