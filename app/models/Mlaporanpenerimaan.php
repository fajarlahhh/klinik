<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mlaporanpenerimaan extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function total_rekap($tgl1, $tgl2, $kasir, $cari) {
        $this->db->select("`a`.`noPembayaran` AS `noPenerimaan`");
        $this->db->where("tglPembayaran between '".$tgl1."' and '".$tgl2."'");
        if($kasir)
            $this->db->where('a.operator', $kasir);
        $this->db->group_start();
        $this->db->like('noPembayaran', $cari);
        $this->db->or_like('namaPasien', $cari);
        $this->db->group_end();
        $this->db->from('`t_pembayaran` `a`');
        $this->db->join('t_pendaftaran b', '`a`.`idPendaftaran` = `b`.`idPendaftaran`', 'left');
        $this->db->join('`m_pasien` `c`', '`b`.`rmPasien` = `c`.`rmPasien`', 'left');
        $sql1 = $this->db->get_compiled_select();
        
        $this->db->select("`idBarangKeluar` AS `noPenerimaan`");
        $this->db->where("tglBarangKeluar between '".$tgl1."' and '".$tgl2."'");
        if($kasir)
            $this->db->where('operator', $kasir);
        $this->db->group_start();
        $this->db->like('idBarangKeluar', $cari);
        $this->db->or_like('pelangganBarangKeluar', $cari);
        $this->db->group_end();
        $this->db->from('t_barang_keluar');
        $sql2 = $this->db->get_compiled_select();
        $query = $this->db->query("$sql1 union all $sql2");
        return $query->num_rows();
    }
    
    function get_rekap_limit($tgl1, $tgl2, $kasir, $cari, $offset  = null, $num = null) {
        $this->db->select("`a`.`noPembayaran` AS `noPenerimaan`,
        `c`.`namaPasien` AS `pelanggan`,
        `a`.`operator` AS `operator`,
        `a`.`tglPembayaran` AS `tglPenerimaan`,
        `a`.`jmlTagihan` AS `jmlPenerimaan`,
        (SELECT 
                SUM((`tdk`.`biayaTindakan` - `tdk`.`biayaTindakan` * `tdk`.`diskonTindakan`/100) * `tdk`.`qtyTindakan` * `tdk`.`bagianPetugas` / 100)
            FROM
                `t_pembayaran_tindakan` `tdk`
            WHERE
                (`tdk`.`noPembayaran` = `a`.`noPembayaran`)) AS `bagianPetugas`,
        (SELECT 
                SUM((`tdk`.`biayaTindakan` - `tdk`.`biayaTindakan` * `tdk`.`diskonTindakan`/100) * `tdk`.`qtyTindakan` * `tdk`.`bagianKlinik` / 100)
            FROM
                `t_pembayaran_tindakan` `tdk`
            WHERE
                (`tdk`.`noPembayaran` = `a`.`noPembayaran`)) AS `bagianKlinik`,
        (SELECT 
                SUM((`tdk`.`biayaTindakan` - `tdk`.`biayaTindakan` * `tdk`.`diskonTindakan`/100) * `tdk`.`qtyTindakan`)
            FROM
                `t_pembayaran_tindakan` `tdk`
            WHERE
                (`tdk`.`noPembayaran` = `a`.`noPembayaran`)) AS `jmlTindakan`,
        (SELECT 
                SUM(((`brg`.`hargaJualBarang` - `brg`.`hargaJualBarang` * `brg`.`diskonBarang`/100) * `brg`.`qtyBarang`))
            FROM
                `t_pembayaran_barang` `brg`
            WHERE
                (`brg`.`noPembayaran` = `a`.`noPembayaran`)) AS `jmlBarang`,
        `a`.`listrikPembayaran` AS `jmlLain1`,
        `a`.`adminPembayaran` AS `jmlLain2`,
        0 AS `jmlLain3`,
        `a`.`tglInput` AS `tglInput`");
        $this->db->where("tglPembayaran between '".$tgl1."' and '".$tgl2."'");
        if($kasir)
            $this->db->where('a.operator', $kasir);        
        $this->db->group_start();
        $this->db->like('noPembayaran', $cari);
        $this->db->or_like('namaPasien', $cari);
        $this->db->group_end();
        $this->db->from('`t_pembayaran` `a`');
        $this->db->join('t_pendaftaran b', '`a`.`idPendaftaran` = `b`.`idPendaftaran`', 'left');
        $this->db->join('`m_pasien` `c`', '`b`.`rmPasien` = `c`.`rmPasien`', 'left');
        $sql1 = $this->db->get_compiled_select();
        
        $this->db->select("a.`idBarangKeluar` AS `noPenerimaan`,
       ifnull((select namaPasien from m_pasien where rmPasien=pelangganBarangKeluar), ifnull(ketBarangKeluar, pelangganBarangKeluar)) AS `pelanggan`,
        `operator` AS `operator`,
        `tglBarangKeluar` AS `tglPenerimaan`,
        `jmlTagihan` AS `jmlPenerimaan`,
        0 AS `bagianPetugas`,
        0 AS `bagianKlinik`,
        0 AS `jmlTindakan`,
        (SELECT 
                SUM(((`brg`.`hargaJualBarang` - `brg`.`hargaJualBarang` * `brg`.`diskonBarang`/100) * `brg`.`qtyBarang`))
            FROM
                `t_barang_keluar_det` `brg`
            WHERE
                (`brg`.`idBarangKeluar` = `a`.`idBarangKeluar`)) AS `jmlBarang`,
        `a`.`listrikBarangKeluar` AS `jmlLain1`,
        `a`.`adminBarangKeluar` AS `jmlLain2`,
        resepBarangKeluar AS `jmlLain3`,
        `tglInput` AS `tglInput`");
        $this->db->where("tglBarangKeluar between '".$tgl1."' and '".$tgl2."'");
        if($kasir)
            $this->db->where('operator', $kasir);
        $this->db->group_start();
        $this->db->like('idBarangKeluar', $cari);
        $this->db->or_like('pelangganBarangKeluar', $cari);
        $this->db->group_end();
        $this->db->from('t_barang_keluar a');
        
        $sql2 = $this->db->get_compiled_select();
            return $this->db->query("$sql1 union all $sql2  order by tglInput asc")->result();
    }

    function total_tindakan($tgl1, $tgl2, $ptg, $cari) {
        $this->db->where("a.tglPembayaran between '".$tgl1."' and '".$tgl2."'");
        if($ptg)
            $this->db->where('a.namaPetugas', $ptg);     
        $this->db->group_start();
        $this->db->like('a.noPembayaran', $cari);
        $this->db->or_like('namaPasien', $cari);
        $this->db->group_end();
        $this->db->from('`t_pembayaran_tindakan` `a`');
        $this->db->join('t_pembayaran d', '`a`.`noPembayaran` = `d`.`noPembayaran`', 'left');
        $this->db->join('m_tindakan e', '`a`.`idTindakan` = `e`.`idTindakan`', 'left');
        $this->db->join('t_pendaftaran b', '`d`.`idPendaftaran` = `b`.`idPendaftaran`', 'left');
        $this->db->join('`m_pasien` `c`', '`b`.`rmPasien` = `c`.`rmPasien`', 'left');
        return $this->db->count_all_results();
    }

    function get_tindakan_limit($tgl1, $tgl2, $ptg, $cari, $offset = null, $num = null) {
        $this->db->select("a.noPembayaran, namaPasien, a.tglPembayaran, e.namaTindakan, qtyTindakan,
        (a.biayaTindakan * a.bagianPetugas / 100) bagianPetugas");
        $this->db->where("a.tglPembayaran between '".$tgl1."' and '".$tgl2."'");
        if($ptg)
            $this->db->where('a.namaPetugas', $ptg);        
        $this->db->group_start();
        $this->db->like('a.noPembayaran', $cari);
        $this->db->or_like('namaPasien', $cari);
        $this->db->group_end();
        $this->db->order_by('d.tglInput', 'asc');
        $this->db->from('`t_pembayaran_tindakan` `a`');
        $this->db->join('t_pembayaran d', '`a`.`noPembayaran` = `d`.`noPembayaran`', 'left');
        $this->db->join('m_tindakan e', '`a`.`idTindakan` = `e`.`idTindakan`', 'left');
        $this->db->join('t_pendaftaran b', '`d`.`idPendaftaran` = `b`.`idPendaftaran`', 'left');
        $this->db->join('`m_pasien` `c`', '`b`.`rmPasien` = `c`.`rmPasien`', 'left');
        return $this->db->get()->result();
    }

    function total_barang($tgl1, $tgl2, $ks, $cari) {
        $this->db->where("a.tglBarangKeluar between '".$tgl1."' and '".$tgl2."'"); 
        if($ks != '')
            $this->db->where('namaSupplier', $ks);
        $this->db->group_start();
        $this->db->like('a.idBarangKeluar', $cari);
        $this->db->or_like('ketBarangKeluar', $cari);
        $this->db->group_end();
        $this->db->from('`t_barang_keluar` `a`');
        $this->db->join('t_stok_keluar c', '`c`.`idBarangKeluar` = `a`.`idBarangKeluar`', 'left');
        return $this->db->count_all_results();
    }

    function get_barang_limit($tgl1, $tgl2, $ks, $cari, $offset = null, $num = null) {
        $this->db->select('a.*, b.namaBarang, ketBarangKeluar');
        $this->db->where("a.tglBarangKeluar between '".$tgl1."' and '".$tgl2."'"); 
        if($ks != '')
            $this->db->where('namaDokter', $ks);
        $this->db->group_start();
        $this->db->like('a.idBarangKeluar', $cari);
        $this->db->or_like('ketBarangKeluar', $cari);
        $this->db->group_end();
        $this->db->from('`t_barang_keluar_det` `a`');
        $this->db->join('m_barang b', '`b`.`idBarang` = `a`.`idBarang`', 'left');
        $this->db->join('t_barang_keluar c', '`c`.`idBarangKeluar` = `a`.`idBarangKeluar`', 'left');
        return $this->db->get()->result();
    }

    function total_lainnya($tgl1, $tgl2, $cari) {
        $this->db->select("noPembayaran AS `noPenerimaan`");
        $this->db->where("tglPembayaran between '".$tgl1."' and '".$tgl2."'");
        $this->db->group_start();
        $this->db->like('noPembayaran', $cari);
        $this->db->or_like('namaPasien', $cari);
        $this->db->group_end();
        $this->db->from('`t_pembayaran` `a`');
        $this->db->join('t_pendaftaran b', '`a`.`idPendaftaran` = `b`.`idPendaftaran`', 'left');
        $this->db->join('`m_pasien` `c`', '`b`.`rmPasien` = `c`.`rmPasien`', 'left');
        $sql1 = $this->db->get_compiled_select();
        
        $this->db->select("idBarangKeluar AS `noPenerimaan`");
        $this->db->where("tglBarangKeluar between '".$tgl1."' and '".$tgl2."'");
        $this->db->group_start();
        $this->db->like('idBarangKeluar', $cari);
        $this->db->or_like('pelangganBarangKeluar', $cari);
        $this->db->group_end();
        $this->db->from('t_barang_keluar');
        $sql2 = $this->db->get_compiled_select();
        $query = $this->db->query("$sql1 union all $sql2");
        return $query->num_rows();
    }

    function get_lainnya_limit($tgl1, $tgl2, $cari, $offset = null, $num = null) {
        $this->db->select("`a`.`noPembayaran` AS `noPenerimaan`,
        `c`.`namaPasien` AS `pelanggan`,
        `a`.`operator` AS `operator`,
        `a`.`tglPembayaran` AS `tglPenerimaan`,
        listrikPembayaran AS `listrikPenerimaan`,
        adminPembayaran AS `adminPenerimaan`,
        '0' AS `resepPenerimaan`,
        `a`.`tglInput` AS `tglInput`");
        $this->db->where("tglPembayaran between '".$tgl1."' and '".$tgl2."'");
        $this->db->group_start();
        $this->db->like('noPembayaran', $cari);
        $this->db->or_like('namaPasien', $cari);
        $this->db->group_end();
        $this->db->from('`t_pembayaran` `a`');
        $this->db->join('t_pendaftaran b', '`a`.`idPendaftaran` = `b`.`idPendaftaran`', 'left');
        $this->db->join('`m_pasien` `c`', '`b`.`rmPasien` = `c`.`rmPasien`', 'left');
        $sql1 = $this->db->get_compiled_select();
        
        $this->db->select("`idBarangKeluar` AS `noPenerimaan`,
        `pelangganBarangKeluar` AS `pelanggan`,
        `operator` AS `operator`,
        `tglBarangKeluar` AS `tglPenerimaan`,
        listrikBarangKeluar AS `listrikPenerimaan`,
        adminBarangKeluar AS `adminPenerimaan`,
        resepBarangKeluar AS `resepPenerimaan`,
        `tglInput` AS `tglInput`");
        $this->db->where("tglBarangKeluar between '".$tgl1."' and '".$tgl2."'");
        $this->db->group_start();
        $this->db->like('idBarangKeluar', $cari);
        $this->db->or_like('pelangganBarangKeluar', $cari);
        $this->db->group_end();
        $this->db->from('t_barang_keluar');
        $sql2 = $this->db->get_compiled_select();
        
            return $this->db->query("$sql1 union all $sql2  order by tglInput asc")->result();
    }

    function get_petugas($tgl1, $tgl2) {
        $this->db->distinct();
        $this->db->select("namaPetugas operator");
        $this->db->where("tglPembayaran between '".$tgl1."' and '".$tgl2."'");
        $this->db->from('t_pembayaran_tindakan');
        return $this->db->get()->result();
    }

    function get_kasir($tgl1, $tgl2){
        $this->db->select("`a`.`operator` AS `operator`");
        $this->db->where("tglPembayaran between '".$tgl1."' and '".$tgl2."'");
        $this->db->from('`t_pembayaran` `a`');
        $sql1 = $this->db->get_compiled_select();
        
        $this->db->select("`operator` AS `operator`");
        $this->db->where("tglBarangKeluar between '".$tgl1."' and '".$tgl2."'");
        $this->db->from('t_barang_keluar');
        $sql2 = $this->db->get_compiled_select();
        return $this->db->query("select distinct operator from ($sql1 union all $sql2) tb order by operator asc")->result();      
    }
}