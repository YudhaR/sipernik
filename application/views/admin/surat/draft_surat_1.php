    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header bg-green">
                <h2>
                   <?php echo $title;?>
                   <div class="divider"></div>
                   <small class="col-blue">Form ini untuk mempermudah dalam membuat surat (Generate dari form ini bisa anda cetak dan edit kembali di Microsoft Word)</small>
                </h2>
            </div>
            <div class="body">
                <?php echo validation_errors(); ?>  
                <form action="<?php echo base_url().'Register/validate_input/'.$alur.'/'.$act;?>" method="post" enctype="multipart/form-data" >
                        <div class="row clearfix">
                            <div class="col-md-6">
                                <p class="col-red">
                                    Style Surat / Bentuk Surat :
                                </p>
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-book"></i>
                                        </span>
                                  <select name="ekspedisi" class="form-control select2" style="width: 100%;">
                                            <option value="1">Lurus Penuh (Full Block Style)</option>
                                            <option value="2">Lurus (Block Style)</option>
                                            <option value="3">Setengah Lurus (Semi Block Style)</option>
                                            <option value="4">Lekuk (Idented Style )</option>
                                            <option value="5">Resmi (Official Style)</option>
                                            <option value="6">Paragraf Bergantung (Hanging Paragraph)</option>
                                            <option value="7">Resmi (New Official Style)</option>
                                  </select>
                                </div> 
                            </div>
                        </div>
                        <div class="row clearfix">
                                 <div class="col-md-3 col-red">
                                    Tanggal surat :
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" id="tgl_surat" class="form-control date date-picker" name="tgl_surat" placeholder="" value="<?php echo $tgl_surat;?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-red">
                                    Nomor Surat :
                                    <div class="input-group">
                                        <div class="form-line">
                                            <input type="text" id="nomor_surat" class="form-control" name="no_surat" placeholder="Nomor Surat" value="<?php echo $no_surat;?>" required>
                                        </div>
                                    </div>      
                                </div>
                                <div class="col-md-4 col-red">
                                    Perihal :
                                     <div class="input-group">
                                        <div class="form-line">
                                            <textarea class="form-control no-resize auto-growth" style="overflow: hidden; overflow-wrap: break-word; height: 32px;" rows="1" name="pengirim" required><?php echo $kepada;?></textarea>
                                        </div>
                                    </div>     
                                </div>
                                <div class="col-md-4 col-red">
                                    Lampiran :
                                    <div class="input-group">
                                        <div class="form-line">
                                            <textarea class="form-control no-resize auto-growth" style="overflow: hidden; overflow-wrap: break-word; height: 32px;" rows="1" name="pengirim" required><?php echo $kepada;?></textarea>
                                        </div>
                                    </div>    
                                </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-6 col-red">
                                Kepada :
                                <div class="input-group">
                                    <div class="form-line">
                                        <textarea class="form-control no-resize auto-growth" style="overflow: hidden; overflow-wrap: break-word; height: 32px;" rows="1" name="pengirim" required><?php echo $kepada;?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-12 col-red">
                                Isi Surat :
                                <div class="input-group">
                                    <div class="form-line">
                                        <textarea class="form-control no-resize auto-growth" style="overflow: hidden; overflow-wrap: break-word; height: 32px;" placeholder="ENTER untuk menambah baris" rows="1" name="perihal" required><?php echo $perihal;?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-6">
                                <p class="col-red">
                                    Yang menanda tangani :
                                </p>
                                  <select name="ekspedisi" class="form-control select2" style="width: 100%;">
                                    <?php
                                    $query = $this->db->query("SELECT * FROM ctr_jabatan")->result();
                                    if (empty($query)) {
                                      echo "<option  value='-'>-</option>";
                                    } else {
                                    foreach($query as $val_m){ ?>
                                        <option <?php if( $ekspedisi == $val_m->id) {echo "selected"; } ?> value='<?php echo $val_m->id ;?>'><?php echo $val_m->jabatan ;?></option>
                                    <?php 
                                    } 
                                    }
                                    ?>
                                  </select>
                           </div> 
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-12 text-center">
                              <a class="btn bg-orange" href="<?php echo base_url('Home')?>"><i class="fa fa-angle-double-left"> </i> Batal</a>
                              <button type="submit" class="btn bg-cyan waves-effect"><i class="fa fa-print"> </i> Generate</button>
                              <input type="hidden" name="enc" value="<?php echo $enc ?>"/>
                              <input type="hidden" name="alur" value="<?php echo $alur ?>"/>
                              <input type="hidden" name="status" value="<?php echo $status ?>"/>
                            </div>
                        </div>
                </div>
             </form>
        </div>
    </div>
<script src="<?php echo base_url() ?>resources/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>resources/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>
<script src="<?php echo base_url() ?>resources/plugins/autosize/autosize.min.js"></script>
<script src="<?php echo base_url() ?>resources/plugins/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript">
autosize(document.querySelectorAll('textarea'));
$(function(){get_nomor('surat'); get_nomor('agenda'); var $maskInput = $('.masked-input'); $maskInput.find('.date').inputmask('dd/mm/yyyy', { placeholder: '__/__/____' }); $( ".date" ).datepicker({autoclose: true, format: "dd/mm/yyyy", }); $('#tgl_surat').change(function() {get_nomor('surat'); get_nomor('agenda'); }) });$("#nomor_surat").keyup(function(){get_nomor('surat'); }); $("#nomor_agenda").keyup(function(){get_nomor('agenda'); }); $('#check_agenda').click(function (event) {get_nomor('agenda'); }); $('#check_nomor').click(function (event) {get_nomor('surat'); });function get_nomor(jenis){if (jenis=="surat"){if($('#check_nomor').prop('checked')) {var f_nomor='<?php echo $format_nomor_surat;?>'; }else{var f_nomor=''; } $('#format_nomor_surat').val(generate_nomor($("#nomor_surat").val()+f_nomor)) }else{if($('#check_agenda').prop('checked')) {var a_nomor='<?php echo $format_nomor_agenda;?>'; }else{var a_nomor=""; } $('#format_nomor_agenda').val(generate_nomor($("#nomor_agenda").val()+a_nomor)) } };function generate_nomor(el){var tmp = $('#tgl_surat').val().split("/"); var bln=tmp[1]; var thn=tmp[2]; var tmp=el; var tmp2 = tmp.replace("BLN", romanize(bln)); var tmp3 = tmp2.replace("NOMOR",''); var result = tmp3.replace("THN", thn); return result; }
</script>