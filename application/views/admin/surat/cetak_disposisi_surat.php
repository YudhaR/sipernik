<?php
	$url = base_url("resources/template/temp_cetak_disposisi.rtf");			


$Template = file_get_contents($url);
$catatan1='';
$disposisi_kepada1='';
$petunjuk1='';
if (isset($data)) {
    foreach ($data as $val) {
        $disposisi_kepada1 .= '- Dari : ' . $val->dari_nama . ' kepada : ' . $val->kepada_nama . ' \par \tab Tanggal : ' . tgl_indo($val->tgl_disposisi) . ' \par ' . $val->isi_disposisi . ' \par ';
    }
}

if (isset($data)) {
    foreach ($data as $val) {
        $catatan1 .= '- Dari : ' . $val->dari_nama . ' kepada : ' . $val->kepada_nama . ' \par \tab Catatan : ' . $val->catatan . ' \par \par ';
    }
}

if (isset($petunjuk)) {
    foreach ($petunjuk as $item) {
        $checkbox = '- ';
        foreach ($data as $val1) {
            if ($item->id == $val1->petunjuk) {
                $checkbox = 'X ';
                break;
            }
        }
        $petunjuk1 .= '' . $checkbox .  $item->nama.' \par \par ';
    }
}

$Template = str_replace('#no_surat#',''.$no_surat.'',$Template);
$Template = str_replace('#tgl_surat#',''.$tgl_surat.'',$Template);
$Template = str_replace('#status#',''.$status.'',$Template);
$Template = str_replace('#nama#',''.$nama.'',$Template);
$Template = str_replace('#jenis#',''.$jenis.'',$Template);
$Template = str_replace('#tgl_terima_kirim#',''.$tgl_terima_kirim.'',$Template);
$Template = str_replace('#no_agenda#',''.$no_agenda.'',$Template);
$Template = str_replace('#pengirim#',''.$pengirim.'',$Template);
$Template = str_replace('#perihal#',''.$perihal.'',$Template);
$Template = str_replace('#disposisi_kepada#',''.$disposisi_kepada1.'',$Template);
$Template = str_replace('#catatan#',''.$catatan1.'',$Template);
$Template = str_replace('#petunjuk#',''.$petunjuk1.'',$Template);
// $Template = str_replace('#tgl_disposisi#',''.$tgl_disposisi.'',$Template);


header("Content-Type: application/vnd.ms-word");
header("Expires: 0");
header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
header("Content-disposition: attachment; filename=Surat_Disposisi_".$no_agenda.".rtf");
echo $Template;
?> 