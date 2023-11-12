<style type="text/css">
  @media print {
  body * {
    visibility: hidden;
    margin: -5px;
  }
  @page {
      size: auto;
      margin: 0;  
  }
  #div_print * {
    visibility: visible;
  }

  #div_print{
    font-size: 80%;
    width: 780px;
    top:-50px;
    left:-50px;
  }
  .card{
    border:2px solid #444;
  }
  table{border:2px solid #444;width:auto;}
  tr.bg-black{background-color:black !important;;color: white !important; }
  h3,td{padding:10px;}
}
</style>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header bg-grey">
                <h2>
                   <?php echo $title;?>
                   <div class="divider"></div>
                    <small class="col-blue">QR-Code Untuk ditempelkan pada Box Penyimpanan / Ordner</small>
                </h2>
            </div>
            <div class="body">
                <div class="row clearfix">
                    <div class="col-md-5 text-center">
                      <div id="div_print" class="card" style="padding:1px">
                        <table width="100%">
                            <tr class="bg-black"><td><h3 class="bg-black"><?php echo $kode ?></h3></td></tr>
                            <tr><td><a><img src="<?php echo $pictQR;?>"/></a></td></tr>
                            <tr class="bg-black"><td><h3 class="bg-black"><?php echo $nama ?></h3></td></tr>
                        </table>
                      </div>
                    </div>
                    <div class="col-md-7">  
                        <a><b>Fungsi QR-Code : </b></a>
                        <br><a>-----------------------</a>
                        <ol>
                          <li>Klik tombol cetak (printer)</li>
                          <li><i class="fa fa-hand-scissors-o"> </i> Potong QR-Code kemudian tempel pada box penyimpanan / ordner</li>
                          <li>Untuk melihat arsip surat yang berada di dalam box, cukup gunakan <b>Smartphone</b> kemudian scan QR-Code pada Box tersebut, <b>Smartphone</b> otomatis menampilkan Daftar Arsip Surat yang ada didalam box.</li>
                        </ol>
                    </div>
              </div>
              <div class="row clearfix">
                  <div class="col-md-12 text-center">
                    <button type="button" class="btn btn-warning btn-small waves-effect" data-dismiss="modal">Batal</button>
                    <a onClick='document.title = "<?php echo "qr_ordner_".strtolower($nama) ?>";window.print();' class="btn bg-cyan  btn-small waves-effect"><i class="fa fa-print"> </i> Cetak</a>
                  </div>
              </div>  
            </div>
      </div>
</div>