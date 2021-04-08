<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Out_Storage extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->session->userdata('dataUser')) {
            redirect('Login');
        }
        $this->load->model('m_storage');
        date_default_timezone_set("Asia/Jakarta"); 
    }
    function index() {
        $data['dataSidebar']=$this->session->userdata('dataSidebar');
        $data['dataMenu']=$this->session->userdata('dataMenu');        
		$this->load->view('outstorage/outstorage',$data);
    }
    function getExpired()
    {
        $date=$this->input->post('date');
        $data['kadaluarsaHariIni']=$this->m_storage->getTransaksiKadaluarsa($date);  
        $this->load->view('outstorage/datatablesOutHariIni',$data);      
    }
    function getJumlahKadaluarsa() {
        $data['kadaluarsaHariIni']=$this->m_storage->getTransaksiKadaluarsa(date("d-m-Y"));
        echo count($data['kadaluarsaHariIni']);
    }
    function updateTransaksiOutKadaluarsa() {
        $this->load->model('m_lab');
        $detail=$this->input->post('detail');
        $tglAntar=$this->input->post('tglAntar');
        $tglAntar=substr($tglAntar,6,4).'-'.substr($tglAntar,3,2).'-'.substr($tglAntar,0,2);
        $dataUser=$this->session->userdata('dataUser');
        foreach ($detail as $key => $value) 
        {
            $dataTransaksi=$this->m_storage->getTransaksiByID($value['IDTrans']);
            $pd=str_replace(" ","",substr($dataTransaksi->Tanggal_Produksi,6)).'-'.substr($dataTransaksi->Tanggal_Produksi,3,2).'-'.substr($dataTransaksi->Tanggal_Produksi,0,2);
            $ed=str_replace(" ","",substr($dataTransaksi->Tanggal_Expired,6)).'-'.substr($dataTransaksi->Tanggal_Expired,3,2).'-'.substr($dataTransaksi->Tanggal_Expired,0,2);
            $filler=$this->m_lab->getMasterFillerLab($dataTransaksi->Kode_Filler)->NamaFillerLab;
            $alias=$this->m_lab->getAliasSample($value['IDProduk'])->Description;
            if($value['JamSampling']!='')
            {
                $dataInsertToEForm=array('idtransaksi' =>$value['IDTrans'],'iddetail'=>$value['ID'],'idproduct'=>$value['IDProduk'],'namaproduk'=>$alias,'idformula'=>$value['IDFormula'],'productiondate'=>$pd,'productiontime'=>$value['JamSampling'],'filler'=>$filler,'qty'=>$value['QtySampling'],'bn'=>$dataTransaksi->BN,'jenisproduk'=>str_replace(' ', '', $dataTransaksi->Kategori),'jenissampel'=>'Uji','month'=>$dataTransaksi->Umur,'pengirim'=>$dataUser['Username'],'tglpengiriman'=>$tglAntar,'waktupengiriman'=>date('H:i'),'penerima'=>'','tglpenerimaan'=>$tglAntar,'waktupnerimaan'=>'','expiredate'=>$ed);
                $this->m_lab->insertToEForm($dataInsertToEForm);
            }
        }        
        $this->m_storage->updateTransaksiOutKadaluarsa($value['IDTrans']);
    }
}
