<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mlaporanbarangmasuk extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function total_rinci($tgl1, $tgl2, $cari) {
        $this->db->where("tglBarangMasuk between '".$tgl1."' and '".$tgl2."'");
        $this->db->group_start();
        $this->db->like('ketBarangMasuk', $cari);
        $this->db->or_like('operator', $cari);
        $this->db->group_end();
        $this->db->from('t_barang_masuk a');
        return $this->db->count_all_results();
    }

    function total_rekap($tgl1, $tgl2, $cari) {
        $this->db->where("a.tglBarangMasuk between '".$tgl1."' and '".$tgl2."'");
        $this->db->group_start();
        $this->db->like('ketBarangMasuk', $cari);
        $this->db->or_like('a.operator', $cari);
        $this->db->group_end();
        $this->db->from('t_barang_masuk a');
        $this->db->group_by('a.tglBarangMasuk');        
        return $this->db->count_all_results();
    }

    function limit_rinci($tgl1, $tgl2, $cari, $offset, $num = null) {
        $this->db->select("a.idBarangMasuk, ketBarangMasuk, a.tglBarangMasuk, a.operator, sum(b.hargaBeliBarang * jmlBarang) sumHargaBeliBarangMasuk,
        GROUP_CONCAT( '<tr><td>',
                                namaBarang, '</td><td align=right>', format(b.hargaBeliBarang, 2), '</td><td align=center>', jmlBarang, ' ', satuanBarang,
                                '</td><td align=right>', format(b.hargaBeliBarang * jmlBarang, 2),
                                '</td><td align=center>',
                                date_format(b.tglKadaluarsaBarang, '%d %b %Y'),'</td><td>', namaSupplier,
                                '</td><td align=center>', if(konsinyasiSupplier = 1, \"Y\", \"T\"), '</td></tr>'
                                SEPARATOR '') barang");        
        $this->db->where("a.tglBarangMasuk between '".$tgl1."' and '".$tgl2."'");
        $this->db->group_start();
        $this->db->like('ketBarangMasuk', $cari);
        $this->db->or_like('a.operator', $cari);
        $this->db->group_end();
        $this->db->order_by('a.tglInput', 'asc');
        if($num)
            $this->db->limit($offset, $num);
        $this->db->from('t_barang_masuk a');
        $this->db->join('t_barang_masuk_det b', 'a.idBarangMasuk = b.idBarangMasuk', 'left');
        $this->db->join('m_barang c', 'b.idBarang=c.idBarang', 'left');
        $this->db->group_by('a.idBarangMasuk');        
        return $this->db->get()->result();
    }

    function limit_rekap($tgl1, $tgl2, $cari, $offset, $num = null) {
        $this->db->select("a.tglBarangMasuk, group_concat(distinct '<tr><td>', c.namaBarang, '</td><td>', 
        (select sum(jmlBarang) from t_barang_masuk_det where idBarang=b.idBarang and tglBarangMasuk=a.tglBarangMasuk), ' ', satuanBarang, '</td></tr>' separator '') barang");        
        $this->db->where("a.tglBarangMasuk between '".$tgl1."' and '".$tgl2."'");
        $this->db->order_by('a.tglBarangMasuk', 'asc');
        if($num)
            $this->db->limit($offset, $num);
        $this->db->from('t_barang_masuk a');
        $this->db->join('t_barang_masuk_det b', 'a.idBarangMasuk = b.idBarangMasuk', 'left');
        $this->db->join('m_barang c', 'b.idBarang=c.idBarang', 'left');
        $this->db->group_by('a.tglBarangMasuk');
        return $this->db->get()->result();
    }
}