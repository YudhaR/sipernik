<?php
$url = base_url("resources/template/spt.rtf");

$Template = file_get_contents($url);

if(!empty($data_ttd)){
	foreach ($data_ttd as $row) {
		$nama_ttd = $row->nama;
		$nip_ttd = $row->nip;
		$pangkat_ttd = $row->pangkat;
		$gol_ttd = $row->golongan;
		if($row->jabatan_id==1){
			$jabatan_ttd = 'Ketua';
		}elseif($row->jabatan_id==2){
			$jabatan_ttd = 'Wakil';			
		}elseif($row->jabatan_id==3){
			$jabatan_ttd = 'Panitera';			
		}elseif($row->jabatan_id==4){
			$jabatan_ttd = 'Sekretaris';			
		}
	}
}else{
	$nama_ttd = '...............';
	$nip_ttd = '...............';
	$pangkat_ttd = '...............';
	$gol_ttd = '...............';	
	$jabatan_ttd = '..................';
}

$Template = str_replace('#namattd#',''.$nama_ttd.'',$Template);
$Template = str_replace('#nipttd#',''.$nip_ttd.'',$Template);
$Template = str_replace('#pangkatttd#',''.$pangkat_ttd.'',$Template);
$Template = str_replace('#golttd#',''.$gol_ttd.'',$Template);
$Template = str_replace('#jabatanttd#',''.$jabatan_ttd.'',$Template);

if(!empty($data_spt)){
	foreach ($data_spt as $spt) {
		$nomor_surat = $spt->nomor_surat;
		$tgl_surat = $this->tanggalhelper->convertKeTglIndo($spt->tanggal_surat);
		$keperluan = $spt->keperluan;
		$sejak = $this->tanggalhelper->convertKeTglIndo($spt->mulai).' s.d '.$this->tanggalhelper->convertKeTglIndo($spt->selesai);
		$id_pegawai = $spt->pegawai_id;
		$berangkat = $this->tanggalhelper->convertKeTglIndo($spt->berangkat);
		$kendaraan = $spt->berkendaraan;
		$tujuan = $spt->pergi_ke;
	}
	$f_pegawai = $this->db->query("SELECT * FROM ctr_pegawai WHERE id IN ($id_pegawai);")->result();
	$i=1;
	$pegawai = '';
	foreach ($f_pegawai as $row) {
		$nama = $row->nama;
		$nip = $row->nip;
		$pangkat = $row->pangkat;
		$golongan = $row->golongan;
		$pegawai .= '\li0\ri0 {'.$i.'\cell '.$nama.'\cell '.$nip.'\cell '.$pangkat.'\cell '.$golongan.'\cell}{\row}';	
		$i++;	
	}
}




$Template = str_replace('#nomor_surat#',''.$nomor_surat.'',$Template);
$Template = str_replace('#tgl_surat#',''.$tgl_surat.'',$Template);
$Template = str_replace('#berangkat#',''.$berangkat.'',$Template);
$Template = str_replace('#keperluan#',''.$keperluan.'',$Template);
$Template = str_replace('#sejak#',''.$sejak.'',$Template);
$Template = str_replace('#kendaraan#',''.$kendaraan.'',$Template);
$Template = str_replace('#tujuan#',''.$tujuan.'',$Template);
$Template = str_replace('#data_pegawai#',''.$pegawai.'',$Template);

header("Content-Type: application/vnd.ms-word");
header("Expires: 0");
header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
header("Content-disposition: attachment; filename=SPT.rtf");
echo $Template;
?> 