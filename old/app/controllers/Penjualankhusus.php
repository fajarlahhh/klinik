<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penjualankhusus extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mpenjualan');
        $this->redirect = current_url(). ($_SERVER['QUERY_STRING'] ? '?' .$_SERVER['QUERY_STRING'] : "");
    }

    public function index(){
        $this->input();
    }

    public function data()
    {
        $this->sessioncheck->validasi('penjualankhusus', $this->redirect);
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
            'base_url' => site_url('penjualankhusus/data?bln='.$bln.'&thn='.$thn.'&q='.$q),
            'first_url' => site_url('penjualankhusus/data?bln='.$bln.'&thn='.$thn.'&q='.$q),    
            'per_page' => 10,
            'page_query_string' => TRUE,
            'total_rows' => $this->mpenjualan->total_rows($bln, $thn, $q)
        );

        $this->load->library('pagination');
        $this->pagination->initialize($config);
        
        $content = array(
            'data' => $this->mpenjualan->get_limit($bln, $thn, $q, 10, $pg),
            'page' => $this->pagination->create_links(),
            'q' => $q,
            'bln' => $bln,
            'thn' => $thn,
            'total' => $config['total_rows']
        );
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('apotek/penjualankhusus/index', $content);
        $this->load->view('include/footer');
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
                        $rs[$j] = array($this->input->post('label')[$i], "Tersisa ".$stok);
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

    public function input($action = null)
    {
        $this->sessioncheck->validasi('penjualankhusus', $this->redirect);
        if($action){
            if($this->session->userdata('lvlPengguna') < 3){
                $this->db->trans_begin();
                $bayar = $this->mpenjualan->get_last();

                if($bayar){
                    $_bayar = substr($bayar->idBarangKeluar,15,4) + 1;
                    $nomor = "KW-OBT-".date('Y')."/".date('m')."/".sprintf('%04s', $_bayar);
                }else{
                    $nomor = "KW-OBT-".date('Y')."/".date('m')."/".'0001';
                }

                $data  = array(
                    'idBarangKeluar' => $nomor,
                    'ketBarangKeluar' => $this->input->post('ketBarangKeluar'),
                    'namaDokter' => $this->input->post('namaDokter'),
                    'khusus' => 1,
                    'pelangganBarangKeluar' => $this->input->post('pelangganBarangKeluar'),
                    'listrikBarangKeluar' => str_replace(",", "", $this->input->post("listrikBarangKeluar")),
                    'adminBarangKeluar' => str_replace(",", "", $this->input->post("adminBarangKeluar")),
                    'resepBarangKeluar' => str_replace(",", "", $this->input->post("resepBarangKeluar")),
                    'jmlTagihan' => str_replace(",", "", $this->input->post("jmlTagihan")),
                    'jmlPembayaran' => str_replace(",", "", $this->input->post("jmlPembayaran")),
                    'tglBarangKeluar' => date('Y-m-d', strtotime($this->input->post("tglBarangKeluar"))),
                    'operator' => $this->session->userdata('nmPengguna')
                );
                $this->mpenjualan->insert($this->security->xss_clean($data));

                $i = 0;
                foreach($this->input->post("idBarang") as $key){
                    $this->mpenjualan->insert_barang(
                        $this->security->xss_clean(array(
                            'urutBarangKeluar' => $i,
                            'idBarangKeluar' => $nomor,
                            'idBarang' => $this->input->post('idBarang')[$i],
                            'namaBarang' => $this->input->post('namaBarang')[$i],
                            'diskonBarang' => $this->input->post('diskonBarang')[$i],
                            'satuanBarang' => $this->input->post('satuanBarang')[$i],
                            'qtyBarang' => $this->input->post('qtyBarang')[$i],
                            'hargaJualBarang' => str_replace(",", "", $this->input->post('hargaJualBarang')[$i]),
                            'resep' => $this->input->post('resepBarang')[$i],
                            'namaResep' => trim( $this->input->post('namaResep')[$this->input->post('resepBarang')[$i]-1]),
                            'tglBarangKeluar' => date('Y-m-d')
                            ))
                    );
                    $i++;
                }
                                
                if ($this->db->trans_status() === FALSE){
                    $this->db->trans_rollback();
                    $dlg = array('pesan' => 'Gagal menyimpan data', 'tipe' => 'alert-danger');
                    $this->session->set_flashdata('message', $dlg);
                    redirect('penjualankhusus');
                }else{
                    $this->db->trans_commit();
                    $dlg = array('pesan' => 'Berhasil menyimpan data', 'tipe' => 'alert-success');
                    $this->session->set_flashdata('message', $dlg);
                    redirect('penjualankhusus/cetak?no='.$nomor);
                }
            }else{
                $dlg = array('pesan' => 'Tidak ada izin untuk menambah/mengubah data', 'tipe' => 'alert-danger');
                $this->session->set_flashdata('message', $dlg);
                redirect();
            }
        }
        $this->load->model('mdatabarang');
        $barang = $this->mdatabarang->get_khusus();
        $this->load->model('mdokter');
        $dokter = null;
        foreach ($this->mdokter->get_all() as $row) {
            $dokter[$row->namaDokter] = $row->namaDokter;
        }
        $content = array(            
            'dokter' => $dokter,
            'barangJSON' => json_encode($barang)
        );
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('apotek/penjualankhusus/form', $content);
        $this->load->view('include/footer');
    }

    public function cetak(){
        $content = array(
            'data' => $this->mpenjualan->get_by_id($this->input->get('no')),
            'resep' => $this->mpenjualan->get_resep($this->input->get('no')),
            'detail' => $this->mpenjualan->get_detail($this->input->get('no'))
        );
        $this->load->view('apotek/penjualankhusus/kwitansi', $content);
    }


    public function cetakdetail(){
        $content = array(
            'data' => $this->mpenjualan->get_by_id($this->input->get('no')),
            'resep' => [],
            'detail' => $this->mpenjualan->get_detail_biasa($this->input->get('no'))
        );
        $this->load->view('apotek/penjualankhusus/kwitansi', $content);
    }

    public function delete()
    {
        $this->sessioncheck->validasi('penjualankhusus', $this->redirect);
        if($this->mpenjualan->delete($this->security->xss_clean($this->input->post('ID')))){
            $dlg = array('pesan' => 'Berhasil menghapus data', 'tipe' => 'alert-success');
            $this->session->set_flashdata('message', $dlg);
        }else{
            $dlg = array('pesan' => 'Gagal menghapus data', 'tipe' => 'alert-danger');
            $this->session->set_flashdata('message', $dlg);
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
}