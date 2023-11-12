<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_surat extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	function surat($alur,$surat_id=NULL,$status=NULL){
		$jabatan_id=$this->session->userdata('sess_jabatanid');
		$group_id=$this->session->userdata('sess_idgroup');
		$surat_ditangani=" ";
		try {
			if ($surat_id!=NULL){
				$val=" AND a.surat_id=".$surat_id;
			}else{
				if ($status=="0"){
					$val=" AND a.status_disposisi=0";
				}else{
					$val=" ";
				}
			}
			if($group_id<=2 or $group_id==11 or $group_id==4){
					$surat_ditangani=" ";
			}elseif ($group_id>2 AND $alur!="keluar"){
					$surat_ditangani=" AND (d1.dari=$jabatan_id OR  d1.kepada=$jabatan_id) ";				
			}


			if ($alur=="keluar"){
				$select=",eks.nama as ekspedisi_nama";
				$join="LEFT JOIN ctr_ekspedisi as eks ON a.ekspedisi=eks.id";
			}else{
				$select="";
				$join="";
			}
			
			$sql =  "SELECT a.*".$select.",b.sifat_id, b.nama,b.kode,d1.dari,d1.kepada,(c.jabatan) AS dari_nama,(e.jabatan) AS kepada_nama, l.id AS ordner_id,l.nama AS nama_bundle, sl.tgl_ordner 
					FROM ctr_surat_".$alur. " as a
					LEFT JOIN ctr_disposisi AS d1 ON a.surat_id=d1.surat_id
					LEFT JOIN ctr_disposisi AS d2 ON a.surat_id=d2.surat_id AND d2.id > d1.id
					LEFT JOIN ctr_sifat_surat AS b ON a.sifat_id=b.sifat_id 
					LEFT JOIN ctr_jabatan AS c ON d1.dari=c.id
					LEFT JOIN ctr_jabatan AS e ON d1.kepada=e.id
					LEFT JOIN ctr_surat_ordner AS sl ON a.surat_id=sl.surat_id
					LEFT JOIN ctr_ordner AS l ON sl.ordner_id=l.id
					".$join."
					WHERE d2.id IS NULL
					".$surat_ditangani."
					$val ORDER BY a.surat_id DESC";

			//echo $sql;exit();
			return $this->db->query($sql);
		} catch (Exception $e) {
			return false;
		}
	}
	function surat_baru($alur,$surat_id=NULL,$status=NULL){
		$jabatan_id=$this->session->userdata('sess_jabatanid');
		$group_id=$this->session->userdata('sess_idgroup');
		$surat_ditangani=" ";
		try {
			if ($surat_id!=NULL){
				$val=" AND a.surat_id=".$surat_id;
			}else{
				if ($status=="0"){
					$val=" AND a.status_disposisi=0";
				}else{
					$val=" ";
				}
			}
			if($group_id<=2 or $group_id==11 or $group_id==4){
					$surat_ditangani=" ";
			}elseif ($group_id>2 AND $alur!="keluar"){
					$surat_ditangani=" AND (d1.dari=$jabatan_id OR  d1.kepada=$jabatan_id) ";				
			}


			if ($alur=="keluar"){
				$select=",eks.nama as ekspedisi_nama";
				$join="LEFT JOIN ctr_ekspedisi as eks ON a.ekspedisi=eks.id";
			}else{
				$select="";
				$join="";
			}
			
			$sql =  "SELECT a.*".$select.",b.sifat_id, b.nama,k.kategori,b.kode,d1.dari,d1.kepada,f.jabatan,(c.jabatan) AS dari_nama,(e.jabatan) AS kepada_nama, l.id AS ordner_id,l.nama AS nama_bundle, sl.tgl_ordner 
					FROM ctr_surat_keluar_baru". " as a
					LEFT JOIN ctr_disposisi AS d1 ON a.surat_id=d1.surat_id
					LEFT JOIN ctr_disposisi AS d2 ON a.surat_id=d2.surat_id AND d2.id > d1.id
					LEFT JOIN ctr_sifat_surat AS b ON a.sifat_id=b.sifat_id 
					LEFT JOIN ctr_kategori_surat AS k ON a.kategori_id=k.id_kategori 
					LEFT JOIN format_nomor_surat AS f ON a.format_no_surat_id=f.id 
					LEFT JOIN ctr_jabatan AS c ON d1.dari=c.id
					LEFT JOIN ctr_jabatan AS e ON d1.kepada=e.id
					LEFT JOIN ctr_surat_ordner AS sl ON a.surat_id=sl.surat_id
					LEFT JOIN ctr_ordner AS l ON sl.ordner_id=l.id
					".$join."
					WHERE d2.id IS NULL
					".$surat_ditangani."
					$val ORDER BY a.surat_id DESC";

			//echo $sql;exit();
			return $this->db->query($sql);
		} catch (Exception $e) {
			return false;
		}
	}

	function get_jumlah_surat($jabatan){
		$jumlah = $this->db->query("SELECT COUNT(surat_id) as jumlah FROM ctr_surat_keluar_baru WHERE format_no_surat_id=$jabatan");
		return $jumlah->result();
	}

	function get_jumlah_surat_kategori($jabatan){
		$jumlah = $this->db->query("SELECT COUNT(surat_id) as jumlah FROM ctr_surat_keluar_baru WHERE format_no_surat_id=$jabatan");
		return $jumlah->result();
	}
	function tampil_surat_kategori($kategori){
		$q= $this->db->query("SELECT a.*,k.kategori FROM ctr_surat_keluar_baru as a 
							LEFT JOIN ctr_kategori_surat as k on a.kategori_id=k.id_kategori 
							WHERE kategori_id=$kategori ORDER BY surat_id DESC");
		return $q;
	}



	function harus_disposisi($alur,$surat_id=NULL,$status=NULL){
		$jabatan_id=$this->session->userdata('sess_jabatanid');
		$group_id=$this->session->userdata('sess_idgroup');
		if($group_id<=2){
			$ordisposisi = ' or a.status_disposisi=0 '; 
		}else{
			$ordisposisi = ' '; 
		}
		$surat_ditangani=" ";
		try {

		
			$sql =  "SELECT a.*,b.sifat_id, b.nama,b.kode,d1.dari,d1.kepada,(c.jabatan) AS dari_nama,(e.jabatan) AS kepada_nama, l.id AS ordner_id,l.nama AS nama_bundle, sl.tgl_ordner 
					FROM ctr_surat_".$alur. " as a
					LEFT JOIN (SELECT * FROM ctr_disposisi WHERE (SELECT MAX(kepada) FROM ctr_disposisi)=".$jabatan_id.") AS d1 ON d1.`surat_id`=a.surat_id
					LEFT JOIN ctr_sifat_surat AS b ON a.sifat_id=b.sifat_id 
					LEFT JOIN ctr_jabatan AS c ON d1.dari=c.id
					LEFT JOIN ctr_jabatan AS e ON d1.kepada=e.id
					LEFT JOIN ctr_surat_ordner AS sl ON a.surat_id=sl.surat_id
					LEFT JOIN ctr_ordner AS l ON sl.ordner_id=l.id
					WHERE d1.kepada=".$jabatan_id." AND a.status_diterima=0 AND sifat<>100 ".$ordisposisi." 
					ORDER BY a.surat_id DESC";

			//echo $sql;exit();
			return $this->db->query($sql);
		} catch (Exception $e) {
			return false;
		}
	}


	function belum_disposisi(){
		try {
			return $this->db->query("SELECT surat_id from ctr_surat_masuk where status_disposisi=0");
		} catch (Exception $e) {
			return false;
		}
	}

	function belum_ordner()
	{
		return $this->db->query("SELECT * FROM ctr_surat_masuk AS sm
								 LEFT JOIN ctr_surat_ordner AS sl ON sl.surat_id=sm.surat_id WHERE sl.id IS NULL");
	}

	function buku_tamu()
	{
		return $this->db->query("SELECT * FROM dix_buku_tamu");
	}

	function jumlah_spt()
	{
		return $this->db->query("SELECT * FROM dix_spt");
	}

	function jumlah_ijin()
	{
		return $this->db->query("SELECT * FROM dix_surat_ijin");
	}

	function tampil_ijin_pegawai()
	{
		return $this->db->query("SELECT p.nama,s.id,s.pegawai_id,s.jenis_ijin,s.tgl_permohonan
							FROM dix_surat_ijin AS s
							LEFT JOIN ctr_pegawai AS p
							ON s.pegawai_id=p.id GROUP BY p.id
							ORDER BY p.nama ASC;");
	}

	function get_last_agenda_id($alur=NULL)
	{
		if($alur=="masuk"){
			$q= $this->db->query("SELECT max(surat_id) as last_id FROM ctr_surat_".$alur);
		}else{
			$q= $this->db->query("SELECT max(surat_id) as last_id FROM ctr_surat_keluar_baru");
		}
		return $q->result();
	}
	function get_last_nomor_surat($jabatan=NULL){
		$no = $this->db->query("SELECT no_surat FROM ctr_surat_keluar_baru WHERE surat_id=(SELECT max(surat_id) from ctr_surat_keluar_baru WHERE format_no_surat_id=$jabatan)");
		// print_r($no->result_array());
		$array = $no->result_array();

		if (count($array) > 0) {

			$string = implode($array[0]);
			$last = explode("/",$string);
			$q = $last[0];
		} else {
			$q = 0;
		}

		// print_r($q);
		
		return $q;
	}
	
	function get_sifat_surat($sifat_id=NULL)
	{
		$sifat_id="";
		if ($sifat_id != NULL){
				$q= $this->db->query("SELECT * from ctr_sifat_surat WHERE sifat_id=$sifat_id");
		}else{
				$q= $this->db->query("SELECT * from ctr_sifat_surat");
		}
		return $q;
	}

	function get_jabatan()
	{
		$q= $this->db->query("SELECT * FROM ctr_jabatan ORDER BY urutan ASC");
		return $q;
	}

	function get_disposisi($surat_id=NULL,$disposisi_id=NULL){
		if ($surat_id!=NULL) {
			$where=" WHERE dis.surat_id=".$surat_id;
		}else{
			$where=" ";
		}
		if ($disposisi_id!=NULL) {
			$and=" AND dis.id=".$disposisi_id;
		}else{
			$and=" ";
		}
		$q="SELECT dis.*,jb_dari.jabatan AS dari_nama,jb_kepada.jabatan AS kepada_nama
							FROM ctr_disposisi AS dis
							LEFT JOIN ctr_jabatan AS jb_dari
							ON jb_dari.id=dis.dari
							LEFT JOIN ctr_jabatan AS jb_kepada
							ON jb_kepada.id=dis.kepada ".$where." ".$and;
		return $this->db->query($q);
	}

	function get_sifat_disposisi()
	{
		$q= $this->db->query("SELECT * from ctr_sifat_disposisi");
		return $q;
	}

	function hapus_surat($alur,$id)
	{
		return $this->db->delete('ctr_surat_'.$alur, array('surat_id' => $id));
	}

	function get_tahun($alur)
	{
		return $this->db->query("SELECT DISTINCT(YEAR(tgl_surat)) as tahun FROM ctr_surat_".$alur." ORDER BY tgl_surat DESC");
	}

	function tampil_agenda($alur=NULL,$jenis_cetak=NULL,$mulai=NULL,$sampai=NULL,$bulan=NULL,$tahun=NULL,$sifat_surat=NULL)
	{
		if ($jenis_cetak=='1'){
			$where=" WHERE a.tgl_surat >= '".$mulai."' AND a.tgl_surat <= '".$sampai."'";
		}else if ($jenis_cetak=='2'){
			if($alur=='masuk'){
				$where=" WHERE month(a.tgl_terima) = '".$bulan."' AND year(a.tgl_terima)='".$tahun."'";	
			}elseif($alur=='keluar'){
				$where=" WHERE month(a.tgl_surat) = '".$bulan."' AND year(a.tgl_surat)='".$tahun."'";
			}
			

		}else if ($jenis_cetak=='3'){
			if($alur=='masuk'){
				$where=" WHERE year(a.tgl_terima) = '".$tahun."'";	
			}elseif($alur=='keluar'){
				$where=" WHERE year(a.tgl_surat) = '".$tahun."'";
			}			
		}else if ($jenis_cetak=='4'){
			if($alur=='masuk'){
				$where=" WHERE year(a.tgl_terima) = '".$tahun."' AND a.sifat_id=$sifat_surat ";
			}elseif($alur=='keluar'){
				$where=" WHERE year(a.tgl_surat) = '".$tahun."' AND a.sifat_id=$sifat_surat ";
			}
		}
		return $this->db->query("SELECT a.*, b.sifat_id, b.nama,b.kode FROM ctr_surat_".$alur. " as a
				LEFT JOIN ctr_sifat_surat as b on a.sifat_id=b.sifat_id 
				". $where."  ORDER BY a.surat_id ASC");
	}
	
	function tampil_ordner($surat_id=NULL)
	{
		if ($surat_id!=NULL){
			$where = " WHERE sm.surat_id=".$surat_id;
		}else{
			$where = " ";
		}
		return $this->db->query("SELECT sa.*,l.kode,l.nama,sm.* FROM ctr_surat_ordner AS sa
								LEFT JOIN ctr_ordner AS l ON sa.ordner_id=l.id
								LEFT JOIN ctr_surat_masuk AS sm ON sa.surat_id=sm.surat_id". $where);
	}

	 function home_rekap_surat($alur=NULL,$bulan=NULL){
		if ($bulan!=NULL) {
			if ($bulan=="1"){
				$where=" WHERE MONTH(sm.tgl_surat) = MONTH(NOW())";
			}
		}else{
			$where=" ";
		}
		if ($alur!=NULL) {
			return $this->db->query("SELECT js.*, count(sm.surat_id) AS jumlah FROM ctr_sifat_surat AS js
									LEFT JOIN  ctr_surat_".$alur." AS sm
									ON sm.sifat_id=js.sifat_id
									".$where." GROUP BY sifat_id");
		} else{
			return $this->db->query("SELECT js.*, count(sm.surat_id) AS jumlah FROM ctr_sifat_surat AS js
									LEFT JOIN  ctr_surat_masuk AS sm
									ON sm.sifat_id=js.sifat_id
									".$where." GROUP BY js.sifat_id");
		}
		
	}

	function cek_ref_format_surat($format_id,$kode){
		try{
			if($kode==1){
				$where=" WHERE id=".$format_id;
			}elseif($kode==2){
				$where=" WHERE format_penomoran='".$format_id."'";
			}			
			return $this->db->query("SELECT * FROM dix_ref_format_nomor_surat ".$where);
		}catch (Exception $e) {
			return false;
		}		
	}

	function rekap_surat_keluar_asal(){
		try{					
			return $this->db->query("SELECT s.surat_id FROM ctr_surat_keluar AS s 
						LEFT JOIN dix_ref_format_nomor_surat AS r
						ON s.format_nomor_id=r.id");
		}catch (Exception $e) {
			return false;
		}		
	}

	function rekap_surat_masuk_perbulan(){
		try{
			return $this->db->query("SELECT 
									            bul.blnSurat,bul.thnSurat,
									            (SELECT COUNT(*) FROM ctr_surat_masuk 
									            WHERE LEFT(tgl_terima, 7) = bul.bul_1) AS jumlah_surat
									FROM
									(SELECT DATE_FORMAT(tgl_terima,'%Y-%m') AS bul_1,
									DATE_FORMAT(DATE_SUB(tgl_terima, INTERVAL -1 MONTH),'%Y-%m') AS bul_2, 
									CONCAT(MONTH(tgl_terima)) AS blnSurat, 
									CONCAT(YEAR(tgl_terima)) AS thnSurat
									FROM ctr_surat_masuk WHERE tgl_terima >= DATE_SUB(CURDATE(), 
									INTERVAL 12 MONTH) GROUP BY DATE_FORMAT(tgl_terima,'%Y-%m')) AS bul");
		}catch(Exception $e){
			return false;
		}
	}

	function get_surat_posisi($id){
		try{					
			return $this->db->query("SELECT a.*,f.jabatan FROM ctr_surat_keluar_baru as a
									LEFT JOIN format_nomor_surat as f
									ON a.format_no_surat_id=f.id
									 WHERE format_no_surat_id=$id ORDER BY surat_id DESC");
			// "SELECT * FROM ctr_surat_keluar WHERE format_no_surat_id='$id'"
		}catch (Exception $e) {
			return false;
		}
	}
	function get_format_jabatan(){
		return $this->db->query("SELECT * FROM format_nomor_surat");
	}
}
