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
                <form class="form_barang" action="<?php echo base_url().'Barang/'.$act.'_barang';?>" method="post" enctype="multipart/form-data" >
                        <div class="row clearfix">
                             <div class="masked-input">
                                <div class="col-md-6 col-red">
                                    Kode Barang:
                                    <div class="input-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control number"  name="kode_barang" maxlength="10"  placeholder="" value="<?php echo $kode_barang;?>">
                                        </div>
                                    </div>
                                </div>
                             </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-12 col-red">
                                Nama Barang :
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-folder-o"></i>
                                    </span>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="uraian" value="<?php echo $uraian;?>" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                                <div class="col-md-12 col-red">
                                    Satuan :
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-folder-o"></i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control capital" placeholder="Mis : buah, box, lusin" name="satuan" value="<?php echo $satuan;?>" required>
                                        </div>
                                    </div>
                                </div>
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