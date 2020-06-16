<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mpembayaran extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function get_rm($id){ 
        $this->db->select('a.idPendaftaran idPendaftaran, tglPendaftaran, namaDokter, fotoPemeriksaan, fotoPemeriksaan, noPembayaran');
        $this->db->where('a.rmPasien', $id);
        $this->db->from('t_pendaftaran a');
        $this->db->join('t_pemeriksaan b', 'a.idPendaftaran = b.idPendaftaran', 'left');
        $this->db->join('t_pembayaran c', 'a.idPendaftaran = c.idPendaftaran', 'left');
        $this->db->order_by('tglPendaftaran', 'asc');
        return $this->db->get()->row();
    }

    function get_pemeriksaan($id){ 
        $this->db->where('idPendaftaran', $id);
        $this->db->from('t_pemeriksaan_det');
        return $this->db->get()->row();
    }

    function get_barang($no){ 
        $this->db->where('noPembayaran', $id);
        $this->db->from('t_pembayaran_barang');
        return $this->db->get()->row();
    }

    function get_tindakan($no){ 
        $this->db->where('noPembayaran', $id);
        $this->db->from('t_pembayaran_tindakan');
        return $this->db->get()->row();
    }
}
