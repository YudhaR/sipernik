 <div class="col-lg-12">
        <div class="card">
            <div class="header bg-green">
                <h2>
                   <?php echo $title;?>
                   <div class="divider"></div>
                    <small class="col-blue">Tips: Kolom dengan tulisan warna merah wajib diisi, Tekan tombol TAB untuk pindah kolom berikutnya</small>
                </h2>
            </div>
            <div class="body">
                  <form method="post" action="<?php echo base_url().'Buku_tamu/'.$act.'_tamu';?>" enctype="multipart/form-data">
                  <div class="row clearfix">
                          <div class="col-md-12 col-red">
                              <b>Menghadap Ke </b>
                                <select name="tujuan_id" class="form-control">
                              <?php
                              $l_jabatan = $this->db->query("SELECT * FROM ctr_jabatan WHERE id<11")->result();
                              if (empty($l_jabatan)) {
                                echo "<option  value=''> --Tidak Ada Data-- </option>";
                              } else {
                              foreach($l_jabatan as $l_jenis_jabatan){
                              ?>
                             <option <?php if( $tujuan_id == $l_jenis_jabatan->id) {echo "selected"; } ?> value='<?php echo $l_jenis_jabatan->id ;?>'><?php echo $l_jenis_jabatan->jabatan ;?></option>

                              <?php 
                                } 
                                }
                              ?>
                              
                            </select>
                          </div>                          
                    </div>
                    <div class="row clearfix">
                          <div class="col-md-12 col-red">
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
                              <b>Alamat  :</b>
                              <div class="input-group">
                                  <div class="form-line">
                                      <textarea class="form-control no-resize auto-growth" style="overflow: hidden; overflow-wrap: break-word; height: 32px;" placeholder="ENTER untuk menambah baris" rows="1" name="alamat" required><?php echo $alamat;?></textarea>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-4 col-red">
                                <b>Nomor Telepon / HP</b>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="telpon" value="<?php echo $telpon;?>" required>
                                </div>
                          </div>                              
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-12 col-red">
                            <b>Keperluan </b>
                            <div class="input-group">                                
                                <div class="form-line">
                                    <textarea class="form-control no-resize auto-growth" style="overflow: hidden; overflow-wrap: break-word; height: 32px;" placeholder="ENTER untuk menambah baris" rows="1" name="keperluan" required><?php echo $keperluan;?></textarea>                                    
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