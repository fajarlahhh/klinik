<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mkartustok extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function total_rows($bulan, $tahun, $obat) {		
        $this->db->select("idBarangMasuk noTransaksi, tglBarangMasuk tglTransaksi, ketBarangMasuk ketTransaksi, jmlBarang jmlTransaksi, 1 tipeTransaksi, tglInput");
        $this->db->where('month(tglBarangMasuk)', $bulan);
        $this->db->where('year(tglBarangMasuk)', $tahun);
        $this->db->where('idBarang', $obat);
        $this->db->from('t_barang_masuk');      
        $sql2 = $this->db->get_compiled_select();
        
        $this->db->select("a.idBarangKeluar noTransaksi, a.tglBarangKeluar tglTransaksi, ketBarangKeluar ketTransaksi, qtyBarang jmlTransaksi, 0 tipeTransaksi, tglInput");
        $this->db->where('month(a.tglBarangKeluar)', $bulan);
        $this->db->where('year(a.tglBarangKeluar)', $tahun);
        $this->db->where('idBarang', $obat);
        $this->db->from('t_barang_keluar_det a');
        $this->db->join('t_barang_keluar b', 'a.idBarangKeluar = b.idBarangKeluar', 'left');  
        $sql3 = $this->db->get_compiled_select();
        $query = $this->db->query("$sql1 union all $sql2");
        return $query->num_rows();
    }

    function get_limit($bulan, $tahun, $obat, $offset, $num = null) {		
        $this->db->select("idBarangMasuk noTransaksi, tglBarangMasuk tglTransaksi, ketBarangMasuk ketTransaksi, jmlBarang jmlTransaksi, 1 tipeTransaksi, tglInput");
        $this->db->where('month(tglBarangMasuk)', $bulan);
        $this->db->where('year(tglBarangMasuk)', $tahun);
        $this->db->where('idBarang', $obat);
        $this->db->from('t_barang_masuk');      
        $sql2 = $this->db->get_compiled_select();
        
        $this->db->select("a.idBarangKeluar noTransaksi, a.tglBarangKeluar tglTransaksi, ketBarangKeluar ketTransaksi, qtyBarang jmlTransaksi, 0 tipeTransaksi,  tglInput");
        $this->db->where('month(a.tglBarangKeluar)', $bulan);
        $this->db->where('year(a.tglBarangKeluar)', $tahun);
        $this->db->where('idBarang', $obat);
        $this->db->from('t_barang_keluar_det a');
        $this->db->join('t_barang_keluar b', 'a.idBarangKeluar = b.idBarangKeluar', 'left');  
        $sql3 = $this->db->get_compiled_select();
        if($num)
            return $this->db->query("$sql1 union all $sql2 order by tglTransaksi, noTransaksi asc limit $num, $offset")->result();
        else
            return $this->db->query("$sql1 union all $sql2 order by tglTransaksi, noTransaksi asc")->result();
    }
}