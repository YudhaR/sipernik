<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class  Info extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('session');
		if($this->session->userdata('sess_is_logged_in')==FALSE){
    		redirect('login');
		}
	}

	function surat($alur){
		$data['color']="teal";
        if ($alur=="masuk"){
        	$data['title']="Register Surat Masuk";
        	$data['msg']="<ul>
        					<li>Pencatatan Surat Masuk, Disposisi dan Ordner / Box Arsip</li>
        					<li>Untuk Disposisi, Klik 'Belum Disposisi', atau klik menu aksi pilih disposisi</li>
        					<li>Untuk Meghapus, Klik menu aksi pilih Hapus</li>
        					<li>Untuk Pengarsipan / Ordner, klik 'Belum di Box' atau klik menu aksi pilih Simpan di Ordner</li>
        					<li>Untuk menambahkan surat baru, klik tombol 'Tambah Surat'</li>
        					<li>Tombol 'Cetak Agenda' : cetak agenda surat</li>
        					</ul>";
        }elseif ($alur=="keluar"){
        	$data['title']="Register Surat Keluar";
        	$data['msg']="<ul>
        					<li>Pencatatan Surat Keluar</li>
        					<li>Untuk melihat detil surat klik menu aksi pilih Detil</li>
        					<li>Untuk Meghapus, Klik menu aksi pilih Hapus</li>
        					<li>Untuk menambahkan surat baru, klik tombol 'Tambah Surat'</li>
        					<li>Tombol 'Cetak Agenda' : cetak agenda surat</li>
        					</ul>";
        }elseif ($alur=="ordner"){
        	$data['title']="Daftar Surat Pada Ordner";
        	$data['msg']="<ul>
        					<li>List ini menampilkan informasi dimana lokasi surat tersimpan pada box / ordner</li>
        					<li>Cara menambahkan adalah buka Menu Persuratan Surat Masuk, kemudian klik menu aksi pilih 'Simpan di Ordner' </li>
        					</ul>";
        }
        $this->load->view('pages/info',$data);
	}

	function system(){
			$data['color']="pink";
			$data['title']="Selamat Datang";
        	$data['msg']="Administrator :<br>
        				  <ul>
        				  	<li>Pastikan Seluruh Referensi sudah diinput sebelum menggunakan aplikasi.</li>
        				  	<li>Referensi Sifat Surat</li>
        				  	<li>Referensi Sifat Disposisi</li>
        				  	<li>Referensi Sifat Surat</li>
        				  	<li>Format Penomoran</li>
        				  	<li>Box / Ordner</li>
        				  </ul>
        				  Tambah User / Pengguna :
        				  <ol>
        					<li>Isi Referensi Jabatan (Menu System - Referensi Jabatan)</li>
        					<li>Isi Data Pegawai (Menu System - Data Pegawai)</li>
        					<li>Buat username dan password untuk masing-masing pegawai / pengguna (Menu System - User / Pengguna)</li>
        				  </ol>
        				  Untuk merubah logo dan nama instansi
        				  <ol>
        					<li>Klik Menu System - Profil Instansi</li>
        					<li>Format logo yang bisa digunakan adalah JPG atau PNG</li>
        					<li>Pastikan logout dan login kembali setelah melakukan perubahan</li>
        				  </ol>
                          <ul>
                            <li><a class='btn btn-primary' href='".base_url()."upload/manual.pdf' target='_blanl'>Klik disini untuk download Manual Book</a></li>
                          <ul>";
			$this->load->view('pages/info',$data);
	}

    function user(){
            $data['color']="red";
            $data['title']="USER PENGGUNA";
            $data['msg']="Kewenangan :<br>
                          <ul>
                            <li>Administrator/Ketua/Wakil/Umum/Subbag. Kepegawaian & Ortala : Bisa merubah edit, tambah dan hapus</li>
                            <li>Panitera / Sekretaris / Subbag. Umum dan Keuangan / Subbag. Perencanaan, TI, & Pelaporan: Bisa menghapus dan disposisi</li>
                            <li>Pegawai / Ruangan : hanya bisa konfirmasi surat jika sudah menerima</li>
                          </ul>";
            $this->load->view('pages/info',$data);
    }
}
