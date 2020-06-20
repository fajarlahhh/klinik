<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tindakandokter extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mtindakandokter');
        $this->redirect = current_url(). ($_SERVER['QUERY_STRING'] ? '?' .$_SERVER['QUERY_STRING'] : "");
    }

    public function index()
    {
        $this->sessioncheck->validasi('tindakandokter', $this->redirect);
        $q = $this->input->get('q');
        $pg = $this->input->get('pg');
        $this->load->model('mdokter');
        $dokter = $this->mdokter->get_tamu();

        if($this->input->get('dr'))
            $dr = $this->input->get('dr');
        else
            $dr = ($dokter? $dokter{0}->idDokter: null);

        $config = array(
            'base_url' => site_url('tindakandokter/index?q='.$q),
            'first_url' => site_url('tindakandokter/index?q='.$q),    
            'per_page' => 10,
            'page_query_string' => TRUE,
            'total_rows' => ($dokter?  $this->mtindakandokter->total_rows($dr, $q): 0)
        );

        $this->load->library('pagination');
        $this->pagination->initialize($config);
        
        $content = array(
            'data' => ($dokter? $this->mtindakandokter->get_limit($dr, $q, 10, $pg): null),
            'page' => $this->pagination->create_links(),
            'dokter' => $dokter,
            'q' => $q,
            'dr' => $dr,
            'total' => $config['total_rows']
        );
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('setup/tindakandokter/index', $content);
        $this->load->view('include/footer');
    }

    public function tambah($action = null)
    {
        $this->sessioncheck->validasi('tindakandokter', $this->redirect);
        if($action){
            $this->db->trans_begin();
            $last = $this->mtindakandokter->get_last();

            if($last){
                $last = substr($last->idTindakanDokter,0,4);
                $last = $last + 1;
                $id = sprintf('%04s', $last);
            }else{
                $id = '0001';
            }

            $data  = array(
                'idTindakanDokter' => $id,
                'idDokter' => $this->input->post('idDokter'),
                'idTindakan' => $this->input->post('idTindakan'),
                'bagianKlinik' => $this->input->post('bagianKlinik'),
                'bagianPetugas' => $this->input->post('bagianPetugas'),
                'biayaTindakan' => str_replace(",", "", $this->input->post("biayaTindakan")),
                'operator' => $this->session->userdata('nmPengguna')
            );
            $this->mtindakandokter->insert($this->security->xss_clean($data));

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
        $this->load->model('mdokter');
        $this->load->model('mdatatindakan');
        $dokter = $this->mdokter->get_by_id($this->input->get('dr'));
        $datatindakan = $this->mdatatindakan->get_all();
        $tindakan = null;
        foreach ($datatindakan as $row) {
            $tindakan[$row->idTindakan] = $row->namaTindakan;
        }
        $content = array(
            'action' => 'Tambah',
            'back' => $_SERVER['HTTP_REFERER'] ? $_SERVER['HTTP_REFERER'] : "tindakandokter",
            'tindakan' => $tindakan,
            'idTindakanDokter' => set_value('idTindakanDokter'),
            'idDokter' => set_value('idDokter', $this->input->get('dr')),
            'namaDokter' => set_value('idDokter', $dokter->namaDokter),
            'idTindakan' => set_value('idTindakan'),
            'bagianPetugas' => set_value('bagianPetugas'),
            'bagianKlinik' => set_value('bagianKlinik'),
            'bagianPetugas' => set_value('bagianPetugas'),
            'biayaTindakan' => set_value('biayaTindakan')
            );
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('setup/tindakandokter/form', $content);
        $this->load->view('include/footer');
    }

    public function edit($action = null)
    {
        $this->sessioncheck->validasi('tindakandokter', $this->redirect);
        if($action){
            $this->db->trans_begin();
            $data  = array(
                'idDokter' => $this->input->post('idDokter'),
                'idTindakan' => $this->input->post('idTindakan'),
                'bagianKlinik' => $this->input->post('bagianKlinik'),
                'bagianPetugas' => $this->input->post('bagianPetugas'),
                'biayaTindakan' => str_replace(",", "", $this->input->post("biayaTindakan")),
                'operator' => $this->session->userdata('nmPengguna')
            );
            $this->mtindakandokter->update($this->input->post('idTindakanDokter'), $this->security->xss_clean($data));

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
        $row = $this->mtindakandokter->get_by_id($this->input->get('id'));
        if ($row) {
            $this->load->model('mdokter');
            $this->load->model('mdatatindakan');
            $datatindakan = $this->mdatatindakan->get_all();
            $tindakan = null;
            foreach ($datatindakan as $tdk) {
                $tindakan[$tdk->idTindakan] = $tdk->namaTindakan;
            }
            $content = array(
                'action' => 'Edit',
                'back' => $_SERVER['HTTP_REFERER'] ? $_SERVER['HTTP_REFERER'] : "tindakandokter",
                'tindakan' => $tindakan,
                'idDokter' => set_value('idDokter', $row->idDokter),
                'namaDokter' => set_value('namaDokter', $row->namaDokter),
                'idTindakanDokter' => set_value('idTindakanDokter', $row->idTindakanDokter),
                'idTindakan' => set_value('idTindakan', $row->idTindakan),
                'bagianPetugas' => set_value('bagianPetugas', $row->bagianPetugas),
                'bagianKlinik' => set_value('bagianKlinik', $row->bagianKlinik),
                'bagianPetugas' => set_value('bagianPetugas', $row->bagianPetugas),
                'biayaTindakan' => set_value('biayaTindakan', $row->biayaTindakan)
                );
            $this->load->view('include/header');
            $this->load->view('include/sidebar');
            $this->load->view('setup/tindakandokter/form', $content);
            $this->load->view('include/footer');
        } else {
            $dlg = array('pesan' => 'Data tidak ditemukan', 'tipe' => 'alert-danger');
            $this->session->set_flashdata('message', $dlg);
            redirect('datatindakan');
        }
    }

    public function delete()
    {
        $this->sessioncheck->validasi('tindakandokter', $this->redirect);
        if($this->mtindakandokter->delete($this->security->xss_clean($this->input->post('ID')))){
            $dlg = array('pesan' => 'Berhasil menghapus data', 'tipe' => 'alert-success');
            $this->session->set_flashdata('message', $dlg);
        }else{
            $dlg = array('pesan' => 'Gagal menghapus data', 'tipe' => 'alert-danger');
            $this->session->set_flashdata('message', $dlg);
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
}