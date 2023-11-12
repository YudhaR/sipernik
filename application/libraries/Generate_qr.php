<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Generate_qr {


		function qr_code($value=NULL,$nama_file){
			$CI =& get_instance();	
			$CI->load->library('Ci_qr_code');
			if (date("d")<10){
				$tgl=date("Ym").'0'.date("d");
			}else{
				$tgl=date("Ym").date("d");
			}
			$textQR=$nama_file;
			$config['imagedir'] 	= 'tmp/qr_codes/'; 
			$image_name = $textQR.'.png';
			$data['data'] = $textQR;
			$data['level'] ='H';
			$data['size'] = 3;
			$data['savename'] = $config['imagedir'].$image_name;
			
			if ($value!=NULL) {
				$data['data'] = $value;
			}
			$CI->ci_qr_code->generate($data);
			$data['savename'] = $config['imagedir'].$image_name;
			return array(base_url().$config['imagedir'].$image_name,$data['data']);
		}

		function acak_nomor($length) {
		    $result = '';
		    for($i = 0; $i < $length; $i++) {
		        $result .= mt_rand(0, 9);
		    }

		    return $result;
		}


		function acak_character(){
			$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		    $result = '';
		    for ($i = 0; $i < 6; $i++)
		        $result .= $characters[mt_rand(0, 35)];
		     return $result;
		}
}