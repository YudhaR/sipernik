<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_barang extends CI_Model {
	function tampil_barang($id=NULL)
	{
		$val=" ";
		if ($id!=NULL){
			$val=" WHERE id=$id";
		}
		return $this->db->query("SELECT * FROM ctr_barang ".$val);
	}

	function tampil_stok($id=NULL)
	{
		$val=" ";
		if ($id!=NULL){
			$val=" WHERE b.id=$id";
		}
		return $this->db->query("SELECT sb.id,b.kode_barang,b.uraian,sb.jumlah,sb.tgl_transaksi, IF (sb.jenis=1,'Tambah','Keluar') as jenis
								 from ctr_barang b
								 right join ctr_transaksi_barang sb
								 on b.kode_barang=sb.kode_barang".$val);
	}

	function tampil_permintaan($jabatan_id=NULL,$tgl_permintaan=NULL,$order_by=NULL,$group_by=NULL)
	{
		$val=" ";
		$val_group=" ";
		$where=" ";
		if ($jabatan_id!=NULL){
			if ($tgl_permintaan!=NULL){
				$where=" WHERE a.jabatan_id=$jabatan_id AND a.tgl_permintaan='".$tgl_permintaan."'";
			}else{
				$where=" WHERE a.jabatan_id=$jabatan_id";
			}
		}else{
			if ($tgl_permintaan!=NULL){
				$where=" WHERE a.tgl_permintaan='".$tgl_permintaan."'";
			}
		}

		if ($group_by!=NULL){
			$val_group=" GROUP BY a.".$group_by;
		}
		if ($order_by!=NULL){
			$val_order=" ORDER BY a.".$order_by;
		}else{
			$val_order=" ORDER BY a.tgl_permintaan DESC";
		}
		
		$sql="SELECT a.*,b.jabatan,c.uraian
								 FROM ctr_permintaan_barang as a
								 LEFT JOIN ctr_jabatan as b on a.jabatan_id=b.id
								 LEFT JOIN ctr_barang as c on a.kode_barang=c.kode_barang ".$where." ".$val_group." ".$val_order;
		return $this->db->query($sql);
	}

}
