<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header text-center">
                <h2 class="text-center col-blue-grey">
                    <i class="icon fa fa-envelope"> </i> USER / PENGGUNA
                </h2>
                <ul class="header-dropdown m-r-0 animated flipInX">
                    <a class="btn bg-red" href="<?php echo base_url('Info/user')?>" data-toggle="modal" data-target="#popUpWindow"><i class="fa fa-question-circle-o  col-white"></i></a>&nbsp
                    <a class="btn btn-warning" href="<?php echo base_url('Konfigurasi_system/user/tambah');?>" data-toggle="modal" data-target="#popUpWindow">Tambah User</a>
                </ul>
            </div>
            <div class="body">
        <table id="example1" class="table table-bordered table-hover dataTable">
          <thead>
            <tr class="bg-red">
              <th>No</th>
              <th>Group</th>
              <th>Nama</th>
              <th>NIP / NRP</th>
              <th>Username</th>
              <th>Password</th>
              <th style="width:20px;">Aksi</th>
          </thead>
          <col width="5%">
          <col width="12%">
          <col width="30%">
          <col width="10%">
          <col width="10%">
          <col width="10%">
          <col width="5%">
          <tbody>
            	<?php  
              $no = 1;
              foreach ($data as $lihat):
                if ($lihat->userid!="0") {
              ?>
          	<tr>
              <td><?php echo $no++ ?></td>
              <td><?php echo ucwords($lihat->kewenangan)?></td>
          		<td><?php echo ucwords($lihat->fullname)?></td>
              <td><?php echo ucwords($lihat->nip_nrp)?></td>
              <td><?php echo ucwords($lihat->username)?></td>
               <td>*****</td>
              <td align="center">
                  <div class="btn-group">
                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bars"></i>
                    </button>
                    <ul class="dropdown-menu" role="menu" style="left:-100px">
                        <li><a href="<?php echo base_url(); ?>Konfigurasi_system/user/edit/<?php echo base64_encode($this->encrypt->encode($lihat->userid)) ?>" data-toggle="modal" data-target="#popUpWindow"><i class="fa fa-edit"></i> Edit</a></li>
                        <li class="divider"></li>
                        <li><a class="text-red" data-toggle="modal" href="#" data-href="<?php echo base_url(); ?>Konfigurasi_system/user/hapus/<?php echo base64_encode($this->encrypt->encode($lihat->userid)) ?>" data-target="#confirm-delete" ><i class="fa fa-trash"></i> Hapus</a></li>
                    </ul>
                  </div>
              </td>                  		
          	</tr>
          	<?php } endforeach; ?>
          </tbody>
        </table>
        </div>
      </div>
   </div>
</div>
      