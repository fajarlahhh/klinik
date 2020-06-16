<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdatatindakan extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function total_rows($cari) {
        $this->db->like('namaTindakan', $cari);
        $this->db->from('m_tindakan');
        return $this->db->count_all_results();
    }
    
    function get_limit($cari, $offset, $num) {
        $this->db->like('namaTindakan', $cari);
        $this->db->limit($offset, $num);
        $this->db->order_by('namaTindakan', 'asc');
        return $this->db->get('m_tindakan')->result();
    }

    function get_by_id($id){
        $this->db->where('idTindakan', $id);
        $this->db->from('m_tindakan');
        return $this->db->get()->row();
    }

    function get_last(){
        $this->db->select('idTindakan');
        $this->db->limit(1);
        $this->db->order_by('idTindakan', 'desc');        
        return $this->db->get('m_tindakan')->row();        
    }
    
    function get_all() {
        return $this->db->get('m_tindakan')->result();
    }

    function insert($data) {
        $save = $this->db->insert('m_tindakan', $data);
        return $save;
    }

    function delete($id) {
        $this->db->where('idTindakan', $id);
        $remove = $this->db->delete('m_tindakan');
        return $remove;
    }

    function update($id, $data) {
        $this->db->where('idTindakan', $id);
        $update = $this->db->update('m_tindakan', $data);
        return $update;
    }
}