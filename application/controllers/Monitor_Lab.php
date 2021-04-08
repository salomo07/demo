<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Monitor_Lab extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->session->userdata('dataUser')) {
            redirect('Login');
        }
        $this->load->model('m_storage');
        $this->load->model('m_lab');
        date_default_timezone_set("Asia/Jakarta"); 
    }
    function index() {
        $data['dataSidebar']=$this->session->userdata('dataSidebar');
        $data['dataMenu']=$this->session->userdata('dataMenu');
		$this->load->view('monitor/monitorlab',$data);
    }
    function getDataPenerimaanByTanggal() 
    {
        $tgl=$this->input->post('tgl');
        $data['dataPenerimaan']=$this->m_lab->getDataPenerimaanByTanggal($tgl);
        $html=$this->load->view('template/datatablesTransaksiLab',$data,true);
        echo $html; 
    }
    function updateDataPenerimaan() 
    {
        $arrayOfObject=$this->input->post('arrayOfObject');
        if(count($arrayOfObject)>0)
        {
            foreach ($arrayOfObject as $key => $value) 
            {
                $this->m_lab->editEForm($value['Filler'],$value['Time'],$value['Qty'],$value['IDPenerimaan'],$value['waktupengiriman']);
            }
        }
    }
    function hapusDataPenerimaan() 
    {
        $arrayOfObject=$this->input->post('arrayOfObject');
        foreach ($arrayOfObject as $key => $value) 
        {           
            $this->m_lab->hapusEForm($value);
        }
    }
}
