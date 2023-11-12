<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Validation_user extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->library('session');
	}
	function validate(){
		$this->db->select('password,userid');
		$this->db->where('username',$this->input->post('username'));
		$query = $this->db->get('sys_users');
		$password = '';
		foreach ($query->result() as $row) {
			$password = $row->password;
			$userid = $row->userid;
		}
		$pass = $this->getPassword();
		if($pass!=false AND !empty($password)){
			if($pass===$password){
				$this->db->select('*');
			    $this->db->from('sys_users AS A');
			    $this->db->join('sys_groups AS C', 'A.groupid = C.groupid', 'left');
			    $this->db->join('sys_user_online AS D', 'D.userid = A.userid', 'left');
			    $this->db->join('ctr_pegawai AS p', 'A.pegawai_id = p.id', 'left');
			    $this->db->where('A.userid',$userid);
			    $result = $this->db->get();
			    foreach ($result->result() as $row) {
			    	if($row->block){
			    		return FALSE;
			    	}
			    	if(!empty($row->user_expired)){
			    		if (strtotime($row->user_expired) < time()) {
			    			# user was expired
			    			return FALSE;
			    		}
			    	}
			    	$data = array(
			    		'sess_fullname' 	 => $row->fullname,
			    		'sess_status' 		 => $row->name,
			    		'sess_username' 	 => $row->username,
			    		'sess_idgroup'		 => $row->groupid,
			    		'sess_level'		 => $row->level,
			    		'sess_jabatanid' 	 => $row->jabatan_id,
			    		'sess_pegawaiid' 	 => $row->pegawai_id,
			    		'sess_foto' 	 	 => $row->foto,
			    		'sess_userid' 	 	 => $userid,
			    		'session_id' 		 => $userid,
			    		'sess_is_logged_in' => TRUE,
			    		'login_time' 		 => date('Y-m-d H:i:s')
			    	);
			    	$this->session->set_userdata($data);
			    	# insert session to db
			    }
			    $this->insertSession();
				return TRUE;
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}

	function arr2md5($arrinput){
	    $hasil='';
	    foreach($arrinput as $val){
	        if($hasil==''){
	            $hasil=md5($val);
	        }
			
	        else {
	            $code=md5($val);
	            for($hit=0;$hit<min(array(strlen($code),strlen($hasil)));$hit++){
	                $hasil[$hit]=chr(ord($hasil[$hit]) ^ ord($code[$hit]));
	            }
	        }
	    }
	    return(md5($hasil));
	}
	
	function getPassword(){
  		$this->db->where('username',$this->input->post('username'));
  		$query = $this->db->get('sys_users');
  		if($query->num_rows() ==1){
  			foreach ($query->result() as $row){
  				$pass = $this->arr2md5(array($row->code_activation, $this->input->post('password')));
  				return $pass;
  			}
  		}else{
  			return false;
  		}  
	}

	function insertSession(){
		$this->load->library('session');
		try {
			$this->db->delete('sys_user_online', array('userid' => $this->session->userdata('sess_userid'))); 
			if ($this->session->userdata('session_id')==NULL){
				$session_id='1';
			}else{
				$session_id=$this->session->userdata('session_id');
			}
			$data = array(
				'session_id' => $session_id,
				'userid' => $this->session->userdata('sess_userid'),
				'host_address' => $this->input->ip_address(),
				'login_time' => date('Y-m-d H:i:s'),
				'user_agent' => $this->agent->browser().' '.$this->agent->version().' '.$this->agent->platform(),
				);
			$this->db->insert('sys_user_online', $data);
			$data = array(
				'last_login' => date('Y-m-d H:i:s'));
			$this->db->where('userid',$this->session->userdata('sess_userid'));
			$this->db->update('sys_users', $data);
			#$this->addLoginHistory();
		} catch (Exception $e) {
			
		}
	}

	function delSession(){
		#$this->addLogoutHistory();
		return $this->db->delete('sys_user_online', array('session_id' => $this->session->userdata('session_id'))); 
	}

	function getAuthorizationForm($groupid){
		if(empty($groupid)){
			echo "ERROR WITH YOUR DATABASES - ERROR CODE: 999";
			exit();
		}
		$sql = "SELECT a.name AS NAME 
				FROM sys_forms AS a 
				LEFT JOIN sys_form_rule AS aa 
				ON a.name=aa.formname 
				WHERE aa.ruleid IS NULL OR aa.ruleid IN ( 
					SELECT a.id FROM 
					sys_group_rule AS g 
					LEFT JOIN sys_rules AS a ON g.ruleid=a.id 
					WHERE g.groupid IN (".$groupid.") GROUP BY a.id )";
		try {
			$query = $this->db->query($sql);
			$data = array();
			foreach ($query->result() as $row) {
				$formName = $row->NAME;
				array_push($data, $row->NAME);
			}
			return $data;
		} catch (Exception $e) {
			log_message('error', $e);
		}
	}

	function getAuthorizationAction($groupid){
		$sql = "SELECT a.code FROM  sys_group_rule AS g 
				LEFT JOIN  sys_rules as a on g.ruleid=a.id 
				WHERE g.groupid in (".$groupid.") 
				GROUP BY a.code ORDER BY a.code";
		try {
			$query = $this->db->query($sql);
			$data = array();
			foreach ($query->result() as $row) {
				array_push($data, $row->code);
			}
			return $data;
		} catch (Exception $e) {
			log_message('error', $e);
		}
	}
	

	function addLoginHistory(){
		try {
			$data = array(
				'userid' => $this->session->userdata('sess_userid'),
				'status' =>1,
				'ipaddress' => $this->input->ip_address(),
				'timestamp' => date('Y-m-d H:i:s'),
				'user_agent' => $this->agent->browser().' '.$this->agent->version().' '.$this->agent->platform(),
			);
			$this->db->insert('sys_login_history',$data);
		} catch (Exception $e) {
			
		}
	}
	function addLogoutHistory(){
		try {
			$data = array(
				'userid' => $this->session->userdata('sess_userid'),
				'status' =>2,
				'ipaddress' => $this->input->ip_address(),
				'timestamp' => date('Y-m-d H:i:s'),
				'user_agent' => $this->agent->browser().' '.$this->agent->version().' '.$this->agent->platform(),
			);
			$this->db->insert('sys_login_history',$data);
		} catch (Exception $e) {
			
		}
	}
}