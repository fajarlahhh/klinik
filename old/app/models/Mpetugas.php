<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mpetugas extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function total_rows($cari) {
        $this->db->like('namaPetugas', $cari);
        $this->db->from('m_petugas');
        return $this->db->count_all_results();
    }
    
    function get_limit($cari, $offset, $num) {
        $this->db->like('namaPetugas', $cari);
        $this->db->limit($offset, $num);
        $this->db->order_by('namaPetugas', 'asc');
        return $this->db->get('m_petugas')->result();
    }
    
    function get_all() {
        return $this->db->get('m_petugas')->result();
    }

    function get_by_id($id){
        $this->db->where('namaPetugas', $id);
        $this->db->from('m_petugas');
        return $this->db->get()->row();
    }

    function insert($data) {
        $save = $this->db->insert('m_petugas', $data);
        return $save;
    }

    function delete($id) {
        $this->db->where('namaPetugas', $id);
        $remove = $this->db->delete('m_petugas');
        return $remove;
    }

    function update($id, $data) {
        $this->db->where('namaPetugas', $id);
        $update = $this->db->update('m_petugas', $data);
        return $update;
    }
}