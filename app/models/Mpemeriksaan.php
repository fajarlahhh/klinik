<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mpemeriksaan extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function total_rows($bln, $thn, $cari) {
        $this->db->where('month(a.tglInput)', $bln);
        $this->db->where('year(a.tglInput)', $thn);
        $this->db->group_start();
        $this->db->like('b.rmPasien', $cari);
        $this->db->or_like('namaPasien', $cari);
        $this->db->or_like('alamatPasien', $cari);
        $this->db->or_like('telpPasien', $cari);
        $this->db->or_like('pekerjaanPasien', $cari);
        $this->db->group_end();
        $this->db->from('t_pemeriksaan a');
        $this->db->join('t_pendaftaran b', 'a.idPendaftaran = b.idPendaftaran', 'left');
        $this->db->join('m_pasien c', 'b.rmPasien = c.rmPasien', 'left');
        
        return $this->db->count_all_results();
    }
    
    function get_limit($bln, $thn, $cari, $offset, $num) {
        $this->db->select('a.*, b.rmPasien rmPasien, namaPasien, alamatPasien, telpPasien, pekerjaanPasien, tempatLahirPasien, tglLahirPasien, kelaminPasien, a.tglInput tglPemeriksaan, statPemeriksaan, statPembayaran');
        $this->db->where('month(a.tglInput)', $bln);
        $this->db->where('year(a.tglInput)', $thn);
        $this->db->group_start();
        $this->db->like('b.rmPasien', $cari);
        $this->db->or_like('namaPasien', $cari);
        $this->db->or_like('alamatPasien', $cari);
        $this->db->or_like('telpPasien', $cari);
        $this->db->or_like('pekerjaanPasien', $cari);
        $this->db->group_end();
        $this->db->limit($offset, $num);
        $this->db->order_by('tglInput', 'asc');
        $this->db->from('t_pemeriksaan a');
        $this->db->join('t_pendaftaran b', 'a.idPendaftaran = b.idPendaftaran', 'left');
        $this->db->join('m_pasien c', 'b.rmPasien = c.rmPasien', 'left');
        return $this->db->get()->result();
    }

    function get_by_id($id){ 
        $this->db->select('b.*, a.idPendaftaran, namaDokter,  a.tglInput tglPemeriksaan');
        $this->db->where('a.idPendaftaran', $id);
        $this->db->from('t_pemeriksaan a');
        $this->db->join('t_pendaftaran c', 'a.idPendaftaran = c.idPendaftaran', 'left');
        $this->db->join('m_pasien b', 'c.rmPasien = b.rmPasien', 'left');
        return $this->db->get()->row();
    }

    function get_blm_periksa($cari){
        $this->db->select('a.*, tamuDokter, namaPasien, alamatPasien, telpPasien, pekerjaanPasien, tempatLahirPasien, tglLahirPasien, kelaminPasien');
        $this->db->where('statPemeriksaan', 0);
        $this->db->where('statPembayaran', 0);
        $this->db->group_start();
        $this->db->like('a.rmPasien', $cari);
        $this->db->or_like('a.idPendaftaran', $cari);
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

    function get_diagnosa($id){
        $this->db->where('idPendaftaran', $id);
        $this->db->from('t_pemeriksaan_det a');
        return $this->db->get()->result();
    }

    function get_tindakan($id){
        $this->db->where('idPendaftaran', $id);
        $this->db->from('t_pemeriksaan_tindakan a');
        $this->db->order_by('urutanPembayaranTindakan', 'asc'); 
        return $this->db->get()->result();
    }
    
    function insert($data) {
        $save = $this->db->insert('t_pemeriksaan', $data);
        return $save;
    }

    function update($id, $data) {
        $this->db->where('idPendaftaran', $id);
        $update = $this->db->update('t_pemeriksaan', $data);
        return $update;
    }
    
    function insert_detail($data) {
        $save = $this->db->insert('t_pemeriksaan_det', $data);
        return $save;
    }
    
    function insert_tindakan($data) {
        $save = $this->db->insert('t_pemeriksaan_tindakan', $data);
        return $save;
    }
    
    function delete($id) {
        $this->db->where('idPendaftaran', $id);
        $remove = $this->db->delete('t_pemeriksaan');
        return $remove;
    }
}
