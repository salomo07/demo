<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_Locator extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->session->userdata('dataUser')) {
            redirect('Login');
        }
        $this->load->model('m_master');
    }
    function index() {
        $data['dataSidebar']=$this->session->userdata('dataSidebar');
        $data['dataMenu']=$this->session->userdata('dataMenu');
        $this->load->view('master/masterLocator',$data);
    }
    function cekKodeKolomSama($kodeKolom) {
        $arrayLocator= $this->m_master->getKolomExist($kodeKolom);
        if(count($arrayLocator)>0)
        {
            echo 'Ditemukan Kolom Sama.';
        }else{echo '';}
    }
    function insertLocator()
    {
        $kolom=$this->input->post('kolom');
        $lama=$this->input->post('lama');
        if($this->cekKodeKolomSama($kolom)!='')
        {}
        else
        {
            $this->m_master->insertLocator($kolom,$lama);
        }        
    }
    function getLocatorAll()
    {
        $data['daftarLocator']=$this->m_master->getLocatorAll();
        $this->load->view('template/tableLocator',$data);
    }
    function updateLocator()
    {
        $kolomlama=$this->input->post('old');
        $kolom=$this->input->post('kolom');
        $lama=$this->input->post('lama');
        $this->m_master->updateLocator($kolomlama,$kolom,$lama);
        echo "Updated";
    }
    function delLocator()
    {
        $kolom=$this->input->post('kolom');
        $this->m_master->deleteLocator($kolom);
        echo 'Terhapus';
    }
    function getJumlahLocator()
    {
        $kolom=$this->m_master->getJumlahLocator();
        echo $kolom->JumlahLocator;
    }
}
