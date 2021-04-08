<?php

class m_item extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function showAll() {
        $query = $this->db->query("SELECT * FROM item"); 
        return $query->result();
    }
    function showDetail($id) {
        $query = $this->db->query("SELECT * FROM item where id=$id"); 
        return $query->row();
    }
    function delete($id) {
        $this->db->delete('item', array('Id' => $id));
    }
    function showByNama($nama) {
        $query = $this->db->query("SELECT * FROM item where nama='$nama'"); 
        return $query->row();
    }
    function insertItem($data) {
        $this->db->insert('item', $data);
    }
    function updateItem($data) {
        $this->db->where('id', $data['id']);
        $this->db->update('item', $data);
    }
    
}
