<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mtindakandokter extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function total_rows($dokter, $cari) {
        $this->db->where('idDokter', $dokter);        
        $this->db->like('namaTindakan', $cari);
        $this->db->from('m_tindakan_dokter a');
        $this->db->join('m_tindakan b', 'a.idTindakan = b.idTindakan', 'left');
        return $this->db->count_all_results();
    }
    
    function get_limit($dokter, $cari, $offset, $num) {
        $this->db->select('a.*, namaDokter, namaTindakan');        
        $this->db->where('a.idDokter', $dokter);        
        $this->db->like('namaTindakan', $cari);
        $this->db->limit($offset, $num);
        $this->db->order_by('namaTindakan', 'asc');
        $this->db->from('m_tindakan_dokter a');
        $this->db->join('m_tindakan b', 'a.idTindakan = b.idTindakan', 'left');
        $this->db->join('m_dokter c', 'a.idDokter = c.idDokter', 'left');
        return $this->db->get()->result();
    }

    function get_by_id($id){
        $this->db->where('idTindakanDokter', $id);
        $this->db->from('m_tindakan_dokter a');
        $this->db->join('m_dokter b', 'b.idDokter = a.idDokter', 'left'); 
        return $this->db->get()->row();
    }

    function get_last(){
        $this->db->select('idTindakanDokter');
        $this->db->limit(1);
        $this->db->order_by('idTindakan', 'desc');        
        return $this->db->get('m_tindakan_dokter')->row();
    }
    
    function get_all() {
        return $this->db->get('m_tindakan_dokter')->result();
    }
    
    function get_by_dokter($id) {
        $this->db->select('a.*, namaTindakan, namaDokter, tamuDokter');        
        $this->db->where('namaDokter', $id);
        $this->db->from('m_tindakan_dokter a');
        $this->db->join('m_dokter c', 'a.idDokter = c.idDokter', 'left');
        $this->db->join('m_tindakan b', 'a.idTindakan = b.idTindakan', 'left');
        $this->db->order_by('namaTindakan', 'asc');        
        return $this->db->get()->result();
    }

    function insert($data) {
        $save = $this->db->insert('m_tindakan_dokter', $data);
        return $save;
    }

    function delete($id) {
        $this->db->where('idTindakanDokter', $id);
        $remove = $this->db->delete('m_tindakan_dokter');
        return $remove;
    }

    function update($id, $data) {
        $this->db->where('idTindakanDokter', $id);
        $update = $this->db->update('m_tindakan_dokter', $data);
        return $update;
    }
}