<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdatapabrik extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function total_rows($cari) {
        $this->db->like('namaPabrik', $cari);
        $this->db->from('m_pabrik');
        return $this->db->count_all_results();
    }
    
    function get_limit($cari, $offset, $num) {
        $this->db->like('namaPabrik', $cari);
        $this->db->limit($offset, $num);
        $this->db->order_by('namaPabrik', 'asc');
        return $this->db->get('m_pabrik')->result();
    }
	
    function get_last(){
        $this->db->select('idBarang');
        $this->db->limit(1);
        $this->db->order_by('idBarang', 'desc');        
        return $this->db->get('m_pabrik')->row();        
    }
    
    function get_all() {
        $this->db->order_by('namaPabrik', 'asc');
        return $this->db->get('m_pabrik')->result();
    }
    
    function insert($data) {
        $save = $this->db->insert('m_pabrik', $data);
        return $save;
    }

    function delete($id) {
        $this->db->where('namaPabrik', $id);
        $remove = $this->db->delete('m_pabrik');
        return $remove;
    }
}