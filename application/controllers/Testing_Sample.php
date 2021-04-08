<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Testing_Sample extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->session->userdata('dataUser')) {
            redirect('Login');
        }
        $this->load->model('m_storage');
    }
    function index() 
    {
        $data['dataSidebar']=$this->session->userdata('dataSidebar');
        $data['dataMenu']=$this->session->userdata('dataMenu');
		$this->load->view('testingsample/testingsample',$data);
        $this->load->model('m_lab');
        //$this->m_lab->selectAllIDProductNull();
    }
    function getUjiHariIni()
    {
        $tgl=$this->input->post('tgl');
        $tgl=str_replace("/","-",$tgl);
        $data['ujiHariIni']=$this->m_storage->getUjiHariIni($tgl); //print_r($data['ujiHariIni']);
        $this->load->view('testingsample/datatablesUjiHariIni',$data);
    }
    function getJumlahUjiHariIni()
    {
        $date=date("d-m-Y");
        $data['ujiHariIni']=$this->m_storage->getUjiHariIni($date);
        echo count($data['ujiHariIni']);
    }
    function sendTransaksiUji()
    {
        $this->load->model('m_lab');

        $arrayOfObject=$this->input->post('arrayOfObject');
        $dataUser=$this->session->userdata('dataUser'); 

        foreach ($arrayOfObject as $key => $value) 
        {
            $tglAntar=$this->input->post('tglAntar');
            $tglAntar=substr($tglAntar,6,4).'-'.substr($tglAntar,3,2).'-'.substr($tglAntar,0,2);
            $dataTransaksi=$this->m_storage->getTransaksiByID($value['IDTrans']);
            $pd=str_replace(" ","",substr($dataTransaksi->Tanggal_Produksi,6)).'-'.substr($dataTransaksi->Tanggal_Produksi,3,2).'-'.substr($dataTransaksi->Tanggal_Produksi,0,2);
            $filler=$this->m_lab->getMasterFillerLab($dataTransaksi->Kode_Filler)->NamaFillerLab;
            $alias=$this->m_lab->getAliasSample($value['IDProduct'])->Description;
            $dataHistoriUji=array('Id_Transaksi' =>$value['IDTrans'],'IdDetail'=>$value['ID'],'Tanggal_Uji'=>date('Y-m-d H:i:s'),'Operator'=>$dataUser['Nik'],'Umur'=>$dataTransaksi->Umur,'Qty'=>$value['QtySampling'],'JamSampling'=>$value['JamSampling']);
            $this->m_storage->insertHistoriUji($dataHistoriUji);    
            $ed=str_replace(" ","",substr($dataTransaksi->Tanggal_Expired,6)).'-'.substr($dataTransaksi->Tanggal_Expired,3,2).'-'.substr($dataTransaksi->Tanggal_Expired,0,2);        
            $dataInsertToEForm=array('idtransaksi' =>$value['IDTrans'],'iddetail'=>$value['ID'],'idproduct'=>$value['IDProduct'],'namaproduk'=>$alias,'idformula'=>$value['IDFormula'],'productiondate'=>$pd,'productiontime'=>$value['JamSampling'],'filler'=>$filler,'qty'=>$value['QtySampling'],'bn'=>$dataTransaksi->BN,'jenisproduk'=>str_replace(' ', '', $dataTransaksi->Kategori),'jenissampel'=>'Uji','month'=>$dataTransaksi->Umur,'pengirim'=>$dataUser['Username'],'tglpengiriman'=>$tglAntar,'waktupengiriman'=>date('H:i'),'penerima'=>'','tglpenerimaan'=>$tglAntar,'waktupnerimaan'=>'','expiredate'=>$ed);
            $this->m_lab->insertToEForm($dataInsertToEForm);
        }
    }
    
}
