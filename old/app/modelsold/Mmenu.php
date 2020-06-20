<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mmenu extends CI_Model {
    function get_parent(){
        $this->db->where('statMenu', 1);
        return $this->db->get('m_menu')->result();
    }

    function get_by_akses($pengguna, $tipe, $parent= null){
		if($parent)
			$this->db->where('parentMenu', $parent);
        $this->db->where('statMenu', $tipe);
        $this->db->where('idPengguna', $pengguna);
        $this->db->order_by('sortMenu', 'asc');   
        $this->db->from('m_menu a');
        $this->db->join('m_akses b', 'a.kdMenu = b.kdMenu', 'right');
        return $this->db->get()->result();
    }

    function get_by_parent($parent){
        $this->db->where('parentMenu', $parent);
        $this->db->order_by('sortMenu', 'asc');        
        return $this->db->get('m_menu')->result();
    }

    function get_by_id($id){
        $this->db->where('kdMenu', $id);
        return $this->db->get('m_menu')->row();
    }
    
    function get_child($id, $admin = null)
    {
        $this->db->where('statMenu', 0);
        $this->db->where('parentMenu', $id);
        $this->db->order_by('sortMenu', 'asc');
        $this->db->from('m_menu a');
		if($admin != 'admin'){
			$this->db->where('b.idPengguna', $admin);
			$this->db->join('m_akses b', 'a.kdMenu = b.kdMenu', 'right');
		}
		
		$this->db->group_by('a.kdMenu');
        return $this->db->get()->result();
    }

    function insert($data) {
        $save = $this->db->insert('m_menu', $data);
        return $save;
    }

    function update($where, $data) {
        $this->db->where($where);
        $update = $this->db->update('m_menu', $data);
        return $update;
    }

    function delete($where) {
        $this->db->where($where);
        $remove = $this->db->delete('m_menu');
        return $remove;
    }
}