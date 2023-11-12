<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kepegawaian extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_kepegawaian','pegawai');
		$this->load->model('M_surat','persuratan');
		$this->load->library('session');
		if($this->session->userdata('sess_is_logged_in')==FALSE){
    		redirect('login');
		}		
	}	

	function surat_spt($act=NULL,$enc=NULL){
        if ($act==NULL) {
        	if ($enc!=NULL){
        		$spt_id=$this->encrypt->decode(base64_decode($enc));
        	}else{
        		$spt_id=NULL;
        	}
			$a['data']	= $this->pegawai->tampilkan_data_spt($spt_id)->result_object();				
			$a['page']	= "admin/ortala/spt_v";
			$a['title']	= "Surat Perintah Tugas (SPT)";
			$a['harus_disposisi']=$this->persuratan->harus_disposisi('masuk')->num_rows();
			$a['belum_disposisi']=$this->persuratan->belum_disposisi()->num_rows();
			$this->load->view('pages/pages',$a);
		}else{
			if ($act=='edit') {
				$id=$this->encrypt->decode(base64_decode($enc));
				$data	= $this->pegawai->tampilkan_data_spt($id)->result_object();						
				$a['data_pegawai'] = $this->pegawai->get_data_pegawai($data[0]->pegawai_id);
				$a['enc']=$enc;
				$a['pegawai_id']=$data[0]->pegawai_id;
				$a['nomor_surat']=$data[0]->nomor_surat;
				$a['tanggal_surat']=$this->tanggalhelper->convertToInputDate($data[0]->tanggal_surat);			
				$a['pergi_ke']=$data[0]->pergi_ke;
				$a['keperluan']=$data[0]->keperluan;				
				$a['berkendaraan']=$data[0]->berkendaraan;
				$a['berangkat']=$this->tanggalhelper->convertToInputDate($data[0]->berangkat);
				$a['mulai']=$this->tanggalhelper->convertToInputDate($data[0]->mulai);
				$a['selesai']=$this->tanggalhelper->convertToInputDate($data[0]->selesai);
				$a['keterangan']=$data[0]->keterangan;
				$a['act']='update';
				$a['aksi']='edit';
				$a['title']	= "Edit Surat Perintah Tugas (SPT)";			
				$this->load->view('admin/ortala/add_spt', $a);
			}
			if ($act=='tambah'){
				$a['pegawai_id']='0';
				$a['nomor_surat']='';
				$a['tanggal_surat']=date('d/m/Y');			
				$a['pergi_ke']='';
				$a['keperluan']='';	
				$a['berkendaraan']='';
				$a['berangkat']='';
				$a['mulai']='';
				$a['selesai']='';
				$a['keterangan']='';
				$a['enc']='';
				$a['act']='insert';
				$a['aksi']='tambah';
				$a['page']	= "add_spt";
				$a['title']	= "Tambah Surat Perintah Tugas (SPT)";				
				$this->load->view('admin/ortala/add_spt', $a);
			}
			if ($act=='hapus'){
				$id = $this->encrypt->decode(base64_decode($enc));
				$this->pegawai->hapus_spt($id);
				redirect('Kepegawaian/surat_spt/','refresh');
			}
		}
	}	

	function insert_spt(){
		$pegawai_id = $this->input->post('pegawai_id');		
		$pegawai_id_arr 	= implode(',',$pegawai_id);
		$nomor_surat= $this->input->post('nomor_surat');
		$tanggal_surat= $this->tanggalhelper->convertToMysqlDate($this->input->post('tanggal_surat'));		
		$berkendaraan= $this->input->post('berkendaraan');
		$pergi_ke= $this->input->post('pergi_ke');
		$berangkat= $this->tanggalhelper->convertToMysqlDate($this->input->post('berangkat'));
		$mulai= $this->tanggalhelper->convertToMysqlDate($this->input->post('mulai'));
		$selesai= $this->tanggalhelper->convertToMysqlDate($this->input->post('selesai'));
		// $keterangan= $this->input->post('keterangan');
		$keperluan= $this->input->post('keperluan');
		$object = array(
				'pegawai_id' => $pegawai_id_arr,
				'nomor_surat' => $nomor_surat,
				'tanggal_surat' => $tanggal_surat,
				'berkendaraan' => $berkendaraan,
				'pergi_ke' => $pergi_ke,
				'berangkat' => $berangkat,
				'mulai' => $mulai,
				'selesai' => $selesai,
				'keperluan' => $keperluan,
				'diinput_oleh' => $this->session->userdata('sess_username'),
				'diinput_tanggal' => date("Y-m-d h:i:s",time())
			);		
		$this->db->insert('dix_spt', $object);
		redirect('Kepegawaian/surat_spt','refresh');
	}

	function update_spt(){
        $id = $this->encrypt->decode(base64_decode($this->input->post('enc')));
		$pegawai_id = $this->input->post('pegawai_id');		
		$pegawai_id_arr = implode(',',$pegawai_id);
		$nomor_surat= $this->input->post('nomor_surat');
		$tanggal_surat= $this->tanggalhelper->convertToMysqlDate($this->input->post('tanggal_surat'));		
		$berkendaraan= $this->input->post('berkendaraan');
		$pergi_ke= $this->input->post('pergi_ke');
		$berangkat= $this->tanggalhelper->convertToMysqlDate($this->input->post('berangkat'));
		$mulai= $this->tanggalhelper->convertToMysqlDate($this->input->post('mulai'));
		$selesai= $this->tanggalhelper->convertToMysqlDate($this->input->post('selesai'));
		// $keterangan= $this->input->post('keterangan');
		$keperluan= $this->input->post('keperluan');		
		$object = array(
				'pegawai_id' => $pegawai_id_arr,
				'nomor_surat' => $nomor_surat,
				'tanggal_surat' => $tanggal_surat,
				'berkendaraan' => $berkendaraan,
				'pergi_ke' => $pergi_ke,
				'berangkat' => $berangkat,
				'mulai' => $mulai,
				'selesai' => $selesai,
				'keperluan' => $keperluan,
				'diinput_oleh' => $this->session->userdata('sess_username'),
				'diinput_tanggal' => date("Y-m-d h:i:s",time())
			);
		$this->db->where('id', $id);
		$this->db->update('dix_spt', $object); 
		redirect('Kepegawaian/surat_spt','refresh');
	}	

	function popup_cetak_spt($enc_spt){
		$spt_id = $this->encrypt->decode(base64_decode($enc_spt));
		$a['enc_spt'] = $enc_spt;
		$a['ttd'] = $this->pegawai->get_ttd()->result_object();
		$a['title'] = 'CETAK SPT';
		$this->load->view('admin/ortala/popup_cetak_spt', $a);
	}

	function cetak_spt(){
		$spt_id = $this->encrypt->decode(base64_decode($this->input->post('enc_spt')));
		$ttd_id = $this->input->post('pejabat_ttd');
		$a['data_spt'] = $this->pegawai->ambil_data_spt($spt_id)->result_object();
		$a['data_ttd'] = $this->pegawai->ambil_data_pegawai($ttd_id)->result_object();		
		$this->load->view('admin/ortala/cetak_spt', $a);
	}	

	function popup_cetak_sppd($enc_spt){
		$spt_id = $this->encrypt->decode(base64_decode($enc_spt));
		$a['enc_spt'] = $enc_spt;
		$data_spt = $this->pegawai->ambil_data_spt($spt_id)->result_object();
		if(!empty($data_spt)){
			foreach ($data_spt as $spt) {				
				$id_pegawai = $spt->pegawai_id;				
			}					
		}
		$a['pegawai_sppd'] = $this->pegawai->ambil_pegawai_sppd($id_pegawai)->result_object();		
		$a['title'] = 'CETAK HALAMAN DEPAN SPPD';
		$this->load->view('admin/ortala/popup_cetak_sppd', $a);
	}

	function cetak_sppd(){
		$spt_id = $this->encrypt->decode(base64_decode($this->input->post('enc_spt')));
		$pegawai_id = $this->input->post('pegawai');		
		$a['data_spt'] = $this->pegawai->ambil_data_spt($spt_id)->result_object();
		$a['data_pegawai'] = $this->pegawai->ambil_data_pegawai($pegawai_id)->result_object();		
		$this->load->view('admin/ortala/cetak_sppd', $a);
	}

	function cetak_sppd_bel(){
		$this->load->view('admin/ortala/cetak_spt_bel');
	}	

	function surat_ijin($act=NULL,$enc=NULL){
        if ($act==NULL) {
        	if ($enc!=NULL){
        		$surat_id=$this->encrypt->decode(base64_decode($enc));
        	}else{
        		$surat_id=NULL;
        	}
			$a['data']	= $this->pegawai->tampilkan_surat_ijin($surat_id)->result_object();
			$a['page']	= "admin/ortala/ijin_pegawai_v";
			$a['title']	= "Surat Ijin Pegawai".$this->encrypt->decode(base64_decode($enc));;						
			$a['harus_disposisi']=$this->persuratan->harus_disposisi('masuk')->num_rows();
			$a['belum_disposisi']=$this->persuratan->belum_disposisi()->num_rows();
			$this->load->view('pages/pages',$a);
		}else{
			if ($act=='status') {
				$surat_id=$this->encrypt->decode(base64_decode($enc));
				$data	= $this->pegawai->tampilkan_surat_ijin($surat_id)->result_object();
				$nmr_last = $this->pegawai->nomor_last()->result_object();						
				$a['data_pegawai'] = $this->pegawai->get_data_pegawai($data[0]->pegawai_id);
				$a['enc']=$enc;
				$a['pegawai_id']=$data[0]->pegawai_id;
				$a['jenis_ijin']= $data[0]->jenis_ijin;				
				$a['tgl_permohonan']=$this->tanggalhelper->convertDayDate($data[0]->tgl_permohonan);
				$a['mulai_ijin']=$this->tanggalhelper->convertDayDate($data[0]->mulai_ijin);
				$a['selesai_ijin']=$this->tanggalhelper->convertDayDate($data[0]->selesai_ijin);
				$a['diijinkan']=$enc.$data[0]->diijinkan;
				$a['keterangan']=$data[0]->keterangan;				
				$a['jenis_ijin_nama']=$data[0]->jenis_ijin_nama;
				$a['tgl_diijinkan']=!empty($data[0]->tgl_diijinkan)?$this->tanggalhelper->convertToInputDate($data[0]->tgl_diijinkan):date("d/m/Y");
				$a['nomor_urut_surat'] = !empty($data[0]->nomor_urut_surat)?$data[0]->nomor_urut_surat:$nmr_last[0]->last_nmr+1;
				$a['nomor_surat'] = $data[0]->nomor_surat;
				$a['aksi']='status';
				$a['act']='status';
				$a['title']	= "Ubah Status Surat Ijin Pegawai ";
				if($a['jenis_ijin']==1){
					$id_format = 2;
				}else{
					$id_format = 8;
				}
				$format= $this->pegawai->ambil_format_surat($id_format)->result_object();
				$a['format_nomor_surat']=$format[0]->format_penomoran;			
				$this->load->view('admin/ortala/status_surat_ijin', $a);
			}
			if ($act=='edit') {
				$surat_id=$this->encrypt->decode(base64_decode($enc));
				$data	= $this->pegawai->tampilkan_surat_ijin($surat_id)->result_object();						
				$a['data_pegawai'] = $this->pegawai->get_data_pegawai($data[0]->pegawai_id);
				$a['enc']=$enc;
				$a['pegawai_id']=$data[0]->pegawai_id;
				$a['jenis_ijin']= $data[0]->jenis_ijin;				
				$a['tgl_permohonan']=$this->tanggalhelper->convertToInputDate($data[0]->tgl_permohonan);
				$a['mulai_ijin']=$this->tanggalhelper->convertToInputDate($data[0]->mulai_ijin);
				$a['selesai_ijin']=$this->tanggalhelper->convertToInputDate($data[0]->selesai_ijin);
				$a['diijinkan']=$data[0]->diijinkan;
				$a['keterangan']=$data[0]->keterangan;
				$a['jenis_ijin_nama']=$data[0]->jenis_ijin_nama;
				$a['aksi']='edit';				
				$a['act']='update';
				$a['title']	= "Edit Surat Ijin Pegawai";			
				$this->load->view('admin/ortala/add_surat_ijin', $a);
			}
			if ($act=='tambah'){
				$a['pegawai_id']='0';
				$a['jenis_ijin']='';
				$a['tgl_permohonan']=date('d/m/Y');			
				$a['mulai_ijin']='';
				$a['selesai_ijin']='';	
				$a['keterangan']='';
				$a['diijinkan']='';
				$a['jenis_ijin_nama']='';				
				$a['enc']='';
				$a['aksi']='tambah';
				$a['act']='insert';
				$a['title']	= "Tambah Surat Ijin Pegawai";				
				$this->load->view('admin/ortala/add_surat_ijin', $a);
			}
			if ($act=='hapus'){
				$id = $this->encrypt->decode(base64_decode($enc));
				$this->pegawai->hapus_ijin($id);
				redirect('Kepegawaian/surat_ijin/','refresh');
			}			
		}
	}	

	function insert_ijin(){
		$pegawai_id = $this->input->post('pegawai_id');		
		$jenis_ijin= $this->input->post('jenis_ijin');
		$tgl_permohonan= $this->tanggalhelper->convertToMysqlDate($this->input->post('tgl_permohonan'));		
		$mulai_ijin= $this->tanggalhelper->convertToMysqlDate($this->input->post('mulai_ijin'));
		$selesai_ijin= $this->tanggalhelper->convertToMysqlDate($this->input->post('selesai_ijin'));
		$selesai= $this->tanggalhelper->convertToMysqlDate($this->input->post('selesai'));
		$keterangan= $this->input->post('keterangan');
		$object = array(
				'pegawai_id' => $pegawai_id,
				'jenis_ijin' => $jenis_ijin,
				'tgl_permohonan' => $tgl_permohonan,
				'mulai_ijin' => $mulai_ijin,
				'selesai_ijin' => $selesai_ijin,
				'keterangan' => $keterangan,				
				'diinput_oleh' => $this->session->userdata('sess_username'),
				'diinput_tanggal' => date("Y-m-d h:i:s",time())
			);	
		$this->db->insert('dix_surat_ijin', $object);
		redirect('Kepegawaian/surat_ijin','refresh');
	}

	function update_ijin(){
		$id = $this->encrypt->decode(base64_decode($this->input->post('enc')));
        $pegawai_id = $this->input->post('pegawai_id');		
		$jenis_ijin= $this->input->post('jenis_ijin');
		$tgl_permohonan= $this->tanggalhelper->convertToMysqlDate($this->input->post('tgl_permohonan'));		
		$mulai_ijin= $this->tanggalhelper->convertToMysqlDate($this->input->post('mulai_ijin'));
		$selesai_ijin= $this->tanggalhelper->convertToMysqlDate($this->input->post('selesai_ijin'));
		$selesai= $this->tanggalhelper->convertToMysqlDate($this->input->post('selesai'));
		$keterangan= $this->input->post('keterangan');		
		$object = array(
				'pegawai_id' => $pegawai_id,
				'jenis_ijin' => $jenis_ijin,
				'tgl_permohonan' => $tgl_permohonan,
				'mulai_ijin' => $mulai_ijin,
				'selesai_ijin' => $selesai_ijin,
				'keterangan' => $keterangan,				
				'diinput_oleh' => $this->session->userdata('sess_username'),
				'diinput_tanggal' => date("Y-m-d h:i:s",time())
			);
		$this->db->where('id', $id);
		$this->db->update('dix_surat_ijin', $object); 
		redirect('Kepegawaian/surat_ijin','refresh');
	}

	function status_ijin(){
		$id = $this->encrypt->decode(base64_decode($this->input->post('enc')));		
		$diijinkan= $this->input->post('diijinkan');			
		$tgl_diijinkan= $this->tanggalhelper->convertToMysqlDate($this->input->post('tgl_diijinkan'));
		if($diijinkan==1){
			$nomor_urut_surat= $this->input->post('nomor_urut_surat');
			$format_nomor_surat= $this->input->post('format_nomor_surat');			
		}else{
			$nomor_urut_surat= NULL;
			$format_nomor_surat= NULL;
		}
		$object = array(
				'diijinkan' => $diijinkan,
				'tgl_diijinkan' => $tgl_diijinkan,
				'nomor_urut_surat' => $nomor_urut_surat,
				'nomor_surat' => $format_nomor_surat				
			);
		$this->db->where('id', $id);
		$this->db->update('dix_surat_ijin', $object); 
		redirect('Kepegawaian/surat_ijin','refresh');
	}

	function cetak_cuti($enc_ijin,$jenis_ijin){
		$surat_id = $this->encrypt->decode(base64_decode($enc_ijin));
		$a['jenis_ijin'] = $this->encrypt->decode(base64_decode($jenis_ijin));
		$a['data_cuti'] = $this->pegawai->ambil_data_cuti($surat_id)->result_object();		
		$a['data_satker'] = $this->pegawai->konfigurasi_instansi()->result_object();	
		$this->load->view('admin/ortala/cetak_permohonan_cuti', $a);
	}

	function popup_cetak_ijin($enc_surat,$jenis_ijin){
		$a['enc_surat'] = $enc_surat;
		$a['jenis_ijin'] = $jenis_ijin;
		$a['ttd'] = $this->pegawai->get_ttd()->result_object();
		$a['title'] = 'CETAK IJIN CUTI';
		$this->load->view('admin/ortala/popup_cetak_ijin_cuti', $a);
	}

	function cetak_ijin_c(){
		$surat_id = $this->encrypt->decode(base64_decode($this->input->post('enc_surat')));		
		$a['jenis_ijin'] = $this->encrypt->decode(base64_decode($this->input->post('jenis_ijin')));
		$ttd_id = $this->input->post('pejabat_ttd');
		$a['data_cuti'] = $this->pegawai->ambil_data_cuti($surat_id)->result_object();
		$a['data_ttd'] = $this->pegawai->ambil_data_pegawai($ttd_id)->result_object();	
		$a['data_satker'] = $this->pegawai->konfigurasi_instansi()->result_object();	
		$this->load->view('admin/ortala/cetak_ijin_cuti', $a);
	}

	function cetak_kartu_cuti($enc_pegawai){
		$pegawai_id = $this->encrypt->decode(base64_decode($enc_pegawai));
		$a['data_cuti'] = $this->pegawai->data_kartu_cuti($pegawai_id)->result_object();
		// print_r($a['data_cuti']);exit();		
		$a['data_satker'] = $this->pegawai->konfigurasi_instansi()->result_object();	
		$this->load->view('admin/ortala/cetak_kartu_cuti', $a);
	}	

}