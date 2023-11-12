<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Validated extends CI_Model{


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


    function error_handle(){
    	echo "DATABASE ERROR, TABLE TIDAK DITEMUKAN";
    	exit();
    }

}