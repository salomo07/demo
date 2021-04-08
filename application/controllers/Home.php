<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        // $this->load->model('m_storage');
        if (!$this->session->userdata('dataUser')) {
            redirect('Login');
        }
        
    }
    public function index() {
        $data['dataMenu']=$this->session->userdata('dataMenu');
        $data['dataSidebar']=$this->session->userdata('dataSidebar');

		$this->load->view('home/home',$data);
    }
    public function signout()
    {
        unset($_SESSION['dataUser']);
        redirect('Login');             
    }
}
