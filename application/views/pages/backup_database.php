<div class="modal fade" id="confirm-restore" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="top:20%;"> 
        <div class="modal-dialog" role="document"> 
                <div class="modal-content modal-col-red">
                        <div class="modal-header"> 
                            <h1 class="modal-title animated infinite flash" id="defaultModalLabel">Perhatian !!</h1> 
                        </div> 
                        <div class="modal-body"> Database akan direstore :
                                                <ul>
                                                    <li>Data persuratan</li>
                                                    <li>Data arsip / ordner</li>
                                                    <li>Data Barang</li>
                                                    <li>Data Pegawai</li>
                                                    <li>Data Username dan Password</li>
                                                </ul>
                                                 Perintah ini tidak bisa dibatalkan, pastikan anda sudah membackup database terlebih dahulu,<br>
                                                 apakah anda yakin !!!</div>
                        <div class="modal-footer"> <a type="button" class="btn btn-link waves-effect btn-ok pull-left">YA</a> <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">TIDAK</button></div>
                 </div>
        </div>
</div> 
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header text-center">
                <div class="icon_big">
                    <i class="icon fa fa-clipboard"> </i>
                </div>
                <h2 class="text-center col-blue-grey">
                     BACKUP DATABASE 
                </h2>
                <ul class="header-dropdown m-r-0 animated flipInX">
                    <a class="btn bg-red" href="<?php echo base_url('Konfigurasi_system/backup_database/now');?>">Backup Sekarang</a>&nbsp
                </ul>
            </div>
            <div class="body">
                <a class="bg-red">Perhatian !!! <br>
                                  Backup terlebih dahulu sebelum anda restore database
                                  </a>
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr class="bg-teal align-center">
                            <th class="align-center">No</th>
                            <th class="align-center">Nama File</th>
                            <th colspan="2" class="align-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($map)>0){
                            $no=0;
                            foreach ($map as $r ) {
                            echo '<tr>';
                            echo '<td>'.++$no.'</td>';
                            echo '<td>'.$r.'</td>';
                            echo '<td class="align-center"><a data-target="#confirm-restore"  data-toggle="modal" href="#" data-href="'.base_url().'Konfigurasi_system/restore_db/'.base64_encode($this->encrypt->encode($r)).'">Restore</a></td>';
                            echo '<td class="align-center"><a href="'.base_url().'upload/backup_database/'.$r.'"> Download</a></td>';
                            echo '</tr>';
                            }
                        }else{
                            echo '<tr><td colspan="4">Tidak ada backup - klik tombol Backup Sekarang</td><tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
