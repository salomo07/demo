<?php

class m_lab extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->dbEForm=$this->load->database('dbEForm', TRUE);
        $this->dbPIC=$this->load->database('dbPIC', TRUE);
    }
    function getDataPenerimaanByTanggal($tgl) {
        $query = $this->dbEForm->query("select * from tblpenerimaanshelflife where substring(CAST (tglpengiriman AS text), 9,2)||'-'||substring(CAST (tglpengiriman AS text), 6,2)||'-'||substring(CAST (tglpengiriman AS text), 1,4)='$tgl'"); 
        return $query->result();
    }
    function getMasterFillerLab($filler) {
        $query = $this->db->query("select * FROM tblMstFillerLab where NamaFillerWTP='$filler'"); 
        return $query->row();
    }
    function getAliasSample($idProduct) {
        $query = $this->dbPIC->query("select Description FROM tblMstProduct where REPLACE(ProductID,' ','')='$idProduct'"); 
        return $query->row();
    }    
    function insertToEForm($data) {
        $this->dbEForm->insert('tblpenerimaanshelflife', $data);
    }
    function editEForm($filler,$jamsampling,$qty,$idPenerimaan,$waktupengiriman) {
        $this->dbEForm->query("update tblpenerimaanshelflife set filler='$filler',productiontime='$jamsampling',qty=$qty,waktupengiriman='$waktupengiriman' where idpenerimaan='$idPenerimaan'"); 
    }
    function hapusEForm($idPenerimaan) {
        $this->dbEForm->query("delete from tblpenerimaanshelflife where idpenerimaan=$idPenerimaan"); 
    }
    function selectAllEForm() {
        $query = $this->dbEForm->query("select * from tblpenerimaanshelflife_2"); 
        return $query->result();
    }
}
