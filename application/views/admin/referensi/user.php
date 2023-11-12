<div class="row">          	
	<div class="col-xs-12">
		<div class="box" style="padding:20px;">
      <div class="box-header">
        <h3 class="box-title">
        	<a href="<?php echo base_url(); ?>admin/user/tambah" class="btn btn-success" data-toggle="modal" data-target="#popUpWindow"><i class="fa fa-edit"></i> Tambah</a>
        </h3>
      </div>
      <div class="box-body table-responsive">
      
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
          <col width="10%">
          <col width="10%">
          <col width="20%">
          <col width="20%">
          <col width="20%">
          <col width="5%">
          <tbody>
            	<?php  
              $no = 1;
              foreach ($data as $lihat):
              ?>
          	<tr>
              <td><?php echo $no++ ?></td>
              <td><?php echo ucwords($lihat->kewenangan)?></td>
          		<td><?php echo ucwords($lihat->fullname)?></td>
              <td><?php echo ucwords($lihat->nip_nrp)?></td>
               <td>*****</td>
               <td>*****</td>
              <td align="center">
                  <div class="btn-group">
                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bars"></i>
                    </button>
                    <ul class="dropdown-menu" role="menu" style="left:-100px">
                        <?php if ($lihat->groupid =='0' AND $this->session->userdata('sess_idgroup',TRUE)=='0'):  ?>
                        <li><a href="<?php echo base_url(); ?>admin/user/edit/<?php echo base64_encode($this->encrypt->encode($lihat->userid)) ?>" data-toggle="modal" data-target="#popUpWindow"><i class="fa fa-edit"></i> Edit</a></li>
                        <?php endif ?>
                        <?php if ($lihat->groupid !='0'):  ?>
                        <li><a href="<?php echo base_url(); ?>admin/user/edit/<?php echo base64_encode($this->encrypt->encode($lihat->userid)) ?>" data-toggle="modal" data-target="#popUpWindow"><i class="fa fa-edit"></i> Edit</a></li>
                        <?php endif ?>
                        <li class="divider"></li>
                        <?php if ($lihat->groupid !='0'): ?>
                        <li><a class="text-red" data-toggle="modal" href="#" data-href="<?php echo base_url(); ?>admin/user/hapus/<?php echo base64_encode($this->encrypt->encode($lihat->userid)) ?>" data-target="#confirm-delete" ><i class="fa fa-trash"></i> Hapus</a></li>
                        <?php endif ?>
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
      