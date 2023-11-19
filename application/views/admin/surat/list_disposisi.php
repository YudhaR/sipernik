<style type="text/css">
  .table tbody tr td,
  .table tbody tr th {
    padding: 2px;
  }

  pre {
    border: none;
    background-color: transparent;
    font-family: inherit;
    font-size: 14px;
    padding: 0px;
  }

  title {
    display: none
  }
</style>
<div class="row clearfix">
  <div class="col-md-12">
    <div class="card">
      <div class="header">
        <ul class="m-l--40">
          <?php if ($alur == "masuk") {
          ?>
            <a class="btn btn-small bg-orange" href="<?php echo base_url('Register/surat') . '/' . $alur; ?>"><i class="fa fa-angle-double-left"> </i> Kembali</a>
          <?php
          } else {
          ?>
            <a class="btn btn-small bg-orange" href="<?php echo base_url('Register/surat/keluar'). '/' . strtolower($jabatan); ?>"><i class="fa fa-angle-double-left"> </i> Kembali</a>
          <?php
          }
          ?>
          <h2 class="text-center">
            <?php echo $title ?>
          </h2>
        </ul>
      </div>
      <div class="body">
        <div class="row clearfix">
          <div class="col-md-7">
            <table class="table table-bordered table-striped">
              <col width="30%">
              <col width="">
              <tbody>
                <?php

                echo '<tr><td><b>Nomor Agenda</b></td><td>' . $no_agenda . '</td></tr>';
                echo '<tr><td><b>Kode Surat</b></td><td>' . $kode . '/' . $nama . '</td></tr>';
                if ($alur == "masuk") {
                  echo '<tr><td><b>Status Surat</b></td><td>' . $status . '</td></tr>';
                  echo '<tr><td><b>Jenis Surat</b></td><td>' . $jenis . '</td></tr>';
                } else if ($alur == "keluar") {
                  echo '<tr><td><b>Kategori Surat</b></td><td>' . $kategori . '</td></tr>';
                }
                echo '<tr><td><b>Tanggal Surat</b></td><td>' . $tgl_surat . '</td></tr>';
                echo '<tr><td><b>Diterima Bagian Umum</b></td><td>' . $tgl_terima . '</td></tr>';
                echo '<tr><td><b>Pengirim</b></td><td><pre>' . $pengirim . '</pre></td></tr>';
                echo '<tr><td><b>Untuk</b></td><td><pre>' . $untuk . '</td></tr>';
                echo '<tr><td><b>Perihal</b></td><td><pre>' . $perihal . '</pre></td></tr>';
                echo '<tr><td><b>Keterangan</b></td><td><pre>' . $ket . '</pre></td></tr>';
                if ($alur == "keluar") {
                  echo '<tr><td><b>Tanggal kirim</b></td><td><pre>' . $tgl_kirim . '</pre></td></tr>';
                  echo '<tr><td><b>Ekspedisi</b></td><td><pre>' . $ekspedisi_nama . '</pre></td></tr>';
                }
                ?>
              </tbody>
            </table>
          </div>
          <?php if ($file_name != "") { ?>
            <div class="col-sm-3">
              <div class="card" style="padding:5px">
                <b>E-Document :</b>
                
                <?php
                if ($alur == "masuk") {
                  $p = $this->db->query("SELECT jenis FROM ctr_jenis_surat_masuk WHERE jenis_surat_masuk_id=$jenis_surat_masuk_id");
                  $jenis_surat_masuk = $p->result();
                  
                  if (count($jenis_surat_masuk) > 0) {
                      $jenis_surat_masuk = $jenis_surat_masuk[0]->jenis;
                  }
                ?>
                <div class="image p-t-10">
                  <img src="<?php echo base_url('upload/surat_' . $alur) . '/' . $jenis_surat_masuk . "/" . $file_name ?>" height="50" alt="-" />
                </div>
                  <a class="text-center" href="<?php echo base_url('upload/surat_' . $alur) . '/' . $jenis_surat_masuk . "/" . $file_name ?>" target="_blank">View / Download</a>
                <?php
                } else {

                ?>
                <div class="image p-t-10">
                  <img src="<?php echo base_url('upload/surat_keluar/' . $jabatan) ."/". $kategori. "/" . $file_name ?>" height="150" alt="<?php echo $file_name ?>" />
                </div>
                  <a class="text-center" href="<?php echo base_url('upload/surat_keluar/' . $jabatan) ."/".$kategori. "/" . $file_name ?>" target="_blank">View / Download</a>
                <?php
                }
                ?>
                <input name="ada_file" type="hidden" value="<?php echo $file_name ?>" />
              </div>
            </div>
          <?php } ?>
          <div class="col-sm-2">
            <div class="card" style="padding:1px">
              <a><img src="<?php echo $pictQR; ?>" /></a>
            </div>
          </div>

        </div>
        <?php if ($alur == 'masuk') : ?>
          <div class="row clearfix">
            <div class="col-md-12">
              <div class="card">
                <?php if ($this->session->userdata('sess_idgroup') == $this->session->userdata('sess_jabatanid')) : ?>
                  <ul class="header-dropdown pull-left m-t-10 m-l--30">
                    <?php if ($list_disposisi->num_rows() > 0) : ?>
                      <a class="btn btn-primary" href="<?php echo base_url('Register/surat/masuk/disposisi/' . $enc . '/preview'); ?>" data-toggle="modal" data-target="#popUpWindow"><i class="fa fa-file-word-o"></i> Cetak Disposisi</a>
                    <?php endif ?>
                    <a class="btn btn-primary" href="<?php echo base_url('Register/surat/masuk/disposisi/' . $enc . '/preview_kosong'); ?>" data-toggle="modal" data-target="#popUpWindow"><i class="fa fa-file-word-o"></i> Cetak Disposisi Kosong</a>
                  </ul>
                  <ul class="header-dropdown pull-right m-t-10 m-r-10">
                    <a class="btn btn-warning" href="<?php echo base_url('Register/surat/' . $alur . '/disposisi') . '/' . $enc . '/tambah/'; ?>" data-toggle="modal" data-target="#popUpWindow">Tambah Disposisi</a>
                  </ul>
                <?php endif ?>
                <table class="table table-bordered table-striped table-hover">
                  <col width="10%">
                  <col width="30%">
                  <col width="">
                  <col width="10%">
                  <thead>
                    <tr class="bg-deep-orange align-center">
                      <th class="align-center">No</th>
                      <th class="align-center">Tanggal Diposisi</th>
                      <th class="align-center">Disposisi</th>
                      <th class="align-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if ($list_disposisi->num_rows >= 0) {
                      $no = 0;
                      foreach ($list_disposisi->result() as $row) {
                        echo '<tr>';
                        echo '<td class="text-center">' . ++$no . '</td>';
                        echo '<td class="text-center">' . tgl_indo($row->tgl_disposisi) . '</td>';
                        if ($row->sifat == 100) {
                          echo '<td class="col-red"> Selesai Diterima : ' . $row->kepada_nama . '</td>';
                        } else {
                          echo '<td> Disposisi : ' . $row->dari_nama . '<br>
                                              Kepada : ' . $row->kepada_nama . '<br>
                                              <pre><small>' . $row->isi_disposisi . '</small></pre>
                                              </td>';
                        }

                        echo '<td class="align-center">';
                        if ($this->session->userdata('sess_idgroup') <= 2 || $this->session->userdata('sess_idgroup') == 11 || $this->session->userdata('sess_idgroup') == $this->session->userdata('sess_jabatanid')) :
                          echo          '<li class="dropdown" style="list-style:none">';
                          echo              '<a href="javascript:void(0);" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i style="font-size:10px;" class="fa fa-navicon"></i></a>';
                          echo              '<ul class="dropdown-menu pull-right">';
                          echo              '<li><a href="' . base_url("Register/surat/" . $alur . "/disposisi") . '/' . base64_encode($this->encrypt->encode($row->surat_id)) . '/edit/' . base64_encode($this->encrypt->encode($row->id)) . '" data-toggle="modal" data-target="#popUpWindow"><i class="fa fa-share">  </i>  Edit</a></li>';
                          if ($this->session->userdata('sess_idgroup') <= 2) :
                            echo              '<li class="divider"></li>';
                            echo              '<li><a data-href="' . base_url("Register/hapus_disposisi/") . '/' . base64_encode($this->encrypt->encode($row->id)) . '/' . base64_encode($this->encrypt->encode($row->surat_id)) . '" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash">  </i>  Hapus</a></li>';
                          endif;
                          echo              '</ul>';
                          echo           '</li>';
                        endif;
                        echo    '</td>';
                        echo '<tr>';
                      }
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        <?php endif ?>
      </div>
    </div>
  </div>
</div>