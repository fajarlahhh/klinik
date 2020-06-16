<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mpengguna extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }
    
    function get_login($id, $password){
        $this->db->where('idPengguna', $id);
        $this->db->where('sandiPengguna', $password);
        return $this->db->get('m_pengguna')->row();
    }

    function get_all($where = null)
    {
        if($where)
            $this->db->where($where);
        $this->db->order_by('idPengguna', 'asc');
        return $this->db->get('m_pengguna')->result();
    }

    function total_rows($cari) {
        $this->db->like('idPengguna', $cari);
        $this->db->or_like('nmPengguna', $cari);
        $this->db->from('m_pengguna');
        return $this->db->count_all_results();
    }
    
    function get_limit($cari, $offset, $num) {
        $this->db->like('idPengguna', $cari);
        $this->db->or_like('nmPengguna', $cari);
        $this->db->limit($offset, $num);
        return $this->db->get('m_pengguna')->result();
    }

    function get_by_id($id){
        $this->db->where('idPengguna', $id);
        $this->db->from('m_pengguna');
        return $this->db->get()->row();
    }

    function get_akses($id){
        $this->db->where('idPengguna', $id);
        $this->db->from('m_akses');
        return $this->db->get()->result();
    }
    
    function insert($data) {
        $save = $this->db->insert('m_pengguna', $data);
        return $save;
    }
    
    function insert_akses($data) {
        $save = $this->db->insert('m_akses', $data);
        return $save;
    }

    function delete($id) {
        $this->db->where('idPengguna', $id);
        $remove = $this->db->delete('m_pengguna');
        return $remove;
    }

    function delete_akses($id) {
        $this->db->where('idPengguna', $id);
        $remove = $this->db->delete('m_akses');
        return $remove;
    }

    function update($id, $data) {
        $this->db->where('idPengguna', $id);
        $update = $this->db->update('m_pengguna', $data);
        return $update;
    }
}