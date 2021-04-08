<?php

class m_sales extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function showAll() {
        $query = $this->db->query("SELECT * FROM transaksi"); 
        return $query->result();
    }
    function showDetail($id) {
        $query = $this->db->query("SELECT * FROM transaksi where id=$id"); 
        return $query->row();
    }
    function delete($id) {
        $this->db->delete('transaksi', array('Id' => $id));
    }
    function getLastTransaksi() {
        $query = $this->db->query("SELECT * FROM `transaksi` t INNER JOIN Customer c on t.customer=c.id where Code=(select max(Code) from transaksi)"); 
        return $query->row();
    }
    function insertTransaksi($data) {
        $this->db->insert('transaksi', $data);
    }
    function updateItem($data) {
        $this->db->where('id', $data['id']);
        $this->db->update('transaksi', $data);
    }
    
}
