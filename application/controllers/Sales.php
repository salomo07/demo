<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sales extends CI_Controller 
{
    function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('m_sales');
        $this->load->model('m_customer');
        $this->load->model('m_item');
        $this->load->helper(array('form', 'url'));
    }
    public function index() {
        $data['dataMenu']=$this->session->userdata('dataMenu');
        $data['dataSidebar']=$this->session->userdata('dataSidebar');
        $data['dataCustomer']=$this->m_customer->showAll();
        $data['dataTransaksi']=$this->m_sales->showAll();
        $data['dataItem']=$this->m_item->showAll();

		$this->load->view('sales/sales',$data);
    }
    public function addTransaksi() {
        // $this->m_sales->insertTransaksi($_POST);
        $data=$this->m_sales->getLastTransaksi();
        echo json_encode($data);
    }
    public function addDetailTransaksi() {
        print_r($_POST);
        // $this->m_sales->insertTransaksi($_POST);
        echo json_encode($data);
    }
    public function showDetailByID() {
        $data=$this->m_sales->showDetail($_POST['id']);
        echo json_encode($data);
    }
    public function edit() {
        $_POST['pic']=json_encode($_POST['pic']);
        $this->m_sales->updateItem($_POST);
        redirect('customer');
    }
    public function delete() {
        $this->m_sales->delete($_POST['id']);
    }
    
}
