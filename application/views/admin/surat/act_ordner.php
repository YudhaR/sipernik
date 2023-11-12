    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header bg-red">
                <h2>
                   <?php echo $title;?>
                   <div class="divider"></div>
                    <small class="col-blue">Pilih Nomor surat dan Lokasi Penyimpanan</small>
                </h2>
            </div>
            <div class="body">
                <?php echo validation_errors(); ?>  
                <form action="<?php echo base_url().'Register/'.$act.'_ordner';?>" method="post" enctype="multipart/form-data" >
                        <div class="row clearfix">
                            <div class="masked-input">
                                <div class="col-md-6 col-red">
                                    <b>Tanggal Memasukkan ke Ordner :</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control date" name="tgl_ordner" placeholder="contoh : 30/07/2016" value="<?php echo date('d/m/Y');?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" id="ordner">
                                <p class="col-red">
                                    Box / Ordner :
                                </p>
                                  <select name="ordner" class="form-control show-tick" data-live-search="true" style="width: 100%;" required>
                                    <?php
                                    $ordner = $this->db->query("SELECT * FROM ctr_ordner")->result();
                                    if (empty($ordner)) {
                                      echo "<option  value='-1'> --Tidak Ada Data-- </option>";
                                    } else {
                                    foreach($ordner as $l){
                                    ?>
                                   <option <?php if($this->encrypt->decode(base64_decode($enc_ordner)) == $l->id) {echo "selected"; } ?> value='<?php echo base64_encode($this->encrypt->encode($l->id)) ;?>'><?php echo $l->kode.' : '.$l->nama ;?></option>

                                    <?php 
                                      } 
                                      }
                                    ?>
                                    
                                  </select>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-12" id="surat">
                                <p class="col-red">
                                    Nomor Surat :
                                </p>
                                  <select name="surat" class="form-control show-tick" data-live-search="true" style="width: 100%;" required>
                                    <?php
                                    if ($act=='insert'){
                                        $surat = $this->db->query("SELECT * FROM ctr_surat_masuk WHERE surat_id NOT IN (SELECT surat_id FROM ctr_surat_ordner)")->result();
                                    }
                                    if ($act=='update'){
                                        $surat = $this->db->query("SELECT * FROM ctr_surat_masuk WHERE surat_id=".$this->encrypt->decode(base64_decode($enc_surat)))->result();
                                    }
                                    if (empty($surat)) {
                                      echo "<option  value='-1'>Tidak Ada Data / Semua sudah di ordner</option>";
                                    } else {
                                    echo "<option  value='-1'>Pilih / ketik nomor surat</option>";
                                    foreach($surat as $s){
                                    ?>
                                        <option <?php if($this->encrypt->decode(base64_decode($enc_surat)) == $s->surat_id) {echo "selected"; } ?> value='<?php echo base64_encode($this->encrypt->encode($s->surat_id)) ;?>'><?php echo $s->no_surat ;?></option>
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
                              <button type="submit" class="btn bg-cyan  btn-lg waves-effect">Simpan</button>
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
        $( ".date" ).datepicker({ 
                  autoclose: true,
                  format: "dd/mm/yyyy",
        });
    });
</script>