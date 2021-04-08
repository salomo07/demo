<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Storage extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->session->userdata('dataUser')) {
            redirect('Login');
        }
        $this->load->model('m_storage');
        date_default_timezone_set("Asia/Jakarta");
    }
    public function index() {
        $data['dataMenu']=$this->session->userdata('dataMenu');
        $data['dataSidebar']=$this->session->userdata('dataSidebar');
		$this->load->view('storage/storage',$data);
    }
    function generateIDPenyimpanan($tgl)
    {
        $Id="";
        $arrayIDPenyimpanan=$this->m_storage->getIDTerakhir($tgl);
        echo "ID:".$arrayIDPenyimpanan->Id_Transaksi;
        if(count($arrayIDPenyimpanan)>0)
        {
            $Id=str_replace('-', '', $tgl).((int)($arrayIDPenyimpanan->Id_Transaksi))."";
        }
        else
        {
           $Id=str_replace('-', '', $tgl)."1";
        }
        return $Id;
    }
    function getDaftarPDWTP()
    {
        $data['daftarPDWTP'] = $this->m_storage->getDaftarPDWTP($_GET['kategori']);
        $html="<option value=''></option>";
        foreach ($data['daftarPDWTP'] as $key => $pd)
        {
            $html=$html."<option value='".$pd->PD."'>".$pd->PD."</option>";
        }
        echo $html.'</select>';
    }
    function getDaftarFillerWTP()
    {
        $data['daftarFillerWTP'] = $this->m_storage->getDaftarFillerWTP($_GET['kategori'],$_GET['tanggal']);
        $html="<option value=''></option>";
        foreach ($data['daftarFillerWTP'] as $key => $pd)
        {
            $html=$html."<option value='".$pd->Filler."'>".$pd->Filler."</option>";
        }
        echo $html.'</select>';
    }
    function getDetailOutputWTP()
    {
        $data['detailOutputWTP'] = $this->m_storage->getDetailOutputWTP($_GET['kategori'],$_GET['tanggal'],$_GET['filler']);
        //print_r($data['detailOutputWTP']);
        $this->load->view('storage/datatables',$data);
    }
    function cekSudahHabis()
    {
        $idTrans=$this->input->post('idTrans');
        $hasil=$this->m_storage->cekSudahHabis($idTrans);
        if(count($hasil)>0){echo "sudah diuji";}
    }
    function cekSudahPernahDisimpan()
    {
        $batchID=$this->input->post('batchID');
        $batchDetail=$this->input->post('batchDetail');
        $hasil=$this->m_storage->getDetailPernahDisimpan($batchID,$batchDetail);
        if(count($hasil)>0)
        {
            echo json_encode($hasil);
        }else{echo "BelumTersimpan";}
    }
    function getTransaksiHariIni()
    {
        $data['transaksiHariIni'] = $this->m_storage->getTransaksiHariIni();
        $this->load->view('home/datatablesTransaksiHariIni',$data);
    }
    function getDetailTransaksi()
    {
        $idTransaksi=$this->input->post('idTrans');
        $data['detailTransksi']=$this->m_storage->getDetailTransaksi($idTransaksi);//print_r($data['detailTransksi']);
        if(isset($_GET['modal'])==1){$this->load->view('template/modalDetail',$data);}
        elseif(isset($_GET['check'])==1){$this->load->view('template/tableDetail2',$data);}
        else
        {
            $this->load->view('template/tableDetail',$data);
        }
    }
    function loadDetailModalOut()
    {
        $objDetailTransksi=$this->input->post('chk');
        $data['titleModal']='Detail Transaksi Sampel Keluar';
        $data['detailTransksi']=$objDetailTransksi;
        $this->load->view('template/modalDetailOut',$data);
    }
    function saveHistoriKeluar()
    {
        $objDetailTransksi=$this->input->post('chk');
        $txtRemark=$this->input->post('txtRemark');
        $dataUser=$this->session->userdata('dataUser');
        $tglAntar=$this->input->post('tglAntar');
        $chkHabis=$this->input->post('chkHabis');
        $tglAntar=substr($tglAntar,6,4).'-'.substr($tglAntar,3,2).'-'.substr($tglAntar,0,2);
        foreach ($objDetailTransksi as $key => $value)
        {
            $idPengeluaran=0;
            if($this->m_storage->getIDHistoriKeluar()==''){$idPengeluaran=1;}
            else
            {
                $idPengeluaran=$this->m_storage->getIDHistoriKeluar()+1;
            }
            $arayHistorykeluar=array('Id_Pengeluaran' => $idPengeluaran,'Id_Transaksi'=>$value['IDTrans'],'Id_Detail_Transaksi'=>$value['ID'],'Qty'=>$value['QtySampling'],'Waktu_Pengeluaran'=>date('Y-m-d H:i:s'),'Komentar'=>$txtRemark,'Pengeluar'=>$dataUser['Nik']);
            $this->m_storage->insertHistoriKeluar($arayHistorykeluar);
            if($value['Habis']=='true')
            {
                $this->m_storage->updateDetailHabis($value['IDTrans'], $value['ID'],$dataUser['Nik']);
            }
            if(strpos(strtoupper($txtRemark), 'LAB')!==false)//Jika ada tulisan uji, maka detail ini masuk kedalam EForm
            {
                $tglAntar=$this->input->post('tglAntar');
                $tglAntar=substr($tglAntar,6,4).'-'.substr($tglAntar,3,2).'-'.substr($tglAntar,0,2);
                $this->load->model('m_lab');
                $dataTransaksi=$this->m_storage->getTransaksiByID($value['IDTrans']);
                $pd=str_replace(" ","",substr($dataTransaksi->Tanggal_Produksi,6)).'-'.substr($dataTransaksi->Tanggal_Produksi,3,2).'-'.substr($dataTransaksi->Tanggal_Produksi,0,2);
                $ed=str_replace(" ","",substr($dataTransaksi->Tanggal_Expired,6)).'-'.substr($dataTransaksi->Tanggal_Expired,3,2).'-'.substr($dataTransaksi->Tanggal_Expired,0,2);
                $filler=$this->m_lab->getMasterFillerLab($dataTransaksi->Kode_Filler)->NamaFillerLab;
                $alias=$this->m_lab->getAliasSample($value['IDProduct'])->Description;
                $tglpeng=substr($tanggal, 6)."-".substr($tanggal, 3,2)."-".substr($tanggal, 0,2);
                $dataInsertToEForm=array('idtransaksi' =>$value['IDTrans'],'iddetail'=>$value['ID'],'idproduct'=>$value['IDProduct'],'namaproduk'=>$alias,'idformula'=>$value['IDFormula'],'productiondate'=>$pd,'productiontime'=>$value['JamSampling'],'filler'=>$filler,'qty'=>$value['QtySampling'],'bn'=>$dataTransaksi->BN,'jenisproduk'=>str_replace(' ', '', $dataTransaksi->Kategori),'jenissampel'=>'Uji','month'=>$dataTransaksi->Umur,'pengirim'=>$dataUser['Username'],'tglpengiriman'=>$tglAntar,'waktupengiriman'=>date('H:i'),'penerima'=>'','tglpenerimaan'=>$tglAntar,'waktupnerimaan'=>'','expiredate'=>$ed);
                $this->m_lab->insertToEForm($dataInsertToEForm);
            }
        }
    }
    function saveSample()
    {
        $txtKodeKolom=$this->input->post('txtKodeKolom');
        $arrayOfObject=$this->input->post('arrayOfObject');
        $chk=$this->input->post('chk');
        $jenis=addslashes($this->input->post('selectCat'));
        $tanggal=addslashes($this->input->post('selectPD'));
        $filler=addslashes($this->input->post('selectFiller'));
        // $rbED=addslashes($this->input->post('rbED'));
        // $rbEDS=addslashes($this->input->post('rbEDS'));
        $pd=substr($tanggal, 6)."-".substr($tanggal, 3,2)."-".substr($tanggal, 0,2);
        // $pd=strtotime($pd);
        // $ed=date('Y-m-d',strtotime('+'.$rbED.' months',$pd));
        // $eds=date('Y-m-d',strtotime('+'.$rbEDS.' months',$pd));
        // $pd=date('Y-m-d',$pd);
        {
            $BN=$arrayOfObject[0]['BN'];
            $idTransaksi=$this->generateIDPenyimpanan($tanggal);
            $dataUser=$this->session->userdata('dataUser');
            $data=array('Id_Transaksi' => $idTransaksi,'Kategori'=>$jenis,'Kode_Filler'=>$filler,'Tanggal_Produksi'=>$pd,'Tanggal_Expired'=>$ed,'Tanggal_Expired_Sampel'=>$eds,'Kode_Kolom'=>$txtKodeKolom,'Tanggal_Simpan'=>date('Y-m-d H:i:s'),'Penyimpan'=>$dataUser['Nik'],'Status'=>0,'isDeleted'=>0,'BN'=>$BN);
            // echo $idTransaksi."\n";
            // echo $tanggal."\n";
            $this->m_storage->insertTransaksi($data);
            foreach ($arrayOfObject as $key => $value)
            {

                $id=(int)$this->m_storage->getIdDetailTransaksi()+1;
                $dataDetailTransaksi=array("Id_Detail_Transaksi"=>$id,"ID_Transaksi"=>$idTransaksi,"ID_Produk"=>$value['IdProduct'],"ID_Formula"=>$value['IdFormula'],"BatchWTPNo"=>$value['ID'],"BatchWTPNoDetail"=>$value['Batch'],"Habis"=>0,"HabisAt"=>null,"Keterangan"=>$value['Keterangan']);
                $this->m_storage->insertDetailTransaksi($dataDetailTransaksi);

                $ed=substr($value['ED'], 6)."-".substr($value['ED'], 3,2)."-".substr($value['ED'], 0,2);
                $eds=substr($value['EDS'], 6)."-".substr($value['EDS'], 3,2)."-".substr($value['EDS'], 0,2);
                $this->m_storage->updateEDEDS($idTransaksi,$ed,$eds);
            }
        }
    }

    function deleteTransaksi()
    {
        $idTransaksi=$this->input->post('idTrans');
        //echo $idTransaksi;
        $this->m_storage->deleteDetailTransaksi($idTransaksi);
        $this->m_storage->deleteTransaksi($idTransaksi);

        $data['arrayTransaksiData']=$this->m_storage->getTransaksiAll();
        $this->load->view('template/datatablesTransaksiAll',$data);
    }
    function cekDetailHabis()
    {
        $idtransaksi=$this->input->post('idtransaksi');
        $habis=$this->m_storage->cekDetailHabis($idtransaksi);
        echo json_encode($habis);
    }
    function getJumlahTransaksi()
    {
        $jumlah=$this->m_storage->getJumlahTransaksi();
        echo $jumlah->JumlahTransaksi;
    }
}
