<style type="text/css">
  table {border: solid 2px #000; border-collapse: collapse; width: 100%;padding:20px;}
  tr { border:none;}
  td { padding: 7px 5px}
  h3 { margin-top: 5px;margin-left: 80px; font-weight: bold;font-size: 18px;}
  h3 span{ font-weight: normal;font-size: 14px;}
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
  pre{
    border: none;
    background-color: transparent;
    font-family: inherit;
    font-size: 12px;
    padding: 0px;
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
    width: 10\20%;
  }
  #div_print * {
    visibility: visible;
  }
  #div_print{
    font-size: 80%;
    width: 650px;
    position: absolute;
    left: -250px;
    top: -90px;
  }
  pre{
    border: none;
    background-color: transparent;
    font-family: inherit;
    font-size: 12px;
    padding: 0px;
  }
  .table {border: solid 2px #000; border-collapse: collapse; width: 120%;height:100%;padding:20px;}
  tr { border:none;}
  td { padding: 7px 5px}
  h3 { margin-top: 5px;margin-left: 80px; font-weight: bold;font-size: 18px;}
  h3 span{ font-weight: normal;font-size: 14px;}
  h2 { margin-bottom: 0px }
  }
</style>
 <div class="col-xs-12" style="background: #fff;">
        <h3 class="box-title m-l--5">  
          <a href="<?php echo base_url('Register/surat').'/'.$alur; ?>/" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali </a>
        	<a onClick='document.title = "<?php echo "agenda_untitle" ?>";window.print();' class="btn bg-cyan  btn-small waves-effect"><i class="fa fa-print"> </i> Cetak</a>
        </h3>
      <div class="body">
          <div class="col-xs-12"  id="div_print">
            <h3 class="box-title text-center m-l--5">
            <a><u>BUKU AGENDA SURAT <?php echo strtoupper($alur) ?></u></a>
            <p><small>Laporan : <?php echo $jenis ?></small></p>
            </small></p></h3>
            <br><br>
            <table class="table table-bordered">
              <col width="5%">
              <col width="10%">
              <col width="10%">
              <col width="10%">
              <col width="15%">
              <col width="15%">
              <col width="20%">              
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Agenda</th>
                  <th>No. Surat</th>
                  <th>Tgl Surat</th>
                  <th>Dari</th>
                  <th>Untuk</th>
                  <th>Perihal</th>                  
              </thead>
              <tbody>
                	<?php  
                	$no = 1;
                  if (count($data)>=1){
                    	foreach ($data as $lihat) {
                    	?>
                    	<tr>
                          <td><?php echo $no++ ?></td>
                          <td><?php echo $lihat->no_agenda?></td>
                        	<td><?php echo $lihat->no_surat?></td>
                        	<td><?php echo $this->tanggalhelper->convertToInputDate($lihat->tgl_surat) ?></td> 
                          <td><pre><?php echo ucwords($lihat->pengirim) ?></pre></td> 
                          <td><pre><?php echo ucwords($lihat->untuk) ?></pre></td> 
                          <td><pre><?php echo ucfirst($lihat->perihal) ?></pre></td>
                  	   </tr>
                  	   <?php } 
                    }else{
                      echo '<tr><td colspan="9" class="text-center font-20"> ------------------- N I H I L ------------------- </td></tr>';
                    }?>
                   <tr></tr>
                 </tbody>
              </table>
            </div>
        </div>
    </div>
</div>