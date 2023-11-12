<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Login extends CI_Controller {
	function __construct(){
		parent::__construct(); 
		$this->load->model('Default/Validated', 'val'); 
		if($this->session->userdata('sess_is_logged_in')==TRUE){redirect('Home'); } 
	} 
	public function index($err=FALSE){
		if($err==FALSE){$err = FALSE; }else{$err =TRUE; } 
		if($this->session->userdata('is_logged_in')){
			if($this->session->userdata('login_time')){
				if (((time()-strtotime($this->session->userdata('login_time')))/60)>60) {
					$this->load->model('Login/validation_user'); 
					if(!$this->validation_user->delSession()){} $this->doLogin($err); 
				}else{redirect('logout'); } 
			}else{$this->doLogin($err); } 
		}else{$this->doLogin($err); } 
	} 
	function doLogin($err=FALSE){
		$data['error'] =$err; 
		$this->load->model('Default/Defaults','defaults'); 
		$this->load->vars($data); $this->load->view('login/login'); 
	} 
	function validation_credential(){
		$this->load->library('form_validation'); 
		$this->form_validation->set_rules('username','username','trim|required'); 
		$this->form_validation->set_rules('password','password','trim|required'); 
		if($this->form_validation->run()===TRUE){
			$this->load->model('Login/Validation_user','validation_user'); 
			if($this->validation_user->validate()==TRUE){
				$this->load->model('Default/Defaults','defaults'); 
				$system_info = $this->defaults->getSystemInfo(); 
				foreach ($system_info->result() as $row) {
					if(isset($system_info)){
						$this->session->set_userdata('instansi',$row->nama); 
						$this->session->set_userdata('alamat_instansi',$row->alamat); 
						$this->session->set_userdata('versi',$row->versi); 
						$this->session->set_userdata('logo_instansi',$row->logo); 
					}else{
						$this->session->set_userdata('instansi',"Belum Di setting"); 
						$this->session->set_userdata('alamat_instansi',"Belum Di setting"); 
						$this->session->set_userdata('versi',"Belum Di setting"); 
						$this->session->set_userdata('logo_instansi','default.png'); 
					} 
				} redirect('Home'); 
			}else{
				redirect('Login/index/ERR'); 
			} 
		}else{
			redirect('Login/index/ERR'); 
		} 
	} 
}