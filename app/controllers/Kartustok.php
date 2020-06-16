<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kartustok extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mkartustok');
        $this->redirect = current_url(). ($_SERVER['QUERY_STRING'] ? '?' .$_SERVER['QUERY_STRING'] : "");
    }

    public function index(){
        $this->sessioncheck->validasi('kartustok', $this->redirect);
        $pg = $this->input->get('pg');

        if ($this->input->get('bln')) 
            $bln = $this->input->get('bln');
        else
            $bln = date('m');

        if ($this->input->get('thn')) 
            $thn = $this->input->get('thn');
        else
            $thn = date('Y');

        $this->load->model('mdatabarang');
        $barang = $this->mdatabarang->get_all();

        if ($this->input->get('brg')) 
            $brg = $this->input->get('brg');
        else
            $brg = $barang{0}->idBarang;

        $config = array(
            'base_url' => site_url('kartustok/index?bln='.$bln.'&thn='.$thn.'&brg='.$brg),
            'first_url' => site_url('kartustok/index?bln='.$bln.'&thn='.$thn.'&brg='.$brg),    
            'per_page' => 10,
            'page_query_string' => TRUE,
            'total_rows' => $this->mkartustok->total_rows($bln, $thn, $brg)
        );

        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $this->load->model('mstokbarang');

        $content = array(
            'barang' => $barang,
            'stokawal' => $this->mstokbarang->get_stok_awal_by_id($bln, $thn, $brg),
            'data' => $this->mkartustok->get_limit($bln, $thn, $brg, 10, $pg),
            'page' => $this->pagination->create_links(),
            'brg' => $brg,
            'bln' => $bln,
            'thn' => $thn,
            'total' => $config['total_rows']
        );
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('laporan/kartustok/index', $content);
        $this->load->view('include/footer');
    }

    public function cetak(){
        $this->sessioncheck->validasi('kartustok', $this->redirect);
        $q = $this->input->get('q');
        $bln = $this->input->get('bln');
        $thn = $this->input->get('thn');
            $brg = $this->input->get('brg');

        $content = array(
            'data' => $this->mkartustok->get_limit($bln, $thn, $brg, null, null),
            'q' => $q,
           'nm' => $this->input->get('nm'),
            'brg' => $brg,
            'bln' => $bln,
            'thn' => $thn
        );
        $this->load->view('laporan/kartustok/cetak', $content);
    }
}