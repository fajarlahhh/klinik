<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporanpenerimaan extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mlaporanpenerimaan');
        $this->redirect = current_url(). ($_SERVER['QUERY_STRING'] ? '?' .$_SERVER['QUERY_STRING'] : "");
    }

    public function index(){
        $this->sessioncheck->validasi('laporanpenerimaan', $this->redirect);
        $q = $this->input->get('q');
        $ks = $this->input->get('ks');

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
        $kasir = null;
        if($tp == 1)
            $kasir = $this->mlaporanpenerimaan->get_kasir($tgl1, $tgl2);
            else if($tp == 2)
                $kasir = $this->mlaporanpenerimaan->get_petugas($tgl1, $tgl2);
                else if($tp == 3){
                    $this->load->model('mdokter');
                    $kasir = $this->mdokter->get_all_alias();
                }

        $data = null;
        $total = 0;
        switch ($tp) {
            case 1:
                $data = $this->mlaporanpenerimaan->get_rekap_limit($tgl1, $tgl2, $ks, $q);
                break;
            case 2:
                $data = $this->mlaporanpenerimaan->get_tindakan_limit($tgl1, $tgl2, $ks, $q);
                break;
            case 3:
                $data = $this->mlaporanpenerimaan->get_barang_limit($tgl1, $tgl2, $ks, $q);
                break;
            case 4:
                $data = $this->mlaporanpenerimaan->get_lainnya_limit($tgl1, $tgl2, $q);
                break;
        }
        
        
        $content = array(
            'data' => $data,
            'q' => $q,
            'ks' => $ks,
            'tp' => $tp,
            'tgl1' => $tgl1,
            'tgl2' => $tgl2,
            'kasir' => $kasir
        );
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('laporan/laporanpenerimaan/index', $content);
        $this->load->view('include/footer');
    }

    public function rekap(){
        $this->sessioncheck->validasi('laporanpenerimaan', $this->redirect);
        $q = $this->input->get('q');
        $tgl1 = $this->input->get('tgl1');
        $tgl2 = $this->input->get('tgl2');
        $ks = $this->input->get('ks');

        $content = array(
            'data' => $this->mlaporanpenerimaan->get_rekap_limit($tgl1, $tgl2, $ks, $q, null, null),
            'q' => $q,
            'ks' => $ks,
            'tgl1' => $tgl1,
            'tgl2' => $tgl2
        );
        $this->load->view('laporan/laporanpenerimaan/rekap', $content);
    }
    
    public function tindakan(){
        $this->sessioncheck->validasi('laporanpenerimaan', $this->redirect);
        $q = $this->input->get('q');
        $tgl1 = $this->input->get('tgl1');
        $tgl2 = $this->input->get('tgl2');
        $ks = $this->input->get('ks');

        $content = array(
            'data' => $this->mlaporanpenerimaan->get_tindakan_limit($tgl1, $tgl2, $ks, $q, null, null),
            'q' => $q,
            'ks' => $ks,
            'tgl1' => $tgl1,
            'tgl2' => $tgl2
        );
        $this->load->view('laporan/laporanpenerimaan/tindakan', $content);
    }
    
    public function barang(){
        $this->sessioncheck->validasi('laporanpenerimaan', $this->redirect);
        $q = $this->input->get('q');
        $tgl1 = $this->input->get('tgl1');
        $tgl2 = $this->input->get('tgl2');
        $ks = $this->input->get('ks');

        $content = array(
            'data' => $this->mlaporanpenerimaan->get_barang_limit($tgl1, $tgl2, $ks, $q, null, null),
            'q' => $q,
            'ks' => $ks,
            'tgl1' => $tgl1,
            'tgl2' => $tgl2
        );
        $this->load->view('laporan/laporanpenerimaan/barang', $content);
    }
    
    public function lainnya(){
        $this->sessioncheck->validasi('laporanpenerimaan', $this->redirect);
        $q = $this->input->get('q');
        $tgl1 = $this->input->get('tgl1');
        $tgl2 = $this->input->get('tgl2');

        $content = array(
            'data' => $this->mlaporanpenerimaan->get_lainnya_limit($tgl1, $tgl2, $q, null, null),
            'q' => $q,
            'tgl1' => $tgl1,
            'tgl2' => $tgl2
        );
        $this->load->view('laporan/laporanpenerimaan/lainnya', $content);
    }
}