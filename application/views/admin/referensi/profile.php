    <style type="text/css">
      pre{
      border: none;
      background-color: transparent;
      font-family: inherit;
      font-size: 14px;
      padding: 0px;
    }
    </style>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        <div class="card p-t-20 p-l-20 p-b-20 p-r-20">
           <img  class="img-responsive" src="<?php echo ($this->session->userdata('logo_instansi')=="" ? base_url('upload/logo/default.png') : base_url("upload/pegawai").'/'.$this->session->userdata('sess_foto')) ;?>" width="230px" alt="tidak ada foto" />
      </div>
    </div>    
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 ">
        <div class="card ">
            <div class="header bg-light-green">
                <h2>
                   <i class="fa fa-user">&nbsp&nbsp&nbsp</i> <?php echo $title;?>
                </h2>
            </div>
            <div class="body">
              <div class="table-responsive">
                  <table class="table table-hover dashboard-task-infos">
                      <tbody>
                         <tr><td>Nama</td><td><?php echo $nama ?></td></tr>
                         <tr><td>NIP</td><td><?php echo $nip ?></td></tr>
                         <tr><td>Jabatan</td><td><?php echo $jabatan ?></td></tr>
                         <tr><td>Email</td><td><pre><?php echo $alamat ?></pre></td></tr>
                         <tr><td>Telepon / HP</td><td><?php echo $telpon ?></td></tr>
                      </tbody>
                  </table>
              </div>
            </div>
      </div>
    </div>