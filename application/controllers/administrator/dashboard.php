<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	/**
	 ManhNT 2014
     fanclubcf@gmail.com
	 */
    public function __construct()
    {
        parent::__construct();
    }
     
	public function index()
	{
		$this->load->library('pagination');
		$data['title'] = 'Dashboard - Administrator manager';
        $data['page'] = 'administrator/pages/item/manager';
        $data['subnav'] = '1';
        
        $this->load->model('administrator/Mproduct');
        
        if($this->input->post(NULL, TRUE))
        {
            $data_post = $this->input->post(NULL, TRUE);
            if(isset($data_post['drop']) && $data_post['drop'] == 'drop')
            {
                foreach($data_post['vl_check'] as $k=>$v)
                {
                    $this->Mproduct->deleteItem($v);
                }
            }
            
            $data['success'] = 1;
        }

        // Cấu hình phân trang
        if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $config['base_url'] = base_url('index.php/administrator/manager/page');
        $config['first_url'] = $config['base_url'].'/0'.http_build_query($_GET);  
        //Check session
        $page = $this->input->get('p', TRUE);
        $total_item = $this->session->userdata('total_item'.$page);
        if($total_item)
        {
            $config['total_rows'] = $total_item;
        }
        else
        {
            $config['total_rows'] = $this->Mproduct->count_all(); // xác d?nh t?ng s? record 
            $this->session->set_userdata('total_item'.$page,$config['total_rows']);
        } 
        
        $config['per_page'] = 30; // xác d?nh s? record ? m?i trang 
        $config['uri_segment'] = 4; // xác d?nh segment ch?a page number 
        $this->pagination->initialize($config); 
        $data['list_item'] = $this->Mproduct->list_all($config['per_page'], $this->uri->segment(4), $page);
        
        if($this->input->get('g') == 1)
        {
            $data['success'] = 1;
        }
        $this->load->view('administrator/layout', $data);
	}
    
    /** Items Category */
    public function itemCategory($categoryId)
    {
        $this->load->library('pagination');
        $data['title'] = 'Dashboard - Administrator manager';
        $data['page'] = 'administrator/pages/item/manager';
        $data['subnav'] = '3';
        
        $this->load->model('administrator/Mproduct');
        
        if($this->input->post(NULL, TRUE))
        {
            $data_post = $this->input->post(NULL, TRUE);
            if(isset($data_post['drop']) && $data_post['drop'] == 'drop')
            {
                foreach($data_post['vl_check'] as $k=>$v)
                {
                    $this->Mproduct->deleteItem($v);
                }
            }
            
            $data['success'] = 1;
        }

        // Cấu hình phân trang
        if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $config['base_url']    = base_url('index.php/administrator/category/'.$categoryId.'/page');
        $config['first_url']   = $config['base_url'].'/0'.http_build_query($_GET);  
        $config['total_rows']  = $this->Mproduct->count_all_item_category($categoryId);
        
        $config['per_page']    = 30; // xác d?nh s? record ? m?i trang 
        $config['uri_segment'] = 5; // xác d?nh segment ch?a page number 
        $this->pagination->initialize($config); 
        $data['list_item'] = $this->Mproduct->list_all_item_category($config['per_page'], $this->uri->segment(5), $categoryId);
        
        if($this->input->get('g') == 1)
        {
            $data['success'] = 1;
        }

        $parentNode = $this->get_parent($this->temp['category'], $categoryId);
        foreach ($parentNode as $node) {
            if (!isset($alert)) {
                $alert = 'Danh mục: '.$node;
            }
            else {
                $alert .= '<i class="btn-icon-only icon-chevron-right" style="margin: 0 2px; font-size:12px"> </i>' . $node;
            }
        }
        $data['alert']     = $alert;
        $this->load->view('administrator/layout', $data);
    }
    
    //Function add 1->20 queries;
    public function addItem()
    { 
        $data['title']    = 'Thêm sản phẩm - Administrator manager';
        $data['page']     = 'administrator/pages/item/add';
        $data['subnav']   = '2';
        $data['category'] = $this->buildTree($this->temp['category']);
        $data['temp']     = $this->temp['temp'];

        $this->load->view('administrator/layout', $data);
    }
    
    public function updateItem($id)
    {
        $id = intval($id);
        if (!$id) {
            redirect('/administrator/manager','refresh');
        }

        $this->load->model('administrator/Mproduct');
        $data['title']    = 'Cập nhật sản phẩm - Administrator manager';
        $data['page']     = 'administrator/pages/item/update';
        $data['subnav']   = '2';
        $data['category'] = $this->buildTree($this->temp['category']);
        $data['temp']     = $this->temp['temp'];
              
        if($this->input->post(NULL, TRUE)) {
            $data_request = $this->input->post(NULL, TRUE);
            $data_request['pattributes'] = urlencode(trim($data_request['pattributes']));
            $data_request['fulldesc']    = urlencode(trim($data_request['fulldesc']));
            
            /*Custom value*/
            $data_request['pbrande']    = $data_request['pbrande-custom'] ? $data_request['pbrande-custom'] : $data_request['pbrande'];
            $data_request['pcolors']    = $data_request['pcolors-custom'] ? $data_request['pcolors-custom'] : $data_request['pcolors'];
            $data_request['pmaterials'] = $data_request['pmaterials-custom'] ? $data_request['pmaterials-custom'] : $data_request['pmaterials'];
            $data_request['pstyles']    = $data_request['pstyles-custom'] ? $data_request['pstyles-custom'] : $data_request['pstyles'];
            $data_request['puses']      = $data_request['puses-custom'] ? $data_request['puses-custom'] : $data_request['puses'];
            $data_request['pseasons']   = $data_request['pseasons-custom'] ? $data_request['pseasons-custom'] : $data_request['pseasons'];
            $data_request['psizes']     = $data_request['psizes-custom'] ? $data_request['psizes-custom'] : $data_request['psizes'];

            $itemId = $this->coreUpdateItem($data_request, 'POST', $id);
            $data['success'] = 1;
        }   
        
        $data['item'] = $this->Mproduct->getItem($id);
        $data['item'] = $data['item'][0]; /*die(json_encode($data['item']));*/
        $this->load->view('administrator/layout', $data);
        
    }
    
    public function checkname()
    {
        $this->load->model('administrator/Mproduct');
        $name = $this->input->post('pname', TRUE);

        if($name)
        {
            $result = $this->Mproduct->check_name_unique($name);
            if($result)
            {
                die('error');
            }
        }
    }
    
    protected function insertTemps($temp, $temp_name, $type) {
        $this->load->model('administrator/Mproduct');
        $temp   = is_array($temp) ? $temp : trim($temp);
        $result = '';
        if (is_array($temp)) {
            /*Nothing*/
        }
        elseif (!is_array($temp) && is_numeric($temp)) {
            $temp = explode('|', $temp);
        }
        else {
            $a_temp = is_array($temp) ? $temp : explode(',', $temp);
            $temp = $this->Mproduct->insertTemps($a_temp, $type);
        }

        foreach ($temp as $t) {
            if(trim($t)) {
                $result .= '|'.$t.'|';
            }
        }
        $result = str_replace('||', '|', $result);

        return $result;
    }
    //Function upload images jquery
    public function upload_files()
    {
        if(!$this->input->post(NULL, TRUE)) {
            $this->redirect('/administrator/manager','refresh');
        }
        //Get data request & insert to database
        $this->load->model('administrator/Mproduct');
        $data_request = $this->input->post(NULL, TRUE);

        $itemId = $this->coreUpdateItem($data_request);
        // Upload images
        // Make sure file is not cached (as it happens for example on iOS devices)
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        
        // 5 minutes execution time
        @set_time_limit(5 * 60);
        
        // Settings
        $setFilePath      = date('d-m-Y') . '/';
        $targetDir        = IMAGE_UPLOAD_PATH . '/products/' . $setFilePath;//
        //$targetDir      = 'uploads';
        $cleanupTargetDir = true; // Remove old files
        $maxFileAge       = 5 * 3600; // Temp file age in seconds
        
        
        // Create target dir
        if (!file_exists($targetDir)) {
        	@mkdir($targetDir);
        }

        if (isset($check_item) && $check_item) {
            $itemId = $check_item;
        }

        /*$path = $_FILES['file']['name'];
        $ext  = '.'.pathinfo($path, PATHINFO_EXTENSION);*/

        // Get a file name
        $fileName = $itemId.'-'.strtolower(str_replace(" ", "_", str_replace("&*#39;","",$_FILES["file"]["name"])));
        
        //Set FilePath
        $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;
        
        // Chunking might be enabled
        $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
        $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;
        
        
        // Remove old temp files	
        if ($cleanupTargetDir) {
        	if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
        		die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
        	}
        
        	while (($file = readdir($dir)) !== false) {
        		$tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;
        
        		// If temp file is current file proceed to the next
        		if ($tmpfilePath == "{$filePath}.part") {
        			continue;
        		}
        
        		// Remove temp file if it is older than the max age and is not the current file
        		if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
        			@unlink($tmpfilePath);
        		}
        	}
        	closedir($dir);
        }	
        
        
        // Open temp file
        if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
        	die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
        }
        
        if (!empty($_FILES)) {
        	if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
        		die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
        	}
        
        	// Read binary input stream and append it to temp file
        	if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
        		die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
        	}
        } else {	
        	if (!$in = @fopen("php://input", "rb")) {
        		die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
        	}
        }
        
        while ($buff = fread($in, 4096)) {
        	fwrite($out, $buff);
        }
        
        @fclose($out);
        @fclose($in);
        
        // Check if file has been uploaded
        if (!$chunks || $chunk == $chunks - 1) {
        	// Strip the temp .part suffix off 
        	rename("{$filePath}.part", $filePath);
        }
        
        /*Resize and create thumb images*/
        $this->load->library('image_lib');
        $image_sizes = array(
            'medium' => array(350, 350),
            'thumb'  => array(110, 110),
        );
        foreach ($image_sizes as $resize) {

            $config = array(
                'image_library'   => 'gd2',
                'source_image'    => $filePath,
                'create_thumb'    => TRUE,
                'new_image'       => $targetDir . $resize[0] . 'x' . $resize[1] . '-' .$fileName,
                'maintain_ratio'  => TRUE,
                'width'           => $resize[0],
                'height'          => $resize[1],
                'master_dim'      => 'width'
            );

            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $this->image_lib->clear();

            if ($resize[0] == 350) {
                $config['y_axis']         = '0';
            }
            else {
                $config['y_axis']         = '0';
            }

            $img_thumb                      = pathinfo($fileName);
            $config['image_library']  = 'gd2';
            $config['source_image']   = $targetDir . $resize[0] . 'x' . $resize[1] . '-' . $img_thumb['filename'] . '_thumb.' . $img_thumb['extension'];
            $config['new_image']      = $targetDir . $resize[0] . 'x' . $resize[1] . '-' . $img_thumb['filename'] . '.' . $img_thumb['extension'];
            $config['quality']        = "100%";
            $config['maintain_ratio'] = FALSE;
            $config['width']          = $resize[0];
            $config['height']         = $resize[1];
            $config['x_axis']         = '0';
            $this->image_lib->initialize($config);
            $this->image_lib->crop();
            $this->image_lib->clear();

        }
        /*Update*/
        $dt_item = array(
            'images' => $setFilePath.$fileName
        );

        $this->Mproduct->updateItem($dt_item, $itemId);
        // Return Success JSON-RPC response
        die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');
        
    }

    protected function coreUpdateItem($data_request, $method = 'GET', $itemId = FALSE) {
        $this->load->model('administrator/Mproduct');
        /*Categories*/
        $categories = '';
        foreach ($data_request['categories'] as $c) {
            $categories .= $categories == '' ? $c : ','.$c;
        }
        $categories = str_replace('||', '|', $categories);
        /*Brande*/
        $brande = $this->insertTemps($data_request['pbrande'], 'pbrande', T_BRANDE);

        /*Materials*/
        $materials = $this->insertTemps($data_request['pmaterials'], 'pmaterials', T_MATERIAL);

        /*Colors*/
        $colors = $this->insertTemps($data_request['pcolors'], 'pcolors', T_COLOR);

        /*Styles*/
        $styles = $this->insertTemps($data_request['pstyles'], 'pstyles', T_STYLE);

        /*Uses*/
        $uses = $this->insertTemps($data_request['puses'], 'puses', T_USES);

        /*Seasons*/
        $seasons = $this->insertTemps($data_request['pseasons'], 'pseasons', T_SEASON);

        /*Sizes*/
        $sizes = $this->insertTemps($data_request['psizes'], 'psizes', T_SIZE);

        /*Attributes*/
        $attributes = array(
            'sort_desc'  => trim($data_request['psortdesc']),
            'attributes' => trim($data_request['pattributes']),
            'fulldesc'   => trim($data_request['fulldesc']),
        );

        $attributes = serialize($attributes);
        
        $check_item = $this->Mproduct->check_name_unique(trim($data_request['pname']));    
        if(!$check_item || $method == 'POST')
        {
            // Insert item
            $dt_item = array(
                'title'       => trim($data_request['pname']),
                'type'        => intval($data_request['ptype']),
                'status'      => intval($data_request['pstatus']),
                'category_id' => $categories,
                'buy_price'   => strpos($data_request['pbuyprice'], '.') !== FALSE ? pow ( 1000 , substr_count($data_request['pbuyprice'], '.') )*intval($data_request['pbuyprice']) : intval($data_request['pbuyprice']),
                'pre_price'   => strpos($data_request['ppreprice'], '.') !== FALSE ? pow ( 1000 , substr_count($data_request['ppreprice'], '.') )*intval($data_request['ppreprice']) : intval($data_request['ppreprice']),
                'brande'      => $brande,
                'colors'      => $colors,
                'materials'   => $materials,
                'styles'      => $styles,
                'uses'        => $uses,
                'seasons'     => $seasons,
                'sizes'       => $sizes,  
                'attributes'  => $attributes,
                'amount'      => intval($data_request['pqty']),
                'is_featured' => intval($data_request['pfeature']),
                'is_hot'      => intval($data_request['phot']),
                'is_saleoff'  => intval($data_request['psale']) ? 1 : 0,
                'created_at'  => time(),
                'created_by'  => $this->temp['adm_logged']['admin_id'],
                'post_time'   => time(),
                'deal'        => strpos($data_request['psale'], '.') !== FALSE ? pow ( 1000 , substr_count($data_request['psale'], '.') )*intval($data_request['psale']) : intval($data_request['psale'])/*intval($data_request['psale'])*/
            );

            if($method == 'POST') {
                $itemId = $this->Mproduct->updateItem($dt_item, $itemId);
            }
            else {
                $itemId = $this->Mproduct->insertItem($dt_item); 
            }
            
            if($itemId)
            {
                $this->session->unset_userdata('total_item');
            }
            unset($dt_item);
        }

        $return = $check_item ? $check_item : $itemId;
        return $return;
    }
    
    public function deleteItem($id, $type)
    {
        if($type == '1')//Delete song -> redirect
        {
            $this->load->model('administrator/Mproduct');
            if($this->Mproduct->deleteItem($id))
            {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
            else
            {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }
        elseif($type == '2')//Delete category -> redirect
        {
            if($this->Mcategory->delete_category_by_id($id))
            {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
            else
            {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }
        elseif($type == '3')//Delete news -> redirect
        {
            $this->load->model('administrator/Mnews');
            if($this->Mnews->deleteItem($id))
            {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
            else
            {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }
        elseif($type == '4')//Delete moderator -> redirect
        {
            $this->load->model('administrator/Mmoderator');
            if($this->Mmoderator->deleteItem($id))
            {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
            else
            {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }
        elseif($type == '5')//Delete orders -> redirect
        {
            $this->load->model('administrator/Morders');
            if($this->Morders->deleteItem($id))
            {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
            else
            {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }
        elseif($type == '6')//Delete brandes -> redirect
        {
            $this->load->model('administrator/Mbrandes');
            if($this->Mbrandes->deleteItem($id))
            {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
            else
            {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }
        elseif($type == '7')//Delete reivews -> redirect
        {
            $this->load->model('administrator/Mreviews');
            if($this->Mreviews->deleteItem($id))
            {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
            else
            {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }
    }
    
    public function search()
    {
        $value = $this->input->get('value',TRUE); 
        $page  = $this->input->get('p',TRUE); 
       
        $this->load->library('pagination');
        $data['title']      = 'Search | '.$value.' | Administrator manager';
        $data['key_search'] = $value;
        $this->load->Model('administrator/Mproduct');
        $value              = addslashes($value);
        $currentUrl         = $this->curPageURL();

        if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $config['base_url']    = base_url('index.php/administrator/search/page');
        $config['first_url']   = $config['base_url'].'/0?'.http_build_query($_GET); 
        $config['total_rows']  = $this->Mproduct->count_all_search($page, $value, $currentUrl); //die(var_dump($config['total_rows']));
        $config['per_page']    = 30; 
        $config['uri_segment'] = 4; 
        $this->pagination->initialize($config);
        $dt = $this->Mproduct->list_all_search($config['per_page'], $this->uri->segment(4), $page, $value, $currentUrl); 
       
        $data['alert']      = ' - Search with key: "<i style="color:#00BA8B">'.$data['key_search'].'</i>" - Total records: "<i style="color:#00BA8B">'.$config['total_rows'].'</i>"';
        $data['searchpage'] = 'manager';
       
        if($page == 'news')
        {
            if($dt)
            {
               $data['list_item'] = $dt;
            }

            $data['searchpage'] = 'news';
            $data['subnav']     = '5';
            $data['page']       = 'administrator/pages/news/manager';
        }
        else {
            if($dt)
            {
               $data['list_item'] = $dt;
            }

            $data['searchpage']    = 'manager';
            $data['subnav']        = '1';
            $data['page']          = 'administrator/pages/item/manager';
            $data['currentUrl']    = $currentUrl;
            $data['option']        = (strpos($currentUrl, 'o=0') !== FALSE || strpos($currentUrl, 'o=1') !== FALSE) ? (strpos($currentUrl, 'o=1') !== FALSE ? 1 : 0) : null;
            $data['option_search'] = TRUE;
        }
        $this->load->view('administrator/layout',$data);
    }

    public function removeFile($imgName, $itemId)
    {
        $this->load->model('administrator/Mproduct');
        $itemId  = $this->input->post('id', TRUE);
        $imgName = $this->input->post('v', TRUE);

        if($itemId && $imgName)
        {
            $result = $this->Mproduct->delete_file_item($imgName, $itemId);
            if(!$result)
            {
                die('error');
            }
        }
        else {
            die('error');
        }
    }

    # Function update Active of Item
    public function publicItem($itemId, $status)
    { 
        $this->load->model('administrator/Mproduct');
        $dt = array('status' => $status);

        # Valid data
        if(is_numeric($itemId) && $itemId > 1 && ($status == 0 || $status == 1)) {
            $this->Mproduct->updateItem($dt, $itemId);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
        else {
            show_404();
        }
    }

    # Function home
    public function home() {
        $data['title'] = 'Home | Administrator manager';
        
        $data['subnav']= '0';
        $data['page']  = 'administrator/index';
        $this->load->view('administrator/layout',$data);
    }
    
}