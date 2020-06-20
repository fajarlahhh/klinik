<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mpasien extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function total_rows($cari) {
        $this->db->like('rmPasien', $cari);
        $this->db->or_like('namaPasien', $cari);
        $this->db->or_like('alamatPasien', $cari);
        $this->db->or_like('telpPasien', $cari);
        $this->db->or_like('pekerjaanPasien', $cari);
        $this->db->from('m_pasien');
        return $this->db->count_all_results();
    }
    
    function get_limit($cari, $offset, $num) {
        $this->db->like('rmPasien', $cari);
        $this->db->or_like('namaPasien', $cari);
        $this->db->or_like('alamatPasien', $cari);
        $this->db->or_like('telpPasien', $cari);
        $this->db->or_like('pekerjaanPasien', $cari);
        $this->db->limit($offset, $num);
        $this->db->order_by('rmPasien', 'asc');
        return $this->db->get('m_pasien')->result();
    }
    
    function get_all($cari) {
        $this->db->select("*, date_format(tglLahirPasien, '%d %b %Y') tglLahirPasien_");
        
        $this->db->like('rmPasien', $cari);
        $this->db->or_like('namaPasien', $cari);
        $this->db->or_like('alamatPasien', $cari);
        $this->db->or_like('telpPasien', $cari);
        $this->db->or_like('pekerjaanPasien', $cari);
        $this->db->order_by('rmPasien', 'asc');
        return $this->db->get('m_pasien')->result();
    }

    function get_by_id($id){
        $this->db->where('rmPasien', $id);
        $this->db->from('m_pasien');
        return $this->db->get()->row();
    }

    function get_last(){
        $this->db->select('rmPasien');
        $this->db->limit(1);
        $this->db->order_by('rmPasien', 'desc');        
        return $this->db->get('m_pasien')->row();        
    }
    
    function insert($data) {
        $save = $this->db->insert('m_pasien', $data);
        return $save;
    }

    function delete($id) {
        $this->db->where('rmPasien', $id);
        $remove = $this->db->delete('m_pasien');
        return $remove;
    }

    function update($id, $data) {
        $this->db->where('rmPasien', $id);
        $update = $this->db->update('m_pasien', $data);
        return $update;
    }
}