<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Datatindakan extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mdatatindakan');
        $this->redirect = current_url(). ($_SERVER['QUERY_STRING'] ? '?' .$_SERVER['QUERY_STRING'] : "");
    }

    public function index()
    {
        $this->sessioncheck->validasi('datatindakan', $this->redirect);
        $q = $this->input->get('q');
        $pg = $this->input->get('pg');

        $config = array(
            'base_url' => site_url('datatindakan/index?q='.$q),
            'first_url' => site_url('datatindakan/index?q='.$q),    
            'per_page' => 10,
            'page_query_string' => TRUE,
            'total_rows' => $this->mdatatindakan->total_rows($q)
        );

        $this->load->library('pagination');
        $this->pagination->initialize($config);
        
        $content = array(
            'data' => $this->mdatatindakan->get_limit($q, 10, $pg),
            'page' => $this->pagination->create_links(),
            'q' => $q,
            'total' => $config['total_rows']
        );
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('datamaster/datatindakan/index', $content);
        $this->load->view('include/footer');
    }

    public function tambah($action = null)
    {
        $this->sessioncheck->validasi('datatindakan', $this->redirect);
        if($action){
            $this->db->trans_begin();
            $last = $this->mdatatindakan->get_last();

            if($last){
                $last = substr($last->idTindakan,0,4);
                $last = $last + 1;
                $id = sprintf('%04s', $last);
            }else{
                $id = '0001';
            }

            $data  = array(
                'idTindakan' => $id,
                'namaTindakan' => $this->input->post('namaTindakan'),
                'bagianKlinik' => $this->input->post('bagianKlinik'),
                'bagianPetugas' => $this->input->post('bagianPetugas'),
                'biayaTindakan' => str_replace(",", "", $this->input->post("biayaTindakan")),
                'operator' => $this->session->userdata('nmPengguna')
            );
            $this->mdatatindakan->insert($this->security->xss_clean($data));

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
            'back' => $_SERVER['HTTP_REFERER'] ? $_SERVER['HTTP_REFERER'] : "datatindakan",
            'idTindakan' => set_value('idTindakan'),
            'namaTindakan' => set_value('namaTindakan'),
            'bagianDokter' => set_value('bagianDokter'),
            'bagianKlinik' => set_value('bagianKlinik'),
            'bagianPetugas' => set_value('bagianPetugas'),
            'biayaTindakan' => set_value('biayaTindakan')
            );
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('datamaster/datatindakan/form', $content);
        $this->load->view('include/footer');
    }

    public function edit($action = null)
    {
        $this->sessioncheck->validasi('datatindakan', $this->redirect);
        if($action){
            $this->db->trans_begin();
            $data  = array(
                'namaTindakan' => $this->input->post('namaTindakan'),
                'bagianKlinik' => $this->input->post('bagianKlinik'),
                'bagianPetugas' => $this->input->post('bagianPetugas'),
                'biayaTindakan' => str_replace(",", "", $this->input->post("biayaTindakan")),
                'operator' => $this->session->userdata('nmPengguna')
            );
            $this->mdatatindakan->update($this->security->xss_clean($this->input->post('idTindakan')), $this->security->xss_clean($data));

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

        $row = $this->mdatatindakan->get_by_id($this->input->get('id'));

        if ($row) {
            $content = array(
                'action' => 'Edit',
                'back' => $_SERVER['HTTP_REFERER'] ? $_SERVER['HTTP_REFERER'] : "datatindakan",
                'idTindakan' => set_value('idTindakan', $row->idTindakan),
                'namaTindakan' => set_value('namaTindakan', $row->namaTindakan),
                'bagianKlinik' => set_value('bagianKlinik', $row->bagianKlinik),
                'bagianPetugas' => set_value('bagianPetugas', $row->bagianPetugas),
                'biayaTindakan' => set_value('biayaTindakan', $row->biayaTindakan)
                );
            $this->load->view('include/header');
            $this->load->view('include/sidebar');
            $this->load->view('datamaster/datatindakan/form', $content);
            $this->load->view('include/footer');
        } else {
            $dlg = array('pesan' => 'Data tidak ditemukan', 'tipe' => 'alert-danger');
            $this->session->set_flashdata('message', $dlg);
            redirect('datatindakan');
        }
    }

    public function delete()
    {
        $this->sessioncheck->validasi('datatindakan', $this->redirect);
        if($this->mdatatindakan->delete($this->security->xss_clean($this->input->post('ID')))){
            $dlg = array('pesan' => 'Berhasil menghapus data', 'tipe' => 'alert-success');
            $this->session->set_flashdata('message', $dlg);
        }else{
            $dlg = array('pesan' => 'Gagal menghapus data', 'tipe' => 'alert-danger');
            $this->session->set_flashdata('message', $dlg);
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
}