<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {
	function __construct() {
        parent::__construct();
    }   	

	public function index(){
        delete_cookie('idPengguna');
        delete_cookie('nmPengguna');
        $this->session->sess_destroy();
        redirect('login');
    }
}