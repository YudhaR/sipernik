<?php
if($this->session->userdata('is_logged_in')===FALSE){
			redirect('login');
}

$url = base_url("resources/template/".$filename.".rtf");

$Template = file_get_contents($url);
$Template = str_replace("#nomor#",' '.$no_surat.' ',$Template);
$Template = str_replace("#tgl_surat#",' '.$tgl_surat.' ',$Template);
$Template = str_replace("#lampiran#",' '.$lampiran.' ',$Template);
$Template = str_replace("#perihal#",' '.$perihal.' ',$Template);
$Template = str_replace("#kepada#",' '.$kepada.' ',$Template);
$Template = str_replace("#isi_surat#",' '.$isi_surat.' ',$Template);
$Template = str_replace("#tanda_tangan#",' '.$tanda_tangan.' ',$Template);
$Template = str_replace("#tembusan#",' '.$tembusan.' ',$Template);

header("Content-Type: application/vnd.ms-word");
header("Expires: 0");
header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
header("Content-disposition: attachment; filename=\"".$filename.".rtf\"");
echo $Template;
?>