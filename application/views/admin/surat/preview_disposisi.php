<style type="text/css">
  .modal-dialog{
    width: 60%;
  }
  table {border: solid 2px #000; border-collapse: collapse; width: 100%;padding:20px;}
  tr { border:none;}
  td { padding: 7px 5px}
  h3 { margin-top: 5px;margin-left: 80px; font-weight: bold;font-size: 25px;}
  h3 span{ font-weight: normal;font-size: 30px;}
  h2 { margin-bottom: 0px }
  .dot{
    width: 90%;
    border-bottom: 1px dotted #444;
  }
  img.blackwhite { 
    -webkit-filter: grayscale(100%);
    filter: grayscale(100%);
    position: absolute;
    margin-right: 50px;
  }

  @media print {
  body * {
    visibility: hidden;
    margin: -5px;
  }
  @page {
      size: auto; 
      margin: 0;  
  }
  .modal-dialog{
    width: 98%;
  }
  #div_print * {
    visibility: visible;
  }
  .qr_code{
    width: 100px;
    height: 100px;
  } 
  #div_print{
    font-size: 140%;
    width: 96%;
    position: absolute;
    left: 50px;
    top: 50px;
  }
    table {border: solid 2px #000; border-collapse: collapse; width: 96%;padding:20px;}
    tr { border:none;}
    td { padding: 7px 5px}
    h3 { margin-top: 5px;font-weight: bold;font-size: 25px;}
    h3 span{ font-weight: normal;font-size: 30px;}
    h2 { margin-bottom: 0px }
    .dot{
      width: 90%;
      border-bottom: 1px dotted #444;
    }
  }
</style>
<div class="header text-center">
  <h3 class="box-title">
    <a onClick='document.title = "<?php echo "disposisi_surat_" ?>";window.print();' class="btn bg-cyan  btn-small waves-effect"><i class="fa fa-print"> </i> Cetak</a>
  </h3>
