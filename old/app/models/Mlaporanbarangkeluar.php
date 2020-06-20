<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mlaporanbarangkeluar extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function get_rinci($tgl1, $tgl2, $cari, $kriteria) {
        $this->db->like('b.namaBarang', $cari);
        $this->db->select("a.tglPembayaran tglKeluar, b.namaBarang, a.hargaBeliBarang hargaBeli, a.diskonBarang, a.hargaJualBarang hargaJual, sum(a.qtyBarang) qtyBarang");
        $this->db->where("a.tglPembayaran between '".$tgl1."' and '".$tgl2."'");
        $this->db->from('`t_pembayaran_barang` `a`');
        $this->db->join('m_barang b', '`a`.`idBarang` = `b`.`idBarang`', 'left');
        $this->db->where('b.khusus', $kriteria);
        $this->db->group_by('`a`.`tglPembayaran`, a.hargaBeliBarang, a.hargaJualBarang, a.diskonBarang');
        $sql1 = $this->db->get_compiled_select();
        
        $this->db->like('b.namaBarang', $cari);
        $this->db->select("a.tglBarangKeluar tglKeluar, b.namaBarang, a.hargaBeliBarang hargaBeli, a.diskonBarang, a.hargaJualBarang hargaJual, sum(a.qtyBarang) qtyBarang");
        $this->db->where("a.tglBarangKeluar between '".$tgl1."' and '".$tgl2."'");
        $this->db->from('`t_barang_keluar_det` `a`');
        $this->db->join('m_barang b', '`a`.`idBarang` = `b`.`idBarang`', 'left');
        $this->db->where('b.khusus', $kriteria);
        $this->db->group_by('`a`.`tglBarangKeluar`, a.hargaBeliBarang, a.hargaJualBarang, a.diskonBarang');
        $sql2 = $this->db->get_compiled_select();
            return $this->db->query("$sql1 union all $sql2  order by tglKeluar asc")->result();
    }
	
	function get_rekap($tgl1, $tgl2, $cari, $kriteria) {
        $this->db->like('b.namaBarang', $cari);
        $this->db->select("b.namaBarang, sum(qtyBarang) qtyBarang");
        $this->db->where("a.tglPembayaran between '".$tgl1."' and '".$tgl2."'");
        $this->db->from('`t_pembayaran_barang` `a`');
        $this->db->join('m_barang b', '`a`.`idBarang` = `b`.`idBarang`', 'left');
        $this->db->where('b.khusus', $kriteria);
        $this->db->group_by('`a`.`idBarang`');
        $sql1 = $this->db->get_compiled_select();
        
        $this->db->like('b.namaBarang', $cari);
        $this->db->select("b.namaBarang, sum(qtyBarang) qtyBarang");
        $this->db->where("a.tglBarangKeluar between '".$tgl1."' and '".$tgl2."'");
        $this->db->from('`t_barang_keluar_det` `a`');
        $this->db->where('b.khusus', $kriteria);
        $this->db->join('m_barang b', '`a`.`idBarang` = `b`.`idBarang`', 'left');
        $this->db->group_by('`a`.`idBarang`');
        $sql2 = $this->db->get_compiled_select();
            return $this->db->query("$sql1 union all $sql2  order by qtyBarang desc")->result();
    }
}