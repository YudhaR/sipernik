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
                    <strong>BUKU TAMU</strong>
                </h2>
                <ul class="header-dropdown m-r-0 animated flipInX">
                  <?php if ($this->session->userdata('sess_idgroup')<2 OR $this->session->userdata('sess_idgroup')==5): ?>
                  <a href="<?php echo base_url(); ?>Buku_tamu/tamu/tambah" class="btn btn-primary  pull-right" data-toggle="modal" data-target="#popUpWindow"> Tambah Data Tamu</a>
                  <?php endif ;?>
                </ul>
            </div>
      <div class="row clearfix">            
      <div class="col-xs-12">
        <div class="box" style="padding:20px;">  
        <table class="table table-bordered table-striped table-hover js-basic-example">
          <thead>
            <tr class="bg-teal">
              <th>No</th>             
              <th>Nama</th>
              <th>Telp/HP</th>
              <th>Alamat</th>
              <th>Keperluan</th>
              <th>Menghadap Ke</th>
              <?php if ($this->session->userdata('sess_idgroup')<2 OR $this->session->userdata('sess_idgroup')==5): ?>
              <th style="width:20px;">Aksi</th>
              <?php endif ;?>
          </thead>
          <col width="5%">
          <col width="15%">
          <col width="15%">
          <col width="15%">
          <col width="30%">
          <col width="15%">
          <?php if ($this->session->userdata('sess_idgroup')<2 OR $this->session->userdata('sess_idgroup')==5): ?>
          <col width="5%">
          <?php endif ;?>
          <tbody>
            	<?php  
              $no = 1;
              foreach ($data as $lihat):
              ?>
          	<tr>
              <td><?php echo $no++ ?></td>
          		<td><?php echo ucwords($lihat->nama)?></td>
              <td><?php echo ucwords($lihat->telpon)?></td>
              <td><?php echo ucwords($lihat->alamat)?></td>
              <td><?php echo ucwords($lihat->keperluan)?></td>
              <td><?php echo ucwords($lihat->bagian)?></td>
              <?php if ($this->session->userdata('sess_idgroup')<2 OR $this->session->userdata('sess_idgroup')==5): ?>
              <td align="center">
                  <div class="btn-group">
                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bars"></i>
                    </button>
                    <ul class="dropdown-menu" role="menu" style="left:-100px">
                        <li><a href="<?php echo base_url(); ?>Buku_tamu/tamu/edit/<?php echo base64_encode($this->encrypt->encode($lihat->id)) ?>" data-toggle="modal" data-target="#popUpWindow"><i class="fa fa-edit"></i> Edit</a></li>
                        <li class="divider"></li>
                        <li><a class="text-red" data-toggle="modal" href="#" data-href="<?php echo base_url(); ?>Buku_tamu/tamu/hapus/<?php echo base64_encode($this->encrypt->encode($lihat->id)) ?>" data-target="#confirm-delete" ><i class="fa fa-trash"></i> Hapus</a></li>
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
      