 <div class="box box-info">
  <div class="box-body">
          <div class="callout callout-info">
            <h4>Tip!</h4>
            <p>Pastikan anda logout kemudian login kembali setelah melakukan konfigurasi.</p>
        </div>
    <form style="background:white;margin:0;" method="post" action="<?php echo base_url().'admin/konfigurasi_instansi/edit';?>" enctype="multipart/form-data">
    <?php //echo form_open_multipart('admin/konfigurasi_instansi/edit'); ?>
      <div class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-4">Nama</label>
          <div class="col-sm-8">
            <input id="nama_text" type="text" class="form-control" name="nama" value="<?php echo $nama; ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4">Alamat</label>
          <div class="col-sm-8">
            <input id="alamat_text" type="text" class="form-control" name="alamat" value="<?php echo $alamat; ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4">Kepala / Ketua</label>
          <div class="col-sm-8">
            <input id="ketua_text" type="text" class="form-control" name="ketua" value="<?php echo $ketua; ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4">NRP / NIP </label>
          <div class="col-sm-8">
            <input id="nip_text" type="text" class="form-control" name="nip" value="<?php echo $nip; ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4">Logo</label>
          <div class="col-sm-8">
            <input type="file" class="form-control" name="file_logo">
          </div>
        </div>
        <br>
        <input type="hidden" name="enc" value="<?php echo $enc ?>">
          <div class="col-md-12 text-center">
              <a href="<?php echo base_url('admin/index')?>" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Batal</a>
          <button type="submit" name="simpan" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
          </div>

      </div>
      <?php echo form_close(); ?>
  </div>
</div>