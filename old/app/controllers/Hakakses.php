<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hakakses extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mpengguna');
        $this->redirect = current_url(). ($_SERVER['QUERY_STRING'] ? '?' .$_SERVER['QUERY_STRING'] : "");
    }

    public function index()
    {
        $this->sessioncheck->validasi('hakakses', $this->redirect);
        $q = $this->input->get('q');
        $pg = $this->input->get('pg');

        $config = array(
            'base_url' => site_url('hakakses/index?q='.$q),
            'first_url' => site_url('hakakses/index?q='.$q),    
            'per_page' => 10,
            'page_query_string' => TRUE,
            'total_rows' => $this->mpengguna->total_rows($q)
        );

        $this->load->library('pagination');
        $this->pagination->initialize($config);
        
        $content = array(
            'data' => $this->mpengguna->get_limit($q, 10, $pg),
            'page' => $this->pagination->create_links(),
            'q' => $q,
            'total' => $config['total_rows']
        );
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('setup/hakakses/index', $content);
        $this->load->view('include/footer');
    }

    public function akses(){
        $this->sessioncheck->validasi('hakakses');
        $this->load->model('mmenu');
        $prt = null;
        for ($i=0; $i < count($this->input->post("kdMenu")); $i++) { 
            $row = $this->mmenu->get_by_id($this->input->post('kdMenu')[$i]);
            if($prt != $row->parentMenu && $row->parentMenu != $this->input->post('kdMenu')[$i]) {
                $data = array(
                    'idPengguna' => $this->input->post('idPengguna'),
                    'kdMenu' => $row->parentMenu 
                    );
                $this->mpengguna->insert_akses($this->security->xss_clean($data));
                $prt = $row->parentMenu;
            }
            if($this->input->post('kdMenu')[$i]){
                $data = array(
                    'idPengguna' => $this->input->post('idPengguna'),
                    'kdMenu' =>  $this->input->post('kdMenu')[$i]
                    );
                $this->mpengguna->insert_akses($this->security->xss_clean($data));
            }
        }
        return 1;
    }

    public function tambah($action = null)
    {
        $this->sessioncheck->validasi('hakakses', $this->redirect);
        if($action){
            if($this->session->userdata('lvlPengguna') == 0){
                $this->db->trans_begin();
                $data  = array(
                    'idPengguna' => $this->input->post('idPengguna'),
                    'nmPengguna' => $this->input->post('nmPengguna'),
                    'tlpPengguna' => $this->input->post('tlpPengguna'),
                    'sandiPengguna' => base64_encode($this->input->post('sandiPengguna')),
                    'lvlPengguna' => $this->input->post('lvlPengguna')
                    );
                $this->mpengguna->insert($this->security->xss_clean($data));
                $this->akses();

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
        $this->load->model('mmenu');
        $content = array(
            'action' => 'Tambah',
            'back' => $_SERVER['HTTP_REFERER'] ? $_SERVER['HTTP_REFERER'] : "hakakses",
            'detail' => null,
            'menu' => $this->mmenu->get_parent(),
            'idPengguna' => set_value('idPengguna'),
            'nmPengguna' => set_value('nmPengguna'),
            'tlpPengguna' => set_value('tlpPengguna'),
            'sandiPengguna' => set_value('sandiPengguna'),
            'lvlPengguna' => set_value('lvlPengguna')
            );
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('setup/hakakses/form', $content);
        $this->load->view('include/footer');
    }

    public function edit($action = null)
    {
        $this->sessioncheck->validasi('hakakses', $this->redirect);
        if($action){
            if($this->session->userdata('lvlPengguna') == 0){
                $this->db->trans_begin();
                $data  = array(
                    'idPengguna' => $this->input->post('idPengguna'),
                    'nmPengguna' => $this->input->post('nmPengguna'),
                    'tlpPengguna' => $this->input->post('tlpPengguna'),
                    'sandiPengguna' => base64_encode($this->input->post('sandiPengguna')),
                    'lvlPengguna' => $this->input->post('lvlPengguna')
                    );
                    $this->mpengguna->update($this->security->xss_clean($this->input->post('ID')), $this->security->xss_clean($data));
                    $this->mpengguna->delete_akses($this->security->xss_clean($this->input->post('ID')));
                $this->akses();

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

        $row = $this->mpengguna->get_by_id($this->input->get('id'));

        if ($row) {
            $this->load->model('mmenu');
            $content = array(
                'action' => 'Edit',
                'back' => $_SERVER['HTTP_REFERER'] ? $_SERVER['HTTP_REFERER'] : "hakakses",
                'detail' => $this->mpengguna->get_akses($this->input->get('id')),
                'menu' => $this->mmenu->get_parent(),
                'idPengguna' => set_value('idPengguna', $row->idPengguna),
                'nmPengguna' => set_value('nmPengguna', $row->nmPengguna),
                'tlpPengguna' => set_value('tlpPengguna', $row->tlpPengguna),
                'sandiPengguna' => set_value('sandiPengguna', $row->sandiPengguna),
                'lvlPengguna' => set_value('lvlPengguna', $row->lvlPengguna)
                );
            $this->load->view('include/header');
            $this->load->view('include/sidebar');
            $this->load->view('setup/hakakses/form', $content);
            $this->load->view('include/footer');
        } else {
            $dlg = array('pesan' => 'Hak akses tidak ditemukan', 'tipe' => 'alert-danger');
            $this->session->set_flashdata('message', $dlg);
            redirect('hakakses');
        }
    }

    public function delete()
    {
        $this->sessioncheck->validasi('hakakses', $this->redirect);
        if($this->session->userdata('lvlPengguna') == 0){
            if($this->input->post('ID') != 'admin'){
                if($this->mpengguna->delete($this->security->xss_clean($this->input->post('ID')))){
                    $dlg = array('pesan' => 'Berhasil menghapus data', 'tipe' => 'alert-success');
                    $this->session->set_flashdata('message', $dlg);
                }else{
                    $dlg = array('pesan' => 'Gagal menghapus data', 'tipe' => 'alert-danger');
                    $this->session->set_flashdata('message', $dlg);
                }
            }else{
                $dlg = array('pesan' => 'Tida dapat menghapus data', 'tipe' => 'alert-danger');
                $this->session->set_flashdata('message', $dlg);
            }        
        }else{
            $dlg = array('pesan' => 'Tidak ada izin untuk menambah/mengubah data', 'tipe' => 'alert-danger');
            $this->session->set_flashdata('message', $dlg);
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
}