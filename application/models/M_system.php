<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_system extends CI_Model {

	function tampil_user($id=NULL)
	{
		if ($id!=NULL){
			$and=" AND a.userid=".$id;
		}else{
			$and="";
		}
		return $this->db->query("SELECT b.name AS kewenangan,b.level, a.* FROM sys_users AS a
								 LEFT JOIN sys_groups AS b ON a.groupid=b.groupid WHERE a.userid>='0'".$and);
	}
	

	function konfigurasi_instansi()
	{
		return $this->db->get('sys_config');
	}

	function get_user_online()
	{
		return $this->db->query("SELECT su.groupid,su.userid, sp.*
								 FROM sys_user_online AS suo
									LEFT JOIN sys_users AS su ON suo.userid=su.userid
									LEFT JOIN ctr_pegawai AS sp ON sp.id=su.pegawai_id");
	}


	function hapus_user($id)
	{
		return $this->db->delete('sys_users', array('userid' => $id));
	}

	function get_list_chat($user_target)
	{
		$user_source=$user_target;
		$user_target=$this->session->userdata('sess_userid');
		return $this->db->query("SELECT c.*,ns.fullname as nama_source,nt.fullname as nama_target
								 FROM  ctr_pesan as c
								 left join sys_users as ns on ns.userid=c.user_source
								 left join sys_users as nt on nt.userid=c.user_target
								 where (c.user_target=$user_target and c.user_source=$user_source) OR (c.user_target=$user_source and c.user_source=$user_target)
								 ORDER BY c.tgl_kirim ASC");
	}

}
