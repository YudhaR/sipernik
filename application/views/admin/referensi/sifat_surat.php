<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header text-center">
                <h2 class="text-center col-blue-grey">
                    <i class="icon fa fa-book"> </i> REFERENSI SIFAT SURAT
                </h2>
                <ul class="header-dropdown m-r-0 animated flipInX">
                  <a href="<?php echo base_url(); ?>Referensi/sifat_surat/tambah" class="btn btn-primary" data-toggle="modal" data-target="#popUpWindow"><i class="fa fa-edit"></i> Tambah</a>
                </ul>
            </div>
            <div class="row clearfix">          	
            	<div class="col-xs-12">
            		<div class="box" style="padding:20px;">               
                    <table class="table table-bordered table-striped table-hover">
                      <thead>
                        <tr class="bg-blue">
                          <th>No</th>
                          <th>Kode Surat</th>
                          <th>Sifat Surat</th>
                          <th style="width:20px;">Aksi</th>
                      </thead>
                      <col width="5%">
                      <col width="10%">
                      <col width="40%">
                      <col width="5%">
                      <tbody>
                        	<?php  
                          $no = 1;
                          foreach ($data as $lihat):
                          ?>
                      	<tr>
                          <td><?php echo $no++ ?></td>
                          <td><?php echo ucwords($lihat->kode)?></td>
                      		<td><?php echo ucwords($lihat->nama)?></td>
                          <td align="center">
                              <div class="btn-group">
                                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bars"></i>
                                </button>
                                <ul class="dropdown-menu" role="menu" style="left:-100px">
                                    <li><a href="<?php echo base_url(); ?>Referensi/sifat_surat/edit/<?php echo base64_encode($this->encrypt->encode($lihat->sifat_id)) ?>" data-toggle="modal" data-target="#popUpWindow"><i class="fa fa-edit"></i> Edit</a></li>
                                    <li class="divider"></li>
                                    <li><a class="text-red" data-toggle="modal" href="#" data-href="<?php echo base_url(); ?>referensi/sifat_surat/hapus/<?php echo base64_encode($this->encrypt->encode($lihat->sifat_id)) ?>" data-target="#confirm-delete" ><i class="fa fa-trash"></i> Hapus</a></li>
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
          </div>
    </div>
</div>
      