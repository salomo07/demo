<?php

class m_customer extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function showAll() {
        $query = $this->db->query("SELECT * FROM customer"); 
        return $query->result();
    }
    function showDetail($id) {
        $query = $this->db->query("SELECT * FROM customer where id=$id"); 
        return $query->row();
    }
    function delete($id) {
        $this->db->delete('customer', array('Id' => $id));
    }
    function getNewId() {
        $query = $this->db->query("SELECT max(Id) as 'Id' FROM `customer`"); 
        return $query->row();
    }
    function insertCustomer($data) {
        $this->db->insert('customer', $data);
    }
    function updateItem($data) {
        $this->db->where('id', $data['id']);
        $this->db->update('customer', $data);
    }
    
}
