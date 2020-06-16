<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Datapetugas extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mpetugas');
        $this->redirect = current_url(). ($_SERVER['QUERY_STRING'] ? '?' .$_SERVER['QUERY_STRING'] : "");
    }

    public function index()
    {
        $this->sessioncheck->validasi('datapetugas', $this->redirect);
        $q = $this->input->get('q');
        $pg = $this->input->get('pg');

        $config = array(
            'base_url' => site_url('datapetugas/index?q='.$q),
            'first_url' => site_url('datapetugas/index?q='.$q),    
            'per_page' => 10,
            'page_query_string' => TRUE,
            'total_rows' => $this->mpetugas->total_rows($q)
        );

        $this->load->library('pagination');
        $this->pagination->initialize($config);
        
        $content = array(
            'data' => $this->mpetugas->get_limit($q, 10, $pg),
            'page' => $this->pagination->create_links(),
            'q' => $q,
            'total' => $config['total_rows']
        );
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('datamaster/datapetugas/index', $content);
        $this->load->view('include/footer');
    }

    public function tambah($action = null)
    {
        $this->sessioncheck->validasi('datapetugas', $this->redirect);
        if($action){
            $this->db->trans_begin();
            $data  = array(
                'namaPetugas' => $this->input->post('namaPetugas')
            );
            $this->mpetugas->insert($this->security->xss_clean($data));

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $dlg = array('pesan' => 'Gagal menyimpan data', 'tipe' => 'alert-danger');
                $this->session->set_flashdata('message', $dlg);
            }else{
                $this->db->trans_commit();
                $dlg = array('pesan' => 'Berhasil menyimpan data', 'tipe' => 'alert-success');
                $this->session->set_flashdata('message', $dlg);
            }
            redirect($this->input->post('back'));
        }
        $content = array(
            'action' => 'Tambah',
            'back' => $_SERVER['HTTP_REFERER'] ? $_SERVER['HTTP_REFERER'] : "datapetugas",
            'namaPetugas' => set_value('namaPetugas'),
            );
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('datamaster/datapetugas/form', $content);
        $this->load->view('include/footer');
    }

    public function edit($action = null)
    {
        $this->sessioncheck->validasi('datapetugas', $this->redirect);
        if($action){
            $this->db->trans_begin();
            $data  = array(
                'namaPetugas' => $this->input->post('namaPetugas')
            );
            $this->mpetugas->update($this->security->xss_clean($this->input->post('ID')), $this->security->xss_clean($data));

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $dlg = array('pesan' => 'Gagal menyimpan data', 'tipe' => 'alert-danger');
                $this->session->set_flashdata('message', $dlg);
            }else{
                $this->db->trans_commit();
                $dlg = array('pesan' => 'Berhasil menyimpan data', 'tipe' => 'alert-success');
                $this->session->set_flashdata('message', $dlg);
            }
            redirect($this->input->post('back'));
        }

        $row = $this->mpetugas->get_by_id($this->input->get('id'));

        if ($row) {
            $content = array(
                'action' => 'Edit',
                'back' => $_SERVER['HTTP_REFERER'] ? $_SERVER['HTTP_REFERER'] : "datapetugas",
                'namaPetugas' => set_value('namaPetugas', $row->namaPetugas),
                );
            $this->load->view('include/header');
            $this->load->view('include/sidebar');
            $this->load->view('datamaster/datapetugas/form', $content);
            $this->load->view('include/footer');
        } else {
            $dlg = array('pesan' => 'Data tidak ditemukan', 'tipe' => 'alert-danger');
            $this->session->set_flashdata('message', $dlg);
            redirect('datapetugas');
        }
    }

    public function delete()
    {
        $this->sessioncheck->validasi('datapetugas', $this->redirect);
        if($this->mpetugas->delete($this->security->xss_clean($this->input->post('ID')))){
            $dlg = array('pesan' => 'Berhasil menghapus data', 'tipe' => 'alert-success');
            $this->session->set_flashdata('message', $dlg);
        }else{
            $dlg = array('pesan' => 'Gagal menghapus data', 'tipe' => 'alert-danger');
            $this->session->set_flashdata('message', $dlg);
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
}