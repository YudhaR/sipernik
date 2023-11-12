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
                <h2 class="text-center col-blue-grey">
                    <a class="btn btn-primary pull-left" href="<?php echo base_url('Barang/barang/')?>">Kembali</a>
                    <i class="icon fa fa-folder-o"> </i> <?php echo $title?>
                </h2>
                <ul class="header-dropdown m-r-0 animated flipInX">
                    <a class="btn btn-warning pull-left" href="<?php echo base_url('Barang/stok/tambah').'/'.$enc.'/'.$enc_kode_barang;?>" data-toggle="modal" data-target="#popUpWindow">Tambah Stok</a>
                </ul>
            </div>
            <div class="body">
                <table class="table table-bordered table-striped table-hover js-basic-example">
                    <col width="6%">
                    <col width="">
                    <col width="">
                    <col width="10%">
                    <col width="10%">
                    <thead>
                        <tr class="bg-pink align-center">
                            <th class="align-center">No</th>
                            <th class="align-center">Tanggal Transaksi </th>
                            <th class="align-center">Jenis</th>
                            <th class="align-center">Jumlah</th>
                            <th class="align-center">Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="bg-pink align-center">
                            <th class="align-center">No</th>
                            <th class="align-center">Tanggal Transaksi</th>
                            <th class="align-center">Jenis</th>
                            <th class="align-center">Jumlah</th>
                            <th class="align-center">Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php if (count($data)>=0) {
                            $no=1;
                            foreach ($data as $t) {
                                echo '<tr>';
                                    echo '<td>'.$no++.'</td>';
                                    echo '<td>'.tgl_indo($t->tgl_transaksi).'</td>';
                                    echo '<td class="align-center">'.$t->jenis.'</td>';
                                     echo '<td class="align-center">'.$t->jumlah.'</td>';
                                    echo '<td class="align-center">
                                            <li class="dropdown" style="list-style:none">
                                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i  class="fa fa-navicon"></i> </a>
                                            <ul class="dropdown-menu pull-right">';
                                         echo   '<li><a href="'.base_url('Barang/stok/edit').'/'.$enc.'/'.base64_encode($this->encrypt->encode($t->id)).'" data-toggle="modal" data-target="#popUpWindow"><i class="fa fa-edit"></i>  Edit </a></li>';
                                        echo   '<li class="divider"></li>';
                                        echo   '<li><a class="col-white bg-red" href="#" data-toggle="modal" data-target="#confirm-delete" data-href="'.base_url('Barang/stok/hapus').'/'.$enc.'/'.base64_encode($this->encrypt->encode($t->id)).'"><i class="fa fa-trash"></i>  Hapus</a></li>';
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
