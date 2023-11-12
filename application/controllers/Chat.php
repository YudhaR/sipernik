<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {

    function __construct()
	{
		parent::__construct();
		$this->load->model('M_system','chat');
		$this->load->model('M_surat','persuratan');
		if($this->session->userdata('sess_is_logged_in')==FALSE){
            redirect('login');
        }
	}

	function Index(){
		$data['data']=$this->chat->get_user_online()->result_object();
		$this->load->view('pages/pop_chat',$data);
	}

	function detil_chat($user_target=NULL){
		$idtarget=$this->encrypt->decode(base64_decode($user_target));
		$data['user_target']=$user_target;
		$data['data']=$this->chat->get_list_chat($idtarget)->result();
		$data['page']="pages/chat";
		$this->load->vars($data);
		$data['harus_disposisi']=$this->persuratan->harus_disposisi('masuk')->num_rows();
		$data['belum_disposisi']=$this->persuratan->belum_disposisi()->num_rows();
		$this->load->view('pages/pages',$data);
	}

	function submit(){
		$isi = $this->input->post('teks_pesan');
		$user_target = $this->input->post('user_target');
		$idtarget=$this->encrypt->decode(base64_decode($user_target));
		$user_source=$this->session->userdata('sess_userid');
		$tgl_kirim = date("Y-m-d H:i:s"); 
		$object = array(
				'user_source' => $user_source,
				'user_target' => $idtarget,
				'tgl_kirim'=> $tgl_kirim,
				'isi'=> $isi,

			);
		$this->db->insert('ctr_pesan', $object);
	}
}
