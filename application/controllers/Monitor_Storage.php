<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Monitor_Storage extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->session->userdata('dataUser')) {
            redirect('Login');
        }
        $this->load->model('m_storage');
        $this->load->model('m_master');
    }
    public function index() {
        $data['dataSidebar']=$this->session->userdata('dataSidebar');
        $data['dataMenu']=$this->session->userdata('dataMenu');
        //$data['arrayTransaksiData']=$this->m_storage->getTransaksiAll();
		$this->load->view('monitor/monitorstorage',$data);
    }
    function getDetailTransaksi()
    {
        $idTransaksi=$this->input->post('idTrans');
        $data['detailTransksi']=$this->m_storage->getDetailTransaksi($idTransaksi);
        if(isset($_GET['modal'])==1){$this->load->view('template/modaldetailtransaksi',$data);}
        else
        {
            $this->load->view('monitor/tableDetail',$data);
        }
    }
    function getTransaksiByID()
    {
        $idTransaksi=$this->input->post('idTrans');
        $data['transaksiByID'] = $this->m_storage->getTransaksiByID($idTransaksi);
        $data['daftarLocator']=$this->m_master->getLocatorAll();
        $this->load->view('monitor/editTransaksi',$data);
    }
    function editTransaksi()
    {
        $idTransaksi=$this->input->post('idTrans');
        $kodeKolom=$this->input->post('kodeKolom');
        $expiredDate=$this->input->post('expiredDate');
        $expiredDateSampel=$this->input->post('expiredDateSampel');
        $this->m_storage->updateTransaksi($idTransaksi,$kodeKolom,$expiredDate,$expiredDateSampel);
        echo "Silahkan muat ulang untuk melihat perubahan.";
    }
    function getTransaksiAll()
    {
        $data['arrayTransaksiData']=$this->m_storage->getTransaksiAll();
        //print_r($data['arrayTransaksiData']);
        if(isset($_GET['checkbox'])=='yes')
        {
            $this->load->view('template/datatablesTransaksiAll2',$data);
        }
        else{$this->load->view('template/datatablesTransaksiAll',$data);}
    }
    function getDetailTransaksiByProductIDFormula()
    {
        $data['detailTransksi']=$this->m_storage->getDetailTransaksiByProductIDFormula();//print_r($data['detailTransksi']);
        $this->load->view('monitor/tableProduct',$data);
    }
    function getTransaksiAll2()
    {
        $data['arrayTransaksiData']=$this->m_storage->getTransaksiAll2();
        $this->load->view('template/datatablesTransaksiAll3',$data);
    }

}
