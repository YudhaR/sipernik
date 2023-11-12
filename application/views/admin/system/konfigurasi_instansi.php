<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header text-center">
                <h2 class="text-center col-blue-grey">
                    <i class="icon fa fa-envelope"> </i> KONFIGURASI PROFIL INSTANSI
                    <small class="col-blue">Tips: Setelah simpan pastikan logout dan login kembali </small>
                </h2>
            </div>
            <div class="body">
                <form style="background:white;margin:0;" method="post" action="<?php echo base_url().'konfigurasi_system/konfigurasi_instansi/edit';?>" enctype="multipart/form-data">
                      <div class="row clearfix">
                            <div class="col-md-5">
                                NAMA INSTANSI :
                                <br><small class="col-blue">Judul Header 1</small>
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="nama" placeholder="PENGADILAN NEGERI XX" value="<?php echo $nama;?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                ALAMAT INSTANSI :
                                <br><small class="col-blue">Judul Header 2</small>
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="alamat"  placeholder="Jl. Jenderal Sudirman No.3 Sawahlunto" value="<?php echo $alamat;?>">
                                    </div>
                                </div>
                            </div>
                      </div>
                      <div class="row clearfix">
                            <div class="col-md-5">
                                NAMA KOTA :                                
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="nama_kota" placeholder="Langsa" value="<?php echo $nama_kota;?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                KODE PENGADILAN :                                
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="kode_pn" placeholder="PN/PA Langsa" value="<?php echo $kode_pn;?>">
                                    </div>
                                </div>
                            </div>
                      </div>
                      <div class="row clearfix">
                            <div class="col-md-5">
                                Ketua / Pimpinan :
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="ketua" placeholder="" value="<?php echo $ketua;?>">
                                    </div>
                                </div>
                            </div>
                              <div class="col-md-5">
                                  NIP :
                                  <div class="input-group">
                                      <div class="form-line">
                                          <input type="text" class="form-control" name="nip" placeholder="" value="<?php echo $nip;?>">
                                      </div>
                                  </div>
                              </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-5">
                                Logo Instansi:
                                <div class="input-group">
                                    <div class="form-line">
                                        <input name="file_logo" type="file" multiple style="display: block" class="btn btn-warning"/>
                                        <small>Format gambar : <strong> JPG,PNG</strong> maksimal 4MB</small>
                                    </div>
                                </div>
                            </div>
                            <?php if ($logo!=""): ?>
                            <div class="col-sm-4">
                                <div class="icon">
                                    <div class="image p-t-10 p-l-20">
                                        <img src="<?php echo base_url('upload/logo')."/".$logo ?>" height="50" alt="-" />
                                    </div>
                                </div>
                            </div>
                            <?php endif ?>
                        </div>

                  <div class="row clearfix">
                      <div class="col-md-12 text-center">
                        <a href="<?php echo base_url('Home')?>" type="button" class="btn btn-warning btn-lg waves-effect" data-dismiss="modal">Batal</a>
                        <button type="submit" class="btn bg-cyan  btn-lg waves-effect">Simpan</button>
                        <input type="hidden" name="enc" value="<?php echo $enc ?>"/>
                      </div>
                  </div>
                  <?php echo form_close(); ?>
  </div>
</div>