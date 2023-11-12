    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header bg-red">
                <h2>
                   <?php echo $title;?>
                   <div class="divider"></div>
                    <small class="col-blue">Format Penomoran Surat Keluar</small>
                </h2>
            </div>
            <div class="body">
              <?php echo form_open('Referensi/'.$act.'_penomoran_surat_keluar'); ?>
                <div class="row clearfix">
                            <div class="col-md-6">
                                <p class="col-red">
                                    Bagian :
                                </p>
                                  <select name="bagian" class="form-control show-tick" data-live-search="true" style="width: 100%;" required>
                                     <option value='1' <?php echo ($bagian=='1' ? 'selected' : '') ?>>Kepegawaian</option>
                                     <option value='2' <?php echo ($bagian=='2' ? 'selected' : '') ?>>Umum dan Keuangan</option>
                                     <option value='3' <?php echo ($bagian=='3' ? 'selected' : '') ?>>Perencaan / IT / Pelaporan</option>
                                     <option value='4' <?php echo ($bagian=='4' ? 'selected' : '') ?>>Pidana</option>
                                     <option value='5' <?php echo ($bagian=='5' ? 'selected' : '') ?>>Perdata</option>
                                     <option value='6' <?php echo ($bagian=='6' ? 'selected' : '') ?>>Hukum</option>
                                  </select>
                            </div>
                          </div>
                  <div class="row clearfix">
                    <div class="col-sm-6">
                        Kode 
                        <div class="input-group">
                          <div class="form-line">
                            <input type="text" class="form-control" name="kode_surat" value="<?php echo $kode_surat; ?>" required>
                          </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        Format Penomoran 
                        <div class="input-group">
                          <div class="form-line">
                            <input type="text" class="form-control" name="format_penomoran" value="<?php echo $format_penomoran; ?>" required>
                          </div>
                        </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-md-12">
                        Keterangan 
                        <div class="input-group">
                          <div class="form-line">
                            <input type="text" class="uraian" name="uraian" value="<?php echo $uraian; ?>" required>
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