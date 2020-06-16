<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Datasupplier extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('msupplier');
        $this->redirect = current_url(). ($_SERVER['QUERY_STRING'] ? '?' .$_SERVER['QUERY_STRING'] : "");
    }

    public function index()
    {
        $this->sessioncheck->validasi('datasupplier', $this->redirect);
        $q = $this->input->get('q');
        $pg = $this->input->get('pg');

        $config = array(
            'base_url' => site_url('datasupplier/index?q='.$q),
            'first_url' => site_url('datasupplier/index?q='.$q),    
            'per_page' => 10,
            'page_query_string' => TRUE,
            'total_rows' => $this->msupplier->total_rows($q)
        );

        $this->load->library('pagination');
        $this->pagination->initialize($config);
        
        $content = array(
            'data' => $this->msupplier->get_limit($q, 10, $pg),
            'page' => $this->pagination->create_links(),
            'q' => $q,
            'total' => $config['total_rows']
        );
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('datamaster/datasupplier/index', $content);
        $this->load->view('include/footer');
    }

    public function tambah($action = null)
    {
        $this->sessioncheck->validasi('datasupplier', $this->redirect);
        if($action){
            $this->db->trans_begin();
            $data  = array(
                'namaSupplier' => $this->input->post('namaSupplier'),
                'alamatSupplier' => $this->input->post('alamatSupplier'),
                'telpSupplier' => $this->input->post('telpSupplier'),
                'konsinyasiSupplier' => $this->input->post('konsinyasiSupplier')
            );
            $this->msupplier->insert($this->security->xss_clean($data));

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
            'back' => $_SERVER['HTTP_REFERER'] ? $_SERVER['HTTP_REFERER'] : "datasupplier",
            'namaSupplier' => set_value('namaSupplier'),
            'alamatSupplier' => set_value('alamatSupplier'),
            'telpSupplier' => set_value('telpSupplier'),
            'konsinyasiSupplier' => set_value('konsinyasiSupplier')
            );
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('datamaster/datasupplier/form', $content);
        $this->load->view('include/footer');
    }

    public function edit($action = null)
    {
        $this->sessioncheck->validasi('datasupplier', $this->redirect);
        if($action){
            $this->db->trans_begin();
            $data  = array(
                'namaSupplier' => $this->input->post('namaSupplier'),
                'alamatSupplier' => $this->input->post('alamatSupplier'),
                'telpSupplier' => $this->input->post('telpSupplier'),
                'konsinyasiSupplier' => $this->input->post('konsinyasiSupplier')
            );
            $this->msupplier->update($this->security->xss_clean($this->input->post('ID')), $this->security->xss_clean($data));

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

        $row = $this->msupplier->get_by_id($this->input->get('id'));

        if ($row) {
            $content = array(
                'action' => 'Edit',
                'back' => $_SERVER['HTTP_REFERER'] ? $_SERVER['HTTP_REFERER'] : "datasupplier",
                'namaSupplier' => set_value('namaSupplier', $row->namaSupplier),
                'alamatSupplier' => set_value('alamatSupplier', $row->alamatSupplier),
                'telpSupplier' => set_value('telpSupplier', $row->telpSupplier),
                'konsinyasiSupplier' => set_value('konsinyasiSupplier', $row->konsinyasiSupplier),
                );
            $this->load->view('include/header');
            $this->load->view('include/sidebar');
            $this->load->view('datamaster/datasupplier/form', $content);
            $this->load->view('include/footer');
        } else {
            $dlg = array('pesan' => 'Data tidak ditemukan', 'tipe' => 'alert-danger');
            $this->session->set_flashdata('message', $dlg);
            redirect('datasupplier');
        }
    }

    public function delete()
    {
        $this->sessioncheck->validasi('datasupplier', $this->redirect);
        if($this->msupplier->delete($this->security->xss_clean($this->input->post('ID')))){
            $dlg = array('pesan' => 'Berhasil menghapus data', 'tipe' => 'alert-success');
            $this->session->set_flashdata('message', $dlg);
        }else{
            $dlg = array('pesan' => 'Gagal menghapus data', 'tipe' => 'alert-danger');
            $this->session->set_flashdata('message', $dlg);
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
}