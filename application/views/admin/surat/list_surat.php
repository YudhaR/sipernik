<style type="text/css">
    .dataTables_filter,
    .dataTables_paginate {
        float: right;
        margin-top: -40px;
        padding-top: 20px;
    }

    .table tbody tr td,
    .table tbody tr th,
    .table tfoot tr th,
    .table thead tr th {
        padding: 5px;
        vertical-align: middle;
    }

    title {
        display: none
    }


</style>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header text-center">
                <div class="icon_big">
                    <i class="icon fa fa-envelope"> </i>
                </div>
                <h2 class="text-center col-blue-grey">
                    REGISTER SURAT <?php echo strtoupper($alur) . " " . strtoupper($title) ?>
                </h2>

            </div>
            <div class="row">

                <div class="col-md-12">
                    <ul class="animated slideInDown">

                        <?php if (($this->session->userdata('sess_idgroup') <= 2 or $this->session->userdata('sess_idgroup') == 11)) :?>
                            <a class="btn btn-danger" href="<?php echo base_url('Info/surat') . '/' . $alur; ?>" data-toggle="modal" data-target="#popUpWindow"><i class="fa fa-question-circle-o  col-white"></i></a>&nbsp
                            <a class="btn btn-warning" href="<?php echo base_url('Register/surat/' . $alur . '/popup_cetak'); ?>" data-toggle="modal" data-target="#popUpWindow">Cetak Buku Agenda</a>&nbsp
                        -->
                        <?php endif;?>
                        <?php if (($this->session->userdata('sess_idgroup') > 2 && $alur == "keluar") &&  $act != "keluar") { ?>
                            <a class="btn btn-primary" href="<?php echo base_url('Register/surat/keluar/tambah'); ?>">Tambah Surat <?php echo ucfirst($alur) ?></a>
                        <?php } elseif (($this->session->userdata('sess_idgroup') > 2 && $alur == "keluar") &&  $act == "keluar") { ?>
                            <a class="btn btn-primary" href="<?php echo base_url('Register/surat/keluar/tambah_surat_lama'); ?>">Tambah Surat <?php echo ucfirst($alur) ?></a>
                        <?php } elseif (($this->session->userdata('sess_idgroup') <= 2 or $this->session->userdata('sess_idgroup') == 11) &&  $act == "keluar") { ?>
                            <a class="btn btn-primary" href="<?php echo base_url('Register/surat/keluar/tambah_surat_lama'); ?>">Tambah Surat <?php echo ucfirst($alur) ?></a>
                        <?php } elseif (($this->session->userdata('sess_idgroup') <= 2 or $this->session->userdata('sess_idgroup') == 11) &&  $alur == "masuk") { ?>
                            <a class="btn btn-primary" href="<?php echo base_url('Register/surat/masuk/tambah_surat_lama'); ?>">Tambah Surat <?php echo ucfirst($alur) ?></a>
                        <?php } elseif (($this->session->userdata('sess_idgroup') <= 2 or $this->session->userdata('sess_idgroup') == 11) &&  $act != "keluar") { ?>
                            <a class="btn btn-primary" href="<?php echo base_url('Register/surat/' . $alur . '/tambah'); ?>">Tambah Surat <?php echo ucfirst($alur) ?></a>

                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="body">
                <?php if ($this->agent->is_mobile() == 1) {
                    $btn = 'btn btn-primary';
                    $sign = ":<br >";
                } else {
                    $btn = 'btn btn-primary';
                    $sign = ":<br >";
                }; ?>
                <table id="suratTbl" class="table table-striped table-hover dt-responsive">
                    <thead>
                        <tr class="align-left">
                            <th class="align-center">No</th>
                            <th class="align-center">No. Surat</th>
                            <th class="desktop align-center">Tgl Surat</th>
                            <th class="align-center">Perihal</th>
                            <th class="align-center">Tgl <?php echo $terima_kirim ?></th>
                            <?php if ($alur == 'masuk') : ?>
                                <th class="align-center">Tempat<br>Ordner/Box</th>
                                <th class="align-center">Status Disposisi</th>
                            <?php endif ?>
                            <th class="align-center">File</th>
                            <th class="align-center"></th>
                            <th class="align-center">Aksi</th>
                        </tr>
                    </thead>

                    <col width="4%">
                    <col width="21%">
                    <col width="10%">
                    <col width="25%">
                    <col width="10%">
                    <?php if ($alur == 'masuk') : ?>
                        <col width="13%">
                        <col width="10%">
                        <col width="10%">
                    <?php endif ?>
                    <?php if ($alur != 'masuk') : ?>
                        <col width="23%">
                    <?php endif ?>
                    <col width="5%">
                    <tbody>
                        <?php if ($data->num_rows >= 0) {
                            $no = $data->num_rows();
                            foreach ($data->result() as $t) {
                                $file_name = $t->file_name;
                                if ($alur == 'masuk') {
                                    $jenis_surat_masuk_id = $t->jenis_surat_masuk_id;
                                    $p = $this->db->query("SELECT jenis FROM ctr_jenis_surat_masuk WHERE jenis_surat_masuk_id=$jenis_surat_masuk_id");
                                    $jenis_surat_masuk = $p->result();
                                    
                                    if (count($jenis_surat_masuk) > 0) {
                                        $path = $jenis_surat_masuk[0]->jenis;
                                    }
                                } else if ($alur == 'keluar' && $act != "keluar"){
                                    $kategori_id = $t->kategori_id;
                                    $p = $this->db->query("SELECT kategori FROM ctr_kategori_surat WHERE id_kategori=$kategori_id");
                                    $kategori_surat = $p->result();
                                    
                                    if (count($kategori_surat) > 0) {
                                        $path = $kategori_surat[0]->kategori;
                                    }
                                    $format_no_surat_id = $t->format_no_surat_id;
                                    $q = $this->db->query("SELECT jabatan FROM format_nomor_surat WHERE id=$format_no_surat_id");
                                    $format_surat = $q->result();
                                    
                                    if (count($format_surat) > 0) {
                                        $jabt = $format_surat[0]->jabatan;
                                    }
                                }
                                echo '<tr>';
                                echo '<td><a class="' . $btn . '">' . $no-- . '</a></td>';

                                echo '<td align="center">' . $t->no_surat . '</td>';
                                echo '<td align="center" data-sort="' . $t->tgl_surat . '">' . $this->tanggalhelper->convertDate($t->tgl_surat) . '</td>';
                                echo '<td align="center">' . $t->perihal . '</td>';
                                if ($alur == 'masuk') {
                                    echo '<td align="center" data-sort="' . $t->tgl_terima . '">' . $this->tanggalhelper->convertDate($t->tgl_terima) . '</td>';
                                    echo '<td align="center">' . ($t->ordner_id == NULL && $this->session->userdata('sess_idgroup') <= 2 || $this->session->userdata('sess_idgroup') == 11  ? '<a class="col-red" href="' . base_url("Register/surat/" . $alur . "/ordner") . '/' . base64_encode($this->encrypt->encode($t->surat_id)) . '/tambah' . '" data-toggle="modal" data-target="#popUpWindow"><i class="icon fa fa-edit"> </i> Belum di box</a>' : $t->nama_bundle) . '</td>';
                                    if ($t->dari == $t->kepada && $t->status_diterima) {
                                        echo '<td align="center" class="col-red"> <b>Selesai Diterima oleh</b> ' . $t->kepada_nama . '</td>';
                                    } else {
                                        echo '<td align="center">' . (($t->kepada_nama == "" or $t->dari_nama == "")  && $this->session->userdata('sess_idgroup') < 2 ? "<a href='" . base_url("Register/surat/" . $alur . "/disposisi") . '/' . base64_encode($this->encrypt->encode($t->surat_id)) . '/tambah' . "' class='col-red' data-toggle='modal' data-target='#popUpWindow'><i class='icon fa fa-edit'> </i> Belum disposisi</a>" : $t->dari_nama . ' ke <br>' . $t->kepada_nama) . '</td>';
                                    }
                                } else {
                                    echo '<td align="center" data-sort="' . $t->tgl_kirim . '">' . ($t->tgl_kirim != "" ? $this->tanggalhelper->convertDate($t->tgl_kirim) : "-") . '</td>';
                                }
                                if ($alur == 'keluar' && $act != "keluar"){
                                    echo '<td align="center"><a href="' . base_url('upload/surat_' . $alur) . '/' . $jabt . '/' . $path . "/" . $file_name . '" target="_blank"> View / Download</a><td>';
                                } else if ($alur == 'keluar') {
                                    echo '<td align="center" ><a href="' . base_url('upload/surat_' . $alur) . '/'  . $file_name . '" target="_blank"> View / Download</a><td>';
                                } else if ($alur == 'masuk') {
                                    echo '<td align="center"><a href="' . base_url('upload/surat_' . $alur) . '/' . $path . '/'  . $file_name . '" target="_blank"> View / Download</a><td>';
                                }
                                if ($this->session->userdata('sess_idgroup') <= 2 or $this->session->userdata('sess_idgroup') == 11) {
                                    echo '<td align="center" class="align-center">
                                                <li class="dropdown" style="list-style:none" >
                                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i  class="fa fa-navicon"></i> </a>
                                                <ul class="dropdown-menu pull-right">';
                                    if ($act != "keluar") {
                                        echo '<li><a href="' . base_url("Register/surat/" . $alur . "/edit") . '/' . base64_encode($this->encrypt->encode($t->surat_id)) . '" ><i class="fa fa-edit">  </i>  Edit</a></li>';
                                    } else {
                                        echo   '<li><a href="' . base_url("Register/surat/" . $alur . "/edit_surat_lama") . '/' . base64_encode($this->encrypt->encode($t->surat_id)) . '"><i class="fa fa-edit">  </i>  Edit</a></li>';
                                    }
                                    if ($alur == "masuk") {
                                        echo   '<li><a href="' . base_url("Register/surat/" . $alur . "/disposisi") . '/' . base64_encode($this->encrypt->encode($t->surat_id)) . '"><i class="fa fa-share">  </i>  Disposisi</a></li>';
                                        if ($t->ordner_id == NULL) {
                                            echo   '<li><a class="col-blue" href="' . base_url("Register/surat/" . $alur . "/ordner") . '/' . base64_encode($this->encrypt->encode($t->surat_id)) . '/tambah' . '" data-toggle="modal" data-target="#popUpWindow"><i class="fa fa-clipboard">  </i>  Simpan di Ordner</a></li>';
                                        }
                                    }elseif($act=="keluar"){

                                        echo   '<li><a href="' . base_url("Register/surat/" . $alur . "/detil") . '/' . base64_encode($this->encrypt->encode($t->surat_id)) . '"><i class="fa fa-share">  </i>  Detil</a></li>';
                                    }
                                    else {
                                        echo   '<li><a href="' . base_url("Register/surat/" . $alur . "/disposisi") . '/' . base64_encode($this->encrypt->encode($t->surat_id)) . '"><i class="fa fa-share">  </i>  Detil</a></li>';
                                    }
                                    echo   '<li class="divider"></li>';
                                    if ($act != "keluar") {
                                        echo   '<li><a class="col-white bg-red" href="#" data-toggle="modal" data-target="#confirm-delete" data-href="' . base_url('Register/hapus_surat') . '/' . $alur . '/' . base64_encode($this->encrypt->encode($t->surat_id)) . '"><i class="fa fa-trash"></i>  Hapus</a></li>';
                                    }else{
                                        echo   '<li><a class="col-white bg-red" href="#" data-toggle="modal" data-target="#confirm-delete" data-href="' . base_url('Register/hapus_surat_lama') . '/' . $alur . '/' . base64_encode($this->encrypt->encode($t->surat_id)) . '"><i class="fa fa-trash"></i>  Hapus</a></li>';

                                    }
                                    echo '</ul>
                                                </li>
                                            </td>';
                                } else {
                                    echo '<td class="align-center">
                                                <li class="dropdown" style="list-style:none">
                                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i  class="fa fa-navicon"></i> </a>
                                                <ul class="dropdown-menu pull-right">';
                                    echo        '<li><a href="' . base_url("Register/surat/" . $alur . "/disposisi") . '/' . base64_encode($this->encrypt->encode($t->surat_id)) . '">Detil</a></li>';
                                    if ($this->session->userdata('sess_idgroup') > 2) :
                                        echo        "<li><a href='" . base_url("Register/surat/" . $alur . "/disposisi") . '/' . base64_encode($this->encrypt->encode($t->surat_id)) . '/diterima' . "' data-toggle='modal' data-target='#popUpWindow'>Konfirmasi Surat diterima</a></li>";
                                    endif;
                                    echo   '</ul></li>';
                                }

                                echo '</tr>';
                            }
                        }; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<script type='text/javascript'>
    $(document).ready(function() {
        $('#suratTbl').dataTable({
            "bDestroy": true,
            "order": []
        });
    });
</script>
