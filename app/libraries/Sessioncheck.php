<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sessioncheck {
	private $CI;
    public function __construct()
    {
        $this->CI =& get_instance();

        if(!isset($this->CI->session)){
            $this->CI->load->library('session');
        }
    }

    public function validasi($menu, $redirect = null){
        $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri_segments = explode('/', $uri_path);
        
        if(!$this->CI->session->userdata('login') == TRUE){
            $this->CI->session->set_flashdata('redirect', $redirect);
            redirect('login');
        }else{
            if (strpos($this->CI->session->userdata('akses'), $menu) == false) {
                $dlg = array('pesan' => 'Tidak ada akses ke menu ini', 'tipe' => 'alert-danger');
                $this->CI->session->set_flashdata('message', $dlg);
                redirect('dashboard');
            }
        }
    }

    public function login($redirect = null){
        if(!$this->CI->session->userdata('login') == TRUE){ 
            if ($redirect)
                $this->CI->session->set_flashdata('redirect', $redirect);
            redirect('login');
        }
    }
}