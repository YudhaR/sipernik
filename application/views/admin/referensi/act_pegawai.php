 <div class="col-lg-12">
        <div class="card">
            <div class="header bg-red">
                <h2>
                   <?php echo $title;?>
                   <div class="divider"></div>
                    <small class="col-blue">Data Pegawai</small>
                </h2>
            </div>
            <div class="body">
                  <form method="post" action="<?php echo base_url().'Referensi/'.$act.'_pegawai';?>" enctype="multipart/form-data">
                  <div class="row clearfix">
                          <div class="col-md-8 col-red">
                              <b>Bagian </b>
                                <select name="jabatan_id" class="form-control">
                              <?php
                              $l_jabatan = $this->db->query("SELECT * FROM ctr_jabatan")->result();
                              if (empty($l_jabatan)) {
                                echo "<option  value=''> --Tidak Ada Data-- </option>";
                              } else {
                              foreach($l_jabatan as $l_jenis_jabatan){
                              ?>
                             <option <?php if( $jabatan_id == $l_jenis_jabatan->id) {echo "selected"; } ?> value='<?php echo $l_jenis_jabatan->id ;?>'><?php echo $l_jenis_jabatan->jabatan ;?></option>

                              <?php 
                                } 
                                }
                              ?>
                              
                            </select>
                          </div>
                          <div class="col-md-3">
                              <div class="input-group pull-right"  style="position:absolute;">
                                  <b>Foto</b>
                                  <div class="card p-l-5 p-r-5" style="width:170px;overflow:hidden">
                                      <div class="icon">
                                          <div class="image p-t-10" >
                                              <img src="<?php echo base_url('upload/pegawai')."/".$foto ?>" width="145px" alt="-" />
                                          </div>
                                      </div>
                                      <input name="file_foto" type="file" multiple style="display: block" class="btn"/>
                                      <input name="ada_file" type="hidden" value="<?php echo $ada_file;?>">
                                        <small>Format gambar : <strong> JPG,PNG</strong> maksimal 4MB</small>
                                  </div>
                              </div>
                          </div>
                    </div>
                    <div class="row clearfix">
                          <div class="col-md-8 col-red">
                              <b>Nama </b>
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
                     <div class="row clearfix">
                          <div class="col-md-8 col-red">
                              <b>NIP</b>
                              <div class="input-group">
                                  <span class="input-group-addon">
                                      <i class="fa fa-book"></i>
                                  </span>
                                  <div class="form-line">
                                      <input type="text" class="form-control" name="nip" value="<?php echo $nip;?>" required>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="row clearfix">
                          <div class="col-md-6 col-red">
                                <b>Pangkat  :</b>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                      <i class="fa fa-book"></i>
                                  </span>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="pangkat" value="<?php echo $pangkat;?>" required>
                                    </div>
                                </div>
                            </div>
                          <div class="col-md-6 col-red">
                              <b>Golongan</b>
                              <div class="input-group">
                                  <span class="input-group-addon">
                                      <i class="fa fa-book"></i>
                                  </span>
                                  <div class="form-line">
                                      <input type="text" class="form-control" name="golongan" value="<?php echo $golongan;?>" required>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="row clearfix">
                            <div class="col-md-6 col-red"">
                                <b>Jabatan  :</b>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                      <i class="fa fa-book"></i>
                                    </span>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="jabatan_nama" value="<?php echo $jabatan_nama;?>" required>
                                    </div>
                                </div>
                            </div>
                              <div class="col-md-4">
                                  <b>Nomor Telepon / HP</b>
                                  <div class="form-line">
                                      <input type="text" class="form-control" name="telpon" value="<?php echo $telpon;?>">
                                  </div>
                              </div>
                      </div>
                      <div class="row clearfix">
                            <div class="col-md-6 col-red">
                                <b>Email  :</b>
                                <div class="input-group">
                                    <div class="form-line">
                                        <textarea class="form-control no-resize auto-growth" style="overflow: hidden; overflow-wrap: break-word; height: 32px;" placeholder="ENTER untuk menambah baris" rows="1" name="alamat"><?php echo $alamat;?></textarea>
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
<script src="<?php echo base_url() ?>resources/plugins/autosize/autosize.min.js"></script>
<script type="text/javascript">
    autosize(document.querySelectorAll('textarea'));
</script>