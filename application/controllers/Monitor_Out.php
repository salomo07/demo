<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Monitor_Out extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->session->userdata('dataUser')) {
            redirect('Login');
        }
        $this->load->model('m_storage');
    }
    public function index()
    {
        $data['dataSidebar']=$this->session->userdata('dataSidebar');
        $data['dataMenu']=$this->session->userdata('dataMenu');
        $data['arrayTransaksiData']=$this->m_storage->getTransaksiAll();
        $data['ujiHariIni']=$this->m_storage->getUjiHariIni(date('d-m-Y'));
        print_r($data['ujiHariIni']);
		$this->load->view('monitor/monitorout',$data);
    }
    function getDetailOut()
    {
        $idTransaksi=$this->input->post('idTrans');
        $data['detailTransksi']=$this->m_storage->getDetailHistoriKeluarGroupByIDTransaksi($idTransaksi);
        $this->load->view('monitor/tableDetailTransaksiKeluar',$data);
    }
    function getDetailUji()
    {
        $idTransaksi=$this->input->post('idTrans');
        $data['detailTransksi']=$this->m_storage->getDetailHistoriUjiGroupByIDTransaksi($idTransaksi);
        $this->load->view('monitor/tableDetailTransaksiUji',$data);
    }
    function getHistoriTransaksiOut()
    {
        $tgl=$this->input->post('tgl');
        $data['arrayTransaksiData']=array();
        if($tgl=='')
        {
            $data['arrayTransaksiData']=$this->m_storage->getHistoriKeluarTransaksiAll();
        }
        else
        {
            $data['arrayTransaksiData']=$this->m_storage->getHistoriKeluarTransaksi($tgl);
        }
        if(isset($_GET['checkbox'])=='yes')
        {
            $this->load->view('template/datatablesTransaksiAll2',$data);
        }
        else{$this->load->view('template/datatablesTransaksiAll',$data);}
        // $tgl=$this->input->post('tgl');
        // $data['arrayTransaksiData']=$this->m_storage->getHistoriKeluarTransaksi($tgl);
        // if(isset($_GET['checkbox'])=='yes')
        // {
        //     $this->load->view('template/datatablesTransaksiAll2',$data);
        // }
        // else{$this->load->view('template/datatablesTransaksiAll',$data);}
    }
    function getHistoriTransaksiUji()
    {
        $tgl=$this->input->post('tgl');
        $data['arrayTransaksiData']=array();
        if($tgl=='')
        {
            $data['arrayTransaksiData']=$this->m_storage->getHistoriUjiTransaksiAll();
        }
        else
        {
            $data['arrayTransaksiData']=$this->m_storage->getHistoriUjiTransaksi($tgl);
        }

        if(isset($_GET['checkbox'])=='yes')
        {
            $this->load->view('template/datatablesTransaksiAll2',$data);
        }
        else{$this->load->view('template/datatablesTransaksiAll',$data);}
    }
}
