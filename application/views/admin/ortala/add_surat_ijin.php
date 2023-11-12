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
                  <form method="post" action="<?php echo base_url().'Kepegawaian/'.$act.'_ijin';?>" enctype="multipart/form-data">                  
                  <div class="row clearfix">                      
                        <div class="col-md-6 col-red">
                          <b>Nama Pegawai </b>
                          <?php
                            $f_pegawai = $this->db->query("SELECT * FROM ctr_pegawai ORDER BY nama ASC")->result();  
                                echo '<select name="pegawai_id" class="form-control" required>';
                                  if(!empty($f_pegawai)){
                                      echo "<option value=''>Pilih Nama Pegawai</option>";
                                      foreach ($f_pegawai as $row){
                                        $id=$row->id;
                                        if($pegawai_id==$row->id){
                                          echo "<option selected value='$id' >$row->nama</option>";
                                        }else{                                    
                                          echo "<option value='$id'>$row->nama</option>";
                                        }                                                                      
                                      }
                                  }                                                                  
                                echo '</select>';                            
                            ?>
                        </div>                        
                    </div>
                    <div class="row clearfix">                          
                          <div class="col-md-6 col-red">
                              <b>Jenis Ijin </b>                                
                                  <select name="jenis_ijin" class="form-control" required> 
                                        <option value="1" <?php echo ($jenis_ijin==1)? 'selected':''; ?>>Ijin Tidak Masuk</option>
                                        <option value="2" <?php echo ($jenis_ijin==2)? 'selected':''; ?>>Cuti Sakit</option>
                                        <option value="3" <?php echo ($jenis_ijin==3)? 'selected':''; ?>>Cuti Tahunan</option>                                        
                                        <option value="4" <?php echo ($jenis_ijin==4)? 'selected':''; ?>>Cuti Besar</option>
                                        <option value="5" <?php echo ($jenis_ijin==5)? 'selected':''; ?>>Cuti Bersalin</option>
                                        <option value="6" <?php echo ($jenis_ijin==6)? 'selected':''; ?>>Cuti Karena Alasan Penting</option>
                                        <option value="7" <?php echo ($jenis_ijin==7)? 'selected':''; ?>>Dinas Luar</option>
                                    ?>
                                  </select>                              
                          </div>
                          <div class="masked-input">
                          <div class="col-md-6 col-red">
                              <b>Tanggal Permohonan </b>
                              <div class="input-group">
                                  <span class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                  </span>
                                  <div class="form-line">
                                      <input type="text" class="form-control date date-picker" name="tgl_permohonan" placeholder="contoh : 30/07/2016" value="<?php echo $tgl_permohonan;?>" required>
                                  </div>
                              </div>                              
                          </div>
                          </div>
                    </div>                                         
                    <div class="row clearfix">
                          <div class="masked-input">                            
                          <div class="col-md-6 col-red">
                              <b>Mulai Ijin </b>
                              <div class="input-group">
                                  <span class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                  </span>
                                  <div class="form-line">
                                      <input type="text" class="form-control date date-picker" name="mulai_ijin" placeholder="contoh : 30/07/2016" value="<?php echo $mulai_ijin;?>" required>
                                  </div>
                              </div>                              
                          </div>
                          </div>                          
                          <div class="masked-input">                            
                          <div class="col-md-6 col-red">
                              <b>Sampai dengan  :</b>
                              <div class="input-group">
                                  <span class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                  </span>
                                  <div class="form-line">
                                      <input type="text" class="form-control date date-picker" name="selesai_ijin" placeholder="contoh : 30/07/2016" value="<?php echo $selesai_ijin;?>" required>
                                  </div>
                              </div>                              
                          </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-12 col-red">
                            <b>Keterangan </b>
                            <div class="input-group">                                
                                <div class="form-line">
                                    <textarea class="form-control no-resize auto-growth" style="overflow: hidden; overflow-wrap: break-word; height: 32px;" placeholder="ENTER untuk menambah baris" rows="1" name="keterangan" required><?php echo $keterangan;?></textarea>                                    
                                </div>
                            </div>                            
                        </div>
                    </div>                    
                    <div class="row clearfix" >
                          <div class="col-md-12 text-center">
                          <input type="hidden" name="enc" value="<?php echo $enc ?>">
                          <input type="hidden" name="aksi" value="<?php echo $aksi ?>">
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
<script src="<?php echo base_url() ?>resources/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>resources/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>
<script src="<?php echo base_url() ?>resources/plugins/autosize/autosize.min.js"></script>
<script src="<?php echo base_url() ?>resources/plugins/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript">
autosize(document.querySelectorAll('textarea'));
$(function() {    
    var $maskInput = $('.masked-input');
    $maskInput.find('.date').inputmask('dd/mm/yyyy', {
        placeholder: '__/__/____'
    });
    $(".date").datepicker({
        autoclose: true,
        format: "dd/mm/yyyy",
    });    
});
 
</script>