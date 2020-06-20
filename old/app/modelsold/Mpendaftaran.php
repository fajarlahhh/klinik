<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mpendaftaran extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function total_rows($bln, $thn, $st, $cari) {
        $this->db->select('a.*, namaPasien, alamatPasien, telpPasien, pekerjaanPasien, tempatLahirPasien, tglLahirPasien, kelaminPasien');
        if($st == 1){
            $this->db->where('month(tglPendaftaran)', $bln);
            $this->db->where('year(tglPendaftaran)', $thn);
        }
        $this->db->where($st);
        $this->db->group_start();
        $this->db->like('a.rmPasien', $cari);
        $this->db->or_like('namaPasien', $cari);
        $this->db->or_like('alamatPasien', $cari);
        $this->db->or_like('telpPasien', $cari);
        $this->db->or_like('pekerjaanPasien', $cari);
        $this->db->group_end();
        $this->db->from('t_pendaftaran a');
        $this->db->join('m_pasien b', 'a.rmPasien = b.rmPasien', 'left');
        
        return $this->db->count_all_results();
    }
    
    function get_limit($bln, $thn, $st, $cari, $offset, $num) {
        $this->db->select('a.*, namaPasien, alamatPasien, telpPasien, pekerjaanPasien, tempatLahirPasien, tglLahirPasien, kelaminPasien');
        if($st == 1){
            $this->db->where('month(tglPendaftaran)', $bln);
            $this->db->where('year(tglPendaftaran)', $thn);
        }
        $this->db->where($st);
        $this->db->group_start();
        $this->db->like('a.rmPasien', $cari);
        $this->db->or_like('namaPasien', $cari);
        $this->db->or_like('alamatPasien', $cari);
        $this->db->or_like('telpPasien', $cari);
        $this->db->or_like('pekerjaanPasien', $cari);
        $this->db->group_end();
        $this->db->limit($offset, $num);
        $this->db->order_by('idPendaftaran', 'asc');
        $this->db->from('t_pendaftaran a');
        $this->db->join('m_pasien b', 'a.rmPasien = b.rmPasien', 'left');
        return $this->db->get()->result();
    }

    function get_by_id($id){
        $this->db->select('b.*, idPendaftaran, noPendaftaran, tglPendaftaran, keluhanPendaftaran, keteranganPendaftaran, namaDokter, a.operator');
        $this->db->where('idPendaftaran', $id);
        $this->db->from('t_pendaftaran a');
        $this->db->join('m_pasien b', 'a.rmPasien = b.rmPasien', 'left');
        return $this->db->get()->row();
    }

    function get_last(){
        $this->db->select('if(noPendaftaran is null, 0, noPendaftaran) noPendaftaran');
        $this->db->where('tglPendaftaran', date('Y-m-d'));
        $this->db->limit(1);
        $this->db->order_by('noPendaftaran', 'desc');        
        return $this->db->get('t_pendaftaran')->row();        
    }
    
    function insert($data) {
        $save = $this->db->insert('t_pendaftaran', $data);
        return $save;
    }

    function delete($id) {
        $this->db->where('idPendaftaran', $id);
        $remove = $this->db->delete('t_pendaftaran');
        return $remove;
    }

    function update($id, $data) {
        $this->db->where('idPendaftaran', $id);
        $update = $this->db->update('t_pendaftaran', $data);
        return $update;
    }
}