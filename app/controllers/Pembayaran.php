<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pembayaran extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mpembayaran');
        $this->redirect = current_url(). ($_SERVER['QUERY_STRING'] ? '?' .$_SERVER['QUERY_STRING'] : "");
    }

    public function index(){
        $this->cari();
    }

    public function cari()
    {
        $this->sessioncheck->validasi('pemeriksaan', $this->redirect);
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('pelayanan/pembayaran/cari');
        $this->load->view('include/footer');
    }

    public function data()
    {
        $this->sessioncheck->validasi('pembayaran', $this->redirect);
        $q = $this->input->get('q');
        $pg = $this->input->get('pg');

        if ($this->input->get('bln')) 
            $bln = $this->input->get('bln');
        else
            $bln = date('m');

            if ($this->input->get('thn')) 
            $thn = $this->input->get('thn');
        else
            $thn = date('Y');

        $config = array(
            'base_url' => site_url('pembayaran/data?bln='.$bln.'&thn='.$thn.'&q='.$q),
            'first_url' => site_url('pembayaran/data?bln='.$bln.'&thn='.$thn.'&q='.$q),    
            'per_page' => 10,
            'page_query_string' => TRUE,
            'total_rows' => $this->mpembayaran->total_rows($bln, $thn, $q)
        );

        $this->load->library('pagination');
        $this->pagination->initialize($config);
        
        $content = array(
            'data' => $this->mpembayaran->get_limit($bln, $thn, $q, 10, $pg),
            'page' => $this->pagination->create_links(),
            'q' => $q,
            'bln' => $bln,
            'thn' => $thn,
            'total' => $config['total_rows']
        );
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('pelayanan/pembayaran/index', $content);
        $this->load->view('include/footer');
    }

    public function getBlmBayar(){
        $cari = $this->mpembayaran->get_blm_bayar(trim($this->input->post('cari')));
        $this->output->set_content_type('application/json')->set_output(json_encode($cari));
    }

    public function cekStok(){
        $rs = null;
        $i = 0; 
        $j = 0;
        $this->load->model('mstokbarang');
        foreach($this->input->post("idBarang") as $key){
            if (strlen($this->input->post('qtyBarang')[$i]) > 0) {
                $stok = $this->mstokbarang->getStok($this->input->post("idBarang")[$i]);

                if(!$stok){
                    $rs[$j] = array($this->input->post('label')[$i], "Stok tidak tersedia");
                    $j++;
                }else{
                    if($stok - $this->input->post('qtyBarang')[$i] < 0){
                        $rs[$j] = array($this->input->post('label')[$i], "Tersisa ".$stok." ".$this->input->post('satuanBarang')[$i]);
                        $j++;
                    }
                }
            }else{
                $rs[$j] = array($this->input->post('label')[$i], "Input qty permintaan");
                $j++;
            }
            $i++;
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($rs));
    }

    public function getTindakan()
    {
        $this->load->model('mdokter');
        $tp = $this->mdokter->get_by_nama($this->input->post('dr'));
        if($tp->tamuDokter == 0){
            $this->load->model('mdatatindakan');
            $rs = $this->mdatatindakan->get_all();
        }else{
            $this->load->model('mtindakandokter');
            $rs = $this->mtindakandokter->get_by_dokter($this->input->post('dr'));
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($rs));
    }

    public function form($action = null)
    {
        $this->sessioncheck->validasi('pembayaran', $this->redirect);
        if($action){
            if($this->session->userdata('lvlPengguna') < 3){
				$this->db->trans_begin();
				
				if ($_FILES['fotoPemeriksaan']['name']){
					$file = '';
					$this->load->helper('string');
					
	
					$config['upload_path'] = "./upload/";
					$config['allowed_types'] = '*';
					$config['file_name'] = random_string('alnum', 16);
					$this->load->library('upload', $config);
	
					if ($this->upload->do_upload('fotoPemeriksaan')) {
						$file = $this->upload->data();
						$file = UPLOAD_PATH.$file['file_name'];
					}
					else {
						$dlg = array('pesan' => 'Proses upload data gagal ('.$this->upload->display_errors().')', 'tipe' => 'alert-danger');
						$this->session->set_flashdata('message', $dlg);
						redirect($this->input->post('back'));
					}

					$data  = array(
						'fotoPemeriksaan' => $file,
					);
					$this->load->model('mpemeriksaan');
					$this->mpemeriksaan->update($this->security->xss_clean($this->input->post('idPendaftaran')), $this->security->xss_clean($data));
				}
				
                $bayar = $this->mpembayaran->get_last();

                if($bayar){
                    $_bayar = substr($bayar->noPembayaran,11,4) + 1;
                    $nomor = "KW-".date('Y')."/".date('m')."/".sprintf('%04s', $_bayar);
                }else{
                    $nomor = "KW-".date('Y')."/".date('m')."/".'0001';
                }

                $data  = array(
                    'noPembayaran' => $nomor,
                    'idPendaftaran' => $this->input->post('idPendaftaran'),
                    'listrikPembayaran' => str_replace(",", "", $this->input->post("listrikPembayaran")),
                    'adminPembayaran' => str_replace(",", "", $this->input->post("adminPembayaran")),
                    'jmlTagihan' => str_replace(",", "", $this->input->post("jmlTagihan")),
                    'jmlPembayaran' => str_replace(",", "", $this->input->post("jmlPembayaran")),
                    'tglPembayaran' => date('Y-m-d'),
                    'operator' => $this->session->userdata('nmPengguna')
                );
                $this->mpembayaran->insert($this->security->xss_clean($data));

                $i = 0;
                foreach($this->input->post("idTindakan") as $key){
                    $this->mpembayaran->insert_tindakan(
                        $this->security->xss_clean(array(
                            'urutanPembayaranTindakan' => $i,
                            'noPembayaran' => $nomor,
                            'idTindakan' => $this->input->post('idTindakan')[$i],
                            'diskonTindakan' => $this->input->post('diskonTindakan')[$i],
                            'qtyTindakan' => $this->input->post('qtyTindakan')[$i],
                            'biayaTindakan' => str_replace(",", "", $this->input->post('biayaTindakan')[$i]),
                            'namaPetugas' => $this->input->post('namaPetugas')[$i] == 'dokter'? $this->input->post('namaDokter'): $this->input->post('namaPetugas')[$i],
                            'tglPembayaran' => date('Y-m-d')
                            ))
                    );
                    $i++;
                }
                
                $i = 0;
                foreach($this->input->post("idBarang") as $key){
                    $this->mpembayaran->insert_barang(
                        $this->security->xss_clean(array(
                            'urutanPembayaranBarang' => $i,
                            'noPembayaran' => $nomor,
                            'idBarang' => $this->input->post('idBarang')[$i],
                            'qtyBarang' => $this->input->post('qtyBarang')[$i],
                            'hargaJualBarang' => str_replace(",", "", $this->input->post('hargaJualBarang')[$i]),
                            'tglPembayaran' => date('Y-m-d')
                            ))
                    );
                    $i++;
                }
                
                if ($this->db->trans_status() === FALSE){
                    $this->db->trans_rollback();
                    $dlg = array('pesan' => 'Gagal menyimpan data', 'tipe' => 'alert-danger');
                    $this->session->set_flashdata('message', $dlg);
                    redirect('pembayaran');
                }else{
                    $this->db->trans_commit();
                    $dlg = array('pesan' => 'Berhasil menyimpan data', 'tipe' => 'alert-success');
                    $this->session->set_flashdata('message', $dlg);
                    redirect('pembayaran/cetak?no='.$nomor);
                }
            }else{
                $dlg = array('pesan' => 'Tidak ada izin untuk menambah/mengubah data', 'tipe' => 'alert-danger');
                $this->session->set_flashdata('message', $dlg);
                redirect();
            }
        }
        $no = $this->input->get('no');
        $rm = $this->input->get('rm');
        $this->load->model('mdatabarang');
        $this->load->model('mdatatindakan');
        $this->load->model('mpendaftaran');
        $this->load->model('mpemeriksaan');
        $this->load->model('mpetugas');
        $this->load->model('mdatatindakan');
        $barang = $this->mdatabarang->get_by_tipe('a');
        $petugas = $this->mpetugas->get_all();
        $tindakan = $this->mdatatindakan->get_all();

        $content = array(            
            'data' => $this->mpendaftaran->get_by_id($no),
            'tindakan' => $this->mpemeriksaan->get_tindakan($no),
            'tindakanJSON' => json_encode($tindakan),
            'barangJSON' => json_encode($barang),
            'petugasJSON' => json_encode($petugas)
        );
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('pelayanan/pembayaran/form', $content);
        $this->load->view('include/footer');
    }

    public function cetak(){
        $content = array(
            'data' => $this->mpembayaran->get_by_id($this->input->get('no')),
            'barang' => $this->mpembayaran->get_barang($this->input->get('no')),
            'tindakan' => $this->mpembayaran->get_tindakan($this->input->get('no')),
        );
        $this->load->view('pelayanan/pembayaran/kwitansi', $content);
    }

    public function delete()
    {
        $this->sessioncheck->validasi('pembayaran', $this->redirect);
        if($this->mpembayaran->delete($this->security->xss_clean($this->input->post('ID')))){
            $dlg = array('pesan' => 'Berhasil menghapus data', 'tipe' => 'alert-success');
            $this->session->set_flashdata('message', $dlg);
        }else{
            $dlg = array('pesan' => 'Gagal menghapus data', 'tipe' => 'alert-danger');
            $this->session->set_flashdata('message', $dlg);
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
}
