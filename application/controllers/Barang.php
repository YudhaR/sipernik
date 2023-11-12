<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class  Barang extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_barang','barang');
		$this->load->model('M_surat','persuratan');
		$this->load->library('session');
		if($this->session->userdata('sess_is_logged_in')==FALSE){
    		redirect('login');
		}
	}

	function barang($act=NULL,$enc=NULL){
        if ($act==NULL) {
			$a['data']	= $this->barang->tampil_barang()->result_object();
			$a['page']	= "admin/barang/barang";
			$a['title']	= "TABEL BARANG";
			$this->load->vars($a);
			$data['harus_disposisi']=$this->persuratan->harus_disposisi('masuk')->num_rows();
			$data['belum_disposisi']=$this->persuratan->belum_disposisi()->num_rows();
			$this->load->view('pages/pages');
		}else{
			if ($act=='edit') {
				$id=$this->encrypt->decode(base64_decode($enc));
				$data	= $this->db->get_where('ctr_barang',array('id'=>$id))->result_object();
				
				$a['enc']=base64_encode($this->encrypt->encode($data[0]->id));
				$a['kode_barang']=$data[0]->kode_barang;
				$a['uraian']=$data[0]->uraian;
				$a['satuan']=$data[0]->satuan;
				$a['act']='update';
				$a['title']	= "Edit Barang";
				$this->load->vars($a);
				$this->load->view('admin/barang/act_barang');
			}
			if ($act=='tambah'){
				$a['enc']="";
				$a['kode_barang']="";
				$a['uraian']="";
				$a['satuan']="";
				$a['act']='insert';
				$a['title']	= "Tambah Barang";
				$this->load->vars($a);
				$this->load->view('admin/barang/act_barang');
			}
			if ($act=='hapus'){
				$id = $this->encrypt->decode(base64_decode($enc));
				$this->db->where('id', $id);
				$this->db->delete('ctr_barang'); 
				redirect('Barang/barang/','refresh');
			}
		}
	}

	function stok($act=NULL,$enc=NULL,$enc_act=NULL){
		if ($act=='detil') {
			$id=$this->encrypt->decode(base64_decode($enc));
			$barang= $this->barang->tampil_barang($id)->result_object();
			$stok	= $this->barang->tampil_stok($id)->result_object();
			$a['data']=$stok;
			$a['enc']=base64_encode($this->encrypt->encode($barang[0]->id));
			$a['enc_kode_barang']=base64_encode($this->encrypt->encode($barang[0]->kode_barang));
			$a['satuan']=$barang[0]->satuan;
			$a['act']='detil';
			$a['page']	= "admin/barang/detil_stok";
			$a['title']	= "DETIL TRANSAKSI <br> Nama Barang : ".strtoupper($barang[0]->uraian);
			$this->load->vars($a);
			$data['harus_disposisi']=$this->persuratan->harus_disposisi('masuk')->num_rows();
			$data['belum_disposisi']=$this->persuratan->belum_disposisi()->num_rows();
			$this->load->view('pages/pages');
		}

		if ($act=='tambah'){
			$kode_barang=$this->encrypt->decode(base64_decode($enc_act));
			$data	= $this->db->get_where('ctr_barang',array('kode_barang'=>$kode_barang))->result_object();
			$a['enc']=$enc;
			$a['enc_act']=$enc_act;
			$a['kode_barang']=$data[0]->kode_barang;
			$a['jumlah']=intval($data[0]->jumlah);
			$a['tambah_stok']='';
			$a['act']='insert';
			$a['title']	= "Tambah Stok Barang";
			$this->load->vars($a);
			$this->load->view('admin/barang/act_stok');
		}

		if ($act=='edit') {
			$id_transaksi=$this->encrypt->decode(base64_decode($enc_act));
			$id_barang=$this->encrypt->decode(base64_decode($enc));
			$data	= $this->db->get_where('ctr_transaksi_barang',array('id'=>$id_transaksi))->result_object();
			$barang= $this->barang->tampil_barang($id_barang)->result_object();
			$a['enc']=$enc;
			$a['enc_act']=$enc_act;
			$a['kode_barang']=$data[0]->kode_barang;
			$a['tgl_transaksi']=$data[0]->tgl_transaksi;
			$a['jumlah']=$barang[0]->jumlah;
			$a['tambah_stok']=$data[0]->jumlah;
			$a['act']='update';
			$a['title']	= "Edit Stok Barang ";
			$this->load->vars($a);
			$this->load->view('admin/barang/act_stok');
		}
		
		if ($act=='hapus'){
			$id = $this->encrypt->decode(base64_decode($enc_act));
			$this->db->where('id', $id);
			$this->db->delete('ctr_transaksi_barang'); 
			redirect('Barang/stok/detil/'.$enc,'refresh');
		}
	}
	function permintaan_seluruh_ruangan($act=NULL){
			$a['data']	= $this->barang->tampil_permintaan("","","",'jabatan_id,tgl_permintaan')->result_object();
			$a['page']	= "admin/barang/permintaan_seluruh_ruangan";
			$a['title']	= "DAFTAR PERMINTAAN BARANG SELURUH RUANGAN";
			$this->load->vars($a);
			$data['harus_disposisi']=$this->persuratan->harus_disposisi('masuk')->num_rows();
			$data['belum_disposisi']=$this->persuratan->belum_disposisi()->num_rows();
			$this->load->view('pages/pages');
	}
	function permintaan($act=NULL,$enc=NULL,$enc_tgl=NULL){
        if ($act==NULL) {
        	$group_id=$this->session->userdata('sess_idgroup');
			$jabatan_id=$this->session->userdata('sess_jabatanid');
			if ($group_id<2){
				$this->permintaan_seluruh_ruangan();
			}else{
				$a['data']	= $this->barang->tampil_permintaan($jabatan_id)->result_object();
				$a['page']	= "admin/barang/permintaan";
				$a['title']	= "DAFTAR PERMINTAAN BARANG";
				$this->load->vars($a);
				$data['harus_disposisi']=$this->persuratan->harus_disposisi('masuk')->num_rows();
				$data['belum_disposisi']=$this->persuratan->belum_disposisi()->num_rows();
				$this->load->view('pages/pages');
			}
		}else{
			if ($act=='edit') {
				$id=$this->encrypt->decode(base64_decode($enc));
				$a['barang']=$this->db->get('ctr_barang')->result_object();
				$data	= $this->db->get_where('ctr_permintaan_barang',array('id'=>$id))->result_object();
				$a['enc']=base64_encode($this->encrypt->encode($data[0]->id));
				$a['user']=$this->db->get('ctr_jabatan')->result_object();
				$a['jabatan_id']=$data[0]->jabatan_id;
				$a['tgl_permintaan']=$this->tanggalhelper->convertToInputDate($data[0]->tgl_permintaan);
				$a['kode_barang']=$data[0]->kode_barang;
				$a['jumlah_diminta']=$data[0]->jumlah_diminta;
				$a['jumlah_diberikan']=$data[0]->jumlah_diberikan;
				$a['act']='update';
				$a['title']	= "Edit Permintaan Barang";
				$this->load->vars($a);
				$this->load->view('admin/barang/act_permintaan');
			}else if ($act=='tambah'){
				$a['enc']="";
				$a['kode_barang']="";
				$a['barang']=$this->db->get('ctr_barang')->result_object();
				$a['user']=$this->db->get('ctr_jabatan')->result_object();
				$a['jabatan_id']="";
				$a['tgl_permintaan']=date('d/m/Y');
				$a['jumlah_diminta']="";
				$a['jumlah_diberikan']="";
				$a['act']='insert';
				$a['title']	= "Tambah Permintaan Barang";
				$this->load->vars($a);
				$this->load->view('admin/barang/act_permintaan');
			}else if ($act=='hapus'){
				$id=$this->encrypt->decode(base64_decode($enc));
				$this->db->where('id', $id);
				$this->db->delete('ctr_permintaan_barang'); 
				redirect('Barang/permintaan/','refresh');
			}else if ($act=='detil'){
				$tgl_where="";
				if ($enc_tgl!=NULL){
					$tgl_where=$this->encrypt->decode(base64_decode($enc_tgl));
				}
				$jabatan_id=$this->encrypt->decode(base64_decode($enc));
				$a['data']	= $this->barang->tampil_permintaan($jabatan_id,$tgl_where)->result_object();
				$a['page']	= "admin/barang/permintaan";
				$a['title']	= "DETIL PERMINTAAN BARANG";
				$this->load->vars($a);
				$data['harus_disposisi']=$this->persuratan->harus_disposisi('masuk')->num_rows();
				$data['belum_disposisi']=$this->persuratan->belum_disposisi()->num_rows();
				$this->load->view('pages/pages');
			}else if ($act=='preview'){
				$tgl_where="";
				if ($enc_tgl!=NULL){
					$tgl_where=$this->encrypt->decode(base64_decode($enc_tgl));
				}
				$jabatan_id=$this->encrypt->decode(base64_decode($enc));
				$a['data']	= $this->barang->tampil_permintaan($jabatan_id,$tgl_where)->result_object();
				$a['page']	= "admin/barang/preview_permintaan";
				$a['title']	= "DETIL PERMINTAAN BARANG";
				$this->load->vars($a);
				$data['harus_disposisi']=$this->persuratan->harus_disposisi('masuk')->num_rows();
				$data['belum_disposisi']=$this->persuratan->belum_disposisi()->num_rows();
				$this->load->view('pages/pages');

			}
		}
	}

	function insert_barang(){
			$kode_barang= $this->input->post('kode_barang');
			$uraian= $this->input->post('uraian');
			$satuan= $this->input->post('satuan');
			$this->form_validation->set_rules('kode_barang', 'Kode Barang', 'trim|required|is_unique[ctr_barang.kode_barang]');
			if($this->form_validation->run() == FALSE){
			 	//
			}
			$object = array(
						'kode_barang' => $kode_barang,
						'uraian' => $uraian,
						'satuan' => $satuan,
					);
			$query=$this->db->insert('ctr_barang', $object);
			redirect('Barang/barang','refresh');
	}

	function update_barang(){
        $id = $this->encrypt->decode(base64_decode($this->input->post('enc')));
        $kode_barang= $this->input->post('kode_barang');
		$uraian= $this->input->post('uraian');
		$satuan= $this->input->post('satuan');
		$object = array(
				'kode_barang' => $kode_barang,
				'uraian' => $uraian,
				'satuan' => $satuan,
			);
		$this->db->where('id', $id);
		$this->db->update('ctr_barang', $object); 
		redirect('Barang/barang','refresh');
	}

	function insert_stok(){
		 	$enc=$this->input->post('enc');
		 	$kode_barang =$this->input->post('kode_barang');
			$tgl_transaksi= $this->tanggalhelper->convertToMysqlDate($this->input->post('tgl_transaksi',TRUE));
			$stok_terakhir= $this->input->post('stok_terakhir');
			$jumlah= $this->input->post('tambah_stok');
			$object = array(
					'kode_barang' => $kode_barang,
					'tgl_transaksi' => $tgl_transaksi,
					'jumlah' => $jumlah,
				);
			$this->db->insert('ctr_transaksi_barang', $object);
			$this->db->where('kode_barang',$kode_barang);
			$object=array('jumlah'=>intval($jumlah)+intval($stok_terakhir));
			$this->db->update('ctr_barang',$object);
			redirect('Barang/stok/detil/'.$enc,'refresh');
	}

	function update_stok(){
			$id_barang=$this->encrypt->decode(base64_decode($this->input->post('enc')));
		 	$id_transaksi=$this->encrypt->decode(base64_decode($this->input->post('enc_act')));
		 	$data_transaksi = $this->db->get_where('ctr_transaksi_barang',array('id'=>$id_transaksi))->result_object();
		 	$jumlah_sebelumnya=$data_transaksi[0]->jumlah;
		 	$kode_barang =$this->input->post('kode_barang');
			$tgl_transaksi= $tgl_terima=$this->tanggalhelper->convertToMysqlDate($this->input->post('tgl_transaksi',TRUE));
			$stok_terakhir= intval($this->input->post('stok_terakhir'))-intval($jumlah_sebelumnya);
			$jumlah= $this->input->post('tambah_stok');
			$object = array(
					'kode_barang' => $kode_barang,
					'tgl_transaksi' => $tgl_transaksi,
					'jumlah' => $jumlah,
				);
			$this->db->where('id',$id_transaksi);
			$this->db->update('ctr_transaksi_barang', $object);
			$this->db->where('kode_barang',$kode_barang);
			$object=array('jumlah'=>intval($jumlah)+intval($stok_terakhir));
			$this->db->update('ctr_barang',$object);
			redirect('Barang/stok/detil/'.$this->input->post('enc'),'refresh');
	}


	function insert_permintaan(){
			$jabatan_id= $this->input->post('jabatan');
			if ($group_id=$this->session->userdata('sess_idgroup')>=2) {
				$jabatan_id=$this->session->userdata('sess_jabatanid');
			}
			$kode_barang= $this->input->post('kode_barang');
			$tgl_permintaan= $this->tanggalhelper->convertToMysqlDate($this->input->post('tgl_permintaan',TRUE));
			$jumlah_diminta= $this->input->post('jumlah_diminta');
			$object = array(
						'jabatan_id'=>$jabatan_id,
						'kode_barang'=>$kode_barang,
						'tgl_permintaan'=>$tgl_permintaan,
						'jumlah_diminta'=>$jumlah_diminta
					);
			$query=$this->db->insert('ctr_permintaan_barang', $object);
			redirect('Barang/permintaan','refresh');
	}

	function update_permintaan(){
			$jabatan_id= $this->input->post('jabatan');
			if ($group_id=$this->session->userdata('sess_idgroup')>=2) {
				$jabatan_id=$this->session->userdata('sess_jabatanid');
			}
			$kode_barang= $this->input->post('kode_barang');
			$tgl_permintaan= $this->tanggalhelper->convertToMysqlDate($this->input->post('tgl_permintaan',TRUE));
			$jumlah_diminta= $this->input->post('jumlah_diminta');
			$jumlah_diberikan= $this->input->post('jumlah_diberikan');
			$object = array(
						'jabatan_id'=>$jabatan_id,
						'kode_barang'=>$kode_barang,
						'tgl_permintaan'=>$tgl_permintaan,
						'jumlah_diminta'=>$jumlah_diminta,
						'jumlah_diberikan'=>$jumlah_diberikan
					);
			$id=$this->encrypt->decode(base64_decode($this->input->post('enc')));
			$this->db->where('id',$id);
			$query=$this->db->update('ctr_permintaan_barang', $object);
			redirect('Barang/permintaan','refresh');
	}
}
