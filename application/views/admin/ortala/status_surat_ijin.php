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
                        <div class="col-md-6 col-blue">
                          <b>Nama Pegawai </b>
                          <?php
                            $f_pegawai = $this->db->query("SELECT * FROM ctr_pegawai ORDER BY nama ASC")->result();                            
                                foreach ($f_pegawai as $row) {
                                   if($pegawai_id==$row->id){
                                      echo '<br><font color="black" size="4px">'.$row->nama.'</font>';
                                   }
                                }                              
                            ?>
                        </div>                        
                    </div>
                    <div class="row clearfix">                          
                          <div class="col-md-6 col-blue">
                              <b>Jenis Ijin </b>                                                           
                                  <br><font color="black" size="4px"><?php echo $jenis_ijin_nama;?></font>
                          </div>
                          <div class="masked-input">
                          <div class="col-md-6 col-blue">
                              <b>Tanggal Permohonan </b>                                                          
                                  <br><font color="black" size="4px"><?php echo $tgl_permohonan; ?></font>
                          </div>
                          </div>
                    </div>                                         
                    <div class="row clearfix">
                          <div class="masked-input">                            
                          <div class="col-md-6 col-blue">
                              <b>Mulai Ijin </b>
                                  <br><font color="black" size="4px"><?php echo $mulai_ijin; ?></font>
                          </div>
                          </div>                          
                          <div class="masked-input">                            
                          <div class="col-md-6 col-blue">
                              <b>Sampai dengan  :</b>                                                           
                                  <br><font color="black" size="4px"><?php echo $selesai_ijin; ?></font>
                          </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-12 col-blue">
                            <b>Keterangan </b>                            
                                  <br><font color="black" size="4px"><?php echo $keterangan;?></font>
                        </div>
                    </div>                                                          
                    <div class="row clearfix">
                        <div class="col-md-6 col-red">
                            <b>Apakah Disetujui Ijinnya? </b>
                                <select id="opsi" name="diijinkan" class="form-control" required>
                                    <option value='1' <?php echo ($diijinkan==1)? 'selected':''; ?>>Disetujui</option>
                                    <option value='2' <?php echo ($diijinkan==2)? 'selected':''; ?>>Tidak Disetujui</option>
                                </select>
                        </div>
                        <div class="masked-input">
                          <div class="col-md-6 col-red">
                              <b>Tanggal Disetujui/Tidak </b>
                              <div class="input-group">
                                  <span class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                  </span>
                                  <div class="form-line">
                                      <input type="text" class="form-control date date-picker" id="tgl_diijinkan" name="tgl_diijinkan" placeholder="contoh : 30/07/2016" value="<?php echo $tgl_diijinkan;?>" required>
                                  </div>
                              </div>
                          </div>
                          </div>
                    </div>
                    <div class="row clearfix" id="nomor">
                        <div class="col-md-3 col-red">
                            <b>Nomor Surat </b>
                            <div class="input-group">                                  
                                  <div class="form-line">
                                      <input type="text" class="form-control" id="nomor_urut" name="nomor_urut_surat" value="<?php echo $nomor_urut_surat;?>" required>
                                  </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-red">                                                    
                              <div class="form-line">
                                    <input id="check_nomor" type="checkbox" <?php echo empty($nomor_surat)?"checked" : " ";?>> Format Surat 
                                    <div class="input-group">
                                            <input type="text" id="format_nomor_surat" class="form-control col-blue" name="format_nomor_surat" readonly>
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
    get_nomor('surat');    
    var $maskInput = $('.masked-input');
    $maskInput.find('.date').inputmask('dd/mm/yyyy', {
        placeholder: '__/__/____'
    });
    $(".date").datepicker({
        autoclose: true,
        format: "dd/mm/yyyy",
    });
    $('#tgl_diijinkan').change(function() {
        get_nomor('surat');        
    });
    var cek = '<?php echo $diijinkan; ?>';
    if(cek==1)
      $("#nomor").show();
    else $("#nomor").hide();
    if(cek=='')
      $("#nomor").show();
});
$('#opsi').change(function() {
    if(($(this).val()==1))
      $("#nomor").show();
    else $("#nomor").hide();        
});

$("#nomor_urut").keyup(function() {
    get_nomor('surat');
});
$('#check_nomor').click(function(event) {
    get_nomor('surat');
});
function get_nomor(jenis) {
    if (jenis == "surat") {
        if ($('#check_nomor').prop('checked')) {
            var f_nomor = '<?php echo $format_nomor_surat;?>';
        } else {
            var f_nomor = '<?php echo $nomor_surat;?>';
        }
        $('#format_nomor_surat').val(generate_nomor(f_nomor))
    } 
}; 
function generate_nomor(el) {
    var tmp = $('#tgl_diijinkan').val().split("/");
    var bln = tmp[1];
    var thn = tmp[2];
    var nmr = $('#nomor_urut').val();
    var tmp = el;
    var tmp2 = tmp.replace("NMR", nmr);
    var tmp3 = tmp2.replace("BLN", romanize(bln));
    var result = tmp3.replace("THN", thn);
    return result;
};   
</script>