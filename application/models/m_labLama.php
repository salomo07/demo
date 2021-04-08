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
    function editEForm($filler,$jamsampling,$qty,$idPenerimaan) {
        $this->dbEForm->query("update tblpenerimaanshelflife set filler='$filler',productiontime='$jamsampling',qty=$qty where idpenerimaan='$idPenerimaan'"); 
    }
    function hapusEForm($idPenerimaan) {
        $this->dbEForm->query("delete tblpenerimaanshelflife where idpenerimaan='$idPenerimaan'"); 
    }
    function selectAllEForm() {
        $query = $this->dbEForm->query("select * from tblpenerimaanshelflife"); 
        return $query->result();
    }
    function updateIDProductEform($idproduk,$idtransaksi,$iddetail)
    {
        $this->dbEForm->query("update tblpenerimaanshelflife set idproduct='$idproduk' where idtransaksi='$idtransaksi' and iddetail='$iddetail'"); 
    }
    function getDetailTransaksi($idtransaksi,$iddetail)
    {
        $query = $this->db->query("select ID_Produk from tblDetailTransaksi where ID_Transaksi='$idtransaksi' and Id_Detail_Transaksi='$iddetail'"); 
        return $query->row();
    }
    function selectAllIDProductNull()
    {
        $query = $this->dbEForm->query("select * from tblpenerimaanshelflife where idProduct =''");
        if(count($query->result())>0)
        {
            foreach ($query->result() as $key => $value) 
            {
                $detail=$this->getDetailTransaksi($value->idtransaksi,$value->iddetail);//print_r($detail->ID_Produk);
                if(count($detail)>0)
                {                    
                    $this->updateIDProductEform($detail->ID_Produk,$value->idtransaksi,$value->iddetail);
                }
                // $this->updateIDProductEform($idproduct,$value->idtransaksi,$value->iddetail);
                // echo "$value->idtransaksi  $value->iddetail\n";
            }
        }
    }
}
