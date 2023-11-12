<?php
if($this->session->userdata('is_logged_in')===FALSE){
            redirect('login');
}
$url = base_url("resources/template/agenda.rtf");
$Template = file_get_contents($url);


//-=======================



//=========================

header("Content-Type: application/vnd.ms-word");
header("Expires: 0");
header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
header("Content-disposition: attachment; filename=agenda.rtf");
echo $Template;

?>