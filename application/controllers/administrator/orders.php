<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Orders extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library(array('session'));
    	$this->load->model('administrator/Morders');
    }

    public function index() {
    	$this->load->library('pagination');
	    $data['title'] = 'Orders page - Administrator Manager';
        $data['subnav'] = '6'; $where = array();

        if($this->input->post(NULL, TRUE))
        {
           $data_request = $this->input->post(NULL, TRUE);
           foreach($data_request['vl_check'] as $k=>$v)
           {
               $this->Morders->deleteItem($v);
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
    			$where['time_created >='] = $s ? $s : 0;

                if ($e) {
                    $where['time_created <='] = $e;
                }
    		}
        }
        // Cấu hình phân trang
        if (count($_GET) > 0) $config['suffix']      = '?' . http_build_query($_GET, '', "&");
        $config['base_url']    = base_url('index.php/administrator/orders/manager/page');
        $config['first_url']   = $config['base_url'].'/0'.http_build_query($_GET);
        $config['total_rows']  = $this->Morders->count_all($where);
        $config['per_page']    = 50;
        $config['uri_segment'] = 5;
        
        $this->pagination->initialize($config); 
        $data['list_item']     = $this->Morders->list_all($config['per_page'], $this->uri->segment(5), $where);
        $data['page']          ='administrator/pages/orders/manager';
	    $this->load->view('administrator/layout', $data);
    }

    public function view($id) {
    	$id = (int)$id;
        $data['title'] = 'View Order - Administrator Manager';
        $data['subnav'] = '6';

        if($this->input->post(NULL, TRUE))
        {
            $data_request = $this->input->post(NULL, TRUE);
            foreach ($data_request as $key => $value) {
                $data_request[$key] = is_string($value) ? trim($value) : $value;
            }
            if (is_numeric($data_request['mods'])) {
                $dt_update = array(
                    'mod_id'  => $data_request['mods'],
                    'status'  => $data_request['status'] ? $data_request['status'] : 2,
                    'comment' => $data_request['comment']
		        );
		        $result = $this->Morders->updateItem($dt_update, $id);
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

        /*UPDATE WITH WHO (MOD) VIEW*/
        $data['details'] = $this->Morders->getItem($id);
        $dt_update = array(
        	'status' => $data['details'][0]['status'] ? $data['details'][0]['status'] : 1,
        	'mod_view' => $this->temp['adm_logged']['admin_id']
        );
        $this->Morders->updateItem($dt_update, $id);

        /*GET MODS MARKET*/
        $this->load->model('administrator/Mmoderator');
        $data['mods'] = $this->Mmoderator->list_mods(4);

        $data['details'] = $this->Morders->getItem($id);
        $data['page']    ='administrator/pages/orders/update';
        $this->load->view('administrator/layout',$data);
    }
}