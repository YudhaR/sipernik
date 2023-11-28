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
                <form action="<?php echo base_url().'Register/validate_input_lama/'.$alur.'/'.$act;?>" method="post" enctype="multipart/form-data" >
                        <div class="row clearfix">
                            <div class="masked-input">
                                <div class="col-md-2 col-red">
                                    Nomor Agenda:
                                    <div class="input-group">
                                        <div class="form-line">
                                            <input type="text" id="nomor_agenda" class="form-control"  name="no_agenda" placeholder="" value="<?php echo $no_agenda;?>">
                                        </div>
                                    </div>       
                                </div>
                                <div class="col-md-4 col-red">
                                    <input id="check_agenda" class="filled-in" type="checkbox" checked> Format Penomoran Agenda: 
                                    <div class="input-group">
                                            <input type="text" id="format_nomor_agenda" class="form-control col-blue" name="format_nomor_agenda" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 col-red">
                                    Tanggal Diterima :
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control date date-picker" id="tgl_terima" name="tgl_terima" placeholder="" value="<?php echo $tgl_terima;?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-6">
                            <?php if ($alur == "masuk") {
                                ?>
                                <p class="col-red">
                                    Sifat Surat :
                                </p>
                                <select name="sifat_surat" class="form-control show-tick" data-live-search="true" style="width: 100%;" required>
                                    <?php
                                    $l_sifat = $this->db->query("SELECT * FROM ctr_sifat_surat")->result();
                                    if (empty($l_sifat)) {
                                        echo "<option  value='-1'> --Tidak Ada Data-- </option>";
                                    } else {
                                        foreach ($l_sifat as $l_sifat_surat) {
                                    ?>
                                            <option <?php if ($sifat_id == $l_sifat_surat->sifat_id) {
                                                        echo "selected";
                                                    } ?> value='<?php echo $l_sifat_surat->sifat_id; ?>'><?php echo $l_sifat_surat->nama; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            <?php
                            } else if ($alur == "keluar") {
                            ?>
                                <p class="col-red">
                                    Sifat Surat :
                                </p>
                                <select name="jenis_surat" class="form-control show-tick" data-live-search="true" style="width: 100%;" required>
                                    <?php
                                    $l_jenis = $this->db->query("SELECT * FROM ctr_jenis_surat")->result();
                                    if (empty($l_jenis)) {
                                        echo "<option  value='-1'> --Tidak Ada Data-- </option>";
                                    } else {
                                        foreach ($l_jenis as $l_jenis_surat) {
                                    ?>
                                            <option <?php if ($jenis_id == $l_jenis_surat->jenis_id) {
                                                        echo "selected";
                                                    } ?> value='<?php echo $l_jenis_surat->jenis_id; ?>'><?php echo $l_jenis_surat->nama; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            <?php
                            } ?>
                            </div>
                             <div class="col-md-6 col-red">
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
                        </div>
                        <div class="row clearfix">
                            <div class="masked-input">
                                <div class="col-md-4 col-red">
                                    Nomor Surat :
                                    <div class="input-group">
                                        <div class="form-line">
                                            <input type="text" id="nomor_surat" class="form-control" name="no_surat" placeholder="Nomor Surat" value="<?php echo $no_surat;?>" required>
                                        </div>
                                    </div>      
                                </div>
                            </div>
                            <?php if ($alur=='keluar'): ?>
                            <div class="col-md-4 col-red">
                                    <input id="check_nomor" type="checkbox" <?php #echo ($act!='edit' ? "checked" : " " );?> checked> Format Surat <?php echo $alur ?>
                                    <select name="format_nomor" id="format" class="form-control show-tick" data-live-search="true" style="width: 100%;" required>
                                    <?php
                                    $l_jenis = $this->db->query("SELECT id,format_penomoran,kode_surat,uraian FROM dix_ref_format_nomor_surat")->result();
                                        foreach($l_jenis as $format){
                                            if ($format_surat_id==$format->id){
                                                echo "<option selected value=".$format->format_penomoran.">".$format->kode_surat."-".$format->uraian."</option>";
                                                    }
                                            else{
                                                echo "<option value=".$format->format_penomoran.">".$format->kode_surat."-".$format->uraian."</option>";
                                                    }                                            
                                        }                                       
                                    ?>                                   
                                  </select>                                                                      
                            </div>                            
                            <div class="col-md-4">
                                    Format Surat :                                    
                                     <div class="input-group">
                                            <input type="text" id="format_nomor_surat" class="form-control col-blue" name="format_nomor_surat" readonly>
                                    </div>
                            </div>
                            <?php endif?>
                            <?php if ($alur == "masuk") {
                                ?>
                                <div class="col-md-4 col-red">
                                    <p class="">
                                        Status Surat :
                                    </p>
                                    <select name="status_surat" class="form-control show-tick" data-live-search="true" style="width: 100%;" required>
                                        <?php
                                        $l_status = $this->db->query("SELECT * FROM ctr_status_surat")->result();
                                        if (empty($l_status)) {
                                            echo "<option  value='-1'> --Tidak Ada Data-- </option>";
                                        } else {
                                            foreach ($l_status as $l_status_surat) {
                                        ?>
                                                <option <?php if ($status_id == $l_status_surat->status_id) {
                                                            echo "selected";
                                                        } ?> value='<?php echo $l_status_surat->status_id; ?>'><?php echo $l_status_surat->status; ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-4 col-red">
                                    <p class="">
                                        Jenis Surat Masuk:
                                    </p>
                                    <select name="jenis_surat_masuk" class="form-control show-tick" data-live-search="true" style="width: 100%;" required>
                                        <?php
                                        $l_jenis_surat_masuk = $this->db->query("SELECT * FROM ctr_jenis_surat_masuk")->result();
                                        if (empty($l_jenis_surat_masuk)) {
                                            echo "<option  value='-1'> --Tidak Ada Data-- </option>";
                                        } else {
                                            foreach ($l_jenis_surat_masuk as $l_jenis_surat_masuk_surat) {
                                        ?>
                                                <option <?php if ($jenis_surat_masuk_id == $l_jenis_surat_masuk_surat->jenis_surat_masuk_id) {
                                                            echo "selected";
                                                        } ?> value='<?php echo $l_jenis_surat_masuk_surat->jenis_surat_masuk_id; ?>'><?php echo $l_jenis_surat_masuk_surat->jenis; ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <?php
                            }
                            ?>
                        </div>            
                        <div class="row clearfix">
                            <div class="col-md-6 col-red">
                                Pengirim / Dari :
                                <div class="input-group">
                                    <div class="form-line">
                                        <textarea class="form-control no-resize auto-growth" style="overflow: hidden; overflow-wrap: break-word; height: 32px;" placeholder="ENTER untuk menambah baris" rows="1" name="pengirim" required><?php echo $pengirim;?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-red">
                                Kepada / Untuk :
                                <div class="input-group">
                                    <div class="form-line">
                                        <textarea class="form-control no-resize auto-growth" style="overflow: hidden; overflow-wrap: break-word; height: 32px;" placeholder="ENTER untuk menambah baris" rows="1" name="untuk"  required><?php echo $untuk;?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-12 col-red">
                                Perihal :
                                <div class="input-group">
                                    <div class="form-line">
                                        <textarea class="form-control no-resize auto-growth" style="overflow: hidden; overflow-wrap: break-word; height: 32px;" placeholder="ENTER untuk menambah baris" rows="1" name="perihal" required><?php echo $perihal;?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                        <?php if ($alur=='keluar'): ?>
                                <div class="masked-input">
                                    <div class="col-md-6 col-red">
                                        Tanggal kirim :
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control date date-picker" name="tgl_kirim" placeholder="contoh : 30/07/2016" value="<?php echo $tgl_terima;?>" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
	                            <div class="col-md-6">
	                                <p class="col-red">
	                                    Ekspedisi :
	                                </p>
                                      <select name="ekspedisi" class="form-control select2" style="width: 100%;">
                                        <?php
                                        $query = $this->db->query("SELECT * FROM ctr_ekspedisi")->result();
                                        if (empty($query)) {
                                          echo "<option  value='-'>-</option>";
                                        } else {
                                        foreach($query as $val_m){ ?>
                                            <option <?php if( $ekspedisi == $val_m->id) {echo "selected"; } ?> value='<?php echo $val_m->id ;?>'><?php echo $val_m->nama ;?></option>
                                        <?php 
                                        } 
                                        }
                                        ?>
                                      </select>
	                           </div> 
                        <?php endif ?>
                        <div class="col-md-12">
                                Keterangan :
                                <div class="input-group">
                                    <div class="form-line">
                                        <textarea class="form-control no-resize auto-growth" style="overflow: hidden; overflow-wrap: break-word; height: 32px;" placeholder="ENTER untuk menambah baris" rows="1" name="ket" placeholder=""><?php echo $ket;?></textarea>
                                    </div>
                                </div>
                            </div>
                            </div> 
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <font color="red">E-Document :</font>
                                <div class="input-group">
                                    <div class="form-line">
                                        <input name="file_surat" type="file" multiple style="display: block" class="btn btn-warning" required />
                                        <small>Format file yang bisa di upload : <strong> JPG, PNG, PDF, ZIP, RAR </strong> maksimal 40MB</small>
                                    </div>
                                </div>
                            </div>
                            <?php if ($file_name != "" ) : ?>
                                <div class="col-sm-4">
                                    <b class="p-l-20">E-doc tersimpan :</b>
                                    <div class="icon">
                                    <div class="image p-t-10 p-l-20">
                                        <?php if ($alur == "keluar") { ?>
                                            <img src="<?php echo base_url('upload/surat_' . $alur) . '/' . $jabatan . '/' . $kategori . "/" . $file_name ?>" height="50" alt="-" />
                                        <?php } else { 
                                            		$p = $this->db->query("SELECT jenis FROM ctr_jenis_surat_masuk WHERE jenis_surat_masuk_id=$jenis_surat_masuk_id");
                                                    $jenis_surat_masuk = $p->result();
                                                    
                                                    if (count($jenis_surat_masuk) > 0) {
                                                        $jenis_surat_masuk = $jenis_surat_masuk[0]->jenis;
                                                    }
                                                    ?>
                                            <img src="<?php echo base_url('upload/surat_' . $alur) . '/' . $jenis_surat_masuk . "/" . $file_name ?>" height="50" alt="-" />
                                        <?php } ?>
                                    </div>
                                        <?php if ($alur == "keluar") { ?>
                                                <a class="p-l-20"x href="<?php echo base_url('upload/surat_' . $alur) . '/' . $jabatan . '/' . $kategori . "/" . $file_name ?>"><?php echo $file_name ?></a>
                                            <?php } else { 
                                                        $p = $this->db->query("SELECT jenis FROM ctr_jenis_surat_masuk WHERE jenis_surat_masuk_id=$jenis_surat_masuk_id");
                                                        $jenis_surat_masuk = $p->result();
                                                        
                                                        if (count($jenis_surat_masuk) > 0) {
                                                            $jenis_surat_masuk = $jenis_surat_masuk[0]->jenis;
                                                        }
                                                        ?>
                                                <a class="p-l-20"x href="<?php echo base_url('upload/surat_' . $alur) . '/' . $jenis_surat_masuk . "/" . $file_name ?>"><?php echo $file_name ?></a>
                                            <?php } ?>
                                        <input name="ada_file" type="hidden" value="<?php echo $file_name ?>" />
                                    </div>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-12 text-center">
                              <a class="btn bg-orange" href="<?php echo base_url('Register/surat').'/'.$alur;?>"><i class="fa fa-angle-double-left"> </i> Batal</a>
                              <button type="submit" class="btn bg-cyan waves-effect">Simpan</button>
                              <input type="hidden" name="enc" value="<?php echo $enc ?>">
                              <input type="hidden" name="alur" value="<?php echo $alur ?>">
                              <input type="hidden" name="status" value="<?php echo $status ?>">
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
$(function() {
    get_nomor('surat');
    get_nomor('agenda');
    var $maskInput = $('.masked-input');
    $maskInput.find('.date').inputmask('dd/mm/yyyy', {
        placeholder: '__/__/____'
    });
    $(".date").datepicker({
        autoclose: true,
        format: "dd/mm/yyyy",
    });
    $('#tgl_terima').change(function() {
        get_nomor('surat');
        get_nomor('agenda');
    })    

});
$("#nomor_surat").keyup(function() {
    get_nomor('surat');
});
$("#nomor_agenda").keyup(function() {
    get_nomor('agenda');
});
$('#check_agenda').click(function(event) {
    get_nomor('agenda');
});
$('#check_nomor').click(function(event) {
    get_nomor('surat');
});

function get_nomor(jenis) {
    if (jenis == "surat") {
        if ($('#check_nomor').prop('checked')) {
            var f_nomor = $('#format').val();
            $('#format_nomor_surat').val(generate_nomor(f_nomor))
        } else {
            var f_nomor = '<?php echo $format_surat;?>';
            $('#format_nomor_surat').val(f_nomor)
        }        
    }else if(jenis == "agenda") {
        if ($('#check_agenda').prop('checked')) {
            var a_nomor = '<?php echo $format_nomor_agenda;?>';
        } else {
            var a_nomor = "";
        }
        $('#format_nomor_agenda').val(generate_nomor_agenda($("#nomor_agenda").val() + a_nomor))
    }
};

function generate_nomor(el) {
    var tmp = $('#tgl_terima').val().split("/");
    var bln = tmp[1];
    var thn = tmp[2];
    var nmr = $('#nomor_surat').val();
    var tmp = el;
    var tmp2 = tmp.replace("NMR", nmr);
    var tmp3 = tmp2.replace("BLN", bln);
    var result = tmp3.replace("THN", thn);
    return result;
}

function generate_nomor_agenda(el) {
    var tmp = $('#tgl_terima').val().split("/");
    var bln = tmp[1];
    var thn = tmp[2];
    var tmp = el;
    var tmp2 = tmp.replace("NMR", '');
    var tmp3 = tmp2.replace("BLN", romanize(bln));
    var result = tmp3.replace("THN", thn);
    return result;
}
</script>