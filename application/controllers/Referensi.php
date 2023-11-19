<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Referensi extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_referensi','referensi');
		$this->load->model('M_surat','persuratan');
		$this->load->library('session');
		if($this->session->userdata('sess_is_logged_in')==FALSE){
    		redirect('login');
		}
		if ($this->session->userdata('sess_idgroup')>=2) {
        		$data['page']= "pages/404";
				$this->load->vars($data);
				$this->load->view('pages/pages');
        }
	}
	function kategori_surat($act=NULL,$enc=NULL){
		if ($act==NULL) {
			 $a['data']	= $this->referensi->tampil_kategori()->result_object();
			 $a['page']	= "admin/referensi/kategori_surat";
			 $a['title']	= "Referensi Kategori Surat";
			 $this->load->vars($a);
			 $a['harus_disposisi']=$this->persuratan->harus_disposisi('masuk')->num_rows();
			 $a['belum_disposisi']=$this->persuratan->belum_disposisi()->num_rows();
 
			 $this->load->view('pages/pages',$a);
		 }else{
			 if ($act=='edit') {
				 $id=$this->encrypt->decode(base64_decode($enc));
				 $data	= $this->db->get_where('ctr_kategori_surat',array('id_kategori'=>$id))->result_object();
				//  print_r($data);
				//  die();
				 $a['enc']=base64_encode($this->encrypt->encode($data[0]->id_kategori));
				 $a['kategori']=$data[0]->kategori;
				 $a['act']='update';
				 $a['title']	= "Edit Kategori Surat";
				 $this->load->vars($a);
				 $this->load->view('admin/referensi/act_kategori_surat',$a);
			 }
			 if ($act=='tambah'){
				 $a['kode']='';
				 $a['kategori']='';
				 $a['enc']='';
				 $a['act']='insert';
				 $a['title']	= "Tambah Kategori Surat";
				 $this->load->vars($a);
				 $this->load->view('admin/referensi/act_kategori_surat',$a);
			 }
			 if ($act=='hapus'){
				 $id = $this->encrypt->decode(base64_decode($enc));
				 $this->referensi->hapus_kategori($id);
				 redirect('Referensi/kategori_surat/','refresh');
			 }
		 }
	 }

	function jenis_surat_masuk($act=NULL,$enc=NULL){
		if ($act==NULL) {
			 $a['data']	= $this->referensi->tampil_jenis_surat_masuk()->result_object();
			 $a['page']	= "admin/referensi/jenis_surat_masuk";
			 $a['title']	= "Referensi Jenis Surat Masuk";
			 $this->load->vars($a);
			 $a['harus_disposisi']=$this->persuratan->harus_disposisi('masuk')->num_rows();
			 $a['belum_disposisi']=$this->persuratan->belum_disposisi()->num_rows();
 
			 $this->load->view('pages/pages',$a);
		 }else{
			 if ($act=='edit') {
				 $id=$this->encrypt->decode(base64_decode($enc));
				 $data	= $this->db->get_where('ctr_jenis_surat_masuk',array('jenis_surat_masuk_id'=>$id))->result_object();
				//  print_r($data);
				//  die();
				 $a['enc']=base64_encode($this->encrypt->encode($data[0]->jenis_surat_masuk_id));
				 $a['jenis']=$data[0]->jenis;
				 $a['act']='update';
				 $a['title']	= "Edit Jenis Surat Masuk";
				 $this->load->vars($a);
				 $this->load->view('admin/referensi/act_jenis_surat_masuk',$a);
			 }
			 if ($act=='tambah'){
				 $a['kode']='';
				 $a['jenis']='';
				 $a['enc']='';
				 $a['act']='insert';
				 $a['title']	= "Tambah Jenis Surat Masuk";
				 $this->load->vars($a);
				 $this->load->view('admin/referensi/act_jenis_surat_masuk',$a);
			 }
			 if ($act=='hapus'){
				 $id = $this->encrypt->decode(base64_decode($enc));
				 $this->referensi->hapus_jenis_surat_masuk($id);
				 redirect('Referensi/jenis_surat_masuk/','refresh');
			 }
		 }
	 }

	function status_surat($act=NULL,$enc=NULL){
		if ($act==NULL) {
			 $a['data']	= $this->referensi->tampil_status_surat()->result_object();
			 $a['page']	= "admin/referensi/status_surat";
			 $a['title']	= "Referensi Status Surat";
			 $this->load->vars($a);
			 $a['harus_disposisi']=$this->persuratan->harus_disposisi('masuk')->num_rows();
			 $a['belum_disposisi']=$this->persuratan->belum_disposisi()->num_rows();
 
			 $this->load->view('pages/pages',$a);
		 }else{
			 if ($act=='edit') {
				 $id=$this->encrypt->decode(base64_decode($enc));
				 $data	= $this->db->get_where('ctr_status_surat',array('id_status_surat'=>$id))->result_object();
				//  print_r($data);
				//  die();
				 $a['enc']=base64_encode($this->encrypt->encode($data[0]->id_status_surat));
				 $a['status']=$data[0]->status;
				 $a['act']='update';
				 $a['title']	= "Edit Status Surat";
				 $this->load->vars($a);
				 $this->load->view('admin/referensi/act_status_surat',$a);
			 }
			 if ($act=='tambah'){
				 $a['kode']='';
				 $a['status']='';
				 $a['enc']='';
				 $a['act']='insert';
				 $a['title']	= "Tambah Status Surat";
				 $this->load->vars($a);
				 $this->load->view('admin/referensi/act_status_surat',$a);
			 }
			 if ($act=='hapus'){
				 $id = $this->encrypt->decode(base64_decode($enc));
				 $this->referensi->hapus_status_surat($id);
				 redirect('Referensi/status_surat/','refresh');
			 }
		 }
	 }

	function jenis_surat($act=NULL,$enc=NULL){
       if ($act==NULL) {
			$a['data']	= $this->referensi->tampil_jenis()->result_object();
			$a['page']	= "admin/referensi/jenis_surat";
			$a['title']	= "Referensi Jenis Surat Keluar";
			$this->load->vars($a);
			$a['harus_disposisi']=$this->persuratan->harus_disposisi('masuk')->num_rows();
			$a['belum_disposisi']=$this->persuratan->belum_disposisi()->num_rows();

			$this->load->view('pages/pages',$a);
		}else{
			if ($act=='edit') {
				$id=$this->encrypt->decode(base64_decode($enc));
				$data	= $this->db->get_where('ctr_jenis_surat',array('jenis_id'=>$id))->result_object();
				$a['enc']=base64_encode($this->encrypt->encode($data[0]->jenis_id));
				$a['kode']=$data[0]->kode;
				$a['nama']=$data[0]->nama;
				$a['act']='update';
				$a['title']	= "Edit Jenis Surat Keluar";
				$this->load->vars($a);
				$this->load->view('admin/referensi/act_jenis_surat',$a);
			}
			if ($act=='tambah'){
				$a['kode']='';
				$a['nama']='';
				$a['enc']='';
				$a['act']='insert';
				$a['title']	= "Tambah Jenis Surat Keluar";
				$this->load->vars($a);
				$this->load->view('admin/referensi/act_jenis_surat',$a);
			}
			if ($act=='hapus'){
				$id = $this->encrypt->decode(base64_decode($enc));
				$this->referensi->hapus_jenis_surat($id);
				redirect('Referensi/jenis_surat/','refresh');
			}
		}
	}

	function sifat_surat($act=NULL,$enc=NULL){
       if ($act==NULL) {
			$a['data']	= $this->referensi->tampil_sifat()->result_object();
			$a['page']	= "admin/referensi/sifat_surat";
			$a['title']	= "Referensi Sifat Surat";
			$this->load->vars($a);
			$a['harus_disposisi']=$this->persuratan->harus_disposisi('masuk')->num_rows();
			$a['belum_disposisi']=$this->persuratan->belum_disposisi()->num_rows();

			$this->load->view('pages/pages',$a);
		}else{
			if ($act=='edit') {
				$id=$this->encrypt->decode(base64_decode($enc));
				$data	= $this->db->get_where('ctr_sifat_surat',array('sifat_id'=>$id))->result_object();
				$a['enc']=base64_encode($this->encrypt->encode($data[0]->sifat_id));
				$a['kode']=$data[0]->kode;
				$a['nama']=$data[0]->nama;
				$a['act']='update';
				$a['title']	= "Edit Sifat Surat";
				$this->load->vars($a);
				$this->load->view('admin/referensi/act_sifat_surat',$a);
			}
			if ($act=='tambah'){
				$a['kode']='';
				$a['nama']='';
				$a['enc']='';
				$a['act']='insert';
				$a['title']	= "Tambah Sifat Surat";
				$this->load->vars($a);
				$this->load->view('admin/referensi/act_sifat_surat',$a);
			}
			if ($act=='hapus'){
				$id = $this->encrypt->decode(base64_decode($enc));
				$this->referensi->hapus_sifat_surat($id);
				redirect('Referensi/sifat_surat/','refresh');
			}
		}
	}

	function insert_kategori_surat(){
			$kategori= $this->input->post('kategori');
			$object = array(
					'kategori' => $kategori,
				);
			$this->db->insert('ctr_kategori_surat', $object);
			redirect('Referensi/kategori_surat','refresh');
	}
	function insert_jenis_surat_masuk(){
			$jenis= $this->input->post('jenis');
			$object = array(
					'jenis' => $jenis,
				);
			$this->db->insert('ctr_jenis_surat_masuk', $object);
			redirect('Referensi/jenis_surat_masuk','refresh');
	}
	function insert_status_surat(){
			$status= $this->input->post('status');
			$object = array(
					'status' => $status,
				);
			$this->db->insert('ctr_status_surat', $object);
			redirect('Referensi/status_surat','refresh');
	}
	function update_kategori_surat(){
        $id = $this->encrypt->decode(base64_decode($this->input->post('enc')));
		$kategori= $this->input->post('kategori');
		$object = array(
				'kategori' => $kategori,
			);
		$this->db->where('id_kategori', $id);
		$this->db->update('ctr_kategori_surat', $object); 

		redirect('Referensi/kategori_surat','refresh');
	}
	function update_jenis_surat_masuk(){
        $id = $this->encrypt->decode(base64_decode($this->input->post('enc')));
		$jenis= $this->input->post('jenis');
		$object = array(
				'jenis' => $jenis,
			);
		$this->db->where('jenis_surat_masuk_id', $id);
		$this->db->update('ctr_jenis_surat_masuk', $object); 

		redirect('Referensi/jenis_surat_masuk','refresh');
	}
	function update_status_surat(){
        $id = $this->encrypt->decode(base64_decode($this->input->post('enc')));
		$status= $this->input->post('status');
		$object = array(
				'status' => $status,
			);
		$this->db->where('id_status_surat', $id);
		$this->db->update('ctr_status_surat', $object); 

		redirect('Referensi/status_surat','refresh');
	}
	function insert_jenis_surat(){

			$kode = $this->input->post('kode');
			$nama= $this->input->post('nama');
			$object = array(
					'kode' => $kode,
					'nama' => $nama,
				);
			$this->db->insert('ctr_jenis_surat', $object);
			redirect('Referensi/jenis_surat','refresh');
	}
	function insert_sifat_surat(){

			$kode = $this->input->post('kode');
			$nama= $this->input->post('nama');
			$object = array(
					'kode' => $kode,
					'nama' => $nama,
				);
			$this->db->insert('ctr_sifat_surat', $object);
			redirect('Referensi/sifat_surat','refresh');
	}
	function hapus_kategori_surat($enc){
		$id = $this->encrypt->decode(base64_decode($enc));
	   $this->referensi->hapus_kategori($id);
	   redirect('Referensi/kategori_surat','refresh');
   }
	function hapus_jenis_surat_masuk($enc){
		$id = $this->encrypt->decode(base64_decode($enc));
	   $this->referensi->hapus_jenis_surat_masuk($id);
	   redirect('Referensi/jenis_surat_masuk','refresh');
   }
	function hapus_status_surat($enc){
		$id = $this->encrypt->decode(base64_decode($enc));
	   $this->referensi->hapus_status_surat($id);
	   redirect('Referensi/status_surat','refresh');
   }
	

	function update_jenis_surat(){
        $id = $this->encrypt->decode(base64_decode($this->input->post('enc')));
		$kode = $this->input->post('kode');
		$nama= $this->input->post('nama');
		$object = array(
				'kode' => $kode,
				'nama' => $nama,
			);
		$this->db->where('jenis_id', $id);
		$this->db->update('ctr_jenis_surat', $object); 

		redirect('Referensi/jenis_surat','refresh');
	}

	function update_sifat_surat(){
        $id = $this->encrypt->decode(base64_decode($this->input->post('enc')));
		$kode = $this->input->post('kode');
		$nama= $this->input->post('nama');
		$object = array(
				'kode' => $kode,
				'nama' => $nama,
			);
		$this->db->where('sifat_id', $id);
		$this->db->update('ctr_sifat_surat', $object); 

		redirect('Referensi/sifat_surat','refresh');
	}

	function hapus_jenis_surat($enc){
         $id = $this->encrypt->decode(base64_decode($enc));
		$this->referensi->hapus_jenis_surat($id);
		redirect('Referensi/jenis_surat','refresh');
	}

	function hapus_sifat_surat($enc){
         $id = $this->encrypt->decode(base64_decode($enc));
		$this->referensi->hapus_sifat_surat($id);
		redirect('Referensi/sifat_surat','refresh');
	}

	function ordner($act=NULL,$enc=NULL){
        if ($act==NULL) {
			$a['data']	= $this->referensi->ref_ordner()->result_object();
			$a['page']	= "admin/referensi/ordner";
			$a['title']	= "Referensi Pengordneran ( ordner )";
			$a['harus_disposisi']=$this->persuratan->harus_disposisi('masuk')->num_rows();
			$a['belum_disposisi']=$this->persuratan->belum_disposisi()->num_rows();
			$this->load->view('pages/pages',$a);
		}else{
			if ($act=='edit') {
				$id=$this->encrypt->decode(base64_decode($enc));
				$data	= $this->db->get_where('ctr_ordner',array('id'=>$id))->result_object();
				$a['enc']=base64_encode($this->encrypt->encode($data[0]->id));
				$a['kode']=$data[0]->kode;
				$a['nama']=$data[0]->nama;
				$a['act']='update';
				$a['title']	= "Edit Referensi ordner";
				$this->load->view('admin/referensi/act_ordner', $a);
			}
			if ($act=='tambah'){
				$a['kode']='';
				$a['nama']='';
				$a['enc']='';
				$a['act']='insert';
				$a['title']	= "Tambah Referensi ordner";
				$this->load->view('admin/referensi/act_ordner', $a);
			}
			if ($act=='hapus'){
				$id = $this->encrypt->decode(base64_decode($enc));
				$this->referensi->hapus_ordner($id);
				redirect('Referensi/ordner/','refresh');
			}
		}
	}

	function cetak_qr($form=NULL,$enc=NULL){
        if ($form=="ordner") {
				$id=$this->encrypt->decode(base64_decode($enc));
				$result=$this->referensi->ref_ordner($id)->result_object();
				$nama_file_qr=preg_replace('/[^a-zA-Z0-9_.]/', '', $result[0]->kode.'_'.$result[0]->nama);
				$qrLink=$this->generate_qr->qr_code(base_url()."Qrscan/st/ordner/".$id,"ordner_".$nama_file_qr);
				$data['kode']=$result[0]->kode;
				$data['nama']=$result[0]->nama;
				$data['pictQR']=$qrLink[0];
				$data['title']	= "QR-CODE ORNDER / BOX";
				$this->load->view('admin/referensi/cetak_qr_ordner', $data);
		}
	}
	function insert_ordner(){

			$kode = $this->input->post('kode');
			$nama= $this->input->post('nama');
			$object = array(
					'kode' => $kode,
					'nama' => $nama,
				);
			$this->db->insert('ctr_ordner', $object);
			redirect('Referensi/ordner','refresh');
	}

	function update_ordner(){
        $id = $this->encrypt->decode(base64_decode($this->input->post('enc')));
		$kode = $this->input->post('kode');
		$nama= $this->input->post('nama');
		$object = array(
				'kode' => $kode,
				'nama' => $nama,
			);
		$this->db->where('id', $id);
		$this->db->update('ctr_ordner', $object); 

		redirect('Referensi/ordner','refresh');
	}

	function hapus_ordner($enc){
         $id = $this->encrypt->decode(base64_decode($enc));
		$this->referensi->hapus_ordner($id);
		redirect('Referensi/ordner','refresh');
	}

	function jabatan($act=NULL,$enc=NULL){
        if ($act==NULL) {
			$a['data']	= $this->referensi->tampil_jabatan()->result_object();
			$a['page']	= "admin/referensi/jabatan";
			$a['title']	= "Referensi Nama Jabatan";
			$a['harus_disposisi']=$this->persuratan->harus_disposisi('masuk')->num_rows();
			$a['belum_disposisi']=$this->persuratan->belum_disposisi()->num_rows();
			$this->load->view('pages/pages',$a);
		}else{
			if ($act=='edit') {
				$id=$this->encrypt->decode(base64_decode($enc));
				$data	= $this->db->get_where('ctr_jabatan',array('id'=>$id))->result_object();
				$a['enc']=base64_encode($this->encrypt->encode($data[0]->id));
				$a['jabatan']=$data[0]->jabatan;
				$a['act']='update';
				$a['title']	= "Edit Nama Jabatan";
				$this->load->view('admin/referensi/act_jabatan', $a);
			}
			if ($act=='tambah'){
				$a['jabatan']='';
				$a['enc']='';
				$a['act']='insert';
				$a['title']	= "Tambah Nama Jabatan";
				$this->load->view('admin/referensi/act_jabatan', $a);
			}
			if ($act=='hapus'){
				$id = $this->encrypt->decode(base64_decode($enc));
				$this->referensi->hapus_jabatan($id);
				redirect('Referensi/jabatan/','refresh');
			}
		}
	}

	function insert_jabatan(){
		$jabatan = $this->input->post('jabatan');
		$object = array(
				'jabatan' => $jabatan,
			);
		$this->db->insert('ctr_jabatan', $object);
		redirect('Referensi/jabatan','refresh');
	}

	function update_jabatan(){
        $id = $this->encrypt->decode(base64_decode($this->input->post('enc')));
		$jabatan = $this->input->post('jabatan');
		$object = array(
				'jabatan' => $jabatan,
			);
		$this->db->where('id', $id);
		$this->db->update('ctr_jabatan', $object); 
		redirect('Referensi/jabatan','refresh');
	}

	function petunjuk_disposisi($act=NULL,$enc=NULL){
        if ($act==NULL) {
			$a['data']	= $this->referensi->tampil_petunjuk_disposisi()->result_object();
			$a['page']	= "admin/referensi/petunjuk_disposisi";
			$a['title']	= "Referensi Petunjuk Disposisi";
			$a['harus_disposisi']=$this->persuratan->harus_disposisi('masuk')->num_rows();
			$a['belum_disposisi']=$this->persuratan->belum_disposisi()->num_rows();
			$this->load->view('pages/pages',$a);
		}else{
			if ($act=='edit') {
				$id=$this->encrypt->decode(base64_decode($enc));
				$data	= $this->db->get_where('ctr_petunjuk_disposisi',array('id'=>$id))->result_object();
				$a['enc']=base64_encode($this->encrypt->encode($data[0]->id));
				$a['nama']=$data[0]->nama;
				$a['act']='update';
				$a['title']	= "Edit Sifat Disposisi";
				$this->load->view('admin/referensi/act_petunjuk_disposisi', $a);
			}
			if ($act=='tambah'){
				$a['nama']='';
				$a['enc']='';
				$a['act']='insert';
				$a['title']	= "Tambah Petunjuk Disposisi";
				$this->load->view('admin/referensi/act_petunjuk_disposisi', $a);
			}
			if ($act=='hapus'){
				$id = $this->encrypt->decode(base64_decode($enc));
				$this->referensi->hapus_petunjuk_disposisi($id);
				redirect('Referensi/petunjuk_disposisi/','refresh');
			}
		}
	}

	function insert_petunjuk_disposisi(){
		$nama= $this->input->post('nama');
		$object = array(
				'nama' => $nama,
			);
		$this->db->insert('ctr_petunjuk_disposisi', $object);
		redirect('Referensi/petunjuk_disposisi','refresh');
	}

	function update_petunjuk_disposisi(){
        $id = $this->encrypt->decode(base64_decode($this->input->post('enc')));
		$nama= $this->input->post('nama');
		$object = array(
				'nama' => $nama,
		);
		$this->db->where('id', $id);
		$this->db->update('ctr_petunjuk_disposisi', $object); 
		redirect('Referensi/petunjuk_disposisi','refresh');
	}

	
	function pegawai($act=NULL,$enc=NULL){
        if ($act==NULL) {
        	if ($enc!=NULL){
        		$pegawai_id=$this->encrypt->decode(base64_decode($enc));
        	}else{
        		$pegawai_id=NULL;
        	}
			$a['data']	= $this->referensi->tampil_pegawai($pegawai_id)->result_object();
			$a['page']	= "admin/referensi/pegawai";
			$a['title']	= "Data Pegawai";
			$a['harus_disposisi']=$this->persuratan->harus_disposisi('masuk')->num_rows();
			$a['belum_disposisi']=$this->persuratan->belum_disposisi()->num_rows();
			$this->load->view('pages/pages',$a);
		}else{
			if ($act=='edit') {
				$id=$this->encrypt->decode(base64_decode($enc));
				$data	= $this->referensi->tampil_pegawai($id)->result_object();
				$a['enc']=base64_encode($this->encrypt->encode($data[0]->id));
				$a['jabatan_id']=$data[0]->jabatan_id;
				$a['jabatan']=$data[0]->jabatan;
				$a['nama']=$data[0]->nama;
				$a['nip']=$data[0]->nip;
				$a['foto']=$data[0]->foto;
				$a['alamat']=$data[0]->alamat;
				$a['telpon']=$data[0]->telpon;
				$a['ada_file']=$data[0]->foto;
				$a['jabatan_nama']=$data[0]->jabatan_nama;
				$a['golongan']=$data[0]->golongan;
				$a['pangkat']=$data[0]->pangkat;
				$a['act']='update';
				$a['title']	= "Edit Pegawai";
				$this->load->view('admin/referensi/act_pegawai', $a);
			}
			if ($act=='tambah'){
				$a['jabatan_id']='0';
				$a['jabatan']='';
				$a['nama']='';
				$a['nip']='';
				$a['foto']='default.png';
				$a['ada_file']='';
				$a['jabatan_nama']='';
				$a['alamat']='';
				$a['telpon']='';
				$a['golongan']='';
				$a['pangkat']='';
				$a['enc']='';
				$a['act']='insert';
				$a['page']	= "act_pegawai";
				$a['title']	= "Tambah Pegawai";
				$this->load->view('admin/referensi/act_pegawai', $a);
			}
			if ($act=='hapus'){
				$id = $this->encrypt->decode(base64_decode($enc));
				$this->referensi->hapus_pegawai($id);
				redirect('Referensi/pegawai/','refresh');
			}
		}
	}

	function insert_pegawai(){
		$jabatan_id = $this->input->post('jabatan_id');
		$nama= $this->input->post('nama');
		$nip= $this->input->post('nip');
		$alamat= $this->input->post('alamat');
		$telpon= $this->input->post('telpon');
		$jabatan_nama= $this->input->post('jabatan_nama');
		$golongan= $this->input->post('golongan');
		$pangkat= $this->input->post('pangkat');
		$this->config_upload();
		if ( ! $this->upload->do_upload('file_foto')) {
				$data_file = array('upload_data' => $this->upload->data());
				$object = array(
						'jabatan_id' => $jabatan_id,
						'nama' => $nama,
						'nip' => $nip,
						'jabatan_nama' => $jabatan_nama,
						'alamat'=>$alamat,
						'telpon'=>$telpon,
						'golongan'=>$golongan,
						'pangkat'=>$pangkat,
						'foto'=>'default.png'
							);
		}else{
				$data_file = array('upload_data' => $this->upload->data());
				$object = array(
						'jabatan_id' => $jabatan_id,
						'nama' => $nama,
						'nip' => $nip,
						'jabatan_nama' => $jabatan_nama,
						'alamat'=>$alamat,
						'telpon'=>$telpon,
						'golongan'=>$golongan,
						'pangkat'=>$pangkat,
						'foto'=>$data_file['upload_data']['file_name']
							);
		}
		$this->db->insert('ctr_pegawai', $object);
		redirect('Referensi/pegawai','refresh');
	}

	function update_pegawai(){
        $id = $this->encrypt->decode(base64_decode($this->input->post('enc')));
		$jabatan_id = $this->input->post('jabatan_id');
		$nama= $this->input->post('nama');
		$nip= $this->input->post('nip');
		$jabatan_nama= $this->input->post('jabatan_nama');
		$alamat= $this->input->post('alamat');
		$telpon= $this->input->post('telpon');
		$golongan= $this->input->post('golongan');
		$ada_file= $this->input->post('ada_file');
		$pangkat= $this->input->post('pangkat');
		$this->config_upload();
		if ( ! $this->upload->do_upload('file_foto')) {
				$data_file = array('upload_data' => $this->upload->data());
				$object = array(
						'jabatan_id' => $jabatan_id,
						'nama' => $nama,
						'nip' => $nip,
						'jabatan_nama' => $jabatan_nama,
						'alamat'=>$alamat,
						'telpon'=>$telpon,
						'golongan'=>$golongan,
						'pangkat'=>$pangkat,
						'foto'=>$ada_file
							);
		}else{
				$data_file = array('upload_data' => $this->upload->data());
				$object = array(
						'jabatan_id' => $jabatan_id,
						'nama' => $nama,
						'nip' => $nip,
						'jabatan_nama' => $jabatan_nama,
						'alamat'=>$alamat,
						'telpon'=>$telpon,
						'golongan'=>$golongan,
						'pangkat'=>$pangkat,
						'foto'=>$data_file['upload_data']['file_name']
							);
		}
		
		$this->db->where('id', $id);
		$this->db->update('ctr_pegawai', $object); 

		redirect('Referensi/pegawai','refresh');
	}

	function hapus_pegawai($enc){
		if($this->session->userdata('sess_is_logged_in')==FALSE){
            redirect('login');
        }
         $id = $this->encrypt->decode(base64_decode($enc));
		$this->referensi->hapus_pegawai($id);
		redirect('Referensi/pegawai','refresh');
	}

	function config_upload(){
		$config['upload_path'] 		= './upload/pegawai';
		$config['allowed_types'] 	= 'jpg|png';
		$config['max_size']			= '10000';
		$config['max_width']  		= '3000';
		$config['max_height'] 		= '3000';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
	}

	function penomoran($act=NULL,$enc=NULL){
		if ($act==NULL){	
			$agenda_masuk= $this->referensi->tampil_penomoran(1)->result_object();
			$agenda_keluar= $this->referensi->tampil_penomoran(2)->result_object();
			$a['format_agenda_masuk']=$agenda_masuk[0]->format_nomor_agenda;
			$a['format_agenda_keluar']=$agenda_keluar[0]->format_nomor_agenda;
			$a['format_surat_keluar']=$this->referensi->tampil_penomoran_surat_keluar()->result_object();
			$a['page']	= "admin/referensi/penomoran";
			$a['title']	= "Format Penomoran Agenda dan Surat Keluar";
			$this->load->vars($a);
			$a['harus_disposisi']=$this->persuratan->harus_disposisi('masuk')->num_rows();
			$a['belum_disposisi']=$this->persuratan->belum_disposisi()->num_rows();
			$this->load->view('pages/pages',$a);
		}else{
			if ($act=='tambah') {
				$a['enc']='';
				$a['bagian']='1';
				$a['format_penomoran']='';
				$a['kode_surat']='';
				$a['uraian']='';
				$a['act']='insert';
				$a['title']	= "Tambah Penomoran Surat Keluar";
				$this->load->view('admin/referensi/act_penomoran', $a);
			}
			if ($act=='edit') {
				$id=$this->encrypt->decode(base64_decode($enc));
				$data	= $this->referensi->tampil_penomoran_surat_keluar($id)->result_object();
				$a['enc']=base64_encode($this->encrypt->encode($data[0]->id));
				$a['bagian']=$data[0]->bagian;
				$a['format_penomoran']=$data[0]->format_penomoran;
				$a['kode_surat']=$data[0]->kode_surat;
				$a['uraian']=$data[0]->uraian;
				$a['act']='update';
				$a['title']	= "Edit Penomoran Surat Keluar";
				$this->load->view('admin/referensi/act_penomoran', $a);
			}
			if ($act=='hapus'){
				$id = $this->encrypt->decode(base64_decode($enc));
				$this->referensi->hapus_penomoran($id);
				redirect('Referensi/penomoran/','refresh');
			}
		}

	}

	function insert_penomoran_surat_keluar(){
		$format_penomoran= $this->input->post('format_penomoran');
		$bagian= $this->input->post('bagian');
		$kode_surat= $this->input->post('kode_surat');
		$uraian= $this->input->post('uraian');
		$object = array(
				'bagian'=>$bagian,
				'format_penomoran' => $format_penomoran,
				'kode_surat'=>$kode_surat,
				'uraian'=>$uraian,
			);
		$this->db->insert('dix_ref_format_nomor_surat', $object);
		redirect('Referensi/penomoran/','refresh');
	}

	function update_penomoran_surat_keluar(){
		$id = $this->encrypt->decode(base64_decode($this->input->post('enc')));
		$bagian= $this->input->post('bagian');
		$format_penomoran= $this->input->post('format_penomoran');
		$kode_surat= $this->input->post('kode_surat');
		$uraian= $this->input->post('uraian');
		$object = array(
				'bagian'=>$bagian,
				'format_penomoran' => $format_penomoran,
				'kode_surat'=>$kode_surat,
				'uraian'=>$uraian,
			);
		$this->db->where('id', $id);
		$this->db->update('dix_ref_format_nomor_surat', $object);
		redirect('Referensi/penomoran/','refresh');
	}

	function update_penomoran(){
		$format_surat_masuk = $this->input->post('format_surat_masuk');
		$format_surat_keluar= $this->input->post('format_surat_keluar');
		$this->db->query('UPDATE dix_ref_nomor_agenda SET format_nomor_agenda="'.$format_surat_masuk.'" WHERE id=1'); 
		$this->db->query('UPDATE dix_ref_nomor_agenda SET format_nomor_agenda="'.$format_surat_keluar.'" WHERE id=2'); 
		redirect('Referensi/penomoran','refresh');
	}
}
