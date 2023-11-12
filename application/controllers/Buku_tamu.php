<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Buku_tamu extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_buku_tamu','buku');
		$this->load->model('M_surat','persuratan');
		$this->load->library('session');
		if($this->session->userdata('sess_is_logged_in')==FALSE){
    		redirect('login');
		}		
	}	
	
	function tamu($act=NULL,$enc=NULL){
        if ($act==NULL) {
        	if ($enc!=NULL){
        		$buku_tamu_id=$this->encrypt->decode(base64_decode($enc));
        	}else{
        		$buku_tamu_id=NULL;
        	}
			$a['data']	= $this->buku->tampilkan_data_buku($buku_tamu_id)->result_object();				
			$a['page']	= "admin/buku_tamu/buku_tamu_v";
			$a['title']	= "Buku Tamu";
			$a['harus_disposisi']=$this->persuratan->harus_disposisi('masuk')->num_rows();
			$a['belum_disposisi']=$this->persuratan->belum_disposisi()->num_rows();
			$this->load->view('pages/pages',$a);
		}else{
			if ($act=='edit') {
				$id=$this->encrypt->decode(base64_decode($enc));
				$data	= $this->buku->tampilkan_data_buku($id)->result_object();
				$a['enc']=$enc;
				$a['tujuan_id']=$data[0]->tujuan_id;
				$a['bagian']=$data[0]->bagian;
				$a['nama']=$data[0]->nama;				
				$a['alamat']=$data[0]->alamat;
				$a['telpon']=$data[0]->telpon;				
				$a['keperluan']=$data[0]->keperluan;
				$a['act']='update';
				$a['title']	= "Edit Buku Tamu";
				$this->load->view('admin/buku_tamu/add_tamu', $a);
			}
			if ($act=='tambah'){
				$a['tujuan_id']='0';
				$a['bagian']='';
				$a['nama']='';				
				$a['alamat']='';
				$a['telpon']='';
				$a['keperluan']='';
				$a['enc']='';
				$a['act']='insert';
				$a['page']	= "add_tamu";
				$a['title']	= "Tambah Buku Tamu";
				$this->load->view('admin/buku_tamu/add_tamu', $a);
			}
			if ($act=='hapus'){
				$id = $this->encrypt->decode(base64_decode($enc));
				$this->buku->hapus_buku_tamu($id);
				redirect('Buku_tamu/tamu/','refresh');
			}
		}
	}	

	function insert_tamu(){
		$tujuan_id = $this->input->post('tujuan_id');
		$nama= $this->input->post('nama');
		$telpon= $this->input->post('telpon');
		$alamat= $this->input->post('alamat');		
		$keperluan= $this->input->post('keperluan');
		$object = array(
				'tujuan_id' => $tujuan_id,
				'nama' => $nama,
				'telpon' => $telpon,
				'alamat' => $alamat,
				'keperluan' => $keperluan,
				'diinput_oleh' => $this->session->userdata('sess_username'),
				'diinput_tanggal' => date("Y-m-d h:i:s",time())
			);
		// print_r($object);exit();		
		$this->db->insert('dix_buku_tamu', $object);
		redirect('Buku_tamu/tamu','refresh');
	}

	function update_tamu(){
        $id = $this->encrypt->decode(base64_decode($this->input->post('enc')));
		$tujuan_id = $this->input->post('tujuan_id');
		$nama= $this->input->post('nama');
		$telpon= $this->input->post('telpon');
		$alamat= $this->input->post('alamat');		
		$keperluan= $this->input->post('keperluan');		
		$object = array(
				'tujuan_id' => $tujuan_id,
				'nama' => $nama,
				'telpon' => $telpon,
				'alamat' => $alamat,
				'keperluan' => $keperluan,
				'diinput_oleh' => $this->session->userdata('sess_username'),
				'diinput_tanggal' => date("Y-m-d h:i:s",time())
					);
		
		$this->db->where('id', $id);
		$this->db->update('dix_buku_tamu', $object); 
		redirect('Buku_tamu/tamu','refresh');
	}

	function hapus_tamu($enc){
		if($this->session->userdata('sess_is_logged_in')==FALSE){
            redirect('login');
        }
        $id = $this->encrypt->decode(base64_decode($enc));
		$this->tamu->hapus_buku_tamu($id);
		redirect('Buku_tamu/tamu','refresh');
	}	

}