</div>
<div id="div_print">
    <table>
      <col width="25%">
      <col width="20%">
      <col width="30%">
      <col width="25%">
      <tbody>
      <tr>
          <td colspan="4" align="center">
              <div style="display: flex; align-items: center;">
                  <img src="<?php echo base_url('resources/img/logo-ma.jpg'); ?>" alt="Logo Image" style="width: 120px; margin-left:3rem; margin-right: 3rem;">
                  <div>
                      <b style="font-size: 20px;">MAHKAMAH AGUNG REPUBLIK INDONESIA<br>DIREKTORAT JENDERAL BADAN PERADILAN MILITER<br>DAN PERADILAN TATA USAHA NEGARA<br>PENGADILAN TINGGI TATA USAHA NEGARA MANADO<br>PENGADILAN TATA USAHA NEGARA GORONTALO</b><br>
                      <span>Jalan Prof. Dr. Aloei Saboe, Desa Toto Selatan, Kecamatan Kabila<br>Kabupaten Bone Bolango, Gorontalo 96128, www.ptun-gorontalo.go.id, info@ptun-gorontalo.go.id</span>
                  </div>
              </div>
          </td>
      </tr>
        <tr >
            <td colspan="4" align="center" style="border-top: solid 2px; font-size: 20px;"><b>LEMBAR DISPOSISI</b></td>
        </tr>
        <tr >
            <td colspan="4" align="center" style="border-top: solid 2px; font-size: 15px;"><b>PERHATIAN : Dilarang memisahkan sehelai Naskah Dinas pun yang tergabung dalam berkas ini.</b></td>
        </tr>
        <tr>
        <tr style="border-top: 2px solid;  border-right: 2px solid; border-left: 2px solid; border-bottom: none;">
           <td style="width: 40%; border-top: 2px solid;  border-right: 2px solid; border-left: 2px solid; border-bottom: none;" valign="top">&nbsp <b>Nomor Naskah Dinas</b>&nbsp&nbsp&nbsp&nbsp: <?= $no_surat;?></td>
           <td style="width: 25%; border-top: 2px solid;  border-right: 2px solid; border-left: 2px solid; border-bottom: none;" valign="top">&nbsp<b>Status</b>&nbsp&nbsp:  <?= $status;?></td>
           <td colspan="2" valign="top" style="width: 35%;border-top: 2px solid;  border-right: 2px solid; border-left: 2px solid; border-bottom: none;">&nbsp<b>Diterima Tanggal</b>&nbsp: <?= $tgl_terima_kirim;?></td>
        </tr>
        <tr style="border-top: none;  border-right: 2px solid; border-left: 2px solid; border-bottom: none;">
           <td style="width: 40%; border-top: none;  border-right: 2px solid; border-left: 2px solid; border-bottom: none;" valign="top">&nbsp <b>Tanggal Naskah Dinas</b>&nbsp&nbsp: <?= $tgl_surat;?></td>
           <td style="width: 25%; border-top: none;  border-right: 2px solid; border-left: 2px solid; border-bottom: none;" valign="top">&nbsp<b>Sifat</b>&nbsp&nbsp&nbsp&nbsp&nbsp:  <?= $nama;?></td>
           <td colspan="2" valign="top" style="width: 35%;border-top: none;  border-right: 2px solid; border-left: 2px solid; border-bottom: none;">&nbsp<b>Nomor Agenda</b>&nbsp&nbsp&nbsp&nbsp: <?= $no_agenda;?></td>
        </tr>
        <tr style="border-top: none;  border-right: 2px solid; border-left: 2px solid; border-bottom: none;">
           <td style="width: 40%; border-top: none;  border-right: 2px solid; border-left: 2px solid; border-bottom: none;" valign="top">&nbsp <b>Lampiran</b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: </td>
           <td style="width: 25%; border-top: none;  border-right: 2px solid; border-left: 2px solid; border-bottom: none;" valign="top">&nbsp<b>Jenis</b>&nbsp&nbsp&nbsp&nbsp:  <?= $jenis;?></td>
        </tr>
        <tr >
            <td colspan="4" style="border-top: solid 2px; font-size: 15px;">&nbsp<b>Dari</b>&nbsp&nbsp&nbsp&nbsp: <?= $pengirim;?></td>
        </tr>
        <tr >
            <td colspan="4" style="border-top: none; font-size: 15px;">&nbsp<b>Hal</b>&nbsp&nbsp&nbsp&nbsp&nbsp: <?= $perihal;?></td>
        </tr>
        <tr>
            <td colspan="1" align="center" style="width: 50%; border: solid 2px; font-size: 15px;">
              <img src="<?php echo base_url('resources/img/unceklis.png'); ?>" alt="Unceklis Image" style="width: 30px; vertical-align: middle;">
              <b>Sangat Segera</b>
            </td>
            <td colspan="3" align="center" style="width: 50%; border: solid 2px; font-size: 15px;">
              <img src="<?php echo base_url('resources/img/unceklis.png'); ?>" alt="Unceklis Image" style="width: 30px; vertical-align: middle;">
              <b>Segera</b>
            </td>
        </tr>
        <tr>
            <td colspan="1"valign="top" style="width: 50%;border-top: solid 2px; border-left: solid 2px;border-bottom: solid 2px;border-right: none;font-size: 15px;">
              &nbsp<b><u>DISPOSISI KEPADA:</u></b><br><br>
              <?php if(isset($data)){ 
                foreach ($data as $val) {
                  echo '<img src="' . base_url('resources/img/unceklis.png') . '" alt="Unceklis Image" style="width: 30px; vertical-align: middle;">';
                  echo '<u>Dari : ' . $val->dari_nama . ' kepada : ' . $val->kepada_nama . ' </u><br>';
                  echo '<div style=" margin-left: 30px;">';
                  echo 'Tanggal : ' . tgl_indo($val->tgl_disposisi) . '<br>' . $val->isi_disposisi . '<br>';
                  echo '</div>';
                }
              } ;?>
              &nbsp<b><u>CATATAN:</u></b><br><br>
                  <div style="margin-left: 30px;">
                      <?= $catatan; ?><br>
                  </div>
            </td>
            <td colspan="3" valign="top" style="width: 50%;border-top: solid 2px; border-left: none;border-bottom: solid 2px;border-right: solid 2px; font-size: 15px;">
              &nbsp<b><u>PETUNJUK:</u></b><br>
              <?php if (isset($petunjuk)) {
                  foreach ($petunjuk as $val) {
                      $imgSrc = ($val->nama == $petunjukterakhir) ? base_url('resources/img/ceklis.png') : base_url('resources/img/unceklis.png');
                      echo '<img src="' . $imgSrc . '" alt="Ceklis Image" style="width: 30px; vertical-align: middle;">';
                      echo $val->nama;
                      echo '<br>';
                  }
              };?>
            </td>
        </tr>
        <tr style="border-top: 2px solid;  border-right: 2px solid; border-left: 2px solid; border-bottom: none;">
           <td colspan="1" style="width: 50%; border-top: 2px solid;  border-right: 2px solid; border-left: 2px solid; border-bottom: none;" valign="top">&nbsp<b>Tanggal Kirim untuk Proses </b> : <?= $tgl_disposisi; ?></td>
           <td colspan="3" style="width: 50%; border-top: 2px solid;  border-right: 2px solid; border-left: 2px solid; border-bottom: none;" valign="top">&nbsp<b>Diterima Oleh</b> :</td>
        </tr>
        <tr style="border-top: none;  border-right: 2px solid; border-left: 2px solid; border-bottom: 2px solid;">
           <td colspan="1" style="width: 50%; border-top: none;  border-right: 2px solid; border-left: 2px solid; border-bottom:2px solid;" valign="top">&nbsp<b>Diajukan Kembali Tanggal </b>:</td>
           <td colspan="3" style="width: 50%; border-top: none;  border-right: 2px solid; border-left: 2px solid; border-bottom: 2px solid;" valign="top">&nbsp<b>Diterima Tanggal</b> :</td>
        </tr>
        <tr style="border-top: 2px solid;  border-right: 2px solid; border-left: 2px solid; border-bottom: none;">
           <td colspan="1" style="width: 50%; border-top: 2px solid;  border-right: 2px solid; border-left: 2px solid; border-bottom: none;" valign="top">&nbsp<b>Tanggal Kembali untuk Proses  </b> : </td>
           <td colspan="3" style="width: 50%; border-top: 2px solid;  border-right: 2px solid; border-left: 2px solid; border-bottom: none;" valign="top">&nbsp<b>Tanggal selesai dari Pejabat yang memberi diposisi </b>:</td>
        </tr>
        <tr style="border-top: none;  border-right: 2px solid; border-left: 2px solid; border-bottom: 2px solid;">
           <td colspan="1" style="width: 50%; border-top: none;  border-right: 2px solid; border-left: 2px solid; border-bottom:2px solid;" valign="top">&nbsp<b>Diterima Oleh</b> :</td>
        </tr>
      </tbody>
    </table>
</div>