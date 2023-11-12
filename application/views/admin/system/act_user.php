    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header bg-red">
                <h2>
                   <?php echo $title;?>
                   <div class="divider"></div>
                    <small class="col-blue">User Management</small>
                </h2>
            </div>
            <div class="body">
              <?php echo form_open('Konfigurasi_system/'.$act.'_user'); ?>
                  <div class="row clearfix">
                      <div class="col-sm-6">
                        <p>Kewenangan / Group</p> 
                        <select name="groupid" class="form-control show-tick" required>
                          <?php
                          if (empty($kewenangan)) {
                            echo "<option  value=''> --Tidak Ada Data-- </option>";
                          } else {
                          foreach($kewenangan as $row){
                            if ($row->groupid!=0){
                          ?>
                         <option value='<?php echo $row->groupid ;?>'><?php echo $row->name ;?></option>

                          <?php 
                            }
                            } 
                            }
                          ?>
                          
                        </select>
                      </div>
                    </div>
                    <div class="row clearfix">
                      <div class="col-sm-12">
                        <p><b>NIP : NAMA</b> <small class="col-red"> (klik kemudian Ketik nip / nama untuk mencari) </small> </p>
                        <select name="userid" class="form-control show-tick" data-live-search="true" style="width: 100%;" required>
                          <?php
                          if (empty($pegawai)) {
                            echo "<option  value=''> --Tidak Ada Data-- </option>";
                          } else {
                          foreach($pegawai as $row){
                          ?>
                         <option <?php if( $nip== $row->nip) {echo "selected"; } ?> value='<?php echo $row->id ;?>'><?php echo '<span class="col-red">'.$row->nip.'</span> : '.$row->nama ;?></option>

                          <?php 
                            } 
                            }
                          ?>
                          
                        </select>
                      </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-sm-6">
                        Username
                        <div class="input-group">
                          <div class="form-line">
                            <input type="text" class="form-control" name="username" value="<?php echo $username; ?>" required>
                          </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        Password
                        <div class="input-group">
                           <div class="form-line">
                              <input type="password" class="form-control" name="password" value="" required>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="row clearfix" >
                        <div class="col-md-12 text-center">
                        <input type="hidden" name="enc" value="<?php echo $enc ?>">
                          <div class="col-md-12 text-center">
                              <button type="button" class="btn btn-warning btn-lg waves-effect" data-dismiss="modal">Batal</button>
                               <button type="submit" class="btn bg-cyan  btn-lg waves-effect">Simpan</button>
                          </div>
                  </div>
                </div>
                <?php echo form_close(); ?>
          </div>
      </div>
</div>
<script src="<?php echo base_url() ?>resources/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>
<script src="<?php echo base_url() ?>resources/js/admin.js"></script>
<script src="<?php echo base_url() ?>resources/plugins/autosize/autosize.min.js"></script>
<script src="<?php echo base_url() ?>resources/plugins/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    autosize(document.querySelectorAll('textarea'));
    $(function () {
    var $maskInput = $('.masked-input');
    $maskInput.find('.number').inputmask('9999999999', { placeholder: '' });
    $maskInput.find('.date').inputmask('dd/mm/yyyy', { placeholder: '__/__/____' });
    $( ".date" ).datepicker({ 
              autoclose: true,
              format: "dd/mm/yyyy",
    });
});
</script>