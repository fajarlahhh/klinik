<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Datadokter extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mdokter');
        $this->redirect = current_url(). ($_SERVER['QUERY_STRING'] ? '?' .$_SERVER['QUERY_STRING'] : "");
    }

    public function index()
    {
        $this->sessioncheck->validasi('datadokter', $this->redirect);
        $q = $this->input->get('q');
        $pg = $this->input->get('pg');

        $config = array(
            'base_url' => site_url('datadokter/index?q='.$q),
            'first_url' => site_url('datadokter/index?q='.$q),    
            'per_page' => 10,
            'page_query_string' => TRUE,
            'total_rows' => $this->mdokter->total_rows($q)
        );

        $this->load->library('pagination');
        $this->pagination->initialize($config);
        
        $content = array(
            'data' => $this->mdokter->get_limit($q, 10, $pg),
            'page' => $this->pagination->create_links(),
            'q' => $q,
            'total' => $config['total_rows']
        );
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('datamaster/datadokter/index', $content);
        $this->load->view('include/footer');
    }

    public function tambah($action = null)
    {
        $this->sessioncheck->validasi('datadokter', $this->redirect);
        if($action){
            $this->db->trans_begin();
            $last = $this->mdokter->get_last();

            if($last){
                $last = substr($last->idDokter,0,4);
                $last = $last + 1;
                $id = sprintf('%04s', $last);
            }else{
                $id = '0001';
            }

            $data  = array(
                'idDokter' => $id,
                'namaDokter' => $this->input->post('namaDokter'),
                'alamatDokter' => $this->input->post('alamatDokter'),
                'telpDokter' => $this->input->post('telpDokter'),
                'tamuDokter' => $this->input->post('tamuDokter'),
                'operator' => $this->session->userdata('nmPengguna')
            );
            $this->mdokter->insert($this->security->xss_clean($data));

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
            'back' => $_SERVER['HTTP_REFERER'] ? $_SERVER['HTTP_REFERER'] : "datadokter",
            'idDokter' => set_value('idDokter'),
            'namaDokter' => set_value('namaDokter'),
            'alamatDokter' => set_value('alamatDokter'),
            'tamuDokter' => set_value('tamuDokter'),
            'telpDokter' => set_value('telpDokter')
            );
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('datamaster/datadokter/form', $content);
        $this->load->view('include/footer');
    }

    public function edit($action = null)
    {
        $this->sessioncheck->validasi('datadokter', $this->redirect);
        if($action){
            $this->db->trans_begin();
            $data  = array(
                'namaDokter' => $this->input->post('namaDokter'),
                'alamatDokter' => $this->input->post('alamatDokter'),
                'telpDokter' => $this->input->post('telpDokter'),
                'tamuDokter' => $this->input->post('tamuDokter'),
                'operator' => $this->session->userdata('nmPengguna')
            );
            $this->mdokter->update($this->security->xss_clean($this->input->post('idDokter')), $this->security->xss_clean($data));

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

        $row = $this->mdokter->get_by_id($this->input->get('id'));

        if ($row) {
            $content = array(
                'action' => 'Edit',
                'back' => $_SERVER['HTTP_REFERER'] ? $_SERVER['HTTP_REFERER'] : "datadokter",
                'idDokter' => set_value('idDokter', $row->idDokter),
                'namaDokter' => set_value('namaDokter', $row->namaDokter),
                'alamatDokter' => set_value('alamatDokter', $row->alamatDokter),
                'tamuDokter' => set_value('tamuDokter', $row->tamuDokter),
                'telpDokter' => set_value('telpDokter', $row->telpDokter),
                );
            $this->load->view('include/header');
            $this->load->view('include/sidebar');
            $this->load->view('datamaster/datadokter/form', $content);
            $this->load->view('include/footer');
        } else {
            $dlg = array('pesan' => 'Data tidak ditemukan', 'tipe' => 'alert-danger');
            $this->session->set_flashdata('message', $dlg);
            redirect('datadokter');
        }
    }

    public function delete()
    {
        $this->sessioncheck->validasi('datadokter', $this->redirect);
        if($this->mdokter->delete($this->security->xss_clean($this->input->post('ID')))){
            $dlg = array('pesan' => 'Berhasil menghapus data', 'tipe' => 'alert-success');
            $this->session->set_flashdata('message', $dlg);
        }else{
            $dlg = array('pesan' => 'Gagal menghapus data', 'tipe' => 'alert-danger');
            $this->session->set_flashdata('message', $dlg);
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
}