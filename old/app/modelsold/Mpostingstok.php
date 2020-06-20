<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mpostingstok extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function stok_akhir($bulan, $tahun) {
        $this->db->select("*,
        ifnull((select sum(jmlBarang) from m_stok_awal where idBarang=o.idBarang and month(tglStokAwal)=$bulan and year(tglStokAwal)=$tahun group by idBarang),0) stokAwal,
        ifnull((select sum(jmlBarang) from t_barang_masuk where idBarang=o.idBarang and month(tglBarangMasuk)=$bulan and year(tglBarangMasuk)=$tahun group by idBarang),0) stokMasuk,
        ifnull((select sum(qtyBarang) from t_pembayaran_barang where idBarang=o.idBarang and month(tglPembayaran)=$bulan and year(tglPembayaran)=$tahun group by idBarang),0) + 
        ifnull((select sum(qtyBarang) from t_barang_keluar_det where idBarang=o.idBarang and month(tglBarangKeluar)=$bulan and year(tglBarangKeluar)=$tahun group by idBarang),0) stokKeluar");
        return $this->db->get('m_barang o')->result();
    }
    
    function insert($data) {        
        $this->db->query('set autocommit=1');
        $save = $this->db->insert('m_stok_awal', $data);
        return $save;
    }

    function delete($tgl) {
        $this->db->where('tglStokAwal', $tgl);
        $remove = $this->db->delete('m_stok_awal');
        return $remove;
    }
}