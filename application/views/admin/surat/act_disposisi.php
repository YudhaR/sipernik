    <link href="<?php echo base_url() ?>resources/plugins/multi-select/css/multi-select.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>resources/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>resources/plugins/date_time_picker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header bg-deep-orange"  style="border:1px solid #ddd">
                <h2>
                   <?php echo $title;?>
                   <div class="divider"></div>
                    <small class="col-blue">Tips: Kolom dengan <span><b>tulisan warna merah</b> </span> wajib diisi, Tekan tombol <span><b>TAB</b> </span> untuk pindah kolom berikutnya</small>
                </h2>
            </div>
            <div class="body">
                <?php echo validation_errors(); ?>  
                <?php echo form_open_multipart('Register/'.$act.'_disposisi/'); ?>
                        <div class="row clearfix">
                            <div class="masked-input">
                                <div class="col-md-4 col-red">
                                    <b>Tanggal Disposisi :</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control date date-picker" name="tgl_disposisi" placeholder="contoh : 30/07/2016" value="<?php echo $tgl_disposisi;?>" required>
                                        </div>
                                    </div>
                                </div>
                        	</div>
                        </div>
                        <div class="row clearfix">
                        	<div class="col-md-4">
                                <p class="col-red">
                                    <b>Disposisi Oleh :</b>
                                </p>
                                <select class="form-control show-tick" name="dari" id="select_dari">
                                    <option  value="-1">Pilih</option>
                                <?php foreach ($jabatan->result() as $val) {
                                    echo '<option '.($this->session->userdata('sess_jabatanid')==$val->id ? "selected" : "").' value="'.$val->id.'">'.$val->jabatan.'</option>';    
                                    
                                };?>
                                </select>

                           </div>
                           <div class="col-md-4">
                                <p class="col-red">
                                    <b>Diteruskan ke :</b>
                                </p>
                                <select class="form-control show-tick" name="kepada" id="select_kepada">
                                <option  value="-1">Pilih</option>
                                <?php foreach ($jabatan->result() as $val) {
                                    echo '<option  '.($kepada==$val->id ? "selected" : "").' value="'.$val->id.'">'.$val->jabatan.'</option>';    
                                    
                                };?>
                                </select>
                           </div>
                          	<div class="col-md-4">
                                <p class="col-red">
                                    <b>Sifat Disposisi :</b>
                                </p>
                                <select class="form-control show-tick" name="sifat">
                                        <option value="-">- Pilih -</option>
                                <?php foreach ($sifat_disposisi->result() as $val) {
                                    echo '<option  value="'.$val->id.'">'.$val->nama.'</option>';    
                                    
                                };?>
                                </select>
                           </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-12 col-red">
                                <b>Ringkasan Isi Disposisi :</b>
                                <div class="input-group">
                                    <div class="form-line">
                                        <textarea class="form-control no-resize auto-growth" style="overflow: hidden; overflow-wrap: break-word; height: 32px;" placeholder="ENTER untuk menambah baris" rows="1"  class="form-control" placeholder="" name="isi_disposisi" required><?php echo $isi_disposisi;?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <b>Keterangan :</b>
                                <div class="input-group">
                                    <div class="form-line">
                                        <textarea class="form-control no-resize auto-growth" style="overflow: hidden; overflow-wrap: break-word; height: 32px;" placeholder="ENTER untuk menambah baris" rows="1"  class="form-control" name="keterangan" placeholder=""><?php echo $keterangan;?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-12 text-center">
                              <button type="button" class="btn btn-warning btn-lg waves-effect" data-dismiss="modal">Batal</button>
                              <button type="submit" class="btn bg-cyan  btn-lg waves-effect">Simpan</button>
                              <input type="hidden" name="enc" value="<?php echo $enc ?>"/>
                              <input type="hidden" name="enc_disposisi" value="<?php echo $enc_disposisi ?>"/>
                              <input type="hidden" name="alur" value="<?php echo $alur ?>"/>
                            </div>
                        </div>
                </div>
             <?php echo form_close(); ?>
        </div>
    </div>

<script src="<?php echo base_url() ?>resources/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>
<script src="<?php echo base_url() ?>resources/js/admin.js"></script>
<script src="<?php echo base_url() ?>resources/plugins/autosize/autosize.min.js"></script>
<script src="<?php echo base_url() ?>resources/plugins/date_time_picker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
    $(function () {
         autosize(document.querySelectorAll('textarea'));
            var $maskInput = $('.masked-input');
            $maskInput.find('.number').inputmask('9999999999', { placeholder: '' });
            $maskInput.find('.date').inputmask('dd/mm/yyyy', { placeholder: '__/__/____' });
            $( '#select_kepada' ).change(function() {
              if ($( '#select_kepada' ).val()==$( '#select_dari' ).val()) {
                alert('tujuan disposisi tidak boleh sama' );
              }
            });
            $( '#select_dari' ).change(function() {
              if ($( '#select_kepada' ).val()==$( '#select_dari' ).val()) {
                alert('tujuan disposisi tidak boleh sama' );
              }
            });
            $( ".date" ).datepicker({ 
              autoclose: true,
              format: "dd/mm/yyyy",
             });
    });
</script>