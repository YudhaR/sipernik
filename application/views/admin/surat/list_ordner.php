<style type="text/css">
    .dataTables_filter, .dataTables_paginate{
        float: right;
        margin-top: -40px;
        padding-top: 20px;
    }    
    .table thead tr th, .table tbody tr td, .table tbody tr th{
      padding:5px;
    }
    title{display: none}
</style>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header text-center">
                <div class="icon_big">
                    <i class="icon fa fa-clipboard"> </i>
                </div>
                <h2 class="text-center col-blue-grey">
                     LIST SURAT PADA BOX / ORDNER 
                </h2>
                <ul class="header-dropdown m-r-0 animated flipInX">
                    <a class="btn bg-red" href="<?php echo base_url('Info/surat/ordner');?>" data-toggle="modal" data-target="#popUpWindow"><i class="fa fa-question-circle-o  col-white"></i></a>&nbsp
                </ul>
            </div>
            <div class="body">
                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                    <thead>
                        <tr class="bg-teal align-center">
                            <th class="align-center">No</th>
                            <th class="align-center">Nomor Surat</th>
                            <th class="align-center">Tgl. Surat</th>
                            <th class="align-center">Tgl. Simpan Ke Ordner</th>
                            <th class="align-center">Box / Ordner</th>
                            <th class="align-center">Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="bg-teal">
                            <th class="align-center">No</th>
                            <th class="align-center">Nomor Surat</th>
                            <th class="align-center">Tgl. Surat</th>
                            <th class="align-center">Tgl. Simpan Ke Ordner</th>
                            <th class="align-center">Box / Ordner</th>
                            <th class="align-center">#</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        if (count($data)>0){
                            $no=0;
                            foreach ($data as $r ) {
                            echo '<tr>';
                            echo '<td>'.++$no.'</td>';
                            echo '<td>'.$r->no_surat.'</td>';
                            echo '<td>'.tgl_indo($r->tgl_surat).'</td>';
                            echo '<td>'.tgl_indo($r->tgl_ordner).'</td>';
                            echo '<td>'.$r->kode.'/'.$r->nama.'</td>';
                            echo '<td class="align-center">
                                         <li class="dropdown" style="list-style:none">
                                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-navicon"></i></a>
                                            <ul class="dropdown-menu pull-right">';
                                        echo   '<li><a class="col-blue" href="'.base_url("Register/surat/".$alur."/ordner").'/'.base64_encode($this->encrypt->encode($r->surat_id)).'/edit'.'" data-toggle="modal" data-target="#popUpWindow"><i class="fa fa-clipboard">  </i>  Edit </a></li>';
                                        echo   '<li class="divider"></li>';
                                        echo   '<li><a class="col-white bg-red" href="#" data-toggle="modal" data-target="#confirm-delete" data-href="'.base_url('Register/hapus_ordner').'/'.base64_encode($this->encrypt->encode($r->id)).'"><i class="fa fa-trash"></i>  Hapus </a></li>';
                                        echo '</ul>
                                        </li></td>';
                            echo '</tr>';
                            }
                        } 
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
