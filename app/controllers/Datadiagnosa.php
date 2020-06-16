<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Datadiagnosa extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mdiagnosa');
        $this->redirect = current_url(). ($_SERVER['QUERY_STRING'] ? '?' .$_SERVER['QUERY_STRING'] : "");
    }

    public function index()
    {
        $this->sessioncheck->validasi('datadiagnosa', $this->redirect);
        $q = $this->input->get('q');
        $pg = $this->input->get('pg');

        $config = array(
            'base_url' => site_url('datadiagnosa/index?q='.$q),
            'first_url' => site_url('datadiagnosa/index?q='.$q),    
            'per_page' => 10,
            'page_query_string' => TRUE,
            'total_rows' => $this->mdiagnosa->total_rows($q)
        );

        $this->load->library('pagination');
        $this->pagination->initialize($config);
        
        $content = array(
            'data' => $this->mdiagnosa->get_limit($q, 10, $pg),
            'page' => $this->pagination->create_links(),
            'q' => $q,
            'total' => $config['total_rows']
        );
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('datamaster/datadiagnosa/index', $content);
        $this->load->view('include/footer');
    }

    public function tambah($action = null)
    {
        $this->sessioncheck->validasi('datadiagnosa', $this->redirect);
        if($action){
            $this->db->trans_begin();
            $last = $this->mdiagnosa->get_last();

            if($last){
                $last = substr($last->idDiagnosa,0,4);
                $last = $last + 1;
                $id = sprintf('%04s', $last);
            }else{
                $id = '0001';
            }

            $data  = array(
                'namaDiagnosa' => $this->input->post('namaDiagnosa'),
            );
            $this->mdiagnosa->insert($this->security->xss_clean($data));

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
            'back' => $_SERVER['HTTP_REFERER'] ? $_SERVER['HTTP_REFERER'] : "datadiagnosa",
            'namaDiagnosa' => set_value('namaDiagnosa'),
            'idDiagnosa' => set_value('idDiagnosa'),
            );
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('datamaster/datadiagnosa/form', $content);
        $this->load->view('include/footer');
    }

    public function edit($action = null)
    {
        $this->sessioncheck->validasi('datadiagnosa', $this->redirect);
        if($action){
            $this->db->trans_begin();
            $data  = array(
                'namaDiagnosa' => $this->input->post('namaDiagnosa'),
            );
            $this->mdiagnosa->update($this->security->xss_clean($this->input->post('idDiagnosa')), $this->security->xss_clean($data));

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

        $row = $this->mdiagnosa->get_by_id($this->input->get('id'));

        if ($row) {
            $content = array(
                'action' => 'Edit',
                'back' => $_SERVER['HTTP_REFERER'] ? $_SERVER['HTTP_REFERER'] : "datadiagnosa",
                'idDiagnosa' => set_value('idDiagnosa', $row->idDiagnosa),
                'namaDiagnosa' => set_value('namaDiagnosa', $row->namaDiagnosa),
                );
            $this->load->view('include/header');
            $this->load->view('include/sidebar');
            $this->load->view('datamaster/datadiagnosa/form', $content);
            $this->load->view('include/footer');
        } else {
            $dlg = array('pesan' => 'Data tidak ditemukan', 'tipe' => 'alert-danger');
            $this->session->set_flashdata('message', $dlg);
            redirect('datadiagnosa');
        }
    }

    public function delete()
    {
        $this->sessioncheck->validasi('datadiagnosa', $this->redirect);
        if($this->mdiagnosa->delete($this->security->xss_clean($this->input->post('ID')))){
            $dlg = array('pesan' => 'Berhasil menghapus data', 'tipe' => 'alert-success');
            $this->session->set_flashdata('message', $dlg);
        }else{
            $dlg = array('pesan' => 'Gagal menghapus data', 'tipe' => 'alert-danger');
            $this->session->set_flashdata('message', $dlg);
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
}
