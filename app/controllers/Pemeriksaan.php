<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pemeriksaan extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mpemeriksaan');
        $this->redirect = current_url(). ($_SERVER['QUERY_STRING'] ? '?' .$_SERVER['QUERY_STRING'] : "");
    }

    public function index(){
        $this->cari();
    }

    public function data()
    {
        $this->sessioncheck->validasi('pemeriksaan', $this->redirect);
        $q = $this->input->get('q');
        $pg = $this->input->get('pg');

        if ($this->input->get('bln')) 
            $bln = $this->input->get('bln');
        else
            $bln = date('m');

            if ($this->input->get('thn')) 
            $thn = $this->input->get('thn');
        else
            $thn = date('Y');

        $config = array(
            'base_url' => site_url('pemeriksaan/data?bln='.$bln.'&thn='.$thn.'&q='.$q),
            'first_url' => site_url('pemeriksaan/data?bln='.$bln.'&thn='.$thn.'&q='.$q),    
            'per_page' => 10,
            'page_query_string' => TRUE,
            'total_rows' => $this->mpemeriksaan->total_rows($bln, $thn, $q)
        );

        $this->load->library('pagination');
        $this->pagination->initialize($config);
        
        $content = array(
            'data' => $this->mpemeriksaan->get_limit($bln, $thn, $q, 10, $pg),
            'page' => $this->pagination->create_links(),
            'q' => $q,
            'bln' => $bln,
            'thn' => $thn,
            'total' => $config['total_rows']
        );
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('pelayanan/pemeriksaan/index', $content);
        $this->load->view('include/footer');
    }

    public function getBlmPeriksa(){
        $cari = $this->mpemeriksaan->get_blm_periksa(trim($this->input->post('cari')));
        $this->output->set_content_type('application/json')->set_output(json_encode($cari));
    }

    public function cari()
    {
        $this->sessioncheck->validasi('pemeriksaan', $this->redirect);
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('pelayanan/pemeriksaan/cari');
        $this->load->view('include/footer');
    }

    public function form($action = null)
    {
        $this->sessioncheck->validasi('pemeriksaan', $this->redirect);
        if($action){
            if($this->session->userdata('lvlPengguna') < 3){
				$this->db->trans_begin();
				
				$file = '';
				if ($_FILES['fotoPemeriksaan']['name']){
					$this->load->helper('string');
					
	
					$config['upload_path'] = "./upload/";
					$config['allowed_types'] = '*';
					$config['file_name'] = random_string('alnum', 16);
					$this->load->library('upload', $config);
	
					if ($this->upload->do_upload('fotoPemeriksaan')) {
						$file = $this->upload->data();
						$file = UPLOAD_PATH.$file['file_name'];
					}
					else {
						$dlg = array('pesan' => 'Proses upload data gagal ('.$this->upload->display_errors().')', 'tipe' => 'alert-danger');
						$this->session->set_flashdata('message', $dlg);
						redirect($this->input->post('back'));
					}
				}

                $data  = array(
                    'idPendaftaran' => $this->input->post('idPendaftaran'),
                    'fotoPemeriksaan' => $file,
                    'operator' => $this->session->userdata('nmPengguna')
                );
                $this->mpemeriksaan->insert($this->security->xss_clean($data));

                $i = 0;
                foreach($this->input->post("diagnosaPemeriksaan") as $key){
                    $this->mpemeriksaan->insert_detail(
                        $this->security->xss_clean(array(
							'idPendaftaran' => $this->input->post('idPendaftaran'),
                            'diagnosaPemeriksaan' => $this->input->post('diagnosaPemeriksaan')[$i],
                            'sifatPemeriksaan' => $this->input->post('sifatPemeriksaan')[$i],
                            'ketPemeriksaan' => $this->input->post('ketPemeriksaan')[$i]
                            ))
                    );
                    $i++;
                }
                
                if ($this->db->trans_status() === FALSE){
                    $this->db->trans_rollback();
                    $dlg = array('pesan' => 'Gagal menyimpan data', 'tipe' => 'alert-danger');
                    $this->session->set_flashdata('message', $dlg);
                    redirect('pemeriksaan');
                }else{
                    $this->db->trans_commit();
                    $dlg = array('pesan' => 'Berhasil menyimpan data', 'tipe' => 'alert-success');
                    $this->session->set_flashdata('message', $dlg);
                    redirect('pemeriksaan/data');
                }
            }else{
                $dlg = array('pesan' => 'Tidak ada izin untuk menambah/mengubah data', 'tipe' => 'alert-danger');
                $this->session->set_flashdata('message', $dlg);
                redirect();
            }
        }
        $no = $this->input->get('no');
        $rm = $this->input->get('rm');
        $this->load->model('mdiagnosa');
        $this->load->model('mpendaftaran');
        $this->load->model('mrekammedis');
        $diagnosa = $this->mdiagnosa->get_all();

        $content = array(
            'diagnosaJSON' => json_encode($diagnosa),
            'data' => $this->mpendaftaran->get_by_id($no),
            'rm' => $this->mrekammedis->get_rm($rm)
        );
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('pelayanan/pemeriksaan/form', $content);
        $this->load->view('include/footer');
    }

    public function foto($action = null)
    {
        $this->sessioncheck->validasi('pemeriksaan', $this->redirect);
        if($action){
            if($this->session->userdata('lvlPengguna') < 3){
				$this->db->trans_begin();
				
                
                if ($this->db->trans_status() === FALSE){
                    $this->db->trans_rollback();
                    $dlg = array('pesan' => 'Gagal menyimpan data', 'tipe' => 'alert-danger');
                    $this->session->set_flashdata('message', $dlg);
                    redirect('pemeriksaan');
                }else{
                    $this->db->trans_commit();
                    $dlg = array('pesan' => 'Berhasil menyimpan data', 'tipe' => 'alert-success');
                    $this->session->set_flashdata('message', $dlg);
                    redirect('pemeriksaan/data');
                }
            }else{
                $dlg = array('pesan' => 'Tidak ada izin untuk menambah/mengubah data', 'tipe' => 'alert-danger');
                $this->session->set_flashdata('message', $dlg);
                redirect();
            }
        }
        $this->load->model('mdiagnosa');
        $diagnosa = $this->mdiagnosa->get_all();

        $content = array(            
            'data' => $this->mpemeriksaan->get_by_id($this->input->get('id'))
        );
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('pelayanan/pemeriksaan/foto', $content);
        $this->load->view('include/footer');
    }

    public function delete()
    {
        $this->sessioncheck->validasi('pemeriksaan', $this->redirect);
        $gambar = $this->mpemeriksaan->get_by_id($this->input->post('ID'));
        if($this->mpemeriksaan->delete($this->security->xss_clean($this->input->post('ID')))){
            if(file_exists("./".$gambar->fotoPemeriksaan)){
                unlink("./".$gambar->fotoPemeriksaan);
            }
            $dlg = array('pesan' => 'Berhasil menghapus data', 'tipe' => 'alert-success');
            $this->session->set_flashdata('message', $dlg);
        }else{
            $dlg = array('pesan' => 'Gagal menghapus data', 'tipe' => 'alert-danger');
            $this->session->set_flashdata('message', $dlg);
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
}
