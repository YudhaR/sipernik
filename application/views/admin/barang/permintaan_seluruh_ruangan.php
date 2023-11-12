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
                    <i class="icon fa fa-shopping-basket"> </i> <?php echo strtoupper($title) ?>
                </h2>
            </div>
            <div class="body">
                <table class="table table-bordered table-striped table-hover js-basic-example">
                    <col width="5%">
                    <col width="25%">
                    <col width="15%">
                    <col width="5%">
                    <thead>
                        <tr class="bg-teal align-center">
                            <th class="align-center">No</th>
                            <th class="align-center">Ruangan / Pegawai</th>
                            <th class="align-center">Tanggal Permintaan</th>
                            <th class="align-center">Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="bg-teal align-center">
                            <th class="align-center">No</th>
                            <th class="align-center">Ruangan / Pegawai</th>
                            <th class="align-center">Tanggal Permintaan</th>
                            <th class="align-center">Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php if (count($data)>=0) {
                            $no=1;
                            foreach ($data as $t) {
                                echo '<tr '.($t->tgl_permintaan==date("Y-m-d") ? "class='col-orange'" : "").'>';
                                    echo '<td>'.$no++.'</td>';
                                    echo '<td>'.$t->jabatan.'</td>';
                                    echo '<td>'.tgl_indo($t->tgl_permintaan).'</td>';
                                    echo '<td class="align-center">
                                            <li class="dropdown" style="list-style:none">
                                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i  class="fa fa-navicon"></i> </a>
                                            <ul class="dropdown-menu pull-right">
                                                <li><a href="'.base_url("Barang/permintaan/detil").'/'.base64_encode($this->encrypt->encode($t->jabatan_id)).'/'.base64_encode($this->encrypt->encode($t->tgl_permintaan)).'"><i class="fa fa-edit">  </i>  Detil </a></li>';
                                        echo   '<li class="divider"></li>';
                                        echo   '<li><a class="col-white bg-red" href="#" data-toggle="modal" data-target="#confirm-delete" data-href="'.base_url('Barang/permintaan/hapus').'/'.base64_encode($this->encrypt->encode($t->id)).'"><i class="fa fa-trash"></i>  Hapus</a></li>';
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