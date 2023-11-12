<?php
if($alur=='masuk'){
	$url = base_url("resources/template/buku_agenda_masuk.rtf");		
}else{
	$url = base_url("resources/template/buku_agenda_keluar.rtf");		
}


$Template = file_get_contents($url);
$agenda='';
if(count($data)>0){
	$i=1;
	foreach ($data as $buku) {
		$surat_id = $buku->surat_id;								
		$no_agenda = $buku->no_agenda;
		$no_surat = $buku->no_surat;				
		$tgl_surat = $this->tanggalhelper->convertToInputDate($buku->tgl_surat);
		$pengirim = $this->tanggalhelper->standradnaming($buku->pengirim);
		$untuk = $this->tanggalhelper->standradnaming($buku->untuk);		
		$perihal = $buku->perihal;
		if($alur=='masuk'){
			$agenda .= '\li0\ri0 {'.$surat_id.'\cell '.$no_surat.'\cell '.$tgl_surat.'\cell '.$pengirim.'\cell '.$perihal.'\cell}{\row}';	
		}elseif($alur=='keluar'){
			$agenda .= '\li0\ri0 {'.$surat_id.'\cell '.$no_surat.'\cell '.$tgl_surat.'\cell '.$untuk.'\cell '.$perihal.'\cell}{\row}';
		}		
		$i++;
	}		
}else{
	$agenda .= '\li0\ri0 { - \cell  NIHIL \cell  NIHIL \cell  NIHIL \cell NIHIL \cell}{\row}';	
}

$Template = str_replace('#jenis_surat#',''.$jenis.'',$Template);
$Template = str_replace('#alur#',''.strtoupper($alur).'',$Template);
$Template = str_replace('#agenda#',''.$agenda.'',$Template);


header("Content-Type: application/vnd.ms-word");
header("Expires: 0");
header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
header("Content-disposition: attachment; filename=Buku_Agenda_".$file_name.".rtf");
echo $Template;
?> 