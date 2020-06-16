<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporanstokbarang extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mlaporanstokbarang');
        $this->redirect = current_url(). ($_SERVER['QUERY_STRING'] ? '?' .$_SERVER['QUERY_STRING'] : "");
    }

    public function index(){
        $this->sessioncheck->validasi('laporanstokbarang', $this->redirect);
        $q = $this->input->get('q');
        $pg = $this->input->get('pg');
        $tp = $this->input->get('tp');

        if ($this->input->get('bln')) 
            $bln = $this->input->get('bln');
        else
            $bln = date('m');

        if ($this->input->get('thn')) 
            $thn = $this->input->get('thn');
        else
            $thn = date('Y');
            
        if ($this->input->get('tp')) 
            $tp = $this->input->get('tp');
        else
            $tp = 1;

        $config = array(
            'base_url' => site_url('laporanstokbarang/index?bln='.$bln.'&thn='.$thn.'&tp='.$tp.'&q='.$q),
            'first_url' => site_url('laporanstokbarang/index?bln='.$bln.'&thn='.$thn.'&tp='.$tp.'&q='.$q),    
            'per_page' => 10,
            'page_query_string' => TRUE,
            'total_rows' => $this->mlaporanstokbarang->total_rows($bln, $thn, $q)
        );

        $this->load->library('pagination');
        $this->pagination->initialize($config);
        
        $content = array(
            'data' => ($tp == 1? $this->mlaporanstokbarang->limit_rekap($bln, $thn, $q, 10, $pg): $this->mlaporanstokbarang->limit_rinci($bln, $thn, $q, 10, $pg)),
            'page' => $this->pagination->create_links(),
            'q' => $q,
            'tp' => $tp,
            'bln' => $bln,
            'thn' => $thn,
            'total' => $config['total_rows']
        );
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('laporan/laporanstokbarang/index', $content);
        $this->load->view('include/footer');
    }

    public function rekap(){
        $this->sessioncheck->validasi('laporanstokbarang', $this->redirect);
        $q = $this->input->get('q');
        $bln = $this->input->get('bln');
        $thn = $this->input->get('thn');

        $content = array(
            'data' => $this->mlaporanstokbarang->limit_rekap($bln, $thn, $q, null, null),
            'q' => $q,
            'bln' => $bln,
            'thn' => $thn
        );
        $this->load->view('laporan/laporanstokbarang/rekap', $content);
    }

    public function rinci(){
        $this->sessioncheck->validasi('laporanstokbarang', $this->redirect);
        $q = $this->input->get('q');
        $bln = $this->input->get('bln');
        $thn = $this->input->get('thn');

        $content = array(
            'data' => $this->mlaporanstokbarang->limit_rinci($bln, $thn, $q, null, null),
            'q' => $q,
            'bln' => $bln,
            'thn' => $thn
        );
        $this->load->view('laporan/laporanstokbarang/rinci', $content);
    }
}