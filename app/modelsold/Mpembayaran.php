<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mpembayaran extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function total_rows($bln, $thn, $cari) {
        $this->db->where('month(tglPembayaran)', $bln);
        $this->db->where('year(tglPembayaran)', $thn);
        $this->db->group_start();
        $this->db->like('b.rmPasien', $cari);
        $this->db->or_like('namaPasien', $cari);
        $this->db->or_like('alamatPasien', $cari);
        $this->db->or_like('telpPasien', $cari);
        $this->db->or_like('pekerjaanPasien', $cari);
        $this->db->or_like('noPembayaran', $cari);
        $this->db->group_end();
        $this->db->from('t_pembayaran a');
        $this->db->join('t_pendaftaran b', 'a.idPendaftaran = b.idPendaftaran', 'left');
        $this->db->join('m_pasien c', 'b.rmPasien = c.rmPasien', 'left');
        
        return $this->db->count_all_results();
    }
    
    function get_limit($bln, $thn, $cari, $offset, $num) {
        $this->db->select('a.*, b.rmPasien rmPasien, namaPasien, alamatPasien, telpPasien, pekerjaanPasien, tempatLahirPasien, tglLahirPasien, kelaminPasien');
        $this->db->where('month(tglPembayaran)', $bln);
        $this->db->where('year(tglPembayaran)', $thn);
        $this->db->group_start();
        $this->db->like('b.rmPasien', $cari);
        $this->db->or_like('namaPasien', $cari);
        $this->db->or_like('alamatPasien', $cari);
        $this->db->or_like('telpPasien', $cari);
        $this->db->or_like('pekerjaanPasien', $cari);
        $this->db->or_like('noPembayaran', $cari);
        $this->db->group_end();
        $this->db->limit($offset, $num);
        $this->db->order_by('tglPembayaran', 'asc');
        $this->db->from('t_pembayaran a');
        $this->db->join('t_pendaftaran b', 'a.idPendaftaran = b.idPendaftaran', 'left');
        $this->db->join('m_pasien c', 'b.rmPasien = c.rmPasien', 'left');
        return $this->db->get()->result();
    }

    function get_by_id($id){ 
        $this->db->select('b.*, noPembayaran, jmlTagihan, jmlPembayaran, tglPembayaran, a.operator, a.idPendaftaran, c.noPendaftaran, tglPendaftaran, namaDokter, adminPembayaran, listrikPembayaran');
        $this->db->where('noPembayaran', $id);
        $this->db->from('t_pembayaran a');
        $this->db->join('t_pendaftaran c', 'a.idPendaftaran = c.idPendaftaran', 'left');
        $this->db->join('m_pasien b', 'c.rmPasien = b.rmPasien', 'left');
        return $this->db->get()->row();
    }

    function get_blm_bayar($cari){
        $this->db->select('a.*, tamuDokter, namaPasien, alamatPasien, telpPasien, pekerjaanPasien, tempatLahirPasien, tglLahirPasien, kelaminPasien');
        $this->db->where('statPembayaran', 0);
        $this->db->group_start();
        $this->db->like('a.rmPasien', $cari);
        $this->db->or_like('namaPasien', $cari);
        $this->db->or_like('alamatPasien', $cari);
        $this->db->or_like('telpPasien', $cari);
        $this->db->or_like('pekerjaanPasien', $cari);
        $this->db->group_end();
        $this->db->from('t_pendaftaran a');
        $this->db->join('m_pasien b', 'a.rmPasien = b.rmPasien', 'left');
        $this->db->join('m_dokter c', 'a.namaDokter = c.namaDokter', 'left');
        return $this->db->get()->result();
    }

    function get_last(){
        $this->db->select('if(noPembayaran is null, 0, noPembayaran) noPembayaran');
        $this->db->where('year(tglInput)', date('Y'));
        $this->db->where('month(tglInput)', date('m'));
        $this->db->limit(1);
        $this->db->order_by('noPembayaran', 'desc');        
        return $this->db->get('t_pembayaran')->row();        
    }

    function get_barang($id){
        $this->db->where('noPembayaran', $id);
        $this->db->from('t_pembayaran_barang a');
        return $this->db->get()->result();
    }

    function get_tindakan($id){
        $this->db->where('noPembayaran', $id);
        $this->db->from('t_pembayaran_tindakan');
        return $this->db->get()->result();
    }
    
    function insert($data) {
        $save = $this->db->insert('t_pembayaran', $data);
        return $save;
    }
    
    function insert_tindakan($data) {
        $save = $this->db->insert('t_pembayaran_tindakan', $data);
        return $save;
    }
    
    function insert_barang($data) {
        $save = $this->db->insert('t_pembayaran_barang', $data);
        return $save;
    }
    
    function delete($id) {
        $this->db->where('idPendaftaran', $id);
        $remove = $this->db->delete('t_pembayaran');
        return $remove;
    }
}