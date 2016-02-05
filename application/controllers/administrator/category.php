<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Category extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library(array('session'));
    }
    
    public function index()
	{
	   $data['title'] = 'Category page - Administrator Manager';
       $data['subnav'] = '7';
       if($this->input->post(NULL, TRUE))
       {
           $data_request = $this->input->post(NULL, TRUE);
           foreach($data_request['vl_check'] as $k=>$v)
           {
               $this->Mcategory->delete_category_by_id($v);
           }
           $data['success'] = 1;
       }
        
        if(isset($_GET['g']) && $_GET['g'] == 1)
        {
            $data['success'] = 1;
        }

        $data['list_category'] = $this->buildTree($this->Mcategory->get_category());
        $data['page']='administrator/pages/category/manager';
	    $this->load->view('administrator/layout',$data);
	}
    
    public function addItem()
    {
        $data['title'] = 'Add new Category - Administrator Manager';
        $data['subnav'] = '7';
        if($this->input->post(NULL, TRUE))
        {
            $data_request = $this->input->post(NULL, TRUE);
            foreach ($data_request as $key => $value) {
                $data_request[$key] = is_string($value) ? trim($value) : $value;
            }
            $nodeLevel = $this->Mcategory->getNodeLevel($data_request['parentcategory']);
            $dt = array(
                'title'         => $data_request['catename'],
                'slug'          => $this->vn_str_filter($data_request['catename']),
                'parent_id'     => $data_request['parentcategory'],
                'level'         => $nodeLevel ? $nodeLevel : 1,
                'sort'          => 0,
                'status'        => $data_request['status'],
                'p_title'       => $data_request['p_title'],
                'p_description' => $data_request['p_desc'],
                'keywords'      => $data_request['p_keywords'],
                'created_at'    => time(),
                'created_by'    => $this->temp['adm_logged']['admin'],
                'updated_at'    => time(),
                'updated_by'    => $this->temp['adm_logged']['admin'],
            );
            $result = $this->Mcategory->add_category($dt);
            if($result)
            {
                $data['success'] = 1;
            }
            else
            {
                $data['warning'] = 1;
            }
        }

        $data['category'] = $this->buildTree($this->temp['category']);
        $data['page']     ='administrator/pages/category/add';
	    $this->load->view('administrator/layout',$data);
    }
    public function updateItem($id)
    {
        $id = (int)$id;
        $data['title'] = 'Update Category - Administrator Manager';
        $data['subnav'] = '7';

        if($this->input->post(NULL, TRUE))
        {
            $data_request = $this->input->post(NULL, TRUE);
            foreach ($data_request as $key => $value) {
                $data_request[$key] = is_string($value) ? trim($value) : $value;
            }
            $nodeLevel = $this->Mcategory->getNodeLevel($data_request['parentcategory']);

            $dt = array(
                'title'         => $data_request['catename'],
                'slug'          => $this->vn_str_filter($data_request['catename']),
                'parent_id'     => $data_request['parentcategory'],
                'level'         => $nodeLevel ? $nodeLevel : 1,
                'sort'          => 0,
                'status'        => $data_request['status'],
                'p_title'       => $data_request['p_title'],
                'p_description' => $data_request['p_desc'],
                'keywords'      => $data_request['p_keywords'],
                'updated_at'    => time(),
                'updated_by'    => $this->temp['adm_logged']['admin'],
            );
            $result = $this->Mcategory->update_category($id, $dt);
            if($result)
            {
                $data['success'] = 1;
            }
            else
            {
                $data['warning'] = 1;
            }
        }


        $data['details']  = $this->Mcategory->get_details($id);
        $data['category'] = $this->buildTree($this->temp['category']);
        $data['page']     ='administrator/pages/category/update';
        $this->load->view('administrator/layout',$data);
    } 
    
    public function order_category($countryCode){
        $countryCode = trim($countryCode); 
        $data['title'] = 'Order Category By Version - Administrator Manager';
        $this->load->Model('music/Mcategory');
        $data['subnav'] = '7';

        if($this->input->post(NULL, TRUE))
        {
            $data_request = $this->input->post(NULL, TRUE);
            $max=count($data_request['categoryid']);
            foreach($data_request['categoryid'] as $c)
            {
                if($c != '')
                {
                    $dt = array(
                        'Priority' => $max
                    );
                    $result = $this->Mcategory->update_category($c, $dt);
                }
                $max--;
            }
            
            
            if($result)
            {
                $data['success'] = 1;
            }
            else
            {
                $data['warning'] = 1;
            }
        }

        $data['list_category'] = $this->Mcategory->get_category_order_by_countryCode($countryCode);
        $data['page']='music/category/manager_order';
        $this->load->view('layout', $data);
    }

    # Function update Active of Category
    public function publish($category_id, $active)
    { 
        $this->load->model('music/Mcategory');
        $dt = array('status' => $active, 'updated_at' => time(), 'updated_by' => $this->temp['adm_logged']['admin']);

        # Valid data
        if(is_numeric($category_id) && $category_id >= 0 && ($active == 0 || $active == 1)) {
            $this->Mcategory->update_category($category_id, $dt);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
        else {
            show_404();
        }
    }

    # Function update Show Home of Category
    public function showhome($category_id, $active)
    { 
        $this->load->model('music/Mcategory');
        $dt = array('show_home' => $active, 'updated_at' => time(), 'updated_by' => $this->temp['adm_logged']['admin']);

        # Valid data
        if(is_numeric($category_id) && $category_id >= 0 && ($active == 0 || $active == 1)) {
            $this->Mcategory->update_category($category_id, $dt);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
        else {
            show_404();
        }
    }
}