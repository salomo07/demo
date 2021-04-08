<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customer extends CI_Controller 
{
    function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('m_customer');
        $this->load->model('m_login');
        $this->load->helper(array('form', 'url'));
    }
    public function index() {
        $data['dataMenu']=$this->session->userdata('dataMenu');
        $data['dataSidebar']=$this->session->userdata('dataSidebar');
        $data['dataCustomer']=$this->m_customer->showAll();
        $data['dataPIC']=$this->m_login->showUserbyRole("PIC");

		$this->load->view('customer/customer',$data);
    }
    public function add() {
        $_POST['pic']=json_encode($_POST['pic']);

        unset($_POST['imageItem']);
        
        $this->m_customer->insertCustomer($_POST);
        $id=$this->m_customer->getNewId();
        $this->do_upload($id->Id);
    }
    public function showDetailByID() {
        $data=$this->m_customer->showDetail($_POST['id']);
        echo json_encode($data);
    }
    public function edit() {
        $_POST['pic']=json_encode($_POST['pic']);
        $this->m_customer->updateItem($_POST);
        redirect('customer');
    }
    public function delete() {
        $this->m_customer->delete($_POST['id']);
    }
    public function do_upload($id)
    {
        ;
        $config['upload_path']          = './upload/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 5024;
        $config['overwrite']=true;
        $config['file_name']="cust".$id;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('imageItem'))
        {
                $error = array('error' => $this->upload->display_errors());
                echo 'Error uploading file';
                $this->m_customer->delete($id);
        }
        else
        {
            $this->db->where('id', $id);
            $this->db->update('customer', ['Image'=>"./upload/".$this->upload->data('file_name')]);
            redirect('customer');
        }
    }
    
}
