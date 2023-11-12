<?php
$url = base_url("resources/template/kartu_cuti_pegawai.rtf");	

$Template = file_get_contents($url);

if(!empty($data_cuti)){
	$i=1;
	$kartu_cuti='';
	foreach ($data_cuti as $cuti) {					
		$mulai = $this->tanggalhelper->convertKeTglIndo($cuti->mulai_ijin);
		$sampai = $this->tanggalhelper->convertKeTglIndo($cuti->selesai_ijin);		
		$nama = $cuti->nama;
		$nip = $cuti->nip;				
		$nama_ijin = $cuti->jenis_ijin_nama;
		$nomor_surat = $cuti->nomor_surat;
		$tgl_diijinkan = $this->tanggalhelper->convertKeTglIndo($cuti->tgl_diijinkan);		
		$kartu_cuti .= '\li0\ri0 {'.$i.'\cell '.$nama_ijin.'\cell '.$nomor_surat.'\cell '.$tgl_diijinkan.'\cell '.$mulai.'\cell '.$sampai.'\cell \cell \cell}{\row}';
		$i++;
	}		
}

if(!empty($data_satker)){
	foreach ($data_satker as $row) {
		$nama_satker = $this->tanggalhelper->standradnaming($row->nama);		
	}
}

$Template = str_replace('#nama_satker#',''.$nama_satker.'',$Template);
$Template = str_replace('#nama#',''.$nama.'',$Template);
$Template = str_replace('#nip#',''.$nip.'',$Template);
$Template = str_replace('#data_cuti#',''.$kartu_cuti.'',$Template);

header("Content-Type: application/vnd.ms-word");
header("Expires: 0");
header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
header("Content-disposition: attachment; filename=Kartu_Cuti.rtf");
echo $Template;
?> 