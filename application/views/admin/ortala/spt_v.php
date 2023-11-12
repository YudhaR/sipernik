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
                    <i class="fa fa-newspaper-o"> </i>
                </div>
                <h2 class="text-center col-blue-grey">
                    <strong>SURAT PERINTAH TUGAS (SPT)</strong>
                </h2>
                <ul class="header-dropdown m-r-0 animated flipInX">
                  <?php if ($this->session->userdata('sess_idgroup')<2 OR $this->session->userdata('sess_idgroup')==6): ?>
                  <a href="<?php echo base_url(); ?>Kepegawaian/surat_spt/tambah" class="btn btn-primary  pull-right" data-toggle="modal" data-target="#popUpWindow"> Tambah Data SPT</a>
                  <?php endif ;?>
                </ul>
            </div>
      <div class="row clearfix">            
      <div class="col-xs-12">
        <div class="box" style="padding:20px;">  
        <table class="table table-bordered table-striped table-hover js-basic-example">
          <thead>
            <tr class="bg-teal">
              <th class="align-center">No</th>             
              <th class="align-center">Nomor & Tgl Surat</th>
              <th class="align-center">Pegawai</th>
              <th class="align-center">Tgl Tugas</th>
              <th class="align-center">Pergi Ke</th>
              <th class="align-center">Keperluan</th>
              <?php if ($this->session->userdata('sess_idgroup')<2 OR $this->session->userdata('sess_idgroup')==6): ?>
              <th class="align-center" style="width:20px;">Aksi</th>
              <?php endif ;?>
          </thead>
          <col width="5%">
          <col width="15%">
          <col width="15%">
          <col width="17%">
          <col width="15%">
          <col width="27%">
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
          		<td><?php echo ucwords($lihat->nomor_surat)?><br><?php echo $this->tanggalhelper->convertDate($lihat->tanggal_surat)?></td>
              <td>
                <?php 
                  $data_pegawai = $this->db->query("SELECT nama FROM ctr_pegawai WHERE id IN (".$lihat->pegawai_id.")")->result();
                  if(!empty($data_pegawai)){
                    foreach($data_pegawai as $row){
                      echo $row->nama.'<br>';
                    }
                  }
                ?>
              </td>
              <td>Berangkat :<br> <?php echo $this->tanggalhelper->convertDate($lihat->berangkat) ?><br>Mulai : <?php echo $this->tanggalhelper->convertDate($lihat->mulai) ?><br>Selesai : <?php echo $this->tanggalhelper->convertDate($lihat->selesai) ?></td>
              <td><?php echo ucwords($lihat->pergi_ke)?></td>
              <td><?php echo ucwords($lihat->keperluan)?></td>
              <?php if ($this->session->userdata('sess_idgroup')<2 OR $this->session->userdata('sess_idgroup')==6): ?>
              <td align="center">
                  <div class="btn-group">
                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bars"></i>
                    </button>
                    <ul class="dropdown-menu" role="menu" style="left:-100px">
                        <li><a href="<?php echo base_url(); ?>Kepegawaian/surat_spt/edit/<?php echo base64_encode($this->encrypt->encode($lihat->id)) ?>" data-toggle="modal" data-target="#popUpWindow"><i class="fa fa-edit"></i> Edit</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url(); ?>Kepegawaian/popup_cetak_spt/<?php echo base64_encode($this->encrypt->encode($lihat->id)) ?>" data-toggle="modal" data-target="#popUpWindow"><i class="fa fa-print"></i> Cetak SPT</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url(); ?>Kepegawaian/popup_cetak_sppd/<?php echo base64_encode($this->encrypt->encode($lihat->id)) ?>" data-toggle="modal" data-target="#popUpWindow"><i class="fa fa-print"></i> Cetak Hal Depan SPPD</a></li>
                        <li><a href="<?php echo base_url(); ?>Kepegawaian/cetak_sppd_bel/"><i class="fa fa-print"></i> Cetak Hal Belakang SPPD</a></li>
                        <li class="divider"></li>
                        <li><a class="text-red" data-toggle="modal" href="#" data-href="<?php echo base_url(); ?>Kepegawaian/surat_spt/hapus/<?php echo base64_encode($this->encrypt->encode($lihat->id)) ?>" data-target="#confirm-delete" ><i class="fa fa-trash"></i> Hapus</a></li>
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
      