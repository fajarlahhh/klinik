<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mbarangmasuk extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function total_rows($where, $cari) {
        $this->db->where($where);
        $this->db->group_start();
        $this->db->like('a.ketBarangMasuk', $cari);
        $this->db->group_end();
        $this->db->from('t_barang_masuk a');        
        return $this->db->count_all_results();
    }
    
    function get_limit($where, $cari, $offset, $num) {
        $this->db->select("a.*, d.namaBarang, deskBarang, tglKadaluarsaBarang, satuanBarang, if(konsinyasiSupplier = 1, \"Y\", \"T\") konsinyasiSupplier");
        $this->db->where($where);
        $this->db->group_start();
        $this->db->like('d.namaBarang', $cari);
        $this->db->or_like('a.ketBarangMasuk', $cari);
        $this->db->or_like('a.namaSupplier', $cari);
        $this->db->or_like('a.ketBarangMasuk', $cari);
        $this->db->group_end();
		if($offset)
			$this->db->limit($offset, $num);
        $this->db->order_by('a.idBarangMasuk', 'desc');
        $this->db->from('t_barang_masuk a');
        $this->db->join('m_barang d', 'a.idBarang = d.idBarang', 'left');
        $this->db->group_by('a.idBarangMasuk');
        return $this->db->get()->result();
    }

    function get_last(){
        $this->db->select('if(idBarangMasuk is null, 0, idBarangMasuk) idBarangMasuk');
        $this->db->where('year(tglInput)', date('Y'));
        $this->db->where('month(tglInput)', date('m'));
        $this->db->limit(1);
        $this->db->order_by('idBarangMasuk', 'desc');        
        return $this->db->get('t_barang_masuk')->row();        
    }
    
    function insert($data) {
        $save = $this->db->insert('t_barang_masuk', $data);
        return $save;
    }
   
    function delete($id) {
        $this->db->where('idBarangMasuk', $id);
        $remove = $this->db->delete('t_barang_masuk');
        return $remove;
    }
}