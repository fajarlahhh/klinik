<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdatabarang extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function total_rows($cari) {
        $this->db->like('namaBarang', $cari);
        $this->db->or_like('ketBarang', $cari);
        $this->db->or_like('satuanBarang', $cari);
        $this->db->from('m_barang');
        return $this->db->count_all_results();
    }
    
    function get_limit($cari, $offset, $num) {
        $this->db->like('namaBarang', $cari);
        $this->db->or_like('ketBarang', $cari);
        $this->db->or_like('satuanBarang', $cari);
        $this->db->limit($offset, $num);
        $this->db->order_by('namaBarang', 'asc');
        return $this->db->get('m_barang')->result();
    }
	
    function get_by_id($id){
        $this->db->where('idBarang', $id);
        $this->db->from('m_barang');
        return $this->db->get()->row();
    }

    function get_last(){
        $this->db->select('idBarang');
        $this->db->limit(1);
        $this->db->order_by('idBarang', 'desc');        
        return $this->db->get('m_barang')->row();        
    }
    
    function get_all() {		
        $this->db->select('*, concat(namaBarang, " ", deskBarang) as namaBarang1');
        //$this->db->select('*, pembulatan((hargaBeliBarang * keuntunganBarang/100) + hargaBeliBarang) as hargaJualBarang');
        $this->db->order_by('namaBarang', 'asc');
        return $this->db->get('m_barang')->result();
    }
    function get_khusus() {		
        $this->db->select('*, concat(namaBarang, " ", deskBarang) as namaBarang1');
        //$this->db->select('*, pembulatan((hargaBeliBarang * keuntunganBarang/100) + hargaBeliBarang) as hargaJualBarang');
        $this->db->order_by('namaBarang', 'asc');
        $this->db->where('khusus', 1);
        return $this->db->get('m_barang')->result();
    }
    function get_tidak_khusus() {		
        $this->db->select('*, concat(namaBarang, " ", deskBarang) as namaBarang1');
        //$this->db->select('*, pembulatan((hargaBeliBarang * keuntunganBarang/100) + hargaBeliBarang) as hargaJualBarang');
        $this->db->order_by('namaBarang', 'asc');
        $this->db->where('khusus', 0);
        return $this->db->get('m_barang')->result();
    }
    
    function get_by_tipe($tipe) {
        $this->db->where('tipeBarang', $tipe);        
        $this->db->select('*, concat(namaBarang, " ", deskBarang) as namaBarang1');
        //$this->db->select('*, pembulatan((hargaBeliBarang * keuntunganBarang/100) + hargaBeliBarang) as hargaJualBarang');
        $this->db->order_by('namaBarang', 'asc');
        return $this->db->get('m_barang')->result();
    }

    function insert($data) {
        $save = $this->db->insert('m_barang', $data);
        return $save;
    }

    function delete($id) {
        $this->db->where('idBarang', $id);
        $remove = $this->db->delete('m_barang');
        return $remove;
    }

    function update($id, $data) {
        $this->db->where('idBarang', $id);
        $update = $this->db->update('m_barang', $data);
        return $update;
    }
}