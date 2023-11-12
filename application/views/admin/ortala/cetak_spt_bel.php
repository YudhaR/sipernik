<?php
$url = base_url("resources/template/hal_bel_sppd.rtf");
$Template = file_get_contents($url);
$Template = str_replace('#cocok#','cocok',$Template);
header("Content-Type: application/vnd.ms-word");
header("Expires: 0");
header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
header("Content-disposition: attachment; filename=SPT.rtf");
echo $Template;
?> 