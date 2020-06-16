<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdokter extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function total_rows($cari) {
        $this->db->like('namaDokter', $cari);
        $this->db->or_like('alamatDokter', $cari);
        $this->db->or_like('telpDokter', $cari);
        $this->db->from('m_dokter');
        return $this->db->count_all_results();
    }
    
    function get_limit($cari, $offset, $num) {
        $this->db->like('namaDokter', $cari);
        $this->db->or_like('alamatDokter', $cari);
        $this->db->or_like('telpDokter', $cari);
        $this->db->limit($offset, $num);
        $this->db->order_by('namaDokter', 'asc');
        return $this->db->get('m_dokter')->result();
    }
    
    function get_all() {
        return $this->db->get('m_dokter')->result();
    }
    
    function get_all_alias() {
        $this->db->select('namaDokter operator');
        return $this->db->get('m_dokter')->result();
    }
    
    function get_tamu() {
        $this->db->where('tamuDokter', 1);
        return $this->db->get('m_dokter')->result();
    }

    function get_by_id($id){
        $this->db->where('idDokter', $id);
        $this->db->from('m_dokter');
        return $this->db->get()->row();
    }

    function get_by_nama($id){
        $this->db->where('namaDokter', $id);
        $this->db->from('m_dokter');
        return $this->db->get()->row();
    }

    function get_last(){
        $this->db->select('idDokter');
        $this->db->limit(1);
        $this->db->order_by('idDokter', 'desc');        
        return $this->db->get('m_dokter')->row();        
    }

    function insert($data) {
        $save = $this->db->insert('m_dokter', $data);
        return $save;
    }

    function delete($id) {
        $this->db->where('idDokter', $id);
        $remove = $this->db->delete('m_dokter');
        return $remove;
    }

    function update($id, $data) {
        $this->db->where('idDokter', $id);
        $update = $this->db->update('m_dokter', $data);
        return $update;
    }
}