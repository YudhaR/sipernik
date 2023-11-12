<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_kepegawaian extends CI_Model {

	function tampilkan_data_spt($id=NULL)
	{
		$val=" ";
		if ($id!=NULL) {
				$val="  WHERE a.id=$id";
		}
		return $this->db->query("SELECT 
								  a.*,
								  b.nama 
								FROM
								  dix_spt AS a 
								  LEFT JOIN ctr_pegawai AS b 
								    ON a.pegawai_id = b.id ".$val."
								ORDER BY a.id DESC ");
	}	

	function tampilkan_surat_ijin($id=NULL)
	{
		$val=" ";
		if ($id!=NULL) {
				$val="  WHERE s.id=$id";
		}		
		return $this->db->query("SELECT s.*, p.nama,
								CASE 
								  WHEN diijinkan=1 THEN 'Disetujui'
								  WHEN diijinkan=2 THEN 'Tidak Disetujui'
								  WHEN diijinkan IS NULL THEN 'Blm Ada Persetujuan'
								END AS status,
								CASE 
								  WHEN diijinkan=1 THEN 'class=col-green'
								  WHEN diijinkan=2 THEN 'class=col-orange'
								  WHEN diijinkan IS NULL THEN 'class=col-red'
								END AS clasnya,
								CASE 
								  WHEN jenis_ijin=1 THEN 'Ijin Tidak Masuk'
								  WHEN jenis_ijin=2 THEN 'Cuti Sakit'
								  WHEN jenis_ijin=3 THEN 'Cuti Tahunan'
								  WHEN jenis_ijin=4 THEN 'Cuti Besar'
								  WHEN jenis_ijin=5 THEN 'Cuti Bersalin'
								  WHEN jenis_ijin=6 THEN 'Cuti Karena Alasan Penting'
								  WHEN jenis_ijin=7 THEN 'Dinas Luar'
								END AS jenis_ijin_nama 
								FROM dix_surat_ijin AS s
								LEFT JOIN ctr_pegawai AS p
								ON s.pegawai_id=p.id ".$val."
								ORDER BY s.id DESC ");
	}

	function get_data_pegawai($id){
		try {			
			$query = $this->db->query("SELECT id FROM ctr_pegawai WHERE id IN (".$id.");");			
			return $query->result_array();
		} catch (Exception $e) {
			return '';
		}
	}

	function get_ttd(){
		return $this->db->query("SELECT cp.id,cp.nama,cj.jabatan FROM ctr_pegawai AS cp
								LEFT JOIN ctr_jabatan AS cj
								ON cp.jabatan_id=cj.id
								WHERE cj.id IN (1,2,3,4)");
	}

	function hapus_spt($id)
	{
		return $this->db->delete('dix_spt', array('id' => $id));
	}	 
	function hapus_ijin($id)
	{
		return $this->db->delete('dix_surat_ijin', array('id' => $id));
	}	 
	
	function ambil_data_spt($id){
		return $this->db->query("SELECT * FROM dix_spt WHERE id=$id;");
	}

	function ambil_data_pegawai($id){
		return $this->db->query("SELECT * FROM ctr_pegawai WHERE id=$id;");
	}

	function ambil_pegawai_sppd($id){
		return $this->db->query("SELECT * FROM ctr_pegawai WHERE id IN (".$id.");");
	}

	function ambil_data_cuti($id){		
		return $this->db->query("SELECT 
								  s.jenis_ijin,s.tgl_permohonan,s.mulai_ijin,s.selesai_ijin,s.keterangan AS alasan_cuti,s.diijinkan,s.tgl_diijinkan,
								  p.nama,p.nip,p.pangkat,p.golongan,p.jabatan_nama,p.alamat
								FROM
								  dix_surat_ijin AS s 
								  LEFT JOIN ctr_pegawai AS p 
								    ON s.pegawai_id = p.id 
								WHERE s.id =$id;");
	}

	function data_kartu_cuti($pegawai_id){		
		return $this->db->query("SELECT 
								CASE 
								  WHEN s.jenis_ijin=1 THEN 'Ijin Tidak Masuk'
								  WHEN s.jenis_ijin=2 THEN 'Cuti Sakit'
								  WHEN s.jenis_ijin=3 THEN 'Cuti Tahunan'
								  WHEN s.jenis_ijin=4 THEN 'Cuti Besar'
								  WHEN s.jenis_ijin=5 THEN 'Cuti Bersalin'
								  WHEN s.jenis_ijin=6 THEN 'Cuti Karena Alasan Penting'
								  WHEN s.jenis_ijin=7 THEN 'Dinas Luar'
								END AS jenis_ijin_nama,
								  s.nomor_surat,s.tgl_diijinkan,s.mulai_ijin,s.selesai_ijin,s.diijinkan,
								  p.nama,p.nip,p.pangkat,p.golongan,p.jabatan_nama,p.alamat
								FROM
								  dix_surat_ijin AS s 
								  LEFT JOIN ctr_pegawai AS p 
								    ON s.pegawai_id = p.id 
								WHERE s.pegawai_id =$pegawai_id AND s.diijinkan=1;");
	}

	function konfigurasi_instansi()
	{
		return $this->db->get('sys_config');
	}	

	function ambil_format_surat($id){
		return $this->db->query("SELECT format_penomoran FROM dix_ref_format_nomor_surat WHERE id=$id;");
	}

	function nomor_last(){
		return $this->db->query("SELECT MAX(nomor_urut_surat) as last_nmr FROM dix_surat_ijin;");
	}

}
