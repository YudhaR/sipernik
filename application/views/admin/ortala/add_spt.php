 <?php
 if($act=='update'){
    if (count($data_pegawai)<>0){                
      foreach ($data_pegawai as $row=>$val){
        $pegawai_sebelumnya[]=$val['id'];              
      }
    }
 }  
 ?>
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
                  <form method="post" action="<?php echo base_url().'Kepegawaian/'.$act.'_spt';?>" enctype="multipart/form-data">
                  <div class="row clearfix">
                          <div class="col-md-6 col-red">
                              <b>Nomor Surat </b>
                              <div class="input-group">
                                  <span class="input-group-addon">
                                      <i class="fa fa-book"></i>
                                  </span>
                                  <div class="form-line">
                                      <input type="text" class="form-control" name="nomor_surat" value="<?php echo $nomor_surat;?>" required>
                                  </div>
                              </div>
                          </div>
                          <div class="masked-input">
                          <div class="col-md-6 col-red">
                              <b>Tanggal Surat </b>
                              <div class="input-group">
                                  <span class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                  </span>
                                  <div class="form-line">
                                      <input type="text" class="form-control date date-picker" name="tanggal_surat" placeholder="contoh : 30/07/2016" value="<?php echo $tanggal_surat;?>" required>
                                  </div>
                              </div>
                          </div>
                          </div>
                    </div>
                  <div class="row clearfix">
                          <div class="col-md-6 col-red">
                            <b>Nama Pegawai </b>
                              <?php
                              $f_pegawai = $this->db->query("SELECT * FROM ctr_pegawai ORDER BY nama ASC")->result();
                              ?>
                            <select name="pegawai_id[]" class="form-control" required>
                              <?php                            
                              if(!empty($f_pegawai)){
                                  echo "<option value=''>Pilih Nama Pegawai</option>";
                                  foreach ($f_pegawai as $row){
                                    $id=$row->id;                                  
                                    if (array_key_exists(0, $pegawai_sebelumnya) AND $act=='update'){
                                      if($pegawai_sebelumnya[0]==$row->id){
                                        echo "<option selected value='$id' >$row->nama</option>";
                                      }else{                                    
                                        echo "<option value='$id'>$row->nama</option>";
                                      }
                                    }else{
                                      echo "<option value='$id'>$row->nama</option>";
                                    }                                    
                                  }
                              }                                
                              ?>
                            </select>
                            <select name="pegawai_id[]" class="form-control">
                              <?php
                              if(!empty($f_pegawai)){
                                  echo "<option value='0'>Pilih Nama Pegawai</option>";
                                  foreach ($f_pegawai as $row){
                                    $id=$row->id;                                  
                                    if (array_key_exists(1, $pegawai_sebelumnya) AND $act=='update'){
                                      if($pegawai_sebelumnya[1]==$row->id){
                                        echo "<option selected value='$id' >$row->nama</option>";
                                      }else{                                    
                                        echo "<option value='$id'>$row->nama</option>";
                                      }
                                    }else{
                                      echo "<option value='$id'>$row->nama</option>";
                                    }
                                    
                                  }
                              }                                
                              ?>
                            </select>                            
                            <select name="pegawai_id[]" class="form-control">
                              <?php
                              if(!empty($f_pegawai)){
                                  echo "<option value='0'>Pilih Nama Pegawai</option>";
                                  foreach ($f_pegawai as $row){
                                    $id=$row->id;                                  
                                    if (array_key_exists(2, $pegawai_sebelumnya) AND $act=='update'){
                                      if($pegawai_sebelumnya[2]==$row->id){
                                        echo "<option selected value='$id' >$row->nama</option>";
                                      }else{                                    
                                        echo "<option value='$id'>$row->nama</option>";
                                      }
                                    }else{
                                      echo "<option value='$id'>$row->nama</option>";
                                    }                                    
                                  }
                              }                                
                              ?>
                            </select>                            
                          </div>
                          <div class="col-md-6 col-red">
                              <b>Pergi Ke </b>
                              <div class="input-group">
                                  <span class="input-group-addon">
                                      <i class="fa fa-book"></i>
                                  </span>
                                  <div class="form-line">
                                      <input type="text" class="form-control" name="pergi_ke" value="<?php echo $pergi_ke;?>" required>
                                  </div>
                              </div>
                          </div>                          
                    </div>
                    <div class="row clearfix">                          
                          <div class="col-md-6 col-red">
                              <b>Berkendaraan </b>
                              <div class="input-group">
                                  <span class="input-group-addon">
                                      <i class="fa fa-book"></i>
                                  </span>
                                  <div class="form-line">
                                      <input type="text" class="form-control" name="berkendaraan" value="<?php echo $berkendaraan;?>" required>
                                  </div>
                              </div>
                          </div>
                          <div class="masked-input">                            
                          <div class="col-md-6 col-red">
                              <b>Berangkat  :</b>
                              <div class="input-group">
                                  <span class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                  </span>
                                  <div class="form-line">
                                      <input type="text" class="form-control date date-picker" name="berangkat" placeholder="contoh : 30/07/2016" value="<?php echo $berangkat;?>" required>
                                  </div>
                              </div>
                          </div>
                        </div>
                    </div>                     
                    <div class="row clearfix">                        
                        <div class="masked-input">
                          <div class="col-md-6 col-red">
                                <b>Mulai</b>
                                <div class="input-group">
                                  <span class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                  </span>
                                  <div class="form-line">
                                      <input type="text" class="form-control date date-picker" name="mulai" placeholder="contoh : 30/07/2016" value="<?php echo $mulai;?>" required>                                      
                                  </div>
                              </div>
                          </div>
                        </div>
                        <div class="masked-input">                              
                          <div class="col-md-6 col-red">
                                <b>Selesai</b>
                                <div class="input-group">
                                  <span class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                  </span>
                                  <div class="form-line">
                                      <input type="text" class="form-control date date-picker" name="selesai" placeholder="contoh : 30/07/2016" value="<?php echo $selesai;?>" required>
                                  </div>
                              </div>
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