            <?php if ($this->agent->is_mobile() == 1) {
                $btn = 'btn btn-primary';
                $sign = ":<br >";
            } else {
                $btn = '';
                $sign = "";
            }; ?>
            <?php if ($this->session->userdata('sess_idgroup') <= 2 or $this->session->userdata('sess_idgroup') == 11) : ?>
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-teal hover-expand-effect animated bounceInLeft" onClick="jalankan('Register/surat/masuk','Surat Masuk')">
                            <div class="icon">
                                <i class="fa fa-envelope"></i>
                            </div>
                            <div class="content">
                                <div class="text">SURAT MASUK</div>
                                <div class="number">Total : <?php echo $jumlah_surat_masuk; ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-red hover-expand-effect animated bounceInRight" onClick="jalankan('Register/surat/keluar','Surat Keluar')">
                            <div class="icon">
                                <i class="fa fa-paper-plane"></i>
                            </div>
                            <div class="content">
                                <div class="text">SURAT KELUAR LAMA</div>
                                <div class="number">Total : <?php echo $jumlah_surat_keluar; ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-red hover-expand-effect animated bounceInRight" onClick="jalankan('Register/surat/keluar/ketua','Surat Keluar')">
                            <div class="icon">
                                <i class="fa fa-paper-plane"></i>
                            </div>
                            <div class="content">
                                <div class="text">SURAT KELUAR KETUA</div>
                                <div class="number">Total : <?php echo $jumlah_surat_keluar_ketua; ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-red hover-expand-effect animated bounceInRight" onClick="jalankan('Register/surat/keluar/sekretaris','Surat Keluar')">
                            <div class="icon">
                                <i class="fa fa-paper-plane"></i>
                            </div>
                            <div class="content">
                                <div class="text">SURAT KELUAR SEKRETARIS</div>
                                <div class="number">Total : <?php echo $jumlah_surat_keluar_sekre; ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-red hover-expand-effect animated bounceInRight" onClick="jalankan('Register/surat/keluar/panitera','Surat Keluar')">
                            <div class="icon">
                                <i class="fa fa-paper-plane"></i>
                            </div>
                            <div class="content">
                                <div class="text">SURAT KELUAR PANITERA</div>
                                <div class="number">Total : <?php echo $jumlah_surat_keluar_panitera; ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-green hover-expand-effect animated bounceInLeft" onClick="jalankan('Register/surat/masuk/0/0/0','Surat Masuk')">
                            <div class="icon">
                                <i class="fa fa-users"></i>
                            </div>
                            <div class="content">
                                <div class="text">BELUM DISPOSISI</div>
                                <div class="number">Total : <?php echo $belum_disposisi ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-orange hover-expand-effect animated bounceInRight" onClick="jalankan('Register/surat/masuk/','Surat Masuk')">
                            <div class="icon">
                                <i class="fa fa-archive"></i>
                            </div>
                            <div class="content">
                                <div class="text">BELUM DI ORDNER</div>
                                <div class="number">Total : <?php echo $belum_ordner ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif ?>

            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect animated bounceInLeft" onClick="jalankan('Barang/permintaan')">
                        <div class="icon">
                            <i class="fa fa-shopping-basket"></i>
                        </div>
                        <div class="content">
                            <div class="text">Permohonan Permintaan Barang</div>
                            <div class="number"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect animated bounceInLeft" onClick="jalankan('Buku_tamu/tamu')">
                        <div class="icon">
                            <i class="fa fa-newspaper-o"></i>
                        </div>
                        <div class="content">
                            <div class="text"><strong>BUKU TAMU</strong></div>
                            <div class="number">Total : <?php echo $jumlah_buku_tamu ?></div>
                        </div>
                    </div>
                </div>
                <?php if ($this->session->userdata('sess_idgroup') <= 2 or $this->session->userdata('sess_idgroup') == 12) : ?>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-cyan hover-expand-effect animated bounceInRight" onClick="jalankan('Kepegawaian/surat_spt','SPT')">
                            <div class="icon">
                                <i class="fa fa-paper-plane"></i>
                            </div>
                            <div class="content">
                                <div class="text"><strong>SPT</strong></div>
                                <div class="number">Total : <?php echo $jumlah_spt; ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-pink hover-expand-effect animated bounceInRight" onClick="jalankan('Kepegawaian/surat_ijin','Surat Ijin Pegawai')">
                            <div class="icon">
                                <i class="fa fa-users"></i>
                            </div>
                            <div class="content">
                                <div class="text"><strong>SURAT IJIN</strong></div>
                                <div class="number">Total : <?php echo $jumlah_ijin ?></div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <?php if ($this->session->userdata('sess_idgroup') <= 2 or $this->session->userdata('sess_idgroup') == 11) : ?>
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-pink hover-expand-effect animated bounceInRight" onClick="jalankan('Barang/barang')">
                            <div class="icon">
                                <i class="fa fa-server"></i>
                            </div>
                            <div class="content">
                                <div class="text">Daftar Tabel Barang</div>
                                <div class="number"></div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($this->session->userdata('sess_idgroup') <= 2 or $this->session->userdata('sess_idgroup') == 12) : ?>
                <div class="row clearfix">
                    <div class="col-xs-12 col-sm-12">
                        <div class="card">
                            <div class="body">
                                <div class="header bg-teal">
                                    <h2>
                                        REKAP IJIN PEGAWAI <i class="fa fa-user"></i>
                                    </h2>
                                </div>
                                <br><br>
                                <table class="table table-striped table-hover js-basic-example dt-responsive">
                                    <thead>
                                        <tr>
                                            <th class="align-center">No</th>
                                            <th class="align-center">Nama</th>
                                            <th class="desktop align-center">Ijin Tidak Masuk</th>
                                            <th class="desktop align-center">Cuti Sakit</th>
                                            <th class="desktop align-center">Cuti Tahunan</th>
                                            <th class="desktop align-center">Cuti Besar</th>
                                            <th class="desktop align-center">Cuti Bersalin</th>
                                            <th class="desktop align-center">Cuti Alasan Penting</th>
                                            <th class="desktop align-center">Kartu Pegawai</th>
                                    </thead>
                                    <col width="3%">
                                    <col width="20%">
                                    <col width="10%">
                                    <col width="10%">
                                    <col width="10%">
                                    <col width="10%">
                                    <col width="10%">
                                    <col width="10%">
                                    <col width="10%">
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($tampil_ijin_pegawai as $row) {
                                            if (!empty($row->pegawai_id)) {
                                                $pegawai_id = $row->pegawai_id;
                                            } else {
                                                $pegawai_id = 0;
                                            }
                                            $tdk_masuk = $this->db->query("SELECT COUNT(id) AS id FROM dix_surat_ijin WHERE jenis_ijin=1 AND diijinkan=1 AND pegawai_id=" . $pegawai_id)->result_object();
                                            $cuti_sakit = $this->db->query("SELECT COUNT(id) AS id FROM dix_surat_ijin WHERE jenis_ijin=2 AND diijinkan=1 AND pegawai_id=" . $pegawai_id)->result_object();
                                            $cuti_thn = $this->db->query("SELECT COUNT(id) AS id FROM dix_surat_ijin WHERE jenis_ijin=3 AND diijinkan=1 AND pegawai_id=" . $pegawai_id)->result_object();
                                            $cuti_besar = $this->db->query("SELECT COUNT(id) AS id FROM dix_surat_ijin WHERE jenis_ijin=4 AND diijinkan=1 AND pegawai_id=" . $pegawai_id)->result_object();
                                            $cuti_bersalin = $this->db->query("SELECT COUNT(id) AS id FROM dix_surat_ijin WHERE jenis_ijin=5 AND diijinkan=1 AND pegawai_id=" . $pegawai_id)->result_object();
                                            $cuti_alasan = $this->db->query("SELECT COUNT(id) AS id FROM dix_surat_ijin WHERE jenis_ijin=6 AND diijinkan=1 AND pegawai_id=" . $pegawai_id)->result_object();
                                            echo '<tr>';
                                            echo '<td align="center"><a class="' . $btn . '">' . $no++ . '</a></td>';
                                            echo '<td>' . $row->nama . '</td>';
                                            echo '<td align="center">' . $tdk_masuk[0]->id . '</td>';
                                            echo '<td align="center">' . $cuti_sakit[0]->id . '</td>';
                                            echo '<td align="center">' . $cuti_thn[0]->id . '</td>';
                                            echo '<td align="center">' . $cuti_besar[0]->id . '</td>';
                                            echo '<td align="center">' . $cuti_bersalin[0]->id . '</td>';
                                            echo '<td align="center">' . $cuti_alasan[0]->id . '</td>';
                                            echo '<td align="center">'; ?>
                                            <a href="<?php echo base_url(); ?>Kepegawaian/cetak_kartu_cuti/<?php echo base64_encode($this->encrypt->encode($row->pegawai_id)) ?>" data-toggle="modal"><i class="fa fa-print"></i> Cetak</a>
                                            </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($this->session->userdata('sess_idgroup') == 11 or $this->session->userdata('sess_idgroup') <= 2) : ?>
                <div class="row clearfix">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="header bg-red">
                                <h2>
                                    Rekapitulasi Surat Masuk <i class="fa fa-envelope"></i>
                                    <small>Berdasarkan jenis surat</small>
                                </h2>
                            </div>
                            <div class="body">
                                <ul class="list-group list-group-unbordered">
                                    <?php
                                    if (empty($rekap_surat_masuk_bln)) {
                                        echo "<b>Tidak ada data</b> <a class='pull-right'></a>";
                                    } else {
                                        foreach ($rekap_surat_masuk_bln->result() as $row) {
                                            if ($row->thnSurat == DATE('Y')) {
                                                echo '<li class="list-group-item">';
                                                echo '<b>' . $this->tanggalhelper->getBulanFull($row->blnSurat) . '</b><label class="pull-right">' . $row->jumlah_surat . '</label>';
                                                echo '</li>';
                                            }
                                        }
                                        echo '<li class="list-group-item">';
                                        echo '<b>Total Surat Masuk</b><label class="pull-right">' . $rekap_surat_masuk[0]->jumlah . '</label>';
                                        echo '</li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="header bg-green">
                                <div class="icon_big">
                                    <i class="fa fa-paper-plane"> </i>
                                </div>
                                <h2>
                                    Rekapitulasi Surat Keluar <i class="fa fa-paper-plane"></i>
                                    <small>Berdasarkan Asal Surat</small>
                                </h2>
                            </div>
                            <div class="body">
                                <ul class="list-group list-group-unbordered">
                                    <?php
                                    if ($rekap_surat_keluar_asal <= 0) {
                                        echo "<b>Tidak ada data</b> <a class='pull-right'></a>";
                                    } else {
                                        $kepegawaian = $this->db->query("SELECT COUNT(s.surat_id) AS jumlah FROM ctr_surat_keluar AS s 
                                            LEFT JOIN dix_ref_format_nomor_surat AS r
                                            ON s.format_nomor_id=r.id
                                            WHERE r.bagian=1")->result_object();
                                        $keuangan = $this->db->query("SELECT COUNT(s.surat_id) AS jumlah FROM ctr_surat_keluar AS s 
                                            LEFT JOIN dix_ref_format_nomor_surat AS r
                                            ON s.format_nomor_id=r.id
                                            WHERE r.bagian=2")->result_object();
                                        $pelaporan = $this->db->query("SELECT COUNT(s.surat_id) AS jumlah FROM ctr_surat_keluar AS s 
                                            LEFT JOIN dix_ref_format_nomor_surat AS r
                                            ON s.format_nomor_id=r.id
                                            WHERE r.bagian=3")->result_object();
                                        $pidana = $this->db->query("SELECT COUNT(s.surat_id) AS jumlah FROM ctr_surat_keluar AS s 
                                            LEFT JOIN dix_ref_format_nomor_surat AS r
                                            ON s.format_nomor_id=r.id
                                            WHERE r.bagian=4")->result_object();
                                        $perdata = $this->db->query("SELECT COUNT(s.surat_id) AS jumlah FROM ctr_surat_keluar AS s 
                                            LEFT JOIN dix_ref_format_nomor_surat AS r
                                            ON s.format_nomor_id=r.id
                                            WHERE r.bagian=5")->result_object();
                                        $hukum = $this->db->query("SELECT COUNT(s.surat_id) AS jumlah FROM ctr_surat_keluar AS s 
                                            LEFT JOIN dix_ref_format_nomor_surat AS r
                                            ON s.format_nomor_id=r.id
                                            WHERE r.bagian=6")->result_object();

                                        echo '<li class="list-group-item">';
                                        echo '<b>Kepegawaian & Oratala</b><label class="pull-right">' . $kepegawaian[0]->jumlah . '</label>';
                                        echo '</li>';
                                        echo '<li class="list-group-item">';
                                        echo '<b>Umum & Keuangan</b><label class="pull-right">' . $keuangan[0]->jumlah . '</label>';
                                        echo '</li>';
                                        echo '<li class="list-group-item">';
                                        echo '<b>Perencanaan, IT & Pelaporan</b><label class="pull-right">' . $pelaporan[0]->jumlah . '</label>';
                                        echo '</li>';
                                        echo '<li class="list-group-item">';
                                        echo '<b>Pidana</b><label class="pull-right">' . $pidana[0]->jumlah . '</label>';
                                        echo '</li>';
                                        echo '<li class="list-group-item">';
                                        echo '<b>Perdata</b><label class="pull-right">' . $perdata[0]->jumlah . '</label>';
                                        echo '</li>';
                                        echo '<li class="list-group-item">';
                                        echo '<b>Hukum</b><label class="pull-right">' . $hukum[0]->jumlah . '</label>';
                                        echo '</li>';
                                        echo '<li class="list-group-item">';
                                        echo '<b>Total Surat Keluar</b><label class="pull-right">' . $rekap_surat_keluar_asal . '</label>';
                                        echo '</li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="header bg-blue">
                                    <h2>
                                        Kategori Surat Masuk <i class="fa fa-envelope"></i>
                                        <small>Berdasarkan Kategori surat</small>
                                    </h2>
                                </div>
                                <div class="body">
                                    <ul class="list-group list-group-unbordered">
                                        <?php

                                        $q = $this->db->query("SELECT * FROM ctr_jenis_surat_masuk");
                                        if (empty($q)) {
                                            echo "<b>Tidak ada data</b> <a class='pull-right'></a>";
                                        } else {
                                            foreach ($q->result() as $row) {

                                                    $jumlah = $this->db->query("SELECT COUNT(surat_id) as jumlah FROM ctr_surat_masuk WHERE jenis_surat_masuk_id=$row->jenis_surat_masuk_id");
                                                    $jumlah = $jumlah->result();
                                                
                                                    echo '<li class="list-group-item">';
                                                    echo '<b style="cursor:pointer" onclick="jalankan(\'Register/surat/masuk/kategori/'.$row->jenis_surat_masuk_id.'\')">' . $row->jenis . '</b><label class="pull-right">' . $jumlah[0]->jumlah . '</label>';
                                                    echo '</li>';
                                                
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="header bg-blue">
                                    <h2>
                                        Kategori Surat Keluar <i class="fa fa-envelope"></i>
                                        <small>Berdasarkan Kategori surat</small>
                                    </h2>
                                </div>
                                <div class="body">
                                    <ul class="list-group list-group-unbordered">
                                        <?php

                                        $q = $this->db->query("SELECT * FROM ctr_kategori_surat");
                                        if (empty($q)) {
                                            echo "<b>Tidak ada data</b> <a class='pull-right'></a>";
                                        } else {
                                            foreach ($q->result() as $row) {

                                                    $jumlah = $this->db->query("SELECT COUNT(surat_id) as jumlah FROM ctr_surat_keluar_baru WHERE kategori_id=$row->id_kategori");
                                                    $jumlah = $jumlah->result();
                                                
                                                    echo '<li class="list-group-item">';
                                                    echo '<b style="cursor:pointer" onclick="jalankan(\'Register/surat/keluar/kategori/'.$row->id_kategori.'\')">' . $row->kategori . '</b><label class="pull-right">' . $jumlah[0]->jumlah . '</label>';
                                                    echo '</li>';
                                                
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php endif; ?>