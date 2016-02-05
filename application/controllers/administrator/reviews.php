<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Reviews extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library(array('session'));
    	$this->load->model('administrator/Mreviews');
        $this->load->model('administrator/Mproduct');
    }

    public function index() {
    	$this->load->library('pagination');
	    $data['title'] = 'Reviews page - Administrator Manager';
        $data['subnav'] = '9'; $where = array();

        if($this->input->post(NULL, TRUE))
        {
            $data_request = $this->input->post(NULL, TRUE);
            foreach($data_request['vl_check'] as $k=>$v)
            {
               $this->Mreviews->deleteItem($v);
            }
 
            if (isset($data_request['reply-comment']) && $data_request['reply-comment']) {
                $dt = array(
                    'item_id'    => $data_request['item_id'],
                    'fullname'   => $this->temp['adm_logged']['admin'],
                    'email'      => '',
                    'phone'      => '',
                    'created_at' => time(),
                    'point'      => 0,
                    'comment'    => $data_request['reply-comment'],
                    'status'     => 1,
                    'parent_id'  => $data_request['parent_id']
                );

                $this->Mreviews->insertItem($dt);
            }
            $data['success'] = 1;
        }
        
        if(isset($_GET['g']) && $_GET['g'] == 1)
        {
            $data['success'] = 1;
        }

        if ($GET = $this->input->get(NULL, TRUE)) {
        	$GET['s'] = str_replace('/', '-', $GET['s']);
            $GET['e'] = str_replace('/', '-', $GET['e']);

        	if (isset($GET['s']) && $GET['s'] && preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}$/", date('d-m-Y', strtotime($GET['s'])))) {
        		$s = strtotime($GET['s']);
        	}
        	if (isset($GET['e']) && $GET['e'] && preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}$/", date('d-m-Y', strtotime($GET['e'])))) {
        		$e = strtotime($GET['e']);
        	}

        	if ($s <= $e)
    		{
    			$where['created_at >='] = $s ? $s : 0;

                if ($e) {
                    $where['created_at <='] = $e;
                }
    		}
        }
        // Cấu hình phân trang
        if (count($_GET) > 0) $config['suffix']      = '?' . http_build_query($_GET, '', "&");
        $config['base_url']    = base_url('index.php/administrator/reviews/manager/page');
        $config['first_url']   = $config['base_url'].'/0'.http_build_query($_GET);
        $config['total_rows']  = $this->Mreviews->count_all($where);
        $config['per_page']    = 50;
        $config['uri_segment'] = 5;
        
        $this->pagination->initialize($config); 
        $data['list_item']     = $this->Mreviews->list_all($config['per_page'], $this->uri->segment(5), $where);
        $data['list_item']     = $this->buildTree($data['list_item']);

        foreach ($data['list_item'] as $key => $value) {
            $item = $this->Mproduct->getItem($value['item_id']);
            $data['list_item'][$key]['product'] = $item[0];
        }
        
        $data['page']          ='administrator/pages/reviews/manager';
	    $this->load->view('administrator/layout', $data);
    }
}