    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header bg-red">
                <h2>
                   <?php echo $title;?>
                   <div class="divider"></div>
                    <small class="col-blue">Pilih tanggal permintaan</small>
                </h2>
            </div>
            <div class="body">
                <?php echo validation_errors(); ?>  
                <form action="<?php echo base_url().'Barang/permintaan/preview_permintaan';?>" method="post" enctype="multipart/form-data" >
                      <div class="row clearfix">
                        <div class="col-md-12">
                                    <p class="col-red">
                                        Pilih Tanggal Permintaan Barang  :
                                    </p>
                                      <select name="tgl_permintaan" class="form-control show-tick" data-live-search="true" style="width: 100%;" required>
                                        <?php
                                        if (empty($data)) {
                                          echo "<option  value='-1'> --Tidak Ada Data-- </option>";
                                        } else {
                                        foreach($data as $tgl){
                                        ?>
                                       <option value='<?php echo $data->tgl_permintaan ;?>'><?php echo tgl_indo($tgl->tgl_permintaan) ;?></option>

                                        <?php 
                                          } 
                                          }
                                        ?>
                                        
                                      </select>
                                </div>                            
                        </div>
                        <div class="row clearfix" >
                            <div class="col-md-12 text-center">
                              <button type="button" class="btn btn-warning btn-lg waves-effect" data-dismiss="modal">Batal</button>
                              <button type="submit" class="btn bg-cyan  btn-lg waves-effect">Tampilkan</button>
                            </div>
                        </div>
             </form>
        </div>
    </div>

<script src="<?php echo base_url() ?>resources/plugins/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    $(function () {
      $( ".date" ).datepicker({ 
                autoclose: true,
                format: "dd/mm/yyyy",
      });
    });
</script>