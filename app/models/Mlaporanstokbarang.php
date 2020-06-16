<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mlaporanstokbarang extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function total_rows($bulan, $tahun, $cari) {
        $this->db->group_start();
        $this->db->like('namaBarang', $cari);
        $this->db->group_end();
        $this->db->from('m_barang o');
        return $this->db->count_all_results();
    }

    function limit_rekap($bulan, $tahun, $cari, $offset = null, $num = null) {
        $this->db->group_start();
        $this->db->like('namaBarang', $cari);
        $this->db->group_end();
        $this->db->select("*,
        ifnull((select sum(jmlBarang) from m_stok_awal where idBarang=o.idBarang and month(tglStokAwal)=$bulan and year(tglStokAwal)=$tahun group by idBarang),0) stokAwal,
        ifnull((select sum(jmlBarang) from t_barang_masuk where idBarang=o.idBarang and month(tglBarangMasuk)=$bulan and year(tglBarangMasuk)=$tahun group by idBarang),0) stokMasuk,
        ifnull((select sum(qtyBarang) from t_pembayaran_barang where idBarang=o.idBarang and month(tglPembayaran)=$bulan and year(tglPembayaran)=$tahun group by idBarang),0) + 
        ifnull((select sum(qtyBarang) from t_barang_keluar_det where idBarang=o.idBarang and month(tglBarangkeluar)=$bulan and year(tglBarangkeluar)=$tahun group by idBarang),0) stokKeluar");
        if($offset)
            $this->db->limit($offset, $num);
        $this->db->order_by('namaBarang', 'asc');
        return $this->db->get('m_barang o')->result();
    }

    function limit_rinci($bulan, $tahun, $cari, $offset = null, $num = null) {
        $this->db->group_start();
        $this->db->like('namaBarang', $cari);
        $this->db->group_end();
        $this->db->select("*,
        getTglKadaluarsa(o.idBarang) rowspan, count(idStokBarang) sumStok,
        (SELECT 
                GROUP_CONCAT(DISTINCT '<tr><td>',
                        date_format(tglKadaluarsaBarang, '%d %b %Y'),
                        '</td><td align=center>',
                        (select count(idStokBarang) from t_stok_barang where tglKadaluarsaBarang=a.tglKadaluarsaBarang and idBarang=a.idBarang), ' ', satuanBarang,
                        '</td></tr>'
                        SEPARATOR '')
            FROM
                t_stok_barang a
            WHERE
                idBarang = o.idBarang) stok");
        $this->db->order_by('namaBarang', 'asc');
        $this->db->from('m_barang o');
        $this->db->join('t_stok_barang s', 'o.idBarang = s.idBarang', 'left');
        if($offset)
            $this->db->limit($offset, $num);
        $this->db->group_by('o.idBarang');
        return $this->db->get()->result();
    }
}