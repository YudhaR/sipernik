    <div class="col-lg-12">
        <form class="form_penomoran" action="<?php echo base_url().'Referensi/update_penomoran';?>" method="post">
            <div class="card">
                <div class="header bg-green text-center">
                    <h2>
                       FORMAT PENOMORAN AGENDA SURAT
                    </h2>

                </div>
                <div class="body">
                    <?php echo validation_errors(); ?>  
                            <div class="row clearfix">
                                <div class="col-md-6 col-red">
                                    <b>Agenda Surat Masuk :</b><br>
                                    <small class="col-green">contoh : NOMOR/AGNO.M/BLN/THN</small>
                                    <div class="input-group">
                                        <div class="form-line">
                                            <input type="text" id="format_surat_masuk" class="form-control" name="format_surat_masuk" value="<?php echo $format_agenda_masuk;?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-red">
                                   <b>Agenda Surat Keluar :</b><br>
                                   <small class="col-green">contoh : NOMOR/AGNO.K/BLN/THN</small>
                                    <div class="input-group">
                                        <div class="form-line">
                                            <input id="format_surat_keluar"  type="text" class="form-control" name="format_surat_keluar" value="<?php echo $format_agenda_keluar;?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-12 text-center">
                                  <button type="submit" class="btn bg-cyan  btn-lg waves-effect">Simpan</button>
                                </div>
                            </div>
                    </div>
            </div>
            </form>
            <div class="card">
            <div class="header bg-green text-center">
                <h2>
                   FORMAT PENOMORAN SURAT KELUAR
                </h2>

            </div>
            <div class="body">
                   <h3 class="box-title">
                    <a href="<?php echo base_url(); ?>Referensi/penomoran/tambah" class="btn btn-success" data-toggle="modal" data-target="#popUpWindow"><i class="fa fa-edit"></i> Tambah</a>
                  </h3>
                <table id="example1" class="table table-bordered table-hover dataTable">
                  <thead>
                    <tr class="bg-red">
                      <th>No</th>
                      <th>Bagian</th>
                      <th>Kode</th>
                      <th>Format Nomor</th>
                      <th>Keterangan</th>
                      <th style="width:20px;">Aksi</th>
                  </thead>
                  <col width="5%">
                  <col width="15%">
                  <col width="10%">
                  <col width="20%">
                  <col width="30%">
                  <col width="5%">
                  <tbody>
                        <?php  
                      $no = 1;
                      foreach ($format_surat_keluar as $lihat):
                      ?>
                    <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo ucwords($lihat->bagian_text)?></td>
                      <td><?php echo ucwords($lihat->kode_surat)?></td>
                      <td><?php echo ucwords($lihat->format_penomoran)?></td>
                      <td><?php echo ucwords($lihat->uraian)?></td>
                      <td align="center">
                          <div class="btn-group">
                            <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bars"></i>
                            </button>
                            <ul class="dropdown-menu" role="menu" style="left:-100px">
                                <?php if ($this->session->userdata('sess_idgroup',TRUE)=='0'):  ?>
                                <li><a href="<?php echo base_url(); ?>Referensi/penomoran/edit/<?php echo base64_encode($this->encrypt->encode($lihat->id)) ?>" data-toggle="modal" data-target="#popUpWindow"><i class="fa fa-edit"></i> Edit</a></li>
                                <?php endif ?>
                                <li class="divider"></li>
                                <li><a class="text-red" data-toggle="modal" href="#" data-href="<?php echo base_url(); ?>Referensi/penomoran/hapus/<?php echo base64_encode($this->encrypt->encode($lihat->id)) ?>" data-target="#confirm-delete" ><i class="fa fa-trash"></i> Hapus</a></li>
                            </ul>
                          </div>
                      </td>                         
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    


<script src="<?php echo base_url() ?>resources/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
    $("#format_nomor_surat").keyup(function(){
        var value=generate_nomor($(this).val());
        $('#examp_surat').text(value)
    })
    $("#format_nomor_agenda").keyup(function(){
        var value=generate_nomor($(this).val());
        $('#examp_agenda').text(value)
    })   
    $(function(){
        $('#examp_surat').text(generate_nomor($("#format_nomor_surat").val()))
        $('#examp_agenda').text(generate_nomor($("#format_nomor_agenda").val()))
    });
    function generate_nomor(e){
        var year= new Date();
        var tahun = year.getFullYear();
        var tmp=e;
        var tmp2 = tmp.replace("BLN", romanize('12'));
        var tmp3 = tmp2.replace("NOMOR", '145');
        var result = tmp3.replace("THN", tahun);
        return result;
    } 
</script>