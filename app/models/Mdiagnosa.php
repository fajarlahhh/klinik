<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdiagnosa extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function total_rows($cari) {
        $this->db->like('namaDiagnosa', $cari);
        $this->db->from('m_diagnosa');
        return $this->db->count_all_results();
    }
    
    function get_limit($cari, $offset, $num) {
        $this->db->like('namaDiagnosa', $cari);
        $this->db->limit($offset, $num);
        $this->db->order_by('namaDiagnosa', 'asc');
        return $this->db->get('m_diagnosa')->result();
    }
    
    function get_all() {
        return $this->db->get('m_diagnosa')->result();
    }
    
    function get_all_alias() {
        $this->db->select('namaDiagnosa operator');
        return $this->db->get('m_diagnosa')->result();
    }
    
    function get_tamu() {
        $this->db->where('tamuDiagnosa', 1);
        return $this->db->get('m_diagnosa')->result();
    }

    function get_by_id($id){
        $this->db->where('idDiagnosa', $id);
        $this->db->from('m_diagnosa');
        return $this->db->get()->row();
    }

    function get_by_nama($id){
        $this->db->where('namaDiagnosa', $id);
        $this->db->from('m_diagnosa');
        return $this->db->get()->row();
    }

    function get_last(){
        $this->db->select('idDiagnosa');
        $this->db->limit(1);
        $this->db->order_by('idDiagnosa', 'desc');        
        return $this->db->get('m_diagnosa')->row();        
    }

    function insert($data) {
        $save = $this->db->insert('m_diagnosa', $data);
        return $save;
    }

    function delete($id) {
        $this->db->where('idDiagnosa', $id);
        $remove = $this->db->delete('m_diagnosa');
        return $remove;
    }

    function update($id, $data) {
        $this->db->where('idDiagnosa', $id);
        $update = $this->db->update('m_diagnosa', $data);
        return $update;
    }
}
