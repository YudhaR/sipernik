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
    title{display: none;}
@media print {
      body * {
        visibility: hidden;
        margin: -5px;
      }
      @page {
          size: auto; 
          margin: 0;  
      }
      #div_print * {
        visibility: visible;
      }

      #div_print{
        font-size: 90%;
        width: 1024px;
        position: absolute;
        left: -150px;
        top: 0px;
      }
  }
</style>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header text-center">
                <?php if ($title=="DETIL PERMINTAAN BARANG"): ?>
                    <a class="btn btn-warning  pull-left" href="<?php echo base_url('Barang/permintaan/');?>"><< Kembali</a>
                <?php endif ?>
                <h2 class="text-center col-blue-grey">
                    <i class="icon fa fa-shopping-basket"> </i> <?php echo strtoupper($title) ?>
                </h2>
                <ul class="header-dropdown m-r-0 animated flipInX">
                    <a class="btn btn-warning" href="<?php echo base_url('Barang/permintaan/tambah');?>" data-toggle="modal" data-target="#popUpWindow"> Cetak  </a>&nbsp&nbsp
                    <a class="btn btn-primary  pull-right" href="<?php echo base_url('Barang/permintaan/tambah');?>" data-toggle="modal" data-target="#popUpWindow">Tambah Permintaan</a>
                </ul>
            </div>
            <div class="body"  id="div_print">
                <div class="judul_print" hidden>
                    <h2 class="text-center col-blue-grey">
                        <i class="icon fa fa-shopping-basket"> </i> <?php echo strtoupper($title) ?>
                    </h2>
                </div>
                <table class="table table-bordered table-striped table-hover dataTable js-basic-example">
                    <col width="5%">
                    <col width="12%">
                    <col width="15%">
                    <col width="">
                    <col width="5%">
                    <col width="5%">
                    <col width="5%">
                    <thead>
                        <tr class="bg-teal align-center">
                            <th class="align-center">No</th>
                            <th class="align-center">Ruangan / Pegawai</th>
                            <th class="align-center">Tanggal Permintaan</th>
                            <th class="align-center">Kode Barang / Nama Barang</th>
                            <th class="align-center">Permintaan</th>
                            <th class="align-center">Diberikan</th>
                            <th class="align-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($data)>=0) {
                            $no=1;
                            foreach ($data as $t) {
                                echo '<tr '.($t->tgl_permintaan==date("Y-m-d") ? "class='col-orange'" : "").'>';
                                    echo '<td>'.$no++.'</td>';
                                    echo '<td>'.$t->jabatan.'</td>';
                                    echo '<td>'.tgl_indo($t->tgl_permintaan).'</td>';
                                    echo '<td>'.$t->kode_barang.' : '.$t->uraian.'</td>';
                                    echo '<td class="align-center">'.$t->jumlah_diminta.'</td>';
                                    echo '<td class="align-center">'.$t->jumlah_diberikan.'</td>';
                                    echo '<td class="align-center">
                                            <li class="dropdown" style="list-style:none">
                                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i  class="fa fa-navicon"></i> </a>
                                            <ul class="dropdown-menu pull-right">
                                                <li><a href="'.base_url("Barang/permintaan/edit").'/'.base64_encode($this->encrypt->encode($t->id)).'" data-toggle="modal" data-target="#popUpWindow"><i class="fa fa-edit">  </i>  Edit</a></li>';
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
