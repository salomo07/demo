<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_User extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->session->userdata('dataUser')) {
            redirect('Login');
        }
        $this->load->model('m_master');
        $this->load->model('m_login');
    }
    function index() {
        $data['dataSidebar']=$this->session->userdata('dataSidebar');
        $data['dataMenu']=$this->session->userdata('dataMenu');
        $this->load->view('master/masterUser',$data);
    }
    function getUser()
    {
        $data['daftarUser']=$this->m_master->getUser();
        $this->load->view('template/tableUser',$data);
    }
    function insertUser()
    {
        $nik=$this->input->post('nik');
        $full=$this->input->post('full');
        $role=$this->input->post('role');
        $dataUser=$this->m_master->getUserExist($nik);
        if(count($dataUser)>0)
        {
            echo "Nik sudah digunakan.";
        }
        else
        {
            $this->m_master->insertUser($nik,$full,$role);
        }
    }
    function editUser()
    {
        $nik=$this->input->post('nik');
        $full=$this->input->post('full');
        $role=$this->input->post('role');
        $dataUser=$this->m_master->editUser($nik,$full,$role);
        echo "User telah terupdate.";
    }
    function deleteUser()
    {
        $nik=$this->input->post('nik');
        $dataUser=$this->m_master->deleteUser($nik);
        echo "User telah terdelete.";
    }
    function getModalChangePassword()
    {
        $nik=$this->input->post('idUser');
        $arrayUserdata=$this->m_login->getUserDateByNik($nik);
        $data['nik']=$arrayUserdata->Nik;
        $data['username']=$arrayUserdata->Username;
        $data['role']=$arrayUserdata->Role;
        $data['titleModal']='Change Password';
        $data['bodyModal']='';
        $data['userid']=$nik;
        $this->load->view('template/modalChangePassword',$data);
    }
    function cekPasswordLamaValid()
    {
        $nik=$this->input->post('idUser');
        $passLama=$this->input->post('passLama');
        $arrayUserdata=$this->m_login->getUserDateByNik($nik);
        if($passLama!=base64_decode($arrayUserdata->Pass))
        {
            echo "Tidak valid";
        }
    }
    function updatePasswordUser()
    {
        $nik=$this->input->post('idUser');
        $passBaru=$this->input->post('passBaru');
        $this->m_master->updatePasswordUser($nik,base64_encode($passBaru));
        echo "Updated".$nik.base64_encode($passBaru);
    }
}
