<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fitur extends CI_Controller {

    function __construct()
	{
		parent::__construct();
		if($this->session->userdata('sess_is_logged_in')==FALSE){
            redirect('login');
        }
        $this->load->model('M_surat','persuratan');
	}

	function pengumuman(){
		$data['title']="Buat Pengumuman";
		$data['page']="pages/pengumuman";
		$this->load->vars($data);
		$data['harus_disposisi']=$this->persuratan->harus_disposisi('masuk')->num_rows();
		$data['belum_disposisi']=$this->persuratan->belum_disposisi()->num_rows();
		$this->load->view('pages/pages');
	}
}
