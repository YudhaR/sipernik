<?php
if($jenis_ijin==1){
	$url = base_url("resources/template/permohonan_tidak_masuk.rtf");	
}elseif($jenis_ijin==2){
	$url = base_url("resources/template/permohonan_cuti_sakit.rtf");	
}elseif($jenis_ijin==3){
	$url = base_url("resources/template/permohonan_cuti_tahunan.rtf");	
}elseif($jenis_ijin==4){
	$url = base_url("resources/template/permohonan_cuti_besar.rtf");	
}elseif($jenis_ijin==5){
	$url = base_url("resources/template/permohonan_cuti_bersalin.rtf");	
}elseif($jenis_ijin==6){
	$url = base_url("resources/template/permohonan_cuti_alasan_p.rtf");	
}


$Template = file_get_contents($url);

if(!empty($data_cuti)){
	foreach ($data_cuti as $cuti) {		
		$tgl_permohonan = $this->tanggalhelper->convertKeTglIndo($cuti->tgl_permohonan);
		$sejak = $this->tanggalhelper->convertKeTglIndo($cuti->mulai_ijin).' s.d '.$this->tanggalhelper->convertKeTglIndo($cuti->selesai_ijin);		
		$mulai = $this->tanggalhelper->convertKeTglIndo($cuti->mulai_ijin);
		$sampai = $this->tanggalhelper->convertKeTglIndo($cuti->selesai_ijin);
		$dari = $cuti->mulai_ijin;
		$ke = $cuti->selesai_ijin;
		$nama = $cuti->nama;
		$nip = $cuti->nip;
		$pangkat = $cuti->pangkat;
		$golongan = $cuti->golongan;			
		$nama_jabatan = $cuti->jabatan_nama;
		$alamat = $cuti->alamat;
		$alasan_cuti = $cuti->alasan_cuti;
	}		
}else{
	$alasan_cuti = '....................';
	$alamat = '.....................';
}

if(!empty($data_satker)){
	foreach ($data_satker as $row) {
		$nama_satker = $this->tanggalhelper->standradnaming($row->nama);
		$nama_kota = $row->kota;
	}
}

$jml_cuti = $this->db->query("CALL JumlahHari ('".$dari."','".$ke."')")->result();

$thn = date("Y",time());
$jml_hari = $jml_cuti[0]->iHariKerja;
$terbilang = $this->tanggalhelper->Terbilang($jml_hari);

$Template = str_replace('#tgl_permohonan#',''.$tgl_permohonan.'',$Template);
$Template = str_replace('#nama_satker#',''.$nama_satker.'',$Template);
$Template = str_replace('#nama_kota#',''.$nama_kota.'',$Template);
$Template = str_replace('#nama#',''.$nama.'',$Template);
$Template = str_replace('#nip#',''.$nip.'',$Template);
$Template = str_replace('#pangkat#',''.$pangkat.'',$Template);
$Template = str_replace('#golongan#',''.$golongan.'',$Template);
$Template = str_replace('#jabatan#',''.$nama_jabatan.'',$Template);
$Template = str_replace('#thn#',''.$thn.'',$Template);
$Template = str_replace('#jml_hari#',''.$jml_hari.'',$Template);
$Template = str_replace('#tanggal_cuti#',''.$sejak.'',$Template);
$Template = str_replace('#alamat#',''.$alamat.'',$Template);
$Template = str_replace('#bilangan#',''.$terbilang.'',$Template);
$Template = str_replace('#mulai#',''.$mulai.'',$Template);
$Template = str_replace('#sampai#',''.$sampai.'',$Template);
$Template = str_replace('#alasan_cuti#',''.$alasan_cuti.'',$Template);


header("Content-Type: application/vnd.ms-word");
header("Expires: 0");
header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
header("Content-disposition: attachment; filename=Permohonan_Cuti.rtf");
echo $Template;
?> 