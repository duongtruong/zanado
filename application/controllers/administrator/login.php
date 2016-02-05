<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $data['title'] = 'Login page - Administrator';
        $adm_logged = $this->session->userdata('adm_logged');
        if(isset($adm_logged['logged_in']) && $adm_logged['logged_in'] == 1)
        {
            redirect(base_url().'index.php/'.$adm_logged['project']);
        } 
       
        if($this->input->post(NULL, TRUE))
        {
            $this->load->Model('administrator/Mlogin');
            $dt = $this->input->post(NULL, TRUE);
            if($dt['username'] && $dt['password'])
            { 
                $row = $this->Mlogin->check_login($dt['username'], $dt['password'], 'homescreen');
                if($row)
                {
                    $adm_logged = array(
                        'admin'     => $row[0]['fullname'],
                        'admin_id'  => $row[0]['id'],
                        'level'     => $row[0]['level'],
                        'project'   => $dt['select-project'],
                        'logged_in' => TRUE);
                    $this->session->set_userdata('adm_logged',$adm_logged);
                    header('location:'.base_url().'index.php/'.$dt['select-project']);
                }
                else
                {
                    $data['username'] = $dt['username'];
                    $data['error'] = 'Sai thông tin tài khoản !';
                }
            }
            else
            {
                $data['username'] = $dt['username'];
                $data['error'] = 'Sai thông tin tài khoản !';
            }
            
       }
	   $this->load->view('administrator/login', $data);
    }
    public function logout()
    {
        $this->session->unset_userdata('adm_logged');
        header('location:'.base_url('/administrator'));
    }
}