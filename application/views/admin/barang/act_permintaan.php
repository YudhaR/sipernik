    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header bg-green">
                <h2>
                   <?php echo $title;?>
                   <div class="divider"></div>
                    <small class="col-blue">Tips: Kolom dengan <span><b>tulisan warna merah</b> </span> wajib diisi, Tekan tombol <span><b>TAB</b> </span> untuk pindah kolom berikutnya</small>
                </h2>
            </div>
            <div class="body">
                <?php echo validation_errors(); ?>  
                <form name="form_permintaan" action="<?php echo base_url().'Barang/'.$act.'_permintaan';?>" method="post" enctype="multipart/form-data" >
                        <div class="row clearfix">
                            <div class="masked-input">
                                <div class="col-md-6 col-red">
                                    Tanggal Permintaan :
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control date date-picker" name="tgl_permintaan" value="<?php echo $tgl_permintaan;?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if ($group_id=$this->session->userdata('sess_idgroup')<2) : ?>
                            <div class="col-md-6">
                                <p class="col-red">
                                    Ruangan / Pegawai:
                                </p>
                                  <select name="jabatan" class="form-control show-tick" data-live-search="true" style="width: 100%;" required>
                                    <?php
                                    if (empty($user)) {
                                      echo "<option  value='-1'> --Tidak Ada Data-- </option>";
                                    } else {
                                    foreach($user as $br){
                                    ?>
                                   <option value='<?php echo $br->id ;?>' <?php echo ($jabatan_id==$br->id ? "selected" : "") ;?>><?php echo $br->jabatan ;?></option>

                                    <?php 
                                      } 
                                      }
                                    ?>
                                    
                                  </select>
                            </div>
                              <?php endif  ?>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-6">
                                <p class="col-red">
                                     Kode Barang / Nama Barang :
                                </p>
                                  <select name="kode_barang" class="form-control show-tick" data-live-search="true" style="width: 100%;" required>
                                    <?php
                                    if (empty($barang)) {
                                      echo "<option  value='-1'> --Tidak Ada Data-- </option>";
                                    } else {
                                    foreach($barang as $br){
                                    ?>
                                   <option value='<?php echo $br->kode_barang ;?>' <?php echo ($kode_barang==$br->kode_barang ? "selected" : "") ;?>><?php echo $br->kode_barang." : ".$br->uraian ;?></option>

                                    <?php 
                                      } 
                                      }
                                    ?>
                                    
                                  </select>
                            </div>
                            <div class="masked-input">
                                <div class="col-md-6 col-red">
                                    Jumlah permintaan :
                                    <div class="input-group">
                                        <div class="form-line">
                                            <input type="text" data-a-sep="." data-a-dec="," class="form-control number" name="jumlah_diminta" value="<?php echo $jumlah_diminta;?>" required >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if ($group_id=$this->session->userdata('sess_idgroup')<2) : ?>
                             <div class="masked-input">
                                <div class="col-md-6 col-red">
                                    Jumlah Diberikan :
                                    <div class="input-group">
                                        <div class="form-line">
                                            <input type="text" data-a-sep="." data-a-dec="," class="form-control number" name="jumlah_diberikan" value="<?php echo $jumlah_diberikan;?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                          <?php endif ;?>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-12 text-center">
                              <button type="button" class="btn btn-warning btn-lg waves-effect" data-dismiss="modal">Batal</button>
                              <button type="submit" class="btn bg-cyan  btn-lg waves-effect">Simpan</button>
                              <input type="hidden" name="enc" value="<?php echo $enc ?>"/>
                            </div>
                        </div>
                </div>
             </form>
        </div>
    </div>

<script src="<?php echo base_url() ?>resources/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>
<script src="<?php echo base_url() ?>resources/js/admin.js"></script>
<script src="<?php echo base_url() ?>resources/plugins/autosize/autosize.min.js"></script>
<script src="<?php echo base_url() ?>resources/plugins/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    $(function () {
        $('[autofocus]:first').focus();
        var $maskInput = $('.masked-input');
        $maskInput.find('.number').inputmask('9999999999', { placeholder: '' });
        $maskInput.find('.date').inputmask('dd/mm/yyyy', { placeholder: '__/__/____' });
        $( ".date" ).datepicker({ 
                  autoclose: true,
                  format: "dd/mm/yyyy",
        });
    });
</script>