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
    <div class="qr_code" style="position:absolute;right:20px;top:220px;">
        <div class="card" style="padding:1px">
        <a><img width="100px" src="<?php echo $pictQR;?>"/></a>
        </div>
    </div>
    <table>
      <col width="25%">
      <col width="20%">
      <col width="30%">
      <col width="25%">
      <tbody>
        <tr>
            <td colspan="4" align="center">
              <b style="font-size: 30px;"><?php echo $this->session->userdata('instansi',TRUE) ?></b><br>
              <span><?php echo $this->session->userdata('alamat_instansi',TRUE) ?></span></h3>
            </td>
        </tr>
        <tr >
            <td colspan="4" align="center" style="border-top: solid 2px"><b>LEMBAR DISPOSISI</b></td>
        </tr>
        <tr>
        <tr style="border: solid 2px">
            <td>&nbsp <b>Nomor Agenda :</b></td>
            <td>: <?= $no_agenda;?></span>&nbsp &nbsp</td>
            <td style="border-left: solid 2px">&nbsp <b>Tingkat Keamanan :</b></td>
            <td>: <?= $jenis_surat;?></span>&nbsp &nbsp</td>
        </tr>
        <tr style="border: solid 2px">
            <td>&nbsp <b>Tanggal Penerimaan</b></td>
            <td>: <?= $tgl_terima_kirim;?></span>&nbsp &nbsp</td>
            <td style="border-left: solid 2px">&nbsp <b>Tanggal Penyelesaian :</b></td>
            <td> : </span>&nbsp &nbsp</td>
        </tr>
        <tr>
            <td>&nbsp &nbsp<b>Tanggal dan Nomor Surat</b></td>
            <td colspan="2" class="dot" >:<?= $tgl_surat ." / ".$no_surat;?>&nbsp &nbsp</td>
        </tr>
        <tr>
           <td>&nbsp &nbsp<b>Dari</b></td><td class="dot" colspan="2">: <?= $pengirim;?> </td>
        </tr>
        <tr>
           <td>&nbsp &nbsp<b>Untuk</b></td><td class="dot" colspan="2">: <?= $untuk;?> </td>
        </tr>
        <tr>
            <td style="vertical-align:top">&nbsp &nbsp<b>Ringkasan Isi</b></td>
            <td colspan="2" class="dot" ><p>: <?= $perihal;?></p>&nbsp &nbsp</td>
        </tr>
        <tr>
            <td>&nbsp &nbsp<b>Lampiran</b></td>
            <td colspan="2" class="dot" >:&nbsp &nbsp</td>
        </tr>
        <tr style="border: solid 2px">
           <td colspan="2" style="border: solid 2px" align="center" valign="top"><b>Disposisi </b></td>
           <td align="center" style="border: solid 2px" valign="top"><b>Diteruskan Kepada Test 123: </b> </td>
           <td align="center" valign="top"><b>Paraf</b> </td>
        </tr>
        <tr style="height: 350px" valign="top">
          <td colspan="2" style="border: solid 2px" align="left" >
          <?php if(isset($data)){ 
                echo '<ol>';
                foreach ($data as $val) {
                  echo    '<li><u>Dari : '.$val->dari_nama.' kepada : '.$val->kepada_nama.' </u><br>Tanggal : '.tgl_indo($val->tgl_disposisi).'<br>'.$val->isi_disposisi.'</li><br><br>';
                }
                echo '<ol>';
            } ;?> 
          </td>
          <td align="left" style="border: solid 2px">
            <?php if(isset($data)){ 
                echo '<ol>';
                $n=0;
                foreach ($data as $val) {
                  echo    '<li>'.$val->kepada_nama.'</li><br>';
                  $n++;
                }
                echo '<ol>';
              } ;?> 
          </td>

        </tr>
        </tbody>
    </table>
</div>