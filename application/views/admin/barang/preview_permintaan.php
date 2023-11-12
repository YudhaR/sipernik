<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header text-center">
                <h2 class="text-center col-blue-grey">
                    <i class="icon fa fa-envelope"> </i> <?php echo strtoupper($title) ?>
                </h2>
                <ul class="header-dropdown m-r-0 animated flipInX">
                    <a class="btn btn-warning pull-left" href="<?php echo base_url('Barang/barang/popup_cetak');?>" data-toggle="modal" data-target="#popUpWindow">Cetak Barang</a>&nbsp
                    <a class="btn btn-primary  pull-right" href="<?php echo base_url('Barang/barang/tambah');?>" data-toggle="modal" data-target="#popUpWindow">Tambah Barang</a>
                </ul>
            </div>
            <div class="body">
                <table class="table table-bordered table-striped table-hover js-basic-example">
                    <col width="5%">
                    <col width="14%">
                    <col width="">
                    <col width="10%">
                    <col width="10%">
                    <col width="5%">
                    <thead>
                        <tr class="bg-teal align-center">
                            <th class="align-center">No</th>
                            <th class="align-center">Kode Barang</th>
                            <th class="align-center">Uraian / Nama Barang</th>
                            <th class="align-center">Satuan</th>
                            <th class="align-center">Stok Terakhir</th>
                            <th class="align-center">Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="bg-teal align-center">
                            <th class="align-center">No</th>
                            <th class="align-center">Kode Barang</th>
                            <th class="align-center">Uraian / Nama Barang</th>
                            <th class="align-center">Satuan</th>
                            <th class="align-center">Stok Terakhir</th>
                            <th class="align-center">Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php if (count($data)>=0) {
                            $no=1;
                            foreach ($data as $t) {
                                echo '<tr>';
                                    echo '<td>'.$no++.'</td>';
                                    echo '<td>'.$t->kode_barang.'</td>';
                                    echo '<td>'.$t->uraian.'</td>';
                                    echo '<td>'.$t->satuan.'</td>';
                                     echo '<td class="align-center"><a href="'.base_url("Barang/stok/detil").'/'.base64_encode($this->encrypt->encode($t->id)).'"><i class="fa fa-edit">  </i> '.$t->jumlah.'</a></td>';
                                    echo '<td class="align-center">
                                            <li class="dropdown" style="list-style:none">
                                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i  class="fa fa-navicon"></i> </a>
                                            <ul class="dropdown-menu pull-right">
                                                <li><a href="'.base_url("Barang/barang/edit").'/'.base64_encode($this->encrypt->encode($t->id)).'" data-toggle="modal" data-target="#popUpWindow"><i class="fa fa-edit">  </i>  Edit</a></li>';
                                        echo   '<li><a href="'.base_url("Barang/stok/detil").'/'.base64_encode($this->encrypt->encode($t->id)).'"><i class="fa fa-edit">  </i> Detil Stok Barang </a></li>';
                                        echo   '<li class="divider"></li>';
                                        echo   '<li><a class="col-white bg-red" href="#" data-toggle="modal" data-target="#confirm-delete" data-href="'.base_url('Barang/barang/hapus').'/'.base64_encode($this->encrypt->encode($t->id)).'"><i class="fa fa-trash"></i>  Hapus</a></li>';
                                        echo '</ul>
                                            </li>
                                        </td>';
                                echo '</tr>';
                            }
                        };?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>