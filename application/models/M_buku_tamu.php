<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_buku_tamu extends CI_Model {

	function tampilkan_data_buku($id=NULL)
	{
		$val=" ";
		if ($id!=NULL) {
				$val="  WHERE a.id=$id";
		}
		return $this->db->query("SELECT a.*,b.jabatan AS bagian FROM dix_buku_tamu  as a
								 LEFT JOIN ctr_jabatan as b on a.tujuan_id=b.id ".$val. " ORDER BY b.id");
	}	

	
	function hapus_buku_tamu($id)
	{
		return $this->db->delete('dix_buku_tamu', array('id' => $id));
	}	 
	

}
