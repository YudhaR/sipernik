<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct()
	{
		parent::__construct();
		$this->load->model('M_surat','persuratan');
		
		if($this->session->userdata('sess_is_logged_in')==FALSE){
            redirect('login');
        }
	}
	
	function page_404(){
		$data['page']='pages/404';
		$this->load->vars($data);
		$data['harus_disposisi']=$this->persuratan->harus_disposisi('masuk')->num_rows();
		$data['belum_disposisi']=$this->persuratan->belum_disposisi()->num_rows();
		$this->load->view('pages/pages');
	}

	function Index(){
		$jumlah_surat_masuk=$this->persuratan->surat('masuk');
		$jumlah_surat_keluar=$this->persuratan->surat('keluar');
		$jumlah_surat_keluar_ketua=$this->persuratan->get_jumlah_surat(1)[0]->jumlah;
		$jumlah_surat_keluar_sekre=$this->persuratan->get_jumlah_surat(2)[0]->jumlah;
		$jumlah_surat_keluar_panitera=$this->persuratan->get_jumlah_surat(3)[0]->jumlah;
		$jumlah_belum_disposisi=$this->persuratan->belum_disposisi();
		$jumlah_belum_ordner=$this->persuratan->belum_ordner();		
		$data['jumlah_surat_masuk']=$jumlah_surat_masuk->num_rows();
		$data['jumlah_surat_keluar']=$jumlah_surat_keluar->num_rows();
		$data['jumlah_surat_keluar_ketua']=$jumlah_surat_keluar_ketua;
		$data['jumlah_surat_keluar_sekre']=$jumlah_surat_keluar_sekre;
		$data['jumlah_surat_keluar_panitera']=$jumlah_surat_keluar_panitera;
		$data['belum_disposisi']=$jumlah_belum_disposisi->num_rows();
		$data['belum_ordner']=$jumlah_belum_disposisi->num_rows();
		$data['jumlah_buku_tamu']=$this->persuratan->buku_tamu()->num_rows();
		$data['jumlah_spt']=$this->persuratan->jumlah_spt()->num_rows();
		$data['jumlah_ijin']=$this->persuratan->jumlah_ijin()->num_rows();
		$data['rekap_surat_masuk']=$this->persuratan->home_rekap_surat('masuk')->result_object();
		$data['rekap_surat_masuk_bln']=$this->persuratan->rekap_surat_masuk_perbulan();
		$data['rekap_surat_keluar_asal']=$this->persuratan->rekap_surat_keluar_asal()->num_rows();
		$data['tampil_ijin_pegawai']=$this->persuratan->tampil_ijin_pegawai()->result_object();
		$data['harus_disposisi']=$this->persuratan->harus_disposisi('masuk')->num_rows();
		$data['belum_disposisi']=$this->persuratan->belum_disposisi()->num_rows();
		$data['page']='pages/dashboard';
		$this->load->vars($data);
		$this->load->view('pages/pages',$data);
	}

	function profile(){
		$data['harus_disposisi']=$this->persuratan->harus_disposisi('masuk')->num_rows();
		$data['belum_disposisi']=$this->persuratan->belum_disposisi()->num_rows();
		$this->load->model('M_referensi','ref');
		$pegawai_id=$this->session->userdata('sess_pegawaiid');
		$profile=$this->ref->tampil_pegawai($pegawai_id)->result_object();
		$data['nama']=strtoupper($profile[0]->nama);
		$data['nip']=$profile[0]->nip;
		$data['email']=$profile[0]->email;
		$data['alamat']=$profile[0]->alamat;
		$data['telpon']=$profile[0]->telpon;
		$data['jabatan']=$profile[0]->jabatan;
		$data['title']="PROFILE USER";
		$data['page']='admin/system/profile';
		$this->load->vars($data);
		$this->load->view('pages/pages',$data);
	}
}
