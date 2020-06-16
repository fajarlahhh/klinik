<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Postingstok extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if($this->session->userdata('lvlPengguna') < 3){
            if($this->input->post('bulan') && $this->input->post('tahun')){
                $this->load->model('mpostingstok');

                $this->db->trans_begin();
                ini_set('max_execution_time', 0);

                $tglLalu = date('Y-m-d', strtotime($this->input->post('tahun')."-".$this->input->post('bulan')."-01"));
                $tglSekarang = date('Y-m-d', strtotime("+1 months", strtotime($tglLalu)));
                
                $this->mpostingstok->delete($tglSekarang);
                $stok = $this->mpostingstok->stok_akhir($this->input->post('bulan'), $this->input->post('tahun'));
				
                foreach ($stok as $row) {					
                    $this->mpostingstok->insert( 
                        array('tglStokAwal' => $tglSekarang,
                            'idBarang' => $row->idBarang,
                            'operator' => $this->session->userdata('nmPengguna'),
                            'jmlBarang' => str_replace(',','.',$row->stokAwal + $row->stokMasuk - $row->stokKeluar)
                            )
                    );
                }
                //echo 1;
                if ($this->db->trans_status() === FALSE){
                    $this->db->trans_rollback();
                    echo 0;
                    return;
                }else{
                    $this->db->trans_commit();
                    echo 1;
                    return;
                }
            }
        }
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('administrator/postingstok/index');
        $this->load->view('include/footer');
    }
}