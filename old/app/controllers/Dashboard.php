<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    private $redirect = '';
    
    public function __construct()
    {
        parent::__construct();
        $this->redirect = current_url(). ($_SERVER['QUERY_STRING'] ? '?' .$_SERVER['QUERY_STRING'] : "");
    }

    public function index()
    {
        $this->sessioncheck->login($this->redirect);
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('dashboard/index'); 
        $this->load->view('include/footer');
    }
}