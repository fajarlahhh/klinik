<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mpenjualan extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function total_rows($bln, $thn, $cari) {
        $this->db->where('month(tglBarangKeluar)', $bln);
        $this->db->where('year(tglBarangKeluar)', $thn);
        $this->db->group_start();
        $this->db->like('ketBarangKeluar', $cari);
        $this->db->or_like('pelangganBarangKeluar', $cari);
        $this->db->or_like('idBarangKeluar', $cari);
        $this->db->group_end();
        $this->db->from('t_barang_keluar a');
        
        return $this->db->count_all_results();
    }
    
    function get_limit($bln, $thn, $cari, $offset, $num) {
        $this->db->where('month(a.tglBarangKeluar)', $bln);
        $this->db->where('year(a.tglBarangKeluar)', $thn);
        $this->db->group_start();
        $this->db->like('ketBarangKeluar', $cari);
        $this->db->or_like('pelangganBarangKeluar', $cari);
        $this->db->or_like('idBarangKeluar', $cari);
        $this->db->group_end();
        $this->db->limit($offset, $num);
        $this->db->order_by('idBarangKeluar', 'asc');
        $this->db->from('t_barang_keluar a');
        $this->db->group_by('a.idBarangKeluar');
        return $this->db->get()->result();
    }

    function get_by_id($id){ 
        $this->db->where('idBarangKeluar', $id);
        $this->db->from('t_barang_keluar a');
        return $this->db->get()->row();
    }

    function get_detail($id){
        $this->db->where('idBarangKeluar', $id);
        $this->db->where('namaResep', '');
        $this->db->from('t_barang_keluar_det');        
        return $this->db->get()->result();
    }

    function get_detail_biasa($id){
        $this->db->where('idBarangKeluar', $id);
        $this->db->from('t_barang_keluar_det');        
        return $this->db->get()->result();
    }

    function get_resep($id){
        $this->db->select('resep, sum((hargaJualBarang - (hargaJualBarang * diskonBarang/100)) * qtyBarang) harga, namaResep');
        $this->db->where('idBarangKeluar', $id);
        $this->db->where('namaResep !=', '');
        $this->db->from('t_barang_keluar_det');
        $this->db->group_by('resep');   
        return $this->db->get()->result();
    }

    function get_last(){
        $this->db->select('if(idBarangKeluar is null, 0, idBarangKeluar) idBarangKeluar');
        $this->db->where('year(tglInput)', date('Y'));
        $this->db->where('month(tglInput)', date('m'));
        $this->db->limit(1);
        $this->db->order_by('idBarangKeluar', 'desc');        
        return $this->db->get('t_barang_keluar')->row();        
    }
    
    function insert($data) {
        $save = $this->db->insert('t_barang_keluar', $data);
        return $save;
    }
    
    function insert_barang($data) {
        $save = $this->db->insert('t_barang_keluar_det', $data);
        return $save;
    }
    
    
    function delete($id) {
        $this->db->where('idBarangKeluar', $id);
        $remove = $this->db->delete('t_barang_keluar');
        return $remove;
    }
}
