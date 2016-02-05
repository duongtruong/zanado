<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
    
class Application extends MY_Controller{

   public $data;
    
   function __construct(){ 
        parent::__construct();
        $this->load->model(array('user_model')); 

        $this->data['logger']      = $this->_getLogger();
        $this->data['cart']        = $this->_getNumCartItem();
        
        // Load facebook library and pass associative array which contains appId and secret key
        $this->load->library('facebook', array('appId' => '1059422337443432', 'secret' => 'b6b82868e8c0b6044eed6bf87a2ee583', 'redirectUri' => base_url('auth/facebook')));
        // Get user's login information
        $this->data['idfacebook']  = $this->facebook->getUser();
        $this->data['f_login_url'] = $this->facebook->getLoginUrl();
        /*Set Sliders False*/
        $this->data['sliders']     = FALSE;
        /*Set Popup*/
        $this->data['popup']       = FALSE;

        /*Set Brandes & News*/
        $this->data['brandes']     = $this->temp['temp'];
        foreach ($this->temp['category'] as $key => $value) {
            if ($value['status'] > 0) {
                $this->data['categories'][]  = $value;
            }
        }
        
        $this->temp['category']    = $this->data['categories'];
        $this->data['news']        = $this->user_model->getNews(10, 0, array('status' => 1));

        if (!isset($this->session->userdata['related']) || !$this->session->userdata['related']) {
            $this->data['related'] = NULL;
        }
        else {
            $this->data['related'] = $this->session->userdata['related'];
        }
    } 

    function _getLogger(){
        $id_logger = $this->auth->userid();

        # Select field in DB
        $this->db->select();
        $logger = $this->user_model->get('id', $id_logger);
        return $logger;
    } 

    function _getNumCartItem() 
    {
        
    }
}