<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mrekammedis extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function get_rm($id){ 
        $this->db->select('a.rmPasien, b.tglInput tglPeriksa, a.idPendaftaran idPendaftaran, tglPendaftaran, namaDokter, fotoPemeriksaan,  noPembayaran');
        $this->db->where('a.rmPasien', $id);
        $this->db->where('statPemeriksaan', 1);
        $this->db->where('statPembayaran', 1);
        $this->db->from('t_pendaftaran a');
        $this->db->join('t_pemeriksaan b', 'a.idPendaftaran = b.idPendaftaran', 'left');
        $this->db->join('t_pembayaran c', 'a.idPendaftaran = c.idPendaftaran', 'left');
        $this->db->order_by('tglPendaftaran', 'desc');
        return $this->db->get()->result();
    }

    function get_pemeriksaan($id){ 
        $this->db->where('idPendaftaran', $id);
        $this->db->from('t_pemeriksaan_det');
        return $this->db->get()->result();
    }

    function get_barang($rm){ 
        $this->db->select('c.*');
        $this->db->where('pelangganBarangKeluar', $rm);
        $this->db->order_by('tglBarangKeluar', 'desc');
        $this->db->from('t_barang_keluar a');
        $this->db->join('t_barang_keluar_det c', 'a.idBarangKeluar = c.idBarangKeluar', 'left');
        return $this->db->get()->result();
    }

    function get_tindakan($no){ 
        $this->db->where('noPembayaran', $no);
        $this->db->from('t_pembayaran_tindakan');
        return $this->db->get()->result();
    }
}
