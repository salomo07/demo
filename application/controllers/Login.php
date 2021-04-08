<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller 
{
    function __construct() {
        parent::__construct();
        // print_r($this->session->userdata('dataUser'));
        // unset($_SESSION['dataUser']);
        if ($this->session->userdata('dataUser')) {
            redirect('Home');
        }
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('m_login');
    }
    public function index() {
		$this->load->view('login/index');
    }
    public function sign_in() 
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $this->sign_in2($username,$password);
    }
    public function sign_in2($username,$password)
    {

        $arrayUserdata=$this->m_login->verifikasi2($username,base64_encode($password));
        if(count($arrayUserdata)>0)
        {
            //echo base64_encode($password)."\n".'||';echo base64_decode('cmVqb2ljZQ==');
            $dataUser=array('Username'=>$arrayUserdata->Username,'Ip'=>$_SERVER['REMOTE_ADDR'],'Waktu_In'=>date('Y-m-d H:i:s'),'Host'=>gethostbyaddr($_SERVER['REMOTE_ADDR']),'Logged'=>1);            
            // $data['dataMenu']=$this->m_login->getMenu1($arrayUserdata->Role);
            // $data['userid']=$arrayUserdata->Nik;
            $this->session->set_userdata('dataUser', $dataUser);
            // $menubar=$this->load->view('template/menubar',$data,true);
            // $this->session->set_userdata('dataMenu', $menubar);

            $sidebar=$this->load->view('template/sidebar',$data,true);
            $this->session->set_userdata('dataSidebar', $sidebar);

            // $logArray=$this->m_login->getCurrentLog($username);
            // if(count($logArray)==0){$this->m_login->insert_tblLoginLog($dataUser);}
            // else if($logArray->Logged==1)//Jika session sebelumnya belum signout, maka update database jadi signout
            // {
            //     $this->m_login->updateSignout($logArray->ID_Log);
            // }
            // else //Buat logLogin baru
            // {
            //     $this->m_login->insert_tblLoginLog($dataUser);
            // }
            redirect('Home');
        }
        else{redirect('Login');}
    }
    public function cekSession()
    {

    }
    
}
