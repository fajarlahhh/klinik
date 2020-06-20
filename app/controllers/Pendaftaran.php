<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mpendaftaran');
        $this->redirect = current_url(). ($_SERVER['QUERY_STRING'] ? '?' .$_SERVER['QUERY_STRING'] : "");
    }

    public function index(){
        $this->tambah();
    }

    public function data()
    {
        $this->sessioncheck->validasi('pendaftaran', $this->redirect);
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

        if ($this->input->get('st')) 
                $st = $this->input->get('st');
            else
                $st = 0;

        $kategory =  array('statPembayaran' => $st);

        $config = array(
            'base_url' => site_url('pendaftaran/data?bln='.$bln.'&thn='.$thn.'&st='.$st.'&q='.$q),
            'first_url' => site_url('pendaftaran/data?bln='.$bln.'&thn='.$thn.'&st='.$st.'&q='.$q),    
            'per_page' => 10,
            'page_query_string' => TRUE,
            'total_rows' => $this->mpendaftaran->total_rows($bln, $thn, $kategory, $q)
        );

        $this->load->library('pagination');
        $this->pagination->initialize($config);
        
        $content = array(
            'data' => $this->mpendaftaran->get_limit($bln, $thn, $kategory, $q, 10, $pg),
            'page' => $this->pagination->create_links(),
            'q' => $q,
            'bln' => $bln,
            'thn' => $thn,
            'st' => $st,
            'total' => $config['total_rows']
        );
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('pelayanan/pendaftaran/index', $content);
        $this->load->view('include/footer');
    }

    public function tambah($action = null)
    {
        $this->sessioncheck->validasi('pendaftaran', $this->redirect);
        if($action){
            if($this->session->userdata('lvlPengguna') < 3){
                $this->db->trans_begin();
                if($this->input->post('baruOrLama') == 'b'){
                    $this->load->model('mpasien');
                    $last = $this->mpasien->get_last();
    
                    if($last){
                        $_last = substr($last->rmPasien,6,4) + 1;
                        $rm = date('y').".".date('m').".".sprintf('%04s', $_last);
                    }else{
                        $rm = date('y').".".date('m').".".'0001';
                    }
    
                    $data  = array(
                        'rmPasien' => $rm,
                        'namaPasien' => $this->input->post('namaPasien'),
                        'ktpPasien' => $this->input->post('ktpPasien'),
                        'alamatPasien' => $this->input->post('alamatPasien'),
                        'tempatLahirPasien' => $this->input->post('tempatLahirPasien'),
                        'tglLahirPasien' => date('Y-m-d', strtotime($this->input->post('tglLahirPasien'))),
                        'kelaminPasien' => $this->input->post('kelaminPasien'),
                        'telpPasien' => $this->input->post('telpPasien'),
                        'pekerjaanPasien' => $this->input->post('pekerjaanPasien'),
                        'tglRegistrasi' => date('Y-m-d'),
                        'operator' => $this->session->userdata('nmPengguna')
                    );
                    $this->mpasien->insert($this->security->xss_clean($data));
                }

                $daftar = $this->mpendaftaran->get_last();
                $nomor = $daftar->noPendaftaran + 1;

                $data  = array(
                    'noPendaftaran' => $nomor,
					'tglPendaftaran' => date('Y-m-d', strtotime($this->input->post('tglPendaftaran'))),
                    'rmPasien' => ($this->input->post('baruOrLama') == 'b'? $rm: $this->input->post('rmPasien')),
                    'keteranganPendaftaran' => $this->input->post('keteranganPendaftaran'),
                    'namaDokter' => $this->input->post('namaDokter'),
                        'statPemeriksaan' => 0,
                    'baruOrLama' => $this->input->post('baruOrLama'),
                    'operator' => $this->session->userdata('nmPengguna')
                );
                $this->mpendaftaran->insert($this->security->xss_clean($data));

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
            redirect($this->input->post('back'));
        }

        $this->load->model('mdokter');
        $dokter = null;
        foreach ($this->mdokter->get_all() as $row) {
            $dokter[$row->namaDokter] = $row->namaDokter;
        }
        $content = array(
            'action' => 'Tambah',
            'back' => "pendaftaran",
            'dokter' => $dokter,
            'rmPasien' => set_value('rmPasien'),
            'namaPasien' => set_value('namaPasien'),
            'ktpPasien' => set_value('ktpPasien'),
            'alamatPasien' => set_value('alamatPasien'),
            'tempatLahirPasien' => set_value('tempatLahirPasien'),
            'tglLahirPasien' => set_value('tglLahirPasien'),
            'tglPendaftaran' => set_value('tglPendaftaran'),
            'telpPasien' => set_value('telpPasien'),
            'kelaminPasien' => set_value('kelaminPasien'),
            'pekerjaanPasien' => set_value('pekerjaanPasien'),
            'keteranganPendaftaran' => set_value('keteranganPendaftaran'),
            'namaDokter' => set_value('namaDokter'),
            'idPendaftaran' => set_value('idPendaftaran')
            );
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('pelayanan/pendaftaran/form', $content);
        $this->load->view('include/footer');
    }

    public function delete()
    {
        $this->sessioncheck->validasi('pendaftaran', $this->redirect);
        if($this->mpendaftaran->delete($this->security->xss_clean($this->input->post('ID')))){
            $dlg = array('pesan' => 'Berhasil menghapus data', 'tipe' => 'alert-success');
            $this->session->set_flashdata('message', $dlg);
        }else{
            $dlg = array('pesan' => 'Gagal menghapus data', 'tipe' => 'alert-danger');
            $this->session->set_flashdata('message', $dlg);
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
}