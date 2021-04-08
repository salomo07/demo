<?php

class m_master extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->dbMIS=$this->load->database('dbMIS', TRUE);
    }
    function getKolomExist($kolom) {
        $query = $this->db->query("select * from tblMstLocator
        where Kode_Kolom=Upper('$kolom')"); 
        return $query->row();
    }
    function insertLocator($kolom,$lama) {
        $this->db->query("insert into tblMstLocator (Kode_Kolom,Masa_Simpan) values ('$kolom',$lama)"); 
    }
    function getTransaksiLocator($kolom) {
        $query=$this->db->query("select * from tblMstLocator where Kode_Kolom='$kolom'"); 
        return $query->row();
    }
    function updateLocator($kolomlama,$kolom,$lama) {
        $test=trim(preg_replace('/\s\s+/', ' ', $kolomlama));
        $this->db->query("update tblMstLocator set Kode_Kolom='$kolom', Masa_Simpan=$lama where Kode_Kolom= '".$test."'");
    }
    function deleteLocator($kolom) {
        $query=$this->db->query("delete tblMstLocator where Kode_Kolom='$kolom'"); 
    }
    function getLocatorAll()
    {
        $query = $this->db->query("SELECT l.Kode_Kolom, Masa_Simpan,(select COUNT(Id_transaksi) from tblTransaksi where Kode_Kolom=l.Kode_Kolom and isDeleted=0) as 'TransaksiTersimpan' from tblMstLocator l ORDER BY Kode_Kolom");
        return $query->result();
    }
    function getUser()
    {
        $query = $this->db->query("select Nik,Username,Pass,r.Role from tblUser u join tblRole r on r.Idrole=u.Role
        ORDER BY Nik");
        return $query->result();
    }
    function getUserExist($nik)
    {
        $query = $this->db->query("select * from tblUser where Nik=$nik");
        return $query->row();
    }
    function deleteUser($nik)
    {
        $query = $this->db->query("delete tblUser where Nik=$nik");
    }
    function editUser($nik,$full,$role)
    {
        $query = $this->db->query("update tblUser set Username='$full',Role=(Select Idrole from tblRole where Role='$role') where Nik=$nik");
    }
    function insertUser($nik,$full,$role)
    {
        $passDefault=base64_encode(1234);
        $query = $this->db->query("insert into tblUser (Nik,Username,Pass,Role) values ($nik,'$full','$passDefault',(select IDRole from tblRole where Role='$role'))");
    }
    function getUjiLab() 
    {
        $date=date("d-m-Y");
        $query = $this->db->query("SELECT t.Id_Transaksi, Kategori, Kode_Filler, CONVERT(varchar, Tanggal_Produksi, 105) AS Tanggal_Produksi, CONVERT(varchar, Tanggal_Expired, 105) 
            AS Tanggal_Expired, CONVERT(varchar, Tanggal_Expired_Sampel, 105) AS Tanggal_Expired_Sampel, Tanggal_Simpan, Penyimpan, Status, Kode_Kolom AS 'Kolom',
            (SELECT DATEDIFF(month, t.Tanggal_Produksi, CONVERT(datetime,'$date',105)) AS Expr1) AS Umur, BN, d.ID_Formula as 'Formula'
            FROM tblTransaksi t join tblDetailTransaksi d on t.Id_Transaksi=d.ID_Transaksi join tblHistoriLab l on l.IdTransaksi=t.Id_Transaksi
            where l.Received=0");
        return $query->result();
    }
    function getJumlahLocator()
    {
        $query = $this->db->query("select count(Kode_Kolom) as 'JumlahLocator' from tblMstLocator");
        return $query->row();
    }
    function updatePasswordUser($nik,$newpass)
    {
        $this->db->query("update tblUser set Pass='$newpass' where Nik='$nik'");
    }
}
