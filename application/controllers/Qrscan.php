<?php defined('BASEPATH') OR exit('No direct script access allowed');
 class Qrscan extends CI_Controller {
 	public function __construct() {parent::__construct();
 	$this->load->model('M_surat','persuratan');
	 $this->load->model('M_referensi','referensi');
 } 
 
 function st($fn=NULL,$id=NULL){
 	if ($fn=="disposisi") {
 		$row=$this->persuratan->surat('masuk',$id)->result();
		$data['list_disposisi']		= $this->persuratan->get_disposisi($id);
		$nama_file_qr=preg_replace('/[^a-zA-Z0-9_.]/', '', $row[0]->no_agenda);
		$data['no_agenda']			= $row[0]->no_agenda;
		$data['balasan']			= $row[0]->balasan;
		$data['kode']				= $row[0]->kode;
		$data['nama']				= $row[0]->nama;
		$data['no_surat']			= $row[0]->no_surat;
		$data['tgl_surat']			= tgl_indo($row[0]->tgl_surat);
		$data['tgl_terima']			= tgl_indo($row[0]->tgl_terima);
		$data['pengirim']			=$row[0]->pengirim;	
		$data['untuk']				=$row[0]->untuk;
		$data['file_name']			=$row[0]->file_name;
		$data['perihal']			=$row[0]->perihal;
		$data['ket']             	=$row[0]->ket;
		$data['title']				= "DIPSOSISI SURAT NOMOR ".$row[0]->no_surat;
		$this->load->vars($data);
		$this->load->view('admin/qrcode/disposisi');
 	} 
	if ($fn=="ordner"){
		$result=$this->referensi->tampil_ordner($id)->result_object();
		if (count($result)>0){
			$data['kode']=$result[0]->kode;
		 	$data['nama']=$result[0]->nama;
		}else{
			$data['kode']="BOX";
		 	$data['nama']="ORDNER TIDAK DITEMUKAN";
		} 
		$data['data']=$result;
		$this->load->view('admin/qrcode/ordner',$data);
	} 
 }
};


