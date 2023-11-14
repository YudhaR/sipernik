<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_referensi extends CI_Model {

	 function tampil_user()
	{
		return $this->db->query("SELECT b.name AS kewenangan,b.level, a.* FROM sys_users AS a
								 LEFT JOIN sys_groups AS b ON a.groupid=b.groupid");
	}

	function ref_ordner($id_ordner=NULL)
	{
		$where="";
		if ($id_ordner!=NULL){
			$where=" WHERE id=$id_ordner";
		}
		return $this->db->query("SELECT * from  ctr_ordner".$where);
	}

	function tampil_ordner($id_ordner=NULL)
	{
		$where="";
		if ($id_ordner!=NULL){
			$where=" WHERE l.id=$id_ordner";
		}
		$sql="SELECT sl.*,l.kode,l.nama,sm.* FROM ctr_surat_ordner AS sl
								LEFT JOIN ctr_ordner AS l ON sl.ordner_id=l.id
								LEFT JOIN ctr_surat_masuk AS sm ON sl.surat_id=sm.surat_id
								".$where;
		return $this->db->query($sql);
	}

	 function belum_ordner()
	{
		return $this->db->query("SELECT * FROM ctr_surat_masuk AS sm
								 LEFT JOIN ctr_surat_ordner AS sl ON sl.surat_id=sm.surat_id WHERE sl.id IS NULL");
	}
	 function tampil_jenis()
	{
		return $this->db->get('ctr_jenis_surat');
	}
	 function tampil_sifat()
	{
		return $this->db->get('ctr_sifat_surat');
	}
	 function tampil_kategori()
	{
		return $this->db->get('ctr_kategori_surat');
	}
	 function tampil_jenis_surat_masuk()
	{
		return $this->db->get('ctr_jenis_surat_masuk');
	}
	 function tampil_status_surat()
	{
		return $this->db->get('ctr_status_surat');
	}

	 function tampil_sifat_disposisi()
	{
		return $this->db->get('ctr_sifat_disposisi');
	}

	 function konfigurasi_instansi()
	{
		return $this->db->get('sys_config');
	}

	 function tampil_jabatan()
	{
		return $this->db->get('ctr_jabatan');
	}

	function tampil_pegawai($id=NULL)
	{
		$val=" ";
		if ($id!=NULL) {
				$val="  WHERE a.id=$id";
		}
		return $this->db->query("SELECT a.*,b.jabatan FROM ctr_pegawai  as a
								 LEFT JOIN ctr_jabatan as b on a.jabatan_id=b.id ".$val. " ORDER BY b.id");
	}

	 function hapus_jenis_surat($id)
	{
		return $this->db->delete('ctr_jenis_surat', array('jenis_id' => $id));
	}
	 function hapus_sifat_surat($id)
	{
		return $this->db->delete('ctr_sifat_surat', array('sifat_id' => $id));
	}
	function hapus_kategori($id)
	{
		return $this->db->delete('ctr_kategori_surat', array('id_kategori' => $id));
	}
	function hapus_jenis_surat_masuk($id)
	{
		return $this->db->delete('ctr_jenis_surat_masuk', array('id_jenis_surat_masuk' => $id));
	}
	function hapus_status_surat($id)
	{
		return $this->db->delete('ctr_status_surat', array('id_status_surat' => $id));
	}
	 function hapus_jabatan($id)
	{
		return $this->db->delete('ctr_jabatan', array('id' => $id));
	}
	 function hapus_ordner($id)
	{
		return $this->db->delete('ctr_ordner', array('id' => $id));
	}
	 function hapus_surat_ordner($id)
	{
		return $this->db->delete('ctr_surat_ordner', array('id' => $id));
	}
	 function hapus_user($id)
	{
		return $this->db->delete('sys_users', array('userid' => $id));
	}
	 function hapus_pegawai($id)
	{
		return $this->db->delete('ctr_pegawai', array('id' => $id));
	}
	 function hapus_penomoran($id)
	{
		return $this->db->delete('dix_ref_format_nomor_surat', array('id' => $id));
	}
	 function hapus_sifat_disposisi($id)
	{
		return $this->db->delete('ctr_sifat_disposisi', array('id' => $id));
	}

	function tampil_penomoran($id=NULL)
	{
		$val=" ";
		if ($id!=NULL) {
				$val="  WHERE id=$id";
		}
		return $this->db->query("SELECT * from dix_ref_nomor_agenda ".$val);
	}

	function tampil_penomoran_surat_keluar($id=NULL)
	{
		$val=" ";
		if ($id!=NULL) {
				$val="  WHERE id=$id";
		}
		return $this->db->query("SELECT *,CASE 
 	  								  	  	WHEN bagian=1 THEN 'Kepegawaian'
   	  								  		WHEN bagian=2 THEN 'Umum dan Keuangan'
   	  								  		WHEN bagian=3 THEN 'Perencaan/IT/Pelaporan'
   	  								  		WHEN bagian=4 THEN 'Pidana'
   	  								  		WHEN bagian=5 THEN 'Perdata'
   	  								  		WHEN bagian=6 THEN 'Hukum'
   	  								  		WHEN bagian IS NULL THEN 'Umum'
   	  									END AS bagian_text
										  from dix_ref_format_nomor_surat ".$val." ORDER BY bagian");
	}

	function tampil_agenda($id)
	{
		return $this->db->query("SELECT format_nomor_agenda from dix_ref_nomor_agenda WHERE id=$id");
	}
	

}
