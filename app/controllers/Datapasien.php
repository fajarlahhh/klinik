<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Datapasien extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mpasien');
        $this->redirect = current_url(). ($_SERVER['QUERY_STRING'] ? '?' .$_SERVER['QUERY_STRING'] : "");
    }

    public function index()
    {
        $this->sessioncheck->validasi('datapasien', $this->redirect);
        $q = $this->input->get('q');
        $pg = $this->input->get('pg');

        $config = array(
            'base_url' => site_url('datapasien/index?q='.$q),
            'first_url' => site_url('datapasien/index?q='.$q),    
            'per_page' => 10,
            'page_query_string' => TRUE,
            'total_rows' => $this->mpasien->total_rows($q)
        );

        $this->load->library('pagination');
        $this->pagination->initialize($config);
        
        $content = array(
            'data' => $this->mpasien->get_limit($q, 10, $pg),
            'page' => $this->pagination->create_links(),
            'q' => $q,
            'total' => $config['total_rows']
        );
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('datamaster/datapasien/index', $content);
        $this->load->view('include/footer');
    }

    public function tambah($action = null)
    {
        $this->sessioncheck->validasi('datapasien', $this->redirect);
        if($action){
            if($this->session->userdata('lvlPengguna') < 2){
                $this->db->trans_begin();
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
                    'operator' => $this->session->userdata('nmPengguna')
                );
                $this->mpasien->insert($this->security->xss_clean($data));

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
        $content = array(
            'action' => 'Tambah',
            'back' => $_SERVER['HTTP_REFERER'] ? $_SERVER['HTTP_REFERER'] : "datapasien",
            'rmPasien' => set_value('rmPasien'),
            'namaPasien' => set_value('namaPasien'),
            'ktpPasien' => set_value('ktpPasien'),
            'alamatPasien' => set_value('alamatPasien'),
            'tempatLahirPasien' => set_value('tempatLahirPasien'),
            'tglLahirPasien' => set_value('tglLahirPasien'),
            'telpPasien' => set_value('telpPasien'),
            'kelaminPasien' => set_value('kelaminPasien'),
            'pekerjaanPasien' => set_value('pekerjaanPasien')
            );
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('datamaster/datapasien/form', $content);
        $this->load->view('include/footer');
    }

    public function getPasien(){
        $this->sessioncheck->login();
        $rs = $this->mpasien->get_all($this->security->xss_clean($this->input->post('ID')));
        $this->output->set_content_type('application/json')->set_output(json_encode($rs));
    }

    public function edit($action = null)
    {
        $this->sessioncheck->validasi('datapasien', $this->redirect);
        if($action){
            if($this->session->userdata('lvlPengguna') < 3){
                $this->db->trans_begin();
                $data  = array(
                    'namaPasien' => $this->input->post('namaPasien'),
                    'ktpPasien' => $this->input->post('ktpPasien'),
                    'alamatPasien' => $this->input->post('alamatPasien'),
                    'tempatLahirPasien' => $this->input->post('tempatLahirPasien'),
                    'tglLahirPasien' => date('Y-m-d', strtotime($this->input->post('tglLahirPasien'))),
                    'kelaminPasien' => $this->input->post('kelaminPasien'),
                    'telpPasien' => $this->input->post('telpPasien'),
                    'pekerjaanPasien' => $this->input->post('pekerjaanPasien'),
                    'operator' => $this->session->userdata('nmPengguna')
                );
                $this->mpasien->update($this->security->xss_clean($this->input->post('rmPasien')), $this->security->xss_clean($data));

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

        $row = $this->mpasien->get_by_id($this->input->get('id'));

        if ($row) {
        $this->load->model('mrekammedis');
            $content = array(
                'action' => 'Edit',
                'back' => $_SERVER['HTTP_REFERER'] ? $_SERVER['HTTP_REFERER'] : "datapasien",
                'rmPasien' => set_value('rmPasien', $row->rmPasien),
                'namaPasien' => set_value('namaPasien', $row->namaPasien),
                'ktpPasien' => set_value('ktpPasien', $row->ktpPasien),
                'alamatPasien' => set_value('alamatPasien', $row->alamatPasien),
                'tempatLahirPasien' => set_value('tempatLahirPasien', $row->tempatLahirPasien),
                'tglLahirPasien' => set_value('tglLahirPasien', $row->tglLahirPasien),
                'telpPasien' => set_value('telpPasien', $row->telpPasien),
                'kelaminPasien' => set_value('kelaminPasien', $row->kelaminPasien),
                'pekerjaanPasien' => set_value('pekerjaanPasien', $row->pekerjaanPasien),
            'rm' => $this->mrekammedis->get_rm($row->rmPasien),
            'obat' => $this->mrekammedis->get_barang($row->rmPasien)		
                );
            $this->load->view('include/header');
            $this->load->view('include/sidebar');
            $this->load->view('datamaster/datapasien/form', $content);
            $this->load->view('include/footer');
        } else {
            $dlg = array('pesan' => 'Data tidak ditemukan', 'tipe' => 'alert-danger');
            $this->session->set_flashdata('message', $dlg);
            redirect('datapasien');
        }
    }

    public function delete()
    {
        $this->sessioncheck->validasi('datapasien', $this->redirect);
        if($this->mpasien->delete($this->security->xss_clean($this->input->post('ID')))){
            $dlg = array('pesan' => 'Berhasil menghapus data', 'tipe' => 'alert-success');
            $this->session->set_flashdata('message', $dlg);
        }else{
            $dlg = array('pesan' => 'Gagal menghapus data', 'tipe' => 'alert-danger');
            $this->session->set_flashdata('message', $dlg);
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
}