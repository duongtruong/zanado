<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class News extends MY_Controller
{
    public $data;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('administrator/Mnews');
        $this->data['types'] = array('1' => 'Khuyến mãi', '2' => 'Thông báo', '3' => 'Xu hướng', '4' => 'Mặc đẹp');
    }
    
    public function index()
	{
        $this->load->library('pagination');
	    $data['title'] = 'News page - Administrator Manager';
        $data['subnav'] = '5';

        if($this->input->post(NULL, TRUE))
        {
           $data_request = $this->input->post(NULL, TRUE);
           foreach($data_request['vl_check'] as $k=>$v)
           {
               $this->Mnews->deleteItem($v);
           }
           $data['success'] = 1;
        }
        
        if(isset($_GET['g']) && $_GET['g'] == 1)
        {
            $data['success'] = 1;
        }

        // Cấu hình phân trang
        if (count($_GET) > 0) $config['suffix']      = '?' . http_build_query($_GET, '', "&");
        $config['base_url']    = base_url('index.php/administrator/news/manager/page');
        $config['first_url']   = $config['base_url'].'/0'.http_build_query($_GET);
        $config['total_rows']  = $this->Mnews->count_all();
        $config['per_page']    = 30;
        $config['uri_segment'] = 5;
        
        $this->pagination->initialize($config); 
        $data['list_item']     = $this->Mnews->list_all($config['per_page'], $this->uri->segment(5));
        
        $data['types']         = $this->data['types'];
        $data['page']          ='administrator/pages/news/manager';
	    $this->load->view('administrator/layout', $data);
	}
    
    public function addItem()
    {
        $data['title'] = 'Add new News - Administrator Manager';
        $data['subnav'] = '5';
        if($this->input->post(NULL, TRUE))
        {
            $data_request = $this->input->post(NULL, TRUE);
            foreach ($data_request as $key => $value) {
                $data_request[$key] = is_string($value) ? trim($value) : $value;
            }

            if ($data_request['newsname'] && $data_request['p_sortdesc'] && $data_request['p_fulldesc']) {
                $dt = array(
                    'title'            => $data_request['newsname'],
                    'slug'             => $this->vn_str_filter($data_request['newsname']),
                    'sort_description' => $data_request['p_sortdesc'],
                    'description'      => urlencode($data_request['p_fulldesc']),
                    'status'           => $data_request['status'],
                    'type'             => $data_request['type'],
                    'created_at'       => time(),
                    'created_by'       => $this->temp['adm_logged']['admin'],
                    'updated_at'       => time(),
                    'updated_by'       => $this->temp['adm_logged']['admin'],
                    'source'           => $data_request['source'],
                    'published_at'     => strtotime(str_replace('/', '-', $data_request['publishAt'])),
                    'icon'             => $data_request['icon']
                );
                $result = $this->Mnews->insertItem($dt);
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

        $data['types'] = $this->data['types'];
        $data['page']  ='administrator/pages/news/add';
	    $this->load->view('administrator/layout', $data);
    }
    public function updateItem($id)
    {
        $id = (int)$id;
        $data['title'] = 'Update News - Administrator Manager';
        $data['subnav'] = '5';

        if($this->input->post(NULL, TRUE))
        {
            $data_request = $this->input->post(NULL, TRUE);
            foreach ($data_request as $key => $value) {
                $data_request[$key] = is_string($value) ? trim($value) : $value;
            }
            if ($data_request['newsname'] && $data_request['p_sortdesc'] && $data_request['p_fulldesc']) {
                $dt = array(
                    'title'            => $data_request['newsname'],
                    'slug'             => $this->vn_str_filter($data_request['newsname']),
                    'sort_description' => $data_request['p_sortdesc'],
                    'description'      => urlencode($data_request['p_fulldesc']),
                    'status'           => $data_request['status'],
                    'type'             => $data_request['type'],
                    'created_at'       => time(),
                    'created_by'       => $this->temp['adm_logged']['admin'],
                    'updated_at'       => time(),
                    'updated_by'       => $this->temp['adm_logged']['admin'],
                    'source'           => $data_request['source'],
                    'published_at'     => strtotime(str_replace('/', '-', $data_request['publishAt'])),
                    'icon'             => $data_request['icon']
                );

                $result = $this->Mnews->updateItem($dt, $id);
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


        $data['details'] = $this->Mnews->getItem($id);
        $data['details'] = $data['details'][0];
        $data['types']   = $this->data['types'];
        $data['page']    ='administrator/pages/news/update';
        $this->load->view('administrator/layout',$data);
    } 

    # Function update Active of Category
    public function publish($itemId, $active)
    {
        $dt = array('status' => $active, 'updated_at' => time(), 'updated_by' => $this->temp['adm_logged']['admin']);

        # Valid data
        if(is_numeric($itemId) && $itemId > 0 && ($active == 0 || $active == 1)) {
            $this->Mnews->updateItem($dt, $itemId);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
        else {
            show_404();
        }
    }
}