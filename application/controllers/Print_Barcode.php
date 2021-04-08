<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Print_Barcode extends CI_Controller {

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
		$this->load->view('printbarcode/printBarcode',$data);
    }
    function result() {
        $_SESSION['jumlahtable']=ceil(count($chk) / 15);
        $_SESSION["chk"]=$this->input->post('chk');
    }
    function printBarcode()
    {
        $this->load->view('printbarcode/tableBarcode');
    }
}
