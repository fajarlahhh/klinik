<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporanbarangmasuk extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mlaporanbarangmasuk');
        $this->redirect = current_url(). ($_SERVER['QUERY_STRING'] ? '?' .$_SERVER['QUERY_STRING'] : "");
    }

    public function index(){
        $this->sessioncheck->validasi('laporanbarangmasuk', $this->redirect);
        $q = $this->input->get('q');
        $pg = $this->input->get('pg');

        if ($this->input->get('tgl1'))
            $tgl1 = $this->input->get('tgl1');
        else
            $tgl1 = date("Y-m-01");
        
        if ($this->input->get('tgl2')) 
            $tgl2 = $this->input->get('tgl2');
        else
            $tgl2 = date("Y-m-t");

        if ($this->input->get('tp')) 
            $tp = $this->input->get('tp');
        else
            $tp = 1;

        $config = array(
            'base_url' => site_url('laporanbarangmasuk/index?tgl1='.$tgl1.'&tgl2='.$tgl2.'&tp='.$tp.'&q='.$q),
            'first_url' => site_url('laporanbarangmasuk/index?tgl1='.$tgl1.'&tgl2='.$tgl2.'&tp='.$tp.'&q='.$q),    
            'per_page' => 10,
            'page_query_string' => TRUE,
            'total_rows' => ($tp == 1? $this->mlaporanbarangmasuk->total_rekap($tgl1, $tgl2, $q): $this->mlaporanbarangmasuk->total_rinci($tgl1, $tgl2, $q))
        );

        $this->load->library('pagination');
        $this->pagination->initialize($config);
        
        $content = array(
            'data' => ($tp == 1? $this->mlaporanbarangmasuk->limit_rekap($tgl1, $tgl2, $q, 10, $pg): $this->mlaporanbarangmasuk->limit_rinci($tgl1, $tgl2, $q, 10, $pg)),
            'page' => $this->pagination->create_links(),
            'q' => $q,
            'tp' => $tp,
            'tgl1' => $tgl1,
            'tgl2' => $tgl2,
            'total' => $config['total_rows']
        );
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('laporan/laporanbarangmasuk/index', $content);
        $this->load->view('include/footer');
    }

    public function rinci(){
        $this->sessioncheck->validasi('laporanbarangmasuk', $this->redirect);
        $q = $this->input->get('q');
        $tgl1 = $this->input->get('tgl1');
        $tgl2 = $this->input->get('tgl2');

        $content = array(
            'data' => $this->mlaporanbarangmasuk->limit_rinci($tgl1, $tgl2, $q, null, null),
            'q' => $q,
            'tgl1' => $tgl1,
            'tgl2' => $tgl2
        );
        $this->load->view('laporan/laporanbarangmasuk/rinci', $content);
    }

    public function rekap(){
        $this->sessioncheck->validasi('laporanbarangmasuk', $this->redirect);
        $q = $this->input->get('q');
        $tgl1 = $this->input->get('tgl1');
        $tgl2 = $this->input->get('tgl2');

        $content = array(
            'data' => $this->mlaporanbarangmasuk->limit_rekap($tgl1, $tgl2, $q, null, null),
            'q' => $q,
            'tgl1' => $tgl1,
            'tgl2' => $tgl2
        );
        $this->load->view('laporan/laporanbarangmasuk/rekap', $content);
    }
}