<style type="text/css">
    .dataTables_filter, .dataTables_paginate{
        float: right;
        margin-top: -40px;
        padding-top: 20px;
    }    
    .table tbody tr td, .table tbody tr th,.table tfoot tr th,.table thead tr th{
      padding:5px;
      vertical-align: middle;
    }
    title{display: none}
</style>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header text-center">
                <div class="icon_big">
                    <i class="fa fa-file-text"> </i>
                </div>
                <h2 class="text-center col-blue-grey">
                    <strong>SURAT IJIN PEGAWAI</strong>
                </h2>
                <ul class="header-dropdown m-r-0 animated flipInX">                  
                  <a href="<?php echo base_url(); ?>Kepegawaian/surat_ijin/tambah" class="btn btn-primary  pull-right" data-toggle="modal" data-target="#popUpWindow"> Tambah Data Ijin Pegawai</a>
                </ul>
            </div>
      <div class="row clearfix">            
      <div class="col-xs-12">
        <div class="box" style="padding:20px;">  
        <table class="table table-bordered table-striped table-hover js-basic-example">
          <thead>
            <tr class="bg-teal">
              <th class="align-center">No</th>             
              <th class="align-center">Pegawai & Tgl Permohonan</th>
              <th class="align-center">Jenis Ijin</th>
              <th class="align-center">Tgl Ijin</th>
              <th class="align-center">Keterangan</th>
              <th class="align-center">Status</th>
              <?php if ($this->session->userdata('sess_idgroup')<2 OR $this->session->userdata('sess_idgroup')==6): ?>
              <th class="align-center" style="width:20px;">Aksi</th>
              <?php endif ;?>
          </thead>
          <col width="5%">
          <col width="20%">
          <col width="15%">
          <col width="17%">
          <col width="27%">
          <col width="10%">
          <?php if ($this->session->userdata('sess_idgroup')<2 OR $this->session->userdata('sess_idgroup')==6): ?>
          <col width="5%">
          <?php endif ;?>
          <tbody>
            	<?php  
              $no = 1;                                                    
              foreach ($data as $lihat):
              ?>
          	<tr>
              <td align="center"><?php echo $no++ ?></td>
          		<td><?php echo ucwords($lihat->nama)?><br><?php echo $this->tanggalhelper->convertDate($lihat->tgl_permohonan)?></td>
              <td>
                <?php 
                  if($lihat->jenis_ijin==1){
                    echo 'Ijin Tidak Masuk';
                  }elseif($lihat->jenis_ijin==2){
                    echo 'Cuti Sakit';
                  }elseif($lihat->jenis_ijin==3){
                    echo 'Cuti Tahunan';
                  }elseif($lihat->jenis_ijin==4){
                    echo 'Cuti Besar';
                  }elseif($lihat->jenis_ijin==5){
                    echo 'Cuti Bersalin';
                  }elseif($lihat->jenis_ijin==6){
                    echo 'Cuti Karena Alasan Penting';
                  }elseif($lihat->jenis_ijin==7){
                    echo 'Dinas Luar';
                  }else{
                    echo '';
                  }
                ?>
              </td>
              <td>Mulai : <?php echo $this->tanggalhelper->convertDate($lihat->mulai_ijin) ?><br>Selesai : <?php echo $this->tanggalhelper->convertDate($lihat->selesai_ijin) ?></td>
              <td><?php echo ucwords($lihat->keterangan)?></td>
              <td align="center">
                <?php if ($this->session->userdata('sess_idgroup')>=3 AND ($this->session->userdata('sess_idgroup')!=6)): 
                		 echo $lihat->status; 
                      endif ;
                ?> 
                <?php if ($this->session->userdata('sess_idgroup')<2 OR $this->session->userdata('sess_idgroup')==6): ?>                                   
                      <a <?php echo $lihat->clasnya ?> href="<?php echo base_url(); ?>Kepegawaian/surat_ijin/status/<?php echo base64_encode($this->encrypt->encode($lihat->id)) ?>" data-toggle="modal" data-target="#popUpWindow"><i class="fa fa-edit"></i> <?php echo $lihat->status; ?></a>
                <?php endif ;?>           
              </td>
              <?php if ($this->session->userdata('sess_idgroup')<2 OR $this->session->userdata('sess_idgroup')==6): ?>
              <td align="center">
                  <div class="btn-group">
                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bars"></i>
                    </button>
                    <ul class="dropdown-menu" role="menu" style="left:-100px">
                        <li><a href="<?php echo base_url(); ?>Kepegawaian/surat_ijin/edit/<?php echo base64_encode($this->encrypt->encode($lihat->id)) ?>" data-toggle="modal" data-target="#popUpWindow"><i class="fa fa-edit"></i> Edit</a></li> 
                        <li class="divider"></li>
                          <li><a <?php echo $lihat->clasnya ?> href="<?php echo base_url(); ?>Kepegawaian/cetak_cuti/<?php echo base64_encode($this->encrypt->encode($lihat->id)) ?>/<?php echo base64_encode($this->encrypt->encode($lihat->jenis_ijin)) ?>" data-toggle="modal"><i class="fa fa-print"></i> Cetak Permohonan</a></li>
                        <?php if($lihat->diijinkan==1 AND $lihat->jenis_ijin!=1):?>
                            <li><a <?php echo $lihat->clasnya ?> href="<?php echo base_url(); ?>Kepegawaian/popup_cetak_ijin/<?php echo base64_encode($this->encrypt->encode($lihat->id)) ?>/<?php echo base64_encode($this->encrypt->encode($lihat->jenis_ijin)) ?>" data-toggle="modal" data-target="#popUpWindow"><i class="fa fa-print"></i> Cetak Ijin</a></li>
                        <?php endif;?>                        
                        <li class="divider"></li>
                        <li><a class="text-red" data-toggle="modal" href="#" data-href="<?php echo base_url(); ?>Kepegawaian/surat_ijin/hapus/<?php echo base64_encode($this->encrypt->encode($lihat->id)) ?>" data-target="#confirm-delete" ><i class="fa fa-trash"></i> Hapus</a></li>
                    </ul>
                  </div>
              </td>
              <?php endif ;?>                  		
          	</tr>
          	<?php endforeach; ?>
          </tbody>
        </table>
        </div>
      </div>
   </div>
</div>
      