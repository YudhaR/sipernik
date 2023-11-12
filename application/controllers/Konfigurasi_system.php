<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Konfigurasi_system extends CI_Controller {
	function __construct(){
		parent::__construct(); 
		$this->load->model('M_system','system');
		$this->load->model('M_surat','persuratan'); 
		$this->load->helper('file'); 
		$this->load->helper('directory'); 
		if($this->session->userdata('sess_is_logged_in')==FALSE){
			redirect('login'); 
		} 
		if ($this->session->userdata('sess_idgroup')>=2) {
			$data['page']				= "pages/404"; 
			$this->load->vars($data); 
			$this->load->view('pages/pages'); 
		} 
	} 
	function backup_database($list=NULL){
		if ($list==NULL){
			$data['map'] = directory_map('./upload/backup_database/'); 
			$data['page'] = "pages/backup_database"; 
			$this->load->vars($data); 
			$data['harus_disposisi']=$this->persuratan->harus_disposisi('masuk')->num_rows();
			$data['belum_disposisi']=$this->persuratan->belum_disposisi()->num_rows();
			$this->load->view('pages/pages',$data); 
		}else{
			$this->load->helper('download'); 
			$tanggal=date('dmY-hi'); 
			$namaFile='backup_'.$tanggal . '.sql'; 
			$this->load->dbutil(); 
			$prefs = array('format'      => 'sql', 'filename'    => 'my_db_backup.sql'); 
			$save = 'upload/backup_database/'.$namaFile; 
			write_file($save, $this->dbutil->backup($prefs)); 
			redirect('Konfigurasi_system/backup_database'); 
		} 
	} 
	function restore_db($enc_filename=NULL){
		if ($enc_filename==NULL){
			redirect('Konfigurasi_system/backup_database'); 
		}else{
			$namaFile=$this->encrypt->decode(base64_decode($enc_filename)); 
			$filekonten = 'upload/backup_database/'.$namaFile; 
			$isi_file=file_get_contents($filekonten); 
			$string_query=rtrim($isi_file, '\n;' ); 
			$array_query=explode(';', $string_query); 
			foreach($array_query as $query){
				$this->db->query($query); 
			} 
		} 
	} 
	function konfigurasi_instansi($act=NULL){
		if ($act==NULL) {
			$data	= $this->system->konfigurasi_instansi()->result_object(); 
			if (isset($data)) {
				$a['enc']=base64_encode($this->encrypt->encode($data[0]->id)); 
				$a['nama']=$data[0]->nama; 
				$a['alamat']=$data[0]->alamat;
				$a['nama_kota']=$data[0]->kota;
				$a['kode_pn']=$data[0]->kode_pn; 
				$a['ketua']=$data[0]->ketua; 
				$a['nip']=$data[0]->nip; 
				$a['logo']=$data[0]->logo; 
				$a['versi']	= $data[0]->versi; 
			}else{
				$a['enc']=''; 
				$a['nama']=''; 
				$a['alamat']='';
				$a['nama_kota']='';
				$a['kode_pn']='';  
				$a['ketua']=''; 
				$a['nip']=''; 
				$a['logo']=''; 
				$a['versi']=''; 
			} 
			$a['page']	= "admin/system/konfigurasi_instansi"; 
			$a['title']	= "Konfigurasi Instansi"; 
			$a['harus_disposisi']=$this->persuratan->harus_disposisi('masuk')->num_rows();
			$a['belum_disposisi']=$this->persuratan->belum_disposisi()->num_rows();
			$this->load->view('pages/pages',$a); 
		}else{
			$id = $this->encrypt->decode(base64_decode($this->input->post('enc'))); 
			$nama=$this->input->post('nama'); 
			$alamat=$this->input->post('alamat'); 
			$nama_kota=$this->input->post('nama_kota');
			$kode_pn=$this->input->post('kode_pn');
			$ketua=$this->input->post('ketua'); 
			$nip=$this->input->post('nip'); 
			$config['upload_path'] 		= './upload/logo'; 
			$config['allowed_types'] 	= 'jpg|png'; 
			$config['max_size']			= '10000'; 
			$config['max_width']  		= '3000'; 
			$config['max_height'] 		= '3000'; 
			$this->load->library('upload', $config); 
			$this->upload->initialize($config); 
			$logo=$this->input->post('file_logo'); 
			if ( ! $this->upload->do_upload('file_logo')) {
				$error = array('error' => $this->upload->display_errors()); 
				$object = array('nama' => $nama, 'alamat'=>$alamat,'kota'=>$nama_kota,'kode_pn'=>$kode_pn, 'ketua'=>$ketua, 'nip'=>$nip, ); 
			} else {
				$data_logo = array('upload_data' => $this->upload->data()); 
				$object = array('nama' => $nama, 'alamat'=>$alamat, 'kota'=>$nama_kota,'kode_pn'=>$kode_pn, 'ketua'=>$ketua, 'nip'=>$nip, 'logo'=>$data_logo['upload_data']['file_name']); 
			} 
			$this->db->where('id', $id); 
			$this->db->update('sys_config', $object); 
			redirect('Konfigurasi_system/konfigurasi_instansi/','refresh'); 
		} 
	} 
	function user($act=NULL,$enc=NULL){
		if ($act==NULL) {
			$a['kewenangan']=$this->db->get('sys_groups')->result_object(); 
			$a['data']	= $this->system->tampil_user()->result_object(); 
			$a['page']	= "admin/system/user"; 
			$a['title']	= "Daftar User"; 
			$a['harus_disposisi']=$this->persuratan->harus_disposisi('masuk')->num_rows();
			$a['belum_disposisi']=$this->persuratan->belum_disposisi()->num_rows();
			$this->load->view('pages/pages',$a); 
		}else{
			if ($act=='edit') {
				$id=$this->encrypt->decode(base64_decode($enc)); 
				$a['kewenangan']=$this->db->get('sys_groups')->result_object(); 
				$a['pegawai']=$this->db->get('ctr_pegawai')->result_object(); 
				$data= $this->system->tampil_user($id)->result_object(); 
				$a['data']=$data; 
				$a['enc']=base64_encode($this->encrypt->encode($data[0]->userid)); 
				$a['nip']=$data[0]->nip_nrp; 
				$a['nama']=$data[0]->fullname; 
				$a['username']=$data[0]->username; 
				$a['password']=''; 
				$a['email']=$data[0]->email; 
				$a['act']='update'; 
				$a['title']	= "Edit User"; 
				$this->load->view('admin/system/act_user', $a); 
			} 
			if ($act=='tambah'){
				$a['kewenangan']=$this->db->get('sys_groups')->result_object(); 
				$data= $this->system->tampil_user()->result_object(); 
				$a['pegawai']=$this->db->get('ctr_pegawai')->result_object(); 
				$a['data']=$data; 
				$a['nip']=''; 
				$a['username']=''; 
				$a['password']=''; 
				$a['email']=''; 
				$a['enc']=''; 
				$a['act']='insert'; 
				$a['title']	= "Tambah User"; 
				$this->load->view('admin/system/act_user', $a); 
			} 
			if ($act=='hapus'){
				$id = $this->encrypt->decode(base64_decode($enc)); 
				$this->system->hapus_user($id); 
				redirect('Konfigurasi_system/user/','refresh'); 
			} 
		} 
	} 
	function insert_user(){
		$groupid=$this->input->post('groupid'); 
		$userid=$this->input->post('userid'); 
		$pegawai = $this->db->get_where('ctr_pegawai',array('id'=>$userid))->result_object(); 
		$nip_nrp=$pegawai[0]->nip; 
		$pegawai_id=$pegawai[0]->id; 
		if ($nip_nrp==""){
			$nip_nrp="-"; 
		} 
		$fullname=$pegawai[0]->nama; 
		$email=$pegawai[0]->email; 
		if ($email==""){
			$email="bandaaceh@ptun.org"; 
		} 
		$username=$this->input->post('username'); 
		$code_activation = md5(uniqid()); 
		$password = $this->arr2md5(array($code_activation,$this->input->post('password',TRUE))); 
		$object = array('groupid'=>$groupid, 'pegawai_id'=>$pegawai_id, 'nip_nrp'=>$nip_nrp, 'fullname'=>$fullname, 'username'=>$username, 'password'=>$password, 'code_activation'=>$code_activation, 'email'=>$email ); 
		$this->db->insert('sys_users', $object); 
		redirect('Konfigurasi_system/user/','refresh'); 
	} 
	function update_user(){
		$id = $this->encrypt->decode(base64_decode($this->input->post('enc'))); 
		$groupid=$this->input->post('groupid'); 
		$userid=$this->input->post('userid'); 
		$pegawai = $this->db->get_where('ctr_pegawai',array('id'=>$userid))->result_object(); 
		$pegawai_id=$pegawai[0]->id; 
		$nip_nrp=$pegawai[0]->nip; 
		if ($nip_nrp==""){
			$nip_nrp="-"; 
		} 
		$fullname=$pegawai[0]->nama; 
		$email=$pegawai[0]->email; 
		if ($email==""){
			$email="bandaaceh@ptun.org"; 
		} 
		$username=$this->input->post('username'); 
		$code_activation = md5(uniqid()); 
		$password = $this->arr2md5(array($code_activation,$this->input->post('password',TRUE))); 
		$object = array('groupid'=>$groupid, 'pegawai_id'=>$pegawai_id, 'nip_nrp'=>$nip_nrp, 'fullname'=>$fullname, 'username'=>$username, 'password'=>$password, 'email'=>$email, 'code_activation'=>$code_activation, ); 
		$this->db->where('userid', $id); 
		$this->db->update('sys_users', $object); redirect('Konfigurasi_system/user/','refresh'); 
	} 
	function page_refresh() {
		header('location:'.$SERVER['HTTPREFERER']); 
		flush(); exit(); 
	} 
	function arr2md5($arrinput){
		$hasil=''; 
		foreach($arrinput as $val){
			if($hasil==''){
				$hasil=md5($val); 
			} else {
				$code=md5($val); 
				for($hit=0;$hit<min(array(strlen($code),strlen($hasil)));$hit++){
					$hasil[$hit]=chr(ord($hasil[$hit]) ^ ord($code[$hit])); 
				} 
			} 
		} 
		return(md5($hasil)); 
	} 
}