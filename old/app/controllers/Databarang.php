<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Databarang extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mdatabarang');
        $this->redirect = current_url(). ($_SERVER['QUERY_STRING'] ? '?' .$_SERVER['QUERY_STRING'] : "");
    }

    public function index()
    {
        $this->sessioncheck->validasi('databarang', $this->redirect);
        $q = $this->input->get('q');
        $pg = $this->input->get('pg');

        $config = array(
            'base_url' => site_url('databarang/index?q='.$q),
            'first_url' => site_url('databarang/index?q='.$q),    
            'per_page' => 10,
            'page_query_string' => TRUE,
            'total_rows' => $this->mdatabarang->total_rows($q)
        );

        $this->load->library('pagination');
        $this->pagination->initialize($config);
        
        $content = array(
            'data' => $this->mdatabarang->get_limit($q, 10, $pg),
            'page' => $this->pagination->create_links(),
            'q' => $q,
            'total' => $config['total_rows']
        );
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('datamaster/databarang/index', $content);
        $this->load->view('include/footer');
    }
	
	public function cetak()
    {
        $this->sessioncheck->validasi('databarang', $this->redirect);
        $content = array(
            'data' => $this->mdatabarang->get_all(),
        );
        $this->load->view('datamaster/databarang/cetak', $content);
    }

    public function tambah($action = null)
    {
        $this->sessioncheck->validasi('databarang', $this->redirect);
        if($action){
            $this->db->trans_begin();
            $last = $this->mdatabarang->get_last();

            if($last){
                $last = substr($last->idBarang,0,4);
                $last = $last + 1;
                $id = sprintf('%04s', $last);
            }else{
                $id = '0001';
            }

            $data  = array(
                'idBarang' => $id,
                'namaBarang' => $this->input->post('namaBarang'),
                'satuanBarang' => $this->input->post('satuanBarang'),
                'stokMinBarang' => $this->input->post('stokMinBarang'),
                'deskBarang' => $this->input->post('deskBarang'),
                'keuntunganBarang' => $this->input->post('keuntunganBarang'),
                'ketBarang' => $this->input->post('ketBarang'),
                'tipeBarang' => $this->input->post('tipeBarang'),
                'khusus' => $this->input->post('khusus'),
                'hargaBeliBarang' => str_replace(",", "", $this->input->post('hargaBeliBarang')),
                'hargaJualBarang' => str_replace(",", "", $this->input->post('hargaJualBarang')),
                'operator' => $this->session->userdata('nmPengguna')
            );
            $this->mdatabarang->insert($this->security->xss_clean($data));

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
            'back' => $_SERVER['HTTP_REFERER'] ? $_SERVER['HTTP_REFERER'] : "databarang",
            'idBarang' => set_value('idBarang'),
            'namaBarang' => set_value('namaBarang'),
            'satuanBarang' => set_value('satuanBarang'),
            'stokMinBarang' => set_value('stokMinBarang'),
            'tipeBarang' => set_value('tipeBarang'),
            'keuntunganBarang' => set_value('keuntunganBarang'),
            'hargaBeliBarang' => set_value('hargaBeliBarang'),
			'hargaJualBarang' => set_value('hargaJualBarang'),
			'deskBarang' => set_value('deskBarang'),
			'tipeBarang' => set_value('tipeBarang'),
			'ketBarang' => set_value('ketBarang'),
                'khusus' => set_value('khusus')
            );
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('datamaster/databarang/form', $content);
        $this->load->view('include/footer');
    }

    public function edit($action = null)
    {
        $this->sessioncheck->validasi('databarang', $this->redirect);
        if($action){
            $this->db->trans_begin();
            $data  = array(
                'namaBarang' => $this->input->post('namaBarang'),
                'satuanBarang' => $this->input->post('satuanBarang'),
                'stokMinBarang' => $this->input->post('stokMinBarang'),
                'deskBarang' => $this->input->post('deskBarang'),
                'ketBarang' => $this->input->post('ketBarang'),
                'tipeBarang' => $this->input->post('tipeBarang'),
                'khusus' => $this->input->post('khusus'),
                'keuntunganBarang' => $this->input->post('keuntunganBarang'),
                'hargaBeliBarang' => str_replace(",", "", $this->input->post('hargaBeliBarang')),
                'hargaJualBarang' => str_replace(",", "", $this->input->post('hargaJualBarang')),
                'operator' => $this->session->userdata('nmPengguna')
            );
            $this->mdatabarang->update($this->security->xss_clean($this->input->post('idBarang')), $this->security->xss_clean($data));

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

        $row = $this->mdatabarang->get_by_id($this->input->get('id'));

        if ($row) {
            $content = array(
                'action' => 'Edit',
                'back' => $_SERVER['HTTP_REFERER'] ? $_SERVER['HTTP_REFERER'] : "databarang",
                'idBarang' => set_value('idBarang', $row->idBarang),
                'namaBarang' => set_value('namaBarang', $row->namaBarang),
                'satuanBarang' => set_value('satuanBarang', $row->satuanBarang),
                'stokMinBarang' => set_value('stokMinBarang', $row->stokMinBarang),
                'tipeBarang' => set_value('tipeBarang', $row->tipeBarang),
                'keuntunganBarang' => set_value('keuntunganBarang', $row->keuntunganBarang),
                'hargaBeliBarang' => set_value('hargaBeliBarang', $row->hargaBeliBarang),
                'hargaJualBarang' => set_value('hargaJualBarang', $row->hargaJualBarang),
                'ketBarang' => set_value('ketBarang', $row->ketBarang),
                'deskBarang' => set_value('deskBarang', $row->deskBarang),
                'khusus' => set_value('khusus', $row->khusus)
                );
            $this->load->view('include/header');
            $this->load->view('include/sidebar');
            $this->load->view('datamaster/databarang/form', $content);
            $this->load->view('include/footer');
        } else {
            $dlg = array('pesan' => 'Data tidak ditemukan', 'tipe' => 'alert-danger');
            $this->session->set_flashdata('message', $dlg);
            redirect('databarang');
        }
    }

    public function delete()
    {
        $this->sessioncheck->validasi('databarang', $this->redirect);
        if($this->mdatabarang->delete($this->security->xss_clean($this->input->post('ID')))){
            $dlg = array('pesan' => 'Berhasil menghapus data', 'tipe' => 'alert-success');
            $this->session->set_flashdata('message', $dlg);
        }else{
            $dlg = array('pesan' => 'Gagal menghapus data', 'tipe' => 'alert-danger');
            $this->session->set_flashdata('message', $dlg);
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
}