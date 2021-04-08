<?php
class m_storage extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->dbWTP=$this->load->database('dbWTP', TRUE);
    }

    function getDetailOutputWTP($jenis,$tanggal,$filler) {
        if($jenis=='CWD')
        {
            $query = $this->dbWTP->query("select o.".$jenis."BatchAutoNo as ID,".$jenis."BatchSNo as 'Batch',ProductID, o.QAFormulaID as Formula,WTPFillerNo as Filler, o.CWDBatchNoBuyer as 'BN', (SELECT convert(nvarchar,DATEADD(month, + shelflife, convert(datetime,'$tanggal',105)),105) FROM [P1PIC].[dbo].[tblMstProduct] p where p.ProductID=o.ProductID) as ED,(SELECT convert(nvarchar,DATEADD(month, 3 + shelflife, convert(datetime,'$tanggal',105)),105) FROM [P1PIC].[dbo].[tblMstProduct] p where p.ProductID=o.ProductID) as EDS,(SELECT shelflife FROM [P1PIC].[dbo].[tblMstProduct] p where p.ProductID=o.ProductID) as Month,'$tanggal' as PD
            FROM tbl".$jenis."ProductionOutput o join tbl".$jenis."Production p
            on o.".$jenis."BatchAutoNo=p.".$jenis."BatchAutoNo
            where convert(nvarchar,".$jenis."ProdDate,105)='".$tanggal."' and WTPFillerNo ='$filler' and DiscardedInd =0"); 
        }
        elseif($jenis=='CMD')
        {
            $jenis='CWD';
            $query = $this->dbWTP->query("select o.".$jenis."BatchAutoNo as ID,".$jenis."BatchSNo as 'Batch',ProductID, o.QAFormulaID as Formula,WTPFillerNo as Filler, o.CWDBatchNoBuyer as 'BN', (SELECT convert(nvarchar,DATEADD(month, + shelflife, convert(datetime,'$tanggal',105)),105) FROM [P1PIC].[dbo].[tblMstProduct] p where p.ProductID=o.ProductID) as ED,(SELECT convert(nvarchar,DATEADD(month, 3 + shelflife, convert(datetime,'$tanggal',105)),105) FROM [P1PIC].[dbo].[tblMstProduct] p where p.ProductID=o.ProductID) as EDS,(SELECT shelflife FROM [P1PIC].[dbo].[tblMstProduct] p where p.ProductID=o.ProductID) as Month,'$tanggal' as PD
            FROM tblCMDProductionOutput o join tblCMDProduction p
            on o.".$jenis."BatchAutoNo=p.".$jenis."BatchAutoNo
            where convert(nvarchar,".$jenis."ProdDate,105)='".$tanggal."' and WTPFillerNo ='$filler' and DiscardedInd =0"); 
        }
        else
        {
            $query = $this->dbWTP->query("select o.".$jenis."BatchAutoNo as ID,".$jenis."BatchSNo as 'Batch',ProductID, o.QAFormulaID as Formula,WTPFillerNo as Filler,FormatDetail as FD,(SELECT convert(nvarchar,DATEADD(month, + shelflife, convert(datetime,'$tanggal',105)),105) FROM [P1PIC].[dbo].[tblMstProduct] p where p.ProductID=o.ProductID) as ED,(SELECT convert(nvarchar,DATEADD(month, 3 + shelflife, convert(datetime,'$tanggal',105)),105) FROM [P1PIC].[dbo].[tblMstProduct] p where p.ProductID=o.ProductID) as EDS,(SELECT shelflife FROM [P1PIC].[dbo].[tblMstProduct] p where p.ProductID=o.ProductID) as Month,'$tanggal' as PD FROM tbl".$jenis."ProductionOutput o join tbl".$jenis."Production p
            on o.".$jenis."BatchAutoNo=p.".$jenis."BatchAutoNo
            where convert(nvarchar,".$jenis."ProdDate,105)='".$tanggal."' and WTPFillerNo ='$filler' and DiscardedInd =0"); 
        }
        echo $this->dbWTP->last_query();
        //print_r($query->result());
        return $query->result();
    }
    function updateEDEDS($idtrans,$ed,$eds)
    {
        $this->db->query("update tblTransaksi set Tanggal_Expired ='$ed', Tanggal_Expired_Sampel ='$eds' where Id_Transaksi ='$idtrans'"); 
    }
    function getDaftarPDWTP($jenis) {
        
        if($jenis=='CMD')
        {
            $jenis='CWD';
            $query = $this->dbWTP->query("select convert(nvarchar,".$jenis."ProdDate,105) as 'PD' FROM tblCMDProduction
            where year(".$jenis."ProdDate)=".date("Y")." or year(".$jenis."ProdDate)=".(date("Y")-1)." or year(".$jenis."ProdDate)=".(date("Y")-2)." group by ".$jenis."ProdDate
            order by convert(datetime,".$jenis."ProdDate,105) desc");
        }
        else
        {
            $query = $this->dbWTP->query("select convert(nvarchar,".$jenis."ProdDate,105) as 'PD' FROM tbl".$jenis."Production
            where year(".$jenis."ProdDate)=".date("Y")." or year(".$jenis."ProdDate)=".(date("Y")-1)." or year(".$jenis."ProdDate)=".(date("Y")-2)." group by ".$jenis."ProdDate
            order by convert(datetime,".$jenis."ProdDate,105) desc"); 
        }            
        return $query->result();
    }
    function getDaftarFillerWTP($kategori,$tanggal)
    {
        if($kategori=='CMD')
        {
            $kategori='CWD';
            $query = $this->dbWTP->query("select WTPFillerNo as 'Filler' FROM tblCMDProductionOutput o inner join tblCMDProduction p
            on p.".$kategori."BatchAutoNo=o.".$kategori."BatchAutoNo
            where convert(nvarchar,".$kategori."ProdDate,105) = '$tanggal' and DiscardedInd=0
            group by WTPFillerNo
            "); 
        }
        else
        {
            $query = $this->dbWTP->query("select WTPFillerNo as 'Filler' FROM tbl".$kategori."ProductionOutput o inner join tbl".$kategori."Production p
            on p.".$kategori."BatchAutoNo=o.".$kategori."BatchAutoNo
            where convert(nvarchar,".$kategori."ProdDate,105) = '$tanggal' and DiscardedInd=0
            group by WTPFillerNo
            "); 
        }
        return $query->result();
    }
    function getIDTerakhir($tglterpilih)
    {
        $query = $this->db->query("SELECT isnull(max(convert(int,SUBSTRING(Id_Transaksi,9,LEN(Id_Transaksi)-6))),0)+1 as Id_Transaksi FROM tblTransaksi AS t 
        WHERE (CONVERT(nvarchar, Tanggal_Produksi, 105) = '$tglterpilih') AND (Status = 0)"); 
        return $query->row();
    }
    function getTransaksiKadaluarsa($date)
    {
        $query=$this->db->query("SELECT Id_Transaksi, Kategori, Kode_Filler, convert(nvarchar,Tanggal_Produksi,105) as Tanggal_Produksi, Tanggal_Expired, Tanggal_Expired_Sampel, Tanggal_Simpan, 
        Status, Penyimpan, Kode_Kolom AS 'Kolom',(SELECT DATEDIFF(month, Tanggal_Produksi, convert(datetime,'$date',105)) AS Expr1) AS Umur,BN
        FROM tblTransaksi
        WHERE (CONVERT(nvarchar, Tanggal_Expired_Sampel, 105) = CONVERT(nvarchar, '$date', 105)) AND (Status <> 2 and
        Status <> 3) and isDeleted=0");
        return $query->result();
    }    
    function getTransaksiByID($id)
    {
        $date=date("d-m-Y");
        $query = $this->db->query("Select Id_Transaksi,Kategori,Kode_Filler,
        CONVERT(char,Tanggal_Produksi,105) as 'Tanggal_Produksi',
        CONVERT(char,Tanggal_Expired,105) as 'Tanggal_Expired',
        CONVERT(char,Tanggal_Expired_Sampel,105) as 'Tanggal_Expired_Sample',
        Kode_Kolom,CONVERT(char,Tanggal_Simpan,105) as 'Tanggal_Simpan',
        Penyimpan,Status,isDeleted,BN, (SELECT DATEDIFF(month,Tanggal_Produksi, convert(datetime,'$date',105)) AS Expr1) AS Umur,
        (SELECT DATEDIFF(month, Tanggal_Produksi,Tanggal_Expired)) as 'UmurED' ,
        (SELECT DATEDIFF(month, Tanggal_Produksi,Tanggal_Expired_Sampel)) as 'UmurEDS'
        from tblTransaksi where Id_Transaksi='$id'"); 
        return $query->row();
    }
    function getTransaksiByID2($id)
    {
        $date=date("d-m-Y");
        $query = $this->db->query("Select Id_Transaksi,Kategori,Kode_Filler,
        Tanggal_Produksi,
        Tanggal_Expired,
        Tanggal_Expired_Sampel,
        Kode_Kolom,CONVERT(char,Tanggal_Simpan,105) as 'Tanggal_Simpan',
        Penyimpan,Status,isDeleted,BN, (SELECT DATEDIFF(month,Tanggal_Produksi, convert(datetime,'$date',105)) AS Expr1) AS Umur,
        (SELECT DATEDIFF(month, Tanggal_Produksi,Tanggal_Expired)) as 'UmurED' ,
        (SELECT DATEDIFF(month, Tanggal_Produksi,Tanggal_Expired_Sampel)) as 'UmurEDS'
        from tblTransaksi where Id_Transaksi='$id'"); 
        return $query->row();
    }
    function getTransaksiAll2() {
        $date=date("d-m-Y");
        $query = $this->db->query("SELECT t.Id_Transaksi, Kategori, Kode_Filler, CONVERT(nvarchar, Tanggal_Produksi, 105) AS Tanggal_Produksi, CONVERT(nvarchar, Tanggal_Expired, 105) 
        AS Tanggal_Expired, CONVERT(nvarchar, Tanggal_Expired_Sampel, 105) AS Tanggal_Expired_Sampel, CONVERT(nvarchar, Tanggal_Simpan, 105) as Tanggal_Simpan, Penyimpan, Status, Kode_Kolom AS 'Kolom',
        (SELECT DATEDIFF(month,Tanggal_Produksi, convert(datetime,'$date',105)) AS Expr1) AS Umur, BN,ID_Produk
        FROM tblTransaksi t join tblDetailTransaksi d
        on t.Id_Transaksi=d.ID_Transaksi
        WHERE (Status <> 3) and t.isDeleted=0
        ORDER BY CONVERT(datetime, Tanggal_Produksi) DESC");
        return $query->result();
    }
    function getTransaksiAll() {
        $date=date("d-m-Y");
        $query = $this->db->query("SELECT t.Id_Transaksi, Kategori, Kode_Filler, CONVERT(nvarchar, Tanggal_Produksi, 105) AS Tanggal_Produksi, CONVERT(nvarchar, Tanggal_Expired, 105) 
        AS Tanggal_Expired, CONVERT(nvarchar, Tanggal_Expired_Sampel, 105) AS Tanggal_Expired_Sampel, CONVERT(nvarchar, Tanggal_Simpan, 105) as Tanggal_Simpan, Penyimpan, Status, Kode_Kolom AS 'Kolom',
        (SELECT DATEDIFF(month,Tanggal_Produksi, convert(datetime,'$date',105)) AS Expr1) AS Umur, BN
        FROM tblTransaksi t
        WHERE (Status <> 3) and t.isDeleted=0
        ORDER BY CONVERT(datetime, Tanggal_Simpan) DESC");
        return $query->result();
    }
    function updateTransaksiOutKadaluarsa($id)
    {
        $query = $this->db->query("update tblTransaksi set Status=3 where ID_Transaksi='$id'");
    }
    function getTransaksiHariIni() {
        $date=date("d-m-Y");
        $query = $this->db->query("SELECT Id_Transaksi, Kategori, Kode_Filler, CONVERT(nvarchar, Tanggal_Produksi, 105) AS Tanggal_Produksi, CONVERT(nvarchar, Tanggal_Expired, 105) 
            AS Tanggal_Expired, CONVERT(nvarchar, Tanggal_Expired_Sampel, 105) AS Tanggal_Expired_Sampel, CONVERT(nvarchar, Tanggal_Simpan, 105) as Tanggal_Simpan, Penyimpan, Status, Kode_Kolom AS 'Kolom',
            (SELECT DATEDIFF(month,Tanggal_Produksi, convert(datetime,'$date',105)) AS Expr1) AS Umur, BN
            FROM tblTransaksi WHERE (Status <> 3) and Convert(nvarchar,Tanggal_Simpan,105)='$date' and isDeleted=0
            ORDER BY CONVERT(datetime, Tanggal_Simpan) DESC");
        return $query->result();
    }
    function getDetailTransaksi($Id_Transaksi) {
        $query = $this->db->query("select * from tblDetailTransaksi where Id_Transaksi='$Id_Transaksi' and Habis <> 1
        ORDER BY CONVERT(int, Id_Detail_Transaksi)");
        return $query->result();
    }
    function getUjiHariIni($date) {
        $query = $this->db->query("SELECT t.Id_Transaksi, Kategori, Kode_Filler, Penyimpan,convert(nvarchar,Tanggal_Produksi,105) as Tanggal_Produksi, convert(nvarchar,Tanggal_Expired,105) as Tanggal_Expired,convert(nvarchar,Tanggal_Expired_Sampel,105) as Tanggal_Expired_Sampel, 
        Tanggal_Simpan, Kode_Kolom AS 'Kolom',Status, (SELECT DATEDIFF(month, Tanggal_Produksi, convert(datetime,'$date',105)) AS Expr1)
         AS Umur,BN FROM tblTransaksi AS t
        where (convert(nvarchar, Tanggal_Produksi, 105) =convert(nvarchar,DATEADD(month, - 13, convert(datetime,'$date',105)),105) 
         OR convert(nvarchar, Tanggal_Produksi, 105) = convert(nvarchar,DATEADD(month, - 6, convert(datetime,'$date',105)),105) 
         OR convert(nvarchar, Tanggal_Produksi, 105) = convert(nvarchar,DATEADD(month, - 16, convert(datetime,'$date',105)),105) 
         OR convert(nvarchar, Tanggal_Produksi, 105) = convert(nvarchar,DATEADD(month, - 12, convert(datetime,'$date',105)),105) 
         OR convert(nvarchar, Tanggal_Produksi, 105) = convert(nvarchar,DATEADD(month, - 15, convert(datetime,'$date',105)),105) 
         OR convert(nvarchar, Tanggal_Produksi, 105) = convert(nvarchar,DATEADD(month, - 18, convert(datetime,'$date',105)),105) 
         OR convert(nvarchar, Tanggal_Produksi, 105) = convert(nvarchar,DATEADD(month, - 21, convert(datetime,'$date',105)),105)
         AND (Status <> 3) AND (convert(nvarchar, Tanggal_Expired_Sampel, 105) <> convert(nvarchar,'$date', 105))) and t.Id_Transaksi not in (select Id_Transaksi from tblHistoriUji where convert(nvarchar,Tanggal_Uji,105)=convert(nvarchar,'$date',105)) and t.isDeleted=0");
        return $query->result();
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
    function getDetailPernahDisimpan($BatchWTPNo,$BatchWTPNoDetail)
    {
        $query = $this->db->query("SELECT * FROM  tblDetailTransaksi
        where BatchWTPNo= $BatchWTPNo and BatchWTPNoDetail=$BatchWTPNoDetail");
        return $query->result();        
    }
    function getDetailByBatch($jenis,$batchNo,$batchDetailNo)
    {
        $query;echo $jenis." ".$batchNo." ".$batchDetailNo;
        if($jenis=='CWD')
        {
            $query = $this->dbWTP->query("select o.".$jenis."BatchAutoNo as ID,".$jenis."BatchSNo as 'Batch',ProductID, o.QAFormulaID as Formula,WTPFillerNo as Filler 
            FROM tbl".$jenis."ProductionOutput o join tbl".$jenis."Production p
            on o.".$jenis."BatchAutoNo=p.".$jenis."BatchAutoNo
            where o.CCUBatchAutoNo=$batchNo and CCUBatchSNo=$batchDetailNo and DiscardedInd =0"); 
        }
        else
        {
            $query = $this->dbWTP->query("select o.".$jenis."BatchAutoNo as ID,".$jenis."BatchSNo as 'Batch',ProductID, o.QAFormulaID as Formula,WTPFillerNo as Filler,FormatDetail as FD FROM tbl".$jenis."ProductionOutput o join tbl".$jenis."Production p
            on o.".$jenis."BatchAutoNo=p.".$jenis."BatchAutoNo
            where o.CCUBatchAutoNo=$batchNo and CCUBatchSNo=$batchDetailNo and DiscardedInd =0"); 
        }
        return $query->result();
    }
    function insertTransaksi($data)
    {
        $this->db->insert('tblTransaksi', $data); 
    } 
    function insertHistoriUji($data)
    {
        $this->db->insert('tblHistoriUji', $data); 
    } 
    function getIdDetailTransaksi()
    {
        $query = $this->db->query("SELECT max(CONVERT(int,Id_Detail_Transaksi)) as Id_Detail_Transaksi FROM tblDetailTransaksi");
        return $query->row()->Id_Detail_Transaksi;
    }
    function insertDetailTransaksi($data)
    {
        $this->db->insert('tblDetailTransaksi', $data); 
    }
    function deleteTransaksi($idTransaksi)
    {
        $this->db->query("delete tblTransaksi
        where ID_Transaksi ='$idTransaksi'");
    }
    function deleteDetailTransaksi($idTransaksi)
    {
        $this->db->query("delete tblDetailTransaksi
        where ID_Transaksi ='$idTransaksi'");
    }
    function updateTransaksiIsDeleted($idTransaksi,$nik)
    {
        $this->db->query("update tblTransaksi set isDeleted=1,deletedBy='$nik' where ID_Transaksi ='$idTransaksi'");
    }
    function updateTransaksi($idTransaksi,$kolom,$ed,$eds)
    {
        $this->db->query("update tblTransaksi set Kode_Kolom='$kolom', Tanggal_Expired=(select DATEADD(month, $ed, (select Tanggal_Produksi from tblTransaksi where Id_Transaksi='$idTransaksi'))),Tanggal_Expired_Sampel=(select DATEADD(month, $eds, (select Tanggal_Produksi from tblTransaksi where Id_Transaksi='$idTransaksi')))
        where ID_Transaksi ='$idTransaksi'");
    }
    function getDetailTransaksiByProductIDFormula()
    {
        $query =$this->db->query("select ID_Produk,ID_Formula FROM tblDetailTransaksi
        group by ID_Produk,ID_Formula
        order by ID_Produk");
        return $query->result();
    }
    function getIDHistoriKeluar()
    {
        // $query =$this->db->query("select top 1 Id_Pengeluaran from tblHistoriKeluar order by convert(int,Id_Pengeluaran) desc");
        $query =$this->db->query("select isnull((select top 1 Id_Pengeluaran from tblHistoriKeluar order by convert(int,Id_Pengeluaran) desc),0) as Id_Pengeluaran");
        $idHistoriKeluar= $query->row();
        $Id_Pengeluaran=$idHistoriKeluar->Id_Pengeluaran;
        return $Id_Pengeluaran;
    }
    function insertHistoriKeluar($data)
    {
        $this->db->insert('tblHistoriKeluar', $data); 
    }
    function updateDetailHabis($idTrans,$idDetailTrans,$petugas)
    {
        $waktu=date('Y-m-d H:i:s');
        $query =$this->db->query("update tblDetailTransaksi set Habis=1, HabisAt='$waktu',HabisBy='$petugas' where Id_Transaksi='$idTrans' and Id_Detail_Transaksi='$idDetailTrans'");
    }
    function cekDetailHabis($idtransaksi)
    {
        $query =$this->db->query("select * from tblDetailTransaksi where Id_Transaksi='$idtransaksi' and Habis=1");
        return $query->result();
    }
    function getDetailBelumHabis($idtransaksi)
    {
        $query =$this->db->query("select * from tblDetailTransaksi where Id_Transaksi='$idtransaksi' and Habis<>1");
        return $query->result();
    }
    function getTransaksiBelumHabis($idtransaksi)
    {
        $query =$this->db->query("select * from tblDetailTransaksi d join tblTransaksi t on t.Id_Transaksi=d.Id_Transaksi where t.Id_Transaksi='$idtransaksi' and Habis<>1");
        return $query->result();
    }
    function getHistoriKeluarTransaksi($tgl)
    {
        $query =$this->db->query("SELECT Id_Transaksi, Kategori, Kode_Filler, CONVERT(nvarchar, Tanggal_Produksi, 105) AS Tanggal_Produksi, CONVERT(nvarchar, Tanggal_Expired, 105) 
            AS Tanggal_Expired, CONVERT(nvarchar, Tanggal_Expired_Sampel, 105) AS Tanggal_Expired_Sampel, CONVERT(nvarchar, Tanggal_Simpan, 105) as Tanggal_Simpan, Penyimpan, Status, Kode_Kolom AS 'Kolom',
            (SELECT DATEDIFF(month,Tanggal_Produksi, convert(datetime,'$tgl',105)) AS Expr1) AS Umur, BN
            FROM tblTransaksi WHERE (Status <> 3) and Id_Transaksi in (select k.Id_Transaksi FROM tblHistoriKeluar k
            left outer join tblDetailTransaksi d on d.Id_Detail_Transaksi=k.Id_Detail_Transaksi where convert(nvarchar,k.Waktu_Pengeluaran,105)='$tgl'
            group by k.Id_Transaksi)
            ORDER BY CONVERT(datetime, Tanggal_Simpan) DESC");
        return $query->result();
    }
    function getHistoriKeluarTransaksiAll()
    {
        $date=date("d-m-Y");
        $query =$this->db->query("SELECT Id_Transaksi, Kategori, Kode_Filler, CONVERT(nvarchar, Tanggal_Produksi, 105) AS Tanggal_Produksi, CONVERT(nvarchar, Tanggal_Expired, 105) 
            AS Tanggal_Expired, CONVERT(nvarchar, Tanggal_Expired_Sampel, 105) AS Tanggal_Expired_Sampel, CONVERT(nvarchar, Tanggal_Simpan, 105) as Tanggal_Simpan, Penyimpan, Status, Kode_Kolom AS 'Kolom',
            (SELECT DATEDIFF(month,Tanggal_Produksi, convert(datetime,'$date',105)) AS Expr1) AS Umur, BN
            FROM tblTransaksi WHERE (Status <> 3) and Id_Transaksi in (select k.Id_Transaksi FROM tblHistoriKeluar k
            left outer join tblDetailTransaksi d on d.Id_Detail_Transaksi=k.Id_Detail_Transaksi
            group by k.Id_Transaksi)
            ORDER BY CONVERT(datetime, Tanggal_Simpan) DESC");
        return $query->result();
    }
    function getHistoriUjiTransaksi($tgl)
    {
        $query =$this->db->query("SELECT t.Id_Transaksi, Kategori, Kode_Filler, CONVERT(nvarchar, Tanggal_Produksi, 105) AS Tanggal_Produksi, CONVERT(nvarchar, Tanggal_Expired, 105) 
        AS Tanggal_Expired, CONVERT(nvarchar, Tanggal_Expired_Sampel, 105) AS Tanggal_Expired_Sampel, CONVERT(nvarchar, Tanggal_Simpan, 105) as Tanggal_Simpan, Penyimpan, Status, Kode_Kolom AS 'Kolom',
        (SELECT DATEDIFF(month,Tanggal_Produksi, convert(datetime,'$tgl',105)) AS Expr1) AS Umur, BN
        FROM tblTransaksi t join tblHistoriUji u on t.Id_Transaksi=u.Id_Transaksi
        WHERE (Status <> 3) and convert(nvarchar,u.Tanggal_Uji,105)='$tgl'
        ORDER BY CONVERT(datetime, Tanggal_Simpan) DESC");
        return $query->result();
    }
    function getHistoriUjiTransaksiAll()
    {
        $date=date("d-m-Y");
        $query =$this->db->query("SELECT t.Id_Transaksi, Kategori, Kode_Filler, CONVERT(nvarchar, Tanggal_Produksi, 105) AS Tanggal_Produksi, CONVERT(nvarchar, Tanggal_Expired, 105) 
        AS Tanggal_Expired, CONVERT(nvarchar, Tanggal_Expired_Sampel, 105) AS Tanggal_Expired_Sampel, CONVERT(nvarchar, Tanggal_Simpan, 105) as Tanggal_Simpan, Penyimpan, Status, Kode_Kolom AS 'Kolom',
        (SELECT DATEDIFF(month,Tanggal_Produksi, convert(datetime,'$date',105)) AS Expr1) AS Umur, BN
        FROM tblTransaksi t join tblHistoriUji u on t.Id_Transaksi=u.Id_Transaksi
        WHERE (Status <> 3)
        ORDER BY CONVERT(datetime, Tanggal_Simpan) DESC");
        return $query->result();
    }
    function getDetailHistoriKeluarGroupByIDTransaksi($idtrans)
    {
        $query =$this->db->query("select k.Id_Transaksi,k.Id_Detail_Transaksi,k.Komentar,k.Pengeluar,ID_Produk,ID_Formula,convert(nvarchar,k.Waktu_Pengeluaran,105) as Waktu_Pengeluaran,BatchWTPNo,BatchWTPNoDetail,Habis,HabisAt,HabisBy
        FROM tblHistoriKeluar k join tblDetailTransaksi d
        on k.Id_Detail_Transaksi=d.Id_Detail_Transaksi
        where k.Id_Transaksi = '$idtrans'
        order by Waktu_Pengeluaran desc");
        return $query->result();
    }
    function getDetailHistoriUjiGroupByIDTransaksi($idtrans)
    {
        $query =$this->db->query("SELECT u.Id_Transaksi,CONVERT(nvarchar,Tanggal_Uji,105) as Tanggal_Uji, Operator, Umur, ID_Produk,ID_Formula
        FROM tblHistoriUji u join tblDetailTransaksi d on u.Id_Transaksi=d.ID_Transaksi
        where u.Id_Transaksi='$idtrans'");
                return $query->result();
    }
    function getHistoriUji()
    {
        $date=date("d-m-Y");
        $query =$this->db->query("SELECT t.Id_Transaksi, Kategori, Kode_Filler, CONVERT(nvarchar, Tanggal_Produksi, 105) AS Tanggal_Produksi, CONVERT(nvarchar, Tanggal_Expired, 105) 
        AS Tanggal_Expired, CONVERT(nvarchar, Tanggal_Expired_Sampel, 105) AS Tanggal_Expired_Sampel, CONVERT(nvarchar, Tanggal_Simpan, 105) as Tanggal_Simpan, Penyimpan, Status, Kode_Kolom AS 'Kolom',
        (SELECT DATEDIFF(month,Tanggal_Produksi, convert(datetime,'$date',105)) AS Expr1) AS Umur, BN
        FROM tblTransaksi t join tblHistoriUji u on u.Id_Transaksi=t.Id_Transaksi order by t.Tanggal_Simpan desc");
        return $query->result();
    }
    function getJumlahTransaksi()
    {
        $query =$this->db->query("SELECT count(Id_Transaksi) as 'JumlahTransaksi' from tblTransaksi where isDeleted=0");
        return $query->row();
    }
}
