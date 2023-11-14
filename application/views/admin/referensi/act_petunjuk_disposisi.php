    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header bg-red">
                <h2>
                   <?php echo $title;?>
                   <div class="divider"></div>
                    <small class="col-blue">Referensi Petunjuk Disposisi</small>
                </h2>
            </div>
            <div class="body">
                  <?php echo form_open('Referensi/'.$act.'_petunjuk_disposisi'); ?>
                    <div class="row clearfix">
                          <div class="col-md-10 col-red">
                              <b>Petunjuk</b>
                              <div class="input-group">
                                  <span class="input-group-addon">
                                      <i class="fa fa-book"></i>
                                  </span>
                                  <div class="form-line">
                                      <input type="text" class="form-control" name="nama" value="<?php echo $nama;?>" required>
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
                    <?php echo form_close(); ?>
            </div>
      </div>
</div>