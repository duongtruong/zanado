<?php 

if (!defined('BASEPATH')) 
    exit('No direct script access allowed'); 

/** 
 * @property CI_Loader $load 
 * @property CI_Form_validation $form_validation 
 * @property CI_Input $input 
 * @property CI_Email $email 
 * @property CI_DB_active_record $db 
 * @property CI_DB_forge $dbforge 
 * @property CI_Table $table 
 * @property CI_Session $session 
 * @property CI_FTP $ftp 
 * 
 */ 
class MY_Controller extends CI_Controller 
{ 
    protected $class_name; 
    protected $function_name;
    public    $temp; 

    public function __construct() 
    { 
        // Call the Model constructor 
        parent::__construct(); 
        //Load những model, helper chung cần thiết ở đây
        $this->load->model('administrator/Mcategory');
        /*Check Login & Permission*/
        $adm_logged = $this->session->userdata('adm_logged');
        $segment = $this->uri->segment(1);

        $this->temp = $this->Mcategory->getAllTemp(); 
        /*Custom Price*/
        $this->temp['temp'][] = array('id' => '1', 't_value' => '0đ - 1.000.000 đ', 't_type' => '8');
        $this->temp['temp'][] = array('id' => '2', 't_value' => '1.000.000 đ - 2.000.000 đ', 't_type' => '8');
        $this->temp['temp'][] = array('id' => '3', 't_value' => '2.000.000đ - 3.000.000 đ', 't_type' => '8');
        
        if ($segment === 'administrator' && (!isset($adm_logged['logged_in']) || $segment != $adm_logged['project']))
        {
            $this->config->set_item('sess_expire_on_close', TRUE);
            redirect(base_url('/administrator/login.html'));
        }
        elseif ($segment === 'administrator') {
            $controller = $this->router->fetch_class();
            $level      = $adm_logged['level'];

            if ($level == 3) {
                if (!in_array($controller, array('news'))) {
                    /*redirect('administrator/503','refresh');*/
                    show_error('You do not have access to this page!');
                }
            }
            elseif ($level == 4) {
                if (in_array($controller, array('news', 'moderator'))) {
                    show_error('You do not have access to this page!');
                }
            }
        }
        $this->temp['adm_logged']    = $adm_logged;
    }

    static public function vn_str_filter($text)
    { 
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

        $text = mb_strtolower($text);
        $text = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $text);
        $text = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $text);
        $text = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $text);
        $text = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $text);
        $text = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $text);
        $text = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $text);
        $text = preg_replace("/(đ)/", 'd', $text);
        $text = preg_replace("/(@|&|<|>)/", '', $text);

        // trim
        $text = trim($text, '-');

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        if (empty($text))
        {
            return 'n-a';
        }

        return $text;
    }

    static public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function _remap($method, $params = array()) 
    { 
        $this->setVariable($method); 
        if (method_exists($this, $method))//Có phương thức đã chỉ định 
        { 
            $result = @call_user_func_array(array($this, $method), $params); 

            if ($result === FALSE)//Không gọi được phương thức đã chỉ định 
            { 
                show_404(); 
            } 
        } 
        else //Phương thức đã chỉ định không có thực => hiện trang báo lỗi 
            show_404(); 
    } 

    protected function setVariable($method) 
    { 
        $this->class_name = strtolower(get_class($this)); 
        $this->function_name = strtolower($method); 
    }
    
    public function checkLogin() 
    { 
        return 'true'; 
    }
    
    protected function curPageURL() {
         $pageURL = 'http';
         if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
         $pageURL .= "://";
         if ($_SERVER["SERVER_PORT"] != "80") {
          $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
         } else {
          $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
         }
         return $pageURL;
    }
    
    public function rrmdir($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir."/".$object) == "dir") 
                        rrmdir($dir."/".$object); 
                        else unlink   ($dir."/".$object);
                    }
                }
            reset($objects);
            rmdir($dir);
        }
    }

    

    public function buildTree($items) {

        $childs = array();

        foreach($items as &$item) $childs[$item['parent_id']][] = &$item;
        unset($item);

        foreach($items as &$item) if (isset($childs[$item['id']]))
                $item['childs'] = $childs[$item['id']];

        return $childs[0];
    }

    public function get_key($arr, $id) {
        foreach ($arr as $key => $val) {
            if ($val['id'] == $id) {
                return array('key'=>$key, 'val'=>$val['title']);
            }
        }
        return null;
    }

    public function get_parent($arr, $id, $parents = array()) {
        $x   = $this->get_key($arr, $id);
        $key = $x['key'];
        if ($arr[$key]['parent_id'] == 0)
        {
            $parents[] = $arr[$key]['title'];
            return array_values(array_reverse($parents));
        }
        else 
        {
            $parents[] = $x['val'];
            return $this->get_parent($arr, $arr[$key]['parent_id'], $parents);
        }
    }
    
    public function get_full_parent($arr, $id, $parents = array()) {
        $x   = $this->get_key($arr, $id);
        $key = $x['key'];
        if ($arr[$key]['parent_id'] == 0)
        {
            $parents[] = $arr[$key];
            return array_values(array_reverse($parents));
        }
        else 
        {
            $parents[] = $arr[$x['key']];
            return $this->get_full_parent($arr, $arr[$key]['parent_id'], $parents);
        }
    }
}