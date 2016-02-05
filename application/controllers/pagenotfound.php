<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
include_once (dirname(__FILE__) . "/frontend/application.php");
class Pagenotfound extends Application {
	public $data;
    public function __construct() {
        parent::__construct(); 
    } 
 
    public function index() { 
        $this->output->set_status_header('404'); // setting header to 404
        $this->data['template'] = '404';
		$this->load->view('frontend/layout', $this->data);
    } 
} 
?> 