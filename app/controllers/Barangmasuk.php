<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Barangmasuk extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mbarangmasuk');
        $this->redirect = current_url(). ($_SERVER['QUERY_STRING'] ? '?' .$_SERVER['QUERY_STRING'] : "");
    }

    public function index(){
        $this->input();
    }

    public function data(){
        $this->sessioncheck->validasi('barangmasuk', $this->redirect);
        $q = $this->input->get('q');
        $pg = $this->input->get('pg');
		$kat = 1;
		
        if ($this->input->get('tgl1')) 
            $tgl1 = date('Y-m-d', strtotime($this->input->get('tgl1')));
        else
            $tgl1 = date('Y-m-1');

		if ($this->input->get('tgl2')) 
            $tgl2 = date('Y-m-d', strtotime($this->input->get('tgl2')));
        else
            $tgl2 = date('Y-m-t');
		
		if ($this->input->get('kat')) 
            $kat = $this->input->get('kat');
        else
            $kat = 1;
		
		if($kat == 1)
			$where = 'tglBarangMasuk between "'.$tgl1.'" and "'.$tgl2.'"';
		else if($kat == 2)
			$where = 'tglJatuhTempo between "'.$tgl1.'" and "'.$tgl2.'"';
		else if($kat == 3)
			$where = 'tglKadaluarsaBarang between "'.$tgl1.'" and "'.$tgl2.'"';
			

        $config = array(
            'base_url' => site_url('barangmasuk/data?tgl1='.$tgl1.'&tgl2='.$tgl2.'&kat='.$this->input->get('kat').'&q='.$q),
            'first_url' => site_url('barangmasuk/data?tgl1='.$tgl1.'&tgl2='.$tgl2.'&kat='.$this->input->get('kat').'&q='.$q),    
            'per_page' => 10,
            'page_query_string' => TRUE,
            'total_rows' => $this->mbarangmasuk->total_rows($where, $q)
        );

        $this->load->library('pagination');
        $this->pagination->initialize($config);
        
        $content = array(
            'data' => $this->mbarangmasuk->get_limit($where, $q, 10, $pg),
            'page' => $this->pagination->create_links(),
            'q' => $q,
            'tgl1' => $tgl1,
            'tgl2' => $tgl2,
            'kat' => $this->input->get('kat'),
            'total' => $config['total_rows']
        );
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('apotek/barangmasuk/index', $content);
        $this->load->view('include/footer');
    }

	
    public function cetak(){
        $this->sessioncheck->validasi('barangmasuk', $this->redirect);
        $q = $this->input->get('q');
		$tgl1 = date('Y-m-d', strtotime($this->input->get('tgl1')));
		$tgl2 = date('Y-m-d', strtotime($this->input->get('tgl2')));
		
		
		if($this->input->get('kat') == 1)
			$where = 'tglBarangMasuk between "'.$tgl1.'" and "'.$tgl2.'"';
		else
			$where = 'tglJatuhTempo between "'.$tgl1.'" and "'.$tgl2.'"';
			
       
        $content = array(
            'data' => $this->mbarangmasuk->get_limit($where, $q, null, null),
            'q' => $q,
            'tgl1' => $tgl1,
            'tgl2' => $tgl2,
            'kat' => $this->input->get('kat')
		);
        $this->load->view('apotek/barangmasuk/cetak', $content);
    }

    public function input($action = null)
    {
        $this->sessioncheck->validasi('barangmasuk', $this->redirect);
        if($action){
            if($this->session->userdata('lvlPengguna') < 3){
                $this->db->trans_begin();                
                $i = 0;
                foreach($this->input->post("idBarang") as $key){
                $masuk = $this->mbarangmasuk->get_last();

                if($masuk){
                    $_masuk = substr($masuk->idBarangMasuk,6,4) + 1;
                    $nomor = date('Y').date('m').sprintf('%04s', $_masuk);
                }else{
                    $nomor = date('Y').date('m').'0001';
                }

                    $this->mbarangmasuk->insert(
                        $this->security->xss_clean(array(
							'idBarangMasuk' => $nomor,
							'tglBarangMasuk' => date("Y-m-d", strtotime($this->input->post('tglBarangMasuk'))),
							'ketBarangMasuk' => $this->input->post('ketBarangMasuk'),
							'operator' => $this->session->userdata('nmPengguna'),
                            'idBarangMasuk' => $nomor,
                            'idBarang' => $this->input->post('idBarang')[$i],
                            'tglKadaluarsaBarang' => date("Y-m-d", strtotime($this->input->post('tglKadaluarsaBarang')[$i])),
                            'tglJatuhTempo' => date("Y-m-d", strtotime($this->input->post('tglJatuhTempo')[$i])),
                            'jmlBarang' => $this->input->post('jmlBarang')[$i],
                            'hargaBeliBarang' => str_replace(",", "", $this->input->post('hargaBeliBarang')[$i]),
                            'namaSupplier' => $this->input->post('namaSupplier')[$i],
                            'namaPabrik' => $this->input->post('namaPabrik')[$i]
                            ))
                    );
                    $i++;
                }
                if ($this->db->trans_status() === FALSE){
                    $this->db->trans_rollback();
                    $dlg = array('pesan' => 'Gagal menyimpan data', 'tipe' => 'alert-danger');
                    $this->session->set_flashdata('message', $dlg);
                }else{
                    $this->db->trans_commit();
                    $dlg = array('pesan' => 'Berhasil menyimpan data', 'tipe' => 'alert-success');
                    $this->session->set_flashdata('message', $dlg);
                }
            }else{
                $dlg = array('pesan' => 'Tidak ada izin untuk menambah/mengubah data', 'tipe' => 'alert-danger');
                $this->session->set_flashdata('message', $dlg);
            }
            redirect('barangmasuk');
        }

        $this->load->model('mdatabarang');
        $this->load->model('msupplier');
        $this->load->model('mdatapabrik');

        $barang = $this->mdatabarang->get_all();
        $supplier = $this->msupplier->get_all();
        $pabrik = $this->mdatapabrik->get_all();
        $content = array(
            'back' => isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : site_url('barangmasuk'),
            'barangJSON' => json_encode($barang),
            'supplierJSON' => json_encode($supplier),
            'pabrikJSON' => json_encode($pabrik)
            );
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('apotek/barangmasuk/form', $content);
        $this->load->view('include/footer');
    }

    public function delete()
    {
        $this->sessioncheck->validasi('barangmasuk', $this->redirect);
        if($this->mbarangmasuk->delete($this->security->xss_clean($this->input->post('ID')))){
            $dlg = array('pesan' => 'Berhasil menghapus data', 'tipe' => 'alert-success');
            $this->session->set_flashdata('message', $dlg);
        }else{
            $dlg = array('pesan' => 'Gagal menghapus data', 'tipe' => 'alert-danger');
            $this->session->set_flashdata('message', $dlg);
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
}