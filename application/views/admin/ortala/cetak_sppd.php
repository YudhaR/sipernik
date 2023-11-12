<?php
$url = base_url("resources/template/hal_depan_sppd.rtf");

$Template = file_get_contents($url);

if(!empty($data_spt)){
	foreach ($data_spt as $spt) {
		$keperluan = $spt->keperluan;
		$sejak = $this->tanggalhelper->convertKeTglIndo($spt->mulai).' s.d '.$this->tanggalhelper->convertKeTglIndo($spt->selesai);
		$kembali = $this->tanggalhelper->convertKeTglIndo($spt->selesai);
		$berangkat = $this->tanggalhelper->convertKeTglIndo($spt->berangkat);
		$kendaraan = $spt->berkendaraan;
		$tujuan = $spt->pergi_ke;
		$mulai = $spt->mulai;
		$sampai = $spt->selesai;
	}		
}
if(!empty($data_pegawai)){
	foreach ($data_pegawai as $row) {
		$nama = $row->nama;
		$nip = $row->nip;
		$pangkat = $row->pangkat;
		$golongan = $row->golongan;	
		$jabatan_id = $row->jabatan_id;		
		$nama_jabatan = $row->jabatan_nama;
	}
}

$hari_ini = $this->tanggalhelper->convertKeTglIndo(date("Y-m-d",time()));
$bln = date("m",time());
$thn = date("Y",time());
$jml_hari = $this->tanggalhelper->getSelisihHari($mulai,$sampai)+1;

$Template = str_replace('#nama#',''.$nama.'',$Template);
$Template = str_replace('#nip#',''.$nip.'',$Template);
$Template = str_replace('#pangkat#',''.$pangkat.'',$Template);
$Template = str_replace('#golongan#',''.$golongan.'',$Template);
$Template = str_replace('#nama_jabatan#',''.$nama_jabatan.'',$Template);
$Template = str_replace('#berangkat#',''.$berangkat.'',$Template);
$Template = str_replace('#keperluan#',''.$keperluan.'',$Template);
$Template = str_replace('#sejak#',''.$sejak.'',$Template);
$Template = str_replace('#kembali#',''.$kembali.'',$Template);
$Template = str_replace('#kendaraan#',''.$kendaraan.'',$Template);
$Template = str_replace('#tujuan#',''.$tujuan.'',$Template);
$Template = str_replace('#hari_ini#',''.$hari_ini.'',$Template);
$Template = str_replace('#bln#',''.$bln.'',$Template);
$Template = str_replace('#thn#',''.$thn.'',$Template);
$Template = str_replace('#jml_hari#',''.$jml_hari.'',$Template);

header("Content-Type: application/vnd.ms-word");
header("Expires: 0");
header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
header("Content-disposition: attachment; filename=SPPD.rtf");
echo $Template;
?> 