  
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header bg-blue-grey">
                <h2>
                   <?php echo $title;?>
                   <div class="divider"></div>
                    <small class="col-blue">Tips: Kolom dengan <span><b>tulisan warna merah</b> </span> wajib diisi, Tekan tombol <span><b>TAB</b> </span> untuk pindah kolom berikutnya</small>
                </h2>
            </div>
            <div class="body">
                <?php echo validation_errors(); ?>  
                <form action="<?php echo base_url().'Barang/'.$act.'_stok';?>" method="post" enctype="multipart/form-data" >
                        <div class="row clearfix">
                            <div class="col-md-6 col-red">
                                Kode Barang :
                                     <?php
                                     if ($act=='insert'){
                                        echo '<div class="input-group">';
                                        echo '    <input type="text" class="form-control" name="kode_barang" value="'.$kode_barang.'" readonly>';
                                        echo '</div>';
                                     }else{
                                          echo '<select name="kode_barang" class="form-control show-tick" data-live-search="true" style="width: 100%;">';
                                            $query = $this->db->query("SELECT * FROM ctr_barang")->result();
                                            echo "<option  value='-'>-</option>";
                                            if (empty($query)) {
                                              echo "<option  value='-'>-</option>";
                                            } else {
                                            foreach($query as $val_m){ ?>
                                                <option value='<?php echo $val_m->kode_barang ;?>' <?php echo ($kode_barang==$val_m->kode_barang ? "selected" : "") ?> ><?php echo $val_m->kode_barang.' : '.$val_m->uraian;?></option>
                                            <?php 
                                            } 
                                            }
                                          echo '</select>';
                                      }
                                    ?>
                            </div>
                            <div class="col-md-6 col-red">
                                Stok terakhir :
                                <div class="input-group">
                                        <input type="text" class="form-control" name="stok_terakhir" value="<?php echo $jumlah;?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="masked-input">
                                <div class="col-md-6 col-red">
                                    <b>Tanggal Tambah Stok :</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control date" name="tgl_transaksi" value="<?php echo date('d/m/Y');?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="masked-input">
                                <div class="col-md-6 col-red">
                                   <?php echo $title;?> :
                                    <div class="input-group">
                                        <div class="form-line">
                                            <input id="tambah_stok" type="text" class="form-control number" name="tambah_stok" value="<?php echo $tambah_stok;?>" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-12 text-center">
                              <button type="button" class="btn btn-warning btn-lg waves-effect" data-dismiss="modal">Batal</button>
                              <button type="submit" class="btn bg-cyan  btn-lg waves-effect">Simpan</button>
                              <input type="hidden" name="enc" value="<?php echo $enc ?>"/>
                              <input type="hidden" name="enc_act" value="<?php echo $enc_act ?>"/>
                            </div>
                        </div>
                </div>
             </form>
        </div>
    </div>

<script src="<?php echo base_url() ?>resources/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>
<script src="<?php echo base_url() ?>resources/js/admin.js"></script>
<script type="text/javascript">
$(function () {
    var $maskInput = $('.masked-input');
    $maskInput.find('.number').inputmask('999999', { placeholder: '' });
    $( ".date" ).datepicker({ 
              autoclose: true,
              format: "dd/mm/yyyy",
    });
});
window.onload = function() {
    $("#tambah_stok").focus();
};
</script>