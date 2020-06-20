<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class laporanbarangkeluarkhusus extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mlaporanbarangkeluar');
        $this->redirect = current_url(). ($_SERVER['QUERY_STRING'] ? '?' .$_SERVER['QUERY_STRING'] : "");
    }

    public function index(){
        $this->sessioncheck->validasi('laporanbarangkeluarkhusus', $this->redirect);
        $q = $this->input->get('q');
        if($this->input->get('pg'))
            $pg = $this->input->get('pg');

        $tp = 1;
        if($this->input->get('tp'))
            $tp = $this->input->get('tp');
		
        if ($this->input->get('tgl1'))
            $tgl1 = $this->input->get('tgl1');
        else
            $tgl1 = date("Y-m-01");
        
        if ($this->input->get('tgl2')) 
            $tgl2 = $this->input->get('tgl2');
        else
            $tgl2 = date("Y-m-t");

        
        $content = array(
            'data' => $tp==1? $this->mlaporanbarangkeluar->get_rinci_khusus($tgl1, $tgl2, $q): $this->mlaporanbarangkeluar->get_rekap_khusus($tgl1, $tgl2, $q),
            'q' => $q,
            'tp' => $tp,
            'tgl1' => $tgl1,
            'tgl2' => $tgl2
        );
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('laporan/laporanbarangkeluarkhusus/index', $content);
        $this->load->view('include/footer');
    }

    public function cetak(){
        $this->sessioncheck->validasi('laporanbarangkeluarkhusus', $this->redirect);
        $q = $this->input->get('q');
        $tgl1 = $this->input->get('tgl1');
        $tgl2 = $this->input->get('tgl2');
		$tp = $this->input->get('tp');

        $content = array(
            'data' => $tp==1? $this->mlaporanbarangkeluar->get_rinci_khusus($tgl1, $tgl2, $q): $this->mlaporanbarangkeluar->get_rekap_khusus($tgl1, $tgl2, $q),
            'q' => $q,
			'tp' => $tp,
            'tgl1' => $tgl1,
            'tgl2' => $tgl2
        );
        $this->load->view('laporan/laporanbarangkeluarkhusus/cetak', $content);
    }
}