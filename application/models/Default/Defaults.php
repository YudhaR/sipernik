<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Defaults extends CI_Model{
	
	function get_user($username){
		try{
			$this->db->select('id_user,username,password');
			$this->db->where('username',$username);
			return $this->db->get('user');
		} catch (Exception $e){
			return false;
		}
	}
	
	function getSystemInfo(){
		try {
            if($this->db=='xxx'){
                show_error('Database belum disetting.');
            }
			$this->db->select('*');
			return $this->db->get('sys_config');
		} catch (Exception $e) {
			log_message('error', $e);
		}
	}
	function is_logged_in(){
		try {
			$this->db->where('userid',$this->session->userdata('userid'));
			$this->db->where('session_id',$this->session->userdata('session_id'));
			$this->db->where('host_address',$this->session->userdata('host_address'));
			$query = $this->db->get('sys_user_online');
			if($query->num_rows()<1){
				redirect("logout");
			}
		} catch (Exception $e) {
		}
	}
}
?>