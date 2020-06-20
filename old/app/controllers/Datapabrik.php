<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Datapabrik extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mdatapabrik');
        $this->redirect = current_url(). ($_SERVER['QUERY_STRING'] ? '?' .$_SERVER['QUERY_STRING'] : "");
    }

    public function index()
    {
        $this->sessioncheck->validasi('datapabrik', $this->redirect);
        $q = $this->input->get('q');
        $pg = $this->input->get('pg');

        $config = array(
            'base_url' => site_url('datapabrik/index?q='.$q),
            'first_url' => site_url('datapabrik/index?q='.$q),    
            'per_page' => 10,
            'page_query_string' => TRUE,
            'total_rows' => $this->mdatapabrik->total_rows($q)
        );

        $this->load->library('pagination');
        $this->pagination->initialize($config);
        
        $content = array(
            'data' => $this->mdatapabrik->get_limit($q, 10, $pg),
            'page' => $this->pagination->create_links(),
            'q' => $q,
            'total' => $config['total_rows']
        );
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('datamaster/datapabrik/index', $content);
        $this->load->view('include/footer');
    }
	
    public function tambah($action = null)
    {
        $this->sessioncheck->validasi('datapabrik', $this->redirect);
        if($action){
            $this->db->trans_begin();
            $data  = array(
                'namaPabrik' => $this->input->post('namaPabrik')
            );
            $this->mdatapabrik->insert($this->security->xss_clean($data));

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
            'back' => $_SERVER['HTTP_REFERER'] ? $_SERVER['HTTP_REFERER'] : "datapabrik",
            'namaPabrik' => set_value('namaPabrik')
            );
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('datamaster/datapabrik/form', $content);
        $this->load->view('include/footer');
    }

    public function delete()
    {
        $this->sessioncheck->validasi('datapabrik', $this->redirect);
        if($this->mdatapabrik->delete($this->security->xss_clean($this->input->post('ID')))){
            $dlg = array('pesan' => 'Berhasil menghapus data', 'tipe' => 'alert-success');
            $this->session->set_flashdata('message', $dlg);
        }else{
            $dlg = array('pesan' => 'Gagal menghapus data', 'tipe' => 'alert-danger');
            $this->session->set_flashdata('message', $dlg);
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
}