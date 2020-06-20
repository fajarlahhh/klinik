<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mstokbarang extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function _getStok($id){
        $this->db->where('idBarang', $id);
        $this->db->from('t_stok_barang');
        return $this->db->count_all_results();
    }
	
	function getStok($id){
		$this->db->select("ifnull((select jmlBarang from m_stok_awal where month(tglStokAwal)=".date('m')." and year(tglStokAwal)=".date('Y')." and idBarang=a.idBarang), 0) + 
ifnull((select sum(jmlBarang) from t_barang_masuk where month(tglBarangMasuk)=".date('m')." and year(tglBarangMasuk)=".date('Y')." and idBarang=a.idBarang), 0) - 
ifnull((select sum(qtyBarang) from t_barang_keluar_det where month(tglBarangKeluar)=".date('m')." and year(tglBarangKeluar)=".date('Y')." and idBarang=a.idBarang), 0) jml");
        $this->db->where('idBarang', $id);
        $stok = $this->db->get('m_barang a')->row();
		return $stok->jml;
	}

    function get_stok_awal_by_id($bulan, $tahun, $barang){
        $this->db->where('idBarang', $barang);
        $this->db->where('month(tglStokAwal)', $bulan);
        $this->db->where('year(tglStokAwal)', $tahun);
        return $this->db->get('m_stok_awal')->row();
    }
}