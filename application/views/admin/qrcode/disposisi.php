<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>ASAP - Aplikasi Surat Arsip dan Permintaan Barang</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link href="<?php echo base_url() ?>resources/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>resources/css/style.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>resources/css/all-themes.min.css" rel="stylesheet" />    
</head>
    <nav class="navbar bg-teal">
        <div class="col-lg-12 m-t-10">
                <div class="content text-center">
                    <div class="number" style="margin:0 auto;font-weight:bold;text-shadow: 0 1px 0 #ccc, 0 1px 0 #c9c9c9;color: #fff;border-bottom: 2px solid #fff">DETIL SURAT</div>
                </div>
        </div>
    </nav>
    <section class="m-t-80">
        <div class="body">
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="body">
                <div class="row clearfix">
	                   <div class="col-md-7">
                       <table class="table table-bordered table-striped">
                            <col width="30%">
                            <col width="">
                            <tbody>
                                <?php

                                    echo '<tr><td><b>Nomor Agenda</b></td><td>'.$no_agenda.'</td></tr>';
                                    echo '<tr><td><b>Kode Surat</b></td><td>'.$kode.'/'.$nama.'</td></tr>';
                                    echo '<tr><td><b>Tanggal Surat</b></td><td>'.$tgl_surat.'</td></tr>';
                                    echo '<tr><td><b>Diterima Bagian Umum</b></td><td>'.$tgl_terima.'</td></tr>';
                                    echo '<tr><td><b>Pengirim</b></td><td><pre>'.$pengirim.'</pre></td></tr>';
                                    echo '<tr><td><b>Untuk</b></td><td><pre>'.$untuk.'</td></tr>';
                                    echo '<tr><td><b>Perihal</b></td><td><pre>'.$perihal.'</pre></td></tr>';    
                                    echo '<tr><td><b>Keterangan</b></td><td><pre>'.$ket.'</pre></td></tr>';
                                  ?>
                            </tbody>
                        </table>
	                   </div>
                     <?php if ($file_name!="") { ?>
                      <div class="col-sm-3">
                        <div class="card" style="padding:5px">
                        <b>E-Document :</b>
                              <a class="text-center" href="<?php echo base_url('upload/surat_masuk')."/".$file_name ?>" target="_blank">View / Download</a>
                              <input name="ada_file" type="hidden" value="<?php echo $file_name ?>"/>
                        </div>
                      </div>
                      <?php }?>
                     
                  </div>
                  <div class="row clearfix">
  	                <div class="col-md-12">
  	                    <div class="card"> 
                             		<table class="table table-bordered table-striped table-hover">
                             			<col width="10%">
                             			<col width="30%">
                             			<col width="">
                             			<col width="10%">
  		                           <thead>
  	                                    <tr class="bg-deep-orange align-center">
  	                                        <th class="align-center">No</th>
  	                                        <th class="align-center">Tanggal Diposisi</th>
  	                                        <th class="align-center">Disposisi</th>
  	                                    </tr>
  	                                </thead>
  	                                <tbody>
  	                                  <?php
                                      if ($list_disposisi->num_rows>=0) {
                                        $no=0;
                                        foreach ($list_disposisi->result() as $row) {
                                        echo '<tr>';
                                        echo '<td class="text-center">'.++$no.'</td>';                                      
                                        echo '<td class="text-center">'.tgl_indo($row->tgl_disposisi).'</td>';
                                        echo '<td> Disposisi : '.$row->dari_nama.'<br>
                                              Kepada : '.$row->kepada_nama.'<br>
                                              <pre><small>'.$row->isi_disposisi.'</small></pre>
                                              </td>';
                                        echo '<tr>';
                                        }
                                      }
                                      ?>
  	                                </tbody>
  	                            </table>
                            </div>
  	                    </div>
  	                </div>
	    		   </div>
		    </div>
      </div>
    </div>