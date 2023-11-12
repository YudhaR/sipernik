<div class="col-lg-12">
        <div class="card">
            <div class="header bg-green">
                <h2><i class="fa fa-print"></i>
                   <?php echo $title;?>                   
                </h2>
            </div>
            <div class="body">
                  <form method="post" action="<?php echo base_url().'Kepegawaian/cetak_ijin_c';?>" enctype="multipart/form-data">                  
                  <div class="row clearfix">
                          <div class="col-md-12 col-red">
                            <b>Pejabat Yang Berwenang </b>                            
                            <select name="pejabat_ttd" class="form-control" required>
                              <?php                            
                              if(!empty($ttd)){                                  
                                  foreach ($ttd as $row){
                                    $id=$row->id;
                                    echo "<option value='$id'>$row->nama</option>";
                                  }
                              }                                
                              ?>
                            </select>                                                       
                          </div>                                                
                    </div>                    
                    <div class="row clearfix" >
                        <div class="col-md-12 text-center">
                        <input type="hidden" name="enc_surat" value="<?php echo $enc_surat ?>">
                        <input type="hidden" name="jenis_ijin" value="<?php echo $jenis_ijin ?>">
                          <div class="col-md-12 text-center">
                              <button type="button" class="btn btn-warning btn-lg waves-effect" data-dismiss="modal">Batal</button>
                               <button type="submit" class="btn bg-cyan  btn-lg waves-effect">Cetak</button>
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
