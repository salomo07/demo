<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Item extends CI_Controller 
{
    function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('m_item');
        $this->load->helper(array('form', 'url'));
    }
    public function index() {
        $data['dataMenu']=$this->session->userdata('dataMenu');
        $data['dataSidebar']=$this->session->userdata('dataSidebar');
        $data['dataItem']=$this->m_item->showAll();
		$this->load->view('item/item',$data);
    }
    public function add() {
        $exist=$this->m_item->showByNama($_POST['nama']);
        if(count($exist)>0)
        {echo 'Nama sudah pernah dipakai...';}
        else
        {
            unset($_POST['imageItem']);
            $this->m_item->insertItem($_POST);
            $data=$this->m_item->showByNama($_POST['nama']);
            $this->do_upload($data);
        }
    }
    public function showDetailByID() {
        $data=$this->m_item->showDetail($_POST['id']);
        echo json_encode($data);
    }
    public function edit() {
        $this->m_item->updateItem($_POST);
        redirect('item');
    }
    public function do_upload($data)
    {
        ;
        $config['upload_path']          = './upload/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 5024;
        $config['overwrite']=true;
        $config['file_name']=$data->Id;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('imageItem'))
        {
                $error = array('error' => $this->upload->display_errors());
                echo 'Error uploading file';
                $this->m_item->delete($data->Id);
        }
        else
        {
            $this->db->where('id', $data->Id);
            $this->db->update('item', ['Image'=>"./upload/".$this->upload->data('file_name')]);
            redirect('item');
        }
    }
    public function delete() {
        $this->m_item->delete($_POST['id']);
    }
    
}
