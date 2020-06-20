<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
        $this->load->model('mpengguna');
	}

    public function index(){
        $this->form();
    }

    private function form(){
        if (get_cookie('idPengguna', TRUE)){
            $this->validasi(get_cookie('idPengguna', TRUE), get_cookie('sandiPengguna', TRUE), TRUE);
        }else{
            $idPengguna = $this->security->xss_clean($this->input->post('idPengguna'));
            $sandiPengguna = $this->security->xss_clean($this->input->post('sandiPengguna'));
            $content = array(
                'idPengguna' => set_value('idPengguna'),
                'sandiPengguna' => set_value('sandiPengguna'),
            );
            if($idPengguna && $sandiPengguna)
                $this->session->set_flashdata('message', 'ID Pengguna atau Kata Sandi salah!!!');
            $this->load->view('login', $content);
        }
    }

	public function validasi($id = null, $sandi = null, $cookie = false){
        if($cookie){
            $idPengguna = $id;
            $sandiPengguna = $sandi;
            $pengguna = $this->mpengguna->get_login($idPengguna, $sandiPengguna);
        }else{
            $idPengguna = $this->security->xss_clean($this->input->post('idPengguna'));
            $sandiPengguna = $this->security->xss_clean($this->input->post('sandiPengguna'));
            $pengguna = $this->mpengguna->get_login($idPengguna, base64_encode($sandiPengguna));
        }

        $akses = null;
        if ($pengguna) {
            $this->load->model('mmenu');
            if($pengguna->lvlPengguna == 0){
				$admin = 'admin';
                $parent = $this->mmenu->get_parent();
            }else{
				$admin = $pengguna->idPengguna;
                $order = array(array('sortMenu'), array('asc'));
                $where = array('statMenu' => '1', 'idPengguna' => $idPengguna);
                $parent = $this->mmenu->get_by_akses($idPengguna, 1);
            }
            $menu = null;
            $x = 0;
            foreach ($parent as $row){
                $y = 0;
                $menu[$x][$y] = array(
                    'kdMenu' => $row->kdMenu,
                    'nmMenu' => $row->nmMenu,
                    'parentMenu' => $row->parentMenu,
                    'iconMenu' => $row->iconMenu,
                    'statMenu' => $row->statMenu
                    );
                $akses = $akses." ".$row->kdMenu;
                $sub = $this->mmenu->get_child($row->kdMenu, $admin);
                foreach ($sub as $row1){
                    $y++;
                    $menu[$x][$y] = array(
                        'kdMenu' => $row1->kdMenu,
                        'nmMenu' => $row1->nmMenu,
                        'parentMenu' => $row->parentMenu,
                        'iconMenu' => $row->iconMenu,
                        'statMenu' => $row->statMenu
                        );
                    $akses = $akses." ".$row1->kdMenu;
                }
                $x++;
            }
            
            array_multisort(array_map('count', $menu), SORT_DESC, $menu);
            $session = array(
                'idPengguna' => $pengguna->idPengguna,
                'nmPengguna' => $pengguna->nmPengguna,
                'tlpPengguna' => $pengguna->tlpPengguna,
                'lvlPengguna' => $pengguna->lvlPengguna,
                'menu' => $menu,
                'akses' => $akses,
                'login' => true
            );
            if($this->input->post('pengingat') == 1 && $cookie == false){
                set_cookie('idPengguna', $pengguna->idPengguna, (10 * 365 * 24 * 60 * 60));
                set_cookie('sandiPengguna', $pengguna->sandiPengguna, (10 * 365 * 24 * 60 * 60));
            }
            $this->session->set_userdata($session);
            redirect($this->session->flashdata('redirect') ? $this->session->flashdata('redirect') : 'dashboard');
        } else {
            $this->form();
        }
    }
}

