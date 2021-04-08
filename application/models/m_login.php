<?php

class m_login extends CI_Model {
    function __construct() {
        parent::__construct();
        // $this->dbMIS=$this->load->database('dbMIS', TRUE);
        // $this->tblLoginLog='tblLoginLog';
        $this->tblMstUser='tblMstUser';
    }

    function verifikasi2($userid, $pass) {
        $query = $this->db->query("SELECT * FROM tblmstuser
        where Username='$userid' and Password='$pass'"); 
        return $query->row();
    }
    function showUserbyRole($role) {
        $query = $this->db->query("SELECT * FROM tblmstuser
        where Role='$role'"); 
        return $query->result();
    }
}
