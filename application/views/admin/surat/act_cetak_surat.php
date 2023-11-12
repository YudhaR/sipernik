    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header bg-red">
                <h2>
                   <?php echo $title;?>
                   <div class="divider"></div>
                    <small class="col-blue">Pilih tanggal pencetakan</small>
                </h2>
            </div>
            <div class="body">
                <?php echo validation_errors(); ?>  
                <form action="<?php echo base_url().'Register/surat/'.$alur.'/cetak_agenda';?>" method="post" enctype="multipart/form-data" >
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <p class="col-red">
                                    Berdasarkan :
                                </p>
                                  <select id="jenis_cetak" name="jenis_cetak" class="form-control show-tick" style="width: 100%;" required>
                                      <option  value='-1'> -- Pilih jenis cetak -- </option>
                                      <option  value='1'>Tanggal Surat</option>
                                      <option  value='2'>Bulanan</option>
                                      <option  value='3'>Tahunan</option>
                                      <option  value='4'>Jenis Surat</option>
                                  </select>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-6" id="bulan" hidden>
                                <p class="col-red">
                                    Bulan :
                                </p>
                                  <select name="bulan" class="form-control show-tick" data-live-search="true" style="width: 100%;" required>
                                      <option  value='1'>Januari</option>
                                      <option  value='2'>Februari</option>
                                      <option  value='3'>Maret</option>
                                      <option  value='4'>April</option>
                                      <option  value='5'>Mei</option>
                                      <option  value='6'>Juni</option>
                                      <option  value='7'>Juli</option>
                                      <option  value='8'>Agustus</option>
                                      <option  value='9'>September</option>
                                      <option  value='10'>Oktober</option>
                                      <option  value='11'>November</option>
                                      <option  value='12'>Desember</option>
                                  </select>
                            </div>
                            <div class="col-md-6" id="jenis_surat" hidden>
                                    <p class="col-red">
                                        Jenis Surat :
                                    </p>
                                      <select name="jenis_surat" class="form-control show-tick" data-live-search="true" style="width: 100%;" required>
                                        <?php
                                        if (empty($jenis_surat)) {
                                          echo "<option  value='-1'> --Tidak Ada Data-- </option>";
                                        } else {
                                        foreach($jenis_surat as $js){
                                        ?>
                                       <option value='<?php echo $js->jenis_id ;?>'><?php echo $js->nama ;?></option>

                                        <?php 
                                          } 
                                          }
                                        ?>
                                        
                                      </select>
                                </div>
                            <div class="col-md-6" id="tahun" hidden>
                                    <p class="col-red">
                                        Tahun :
                                    </p>
                                      <select name="tahun" class="form-control show-tick" data-live-search="true" style="width: 100%;" required>
                                        <?php
                                        if (empty($tahun)) {
                                          echo "<option  value='-1'> --Tidak Ada Data-- </option>";
                                        } else {
                                        foreach($tahun as $t){
                                        ?>
                                       <option value='<?php echo $t->tahun ;?>'><?php echo $t->tahun ;?></option>

                                        <?php 
                                          } 
                                          }
                                        ?>
                                        
                                      </select>
                                </div>
                        </div>
                        <div class="row clearfix" id="range_tanggal" hidden>
                            <div class="masked-input">
                                <div class="col-md-4 col-red">
                                    Tanggal  :
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control date date-picker" name="dari" value="<?php echo $dari;?>" required>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-4">
                                    sampai dengan
                                 </div>
                                <div class="col-md-4 col-red">
                                   Tanggal  :
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control date date-picker" name="sampai" value="<?php echo $sampai;?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix" >
                            <div class="col-md-12 text-center">
                              <button type="button" class="btn btn-warning btn-lg waves-effect" data-dismiss="modal">Batal</button>
                              <button type="submit" class="btn bg-cyan  btn-lg waves-effect">Download Word</button>
                              <input type="hidden" name="alur" value="<?php echo $alur ?>"/>
                            </div>
                        </div>
             </form>
        </div>
    </div>

<script src="<?php echo base_url() ?>resources/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>
<script src="<?php echo base_url() ?>resources/js/admin.js"></script>

<script src="<?php echo base_url() ?>resources/plugins/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    $(function () {
    var $maskInput = $('.masked-input');
    $maskInput.find('.number').inputmask('9999999999', { placeholder: '' });
    $maskInput.find('.date').inputmask('dd/mm/yyyy', { placeholder: '__/__/____' });
    $( ".date" ).datepicker({ 
              autoclose: true,
              format: "dd/mm/yyyy",
    });
   $( '#jenis_cetak' ).change(function() {
      var a=$( '#jenis_cetak' ).val(); 
      if (a=='1') {
        $( '#range_tanggal').show();
        $( '#tahun').hide();
        $( '#bulan').hide();
        $( '#jenis_surat').hide();
      }else{
        $( '#range_tanggal').hide();
      }
      if (a=='2' || a=='3' ) {
        $( '#jenis_surat').hide();
        $( '#range_tanggal').hide();
        $( '#tahun').show();
        if (a=='3'){
            $( '#bulan').hide();
        }else{
            $( '#bulan').show();
        }
      }else{
        $( '#tahun').hide();
        $( '#bulan').hide();
      }
      if (a=='4' ) {
        $( '#jenis_surat').show();
        $( '#tahun').show();
        $( '#bulan').hide();
        $( '#range_tanggal').hide();
      }
    });

});
</script>