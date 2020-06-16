<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Msupplier extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function total_rows($cari) {
        $this->db->like('namaSupplier', $cari);
        $this->db->or_like('alamatSupplier', $cari);
        $this->db->or_like('telpSupplier', $cari);
        $this->db->from('m_supplier');
        return $this->db->count_all_results();
    }
    
    function get_limit($cari, $offset, $num) {
        $this->db->like('namaSupplier', $cari);
        $this->db->or_like('alamatSupplier', $cari);
        $this->db->or_like('telpSupplier', $cari);
        $this->db->limit($offset, $num);
        $this->db->order_by('namaSupplier', 'asc');
        return $this->db->get('m_supplier')->result();
    }
    
    function get_all() {
        return $this->db->get('m_supplier')->result();
    }
    
    function get_konsinyasi() {
        $this->db->where('konsinyasiSupplier', '1');
        return $this->db->get('m_supplier')->result();
    }
    
    function get_konsinyasi_alias() {
        $this->db->select('namaSupplier operator');
        
        $this->db->where('konsinyasiSupplier', '1');
        return $this->db->get('m_supplier')->result();
    }

    function get_by_id($id){
        $this->db->where('namaSupplier', $id);
        $this->db->from('m_supplier');
        return $this->db->get()->row();
    }
    
    function insert($data) {
        $save = $this->db->insert('m_supplier', $data);
        return $save;
    }

    function delete($id) {
        $this->db->where('namaSupplier', $id);
        $remove = $this->db->delete('m_supplier');
        return $remove;
    }

    function update($id, $data) {
        $this->db->where('namaSupplier', $id);
        $update = $this->db->update('m_supplier', $data);
        return $update;
    }
}