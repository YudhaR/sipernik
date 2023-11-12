<aside id="leftsidebar" class="sidebar">
    <div class="user-info align-center">
        <div class="image m-l--15">
            <?php if ($this->session->userdata('sess_foto') == "") {
                $profile = "default.png";
            } else {
                $profile = $this->session->userdata('sess_foto');
            }
            ?>
            <img src="<?php echo base_url('upload/pegawai') . '/' . $profile ?>" width="68" height="68" alt="User" />
        </div>
        <div class="info-container m-l-6">
            <div class="name col-yellow"><?php echo $this->session->userdata('sess_fullname') ?></div>
            <div class="email">Login : <?php echo $this->session->userdata('sess_status') ?></div>
            <div class="btn-group user-helper-dropdown">
                <i style="font-size:22px;" class="fa fa-angle-double-down animated infinite rubberBand" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></i>
                <ul class="dropdown-menu pull-right">
                    <li><a href="<?php echo base_url('Home/profile') . '/' . base64_encode($this->encrypt->encode($this->session->userdata('sess_pegawaiid'))) ?>"><i class="fa fa-user"> </i> Profile </a></li>
                    <li role="seperator" class="divider"></li>
                    <li><a href="<?php echo base_url('Logout'); ?>"><i class="fa fa-sign-out"> </i> Log Out </a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="menu">
        <ul class="list">
            <li class="header">Menu Utama</li>
            <li class="<?php echo ($page == 'pages/dashboard' ? 'active' : ''); ?>">
                <a href="#" onClick="jalankan('Home','Selamat Datang')">
                    <i class="fa fa-home"> </i>
                    <span> Dashboard </span>
                </a>
            </li>
            <li class="<?php echo ($page == 'admin/surat/list_surat' ? 'active' : ''); ?>">
                <a href="javascript:void(0);" class="menu-toggle col-default">
                    <i class="icon fa fa-envelope"> </i>
                    <span>Persuratan </span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="#" onClick="jalankan('Register/surat/masuk')">Surat Masuk</a>
                    </li>
                    <li>
                        <a href="#" onClick="jalankan('Register/surat/keluar')">Surat Keluar Umum</a>
                    </li>
                    <?php
                    $jabatan = $this->db->query("SELECT * FROM format_nomor_surat");
                    
                    foreach ($jabatan->result() as $j) {


                    ?>
                        <li>
                            <a href="#" onClick="jalankan('Register/surat/keluar/<?= strtolower($j->jabatan); ?>')">Surat Keluar <?= $j->jabatan; ?></a>
                        </li>
                    <?php
                    }

                    ?>
                    <!--                     <li>
                        <a href="#" onClick="jalankan('Register/surat/keluar')">Resume</a>
                    </li> -->
                    <li>
                        <a href="#" onClick="jalankan('Register/surat/masuk/ordner')">Box / Ordner</a>
                    </li>
                </ul>
            </li>

            <?php if ($this->session->userdata('sess_idgroup') <= 2 or $this->session->userdata('sess_idgroup') == 7) : ?>
                <li class="<?php echo ($page == 'admin/buku_tamu/buku_tamu_v' ? 'active' : ''); ?>">
                    <a href="javascript:void(0);" class="menu-toggle col-default">
                        <i class="fa fa-newspaper-o"> </i>
                        <span>Meja Informasi</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="#" onClick="jalankan('Buku_tamu/tamu')">Buku Tamu</a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>
            <?php #if ($this->session->userdata('sess_idgroup')<2 OR $this->session->userdata('sess_idgroup')==6): 
            ?>
            <li class="<?php echo ($page == 'admin/ortala/spt_v' ? 'active' : ''); ?>">
                <a href="javascript:void(0);" class="menu-toggle col-default">
                    <i class="fa fa-users"> </i>
                    <span>Kepegawaian</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="#" onClick="jalankan('Kepegawaian/surat_spt')">Surat Perintah Tugas (SPT)</a>
                    </li>
                    <li>
                        <a href="#" onClick="jalankan('Kepegawaian/surat_ijin')">Surat Ijin</a>
                    </li>
                </ul>
            </li>
            <?php #endif ;
            ?>
            <!-- <?php if ($this->session->userdata('sess_idgroup') < 2 or $this->session->userdata('sess_idgroup') == 7) : ?>
            <li class="<?php echo ($page == '' ? 'active' : ''); ?>" >
                <a href="javascript:void(0);" class="menu-toggle col-pink">
                    <i class="fa fa-low-vision"> </i>
                    <span>Perencanaan, IT & Pelaporan</span>
                </a>
                <ul class="ml-menu">
                    <li>
                       <a href="#" onClick="jalankan('')">Monitor IT</a>
                    </li>                    
                </ul>
            </li>
            <?php endif; ?> -->
            <?php if ($this->session->userdata('sess_idgroup') <= 2) : ?>
                <li class="<?php echo (explode("/", $page)[1] == 'referensi' ? 'active' : ''); ?>">
                    <a href="javascript:void(0);" class="menu-toggle col-default">
                        <i class="icon fa fa-book"> </i>
                        <span>Referensi</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="#" onClick="jalankan('Referensi/jenis_surat')">Jenis Surat</a>
                        </li>
                        <li>
                            <a href="#" onClick="jalankan('Referensi/kategori_surat')">Kategori Surat</a>
                        </li>
                        <li>
                            <a href="#" onClick="jalankan('Referensi/sifat_disposisi')">Sifat Disposisi</a>
                        </li>
                        <li>
                            <a href="#" onClick="jalankan('Referensi/penomoran')">Format Penomoran</a>
                        </li>
                        <li>
                            <a href="#" onClick="jalankan('Referensi/ordner')">Box / Ordner</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>Referensi/jabatan">Jabatan</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>Referensi/pegawai">Data Pegawai</a>
                        </li>

                    </ul>
                </li>
            <?php endif; ?>
            <?php if ($this->session->userdata('sess_idgroup') <= 2 or $this->session->userdata('sess_idgroup') == 11) : ?>
                <li class="<?php echo (explode("/", $page)[1] == 'Konfigurasi_system' ? 'active' : ''); ?>">
                    <a href="javascript:void(0);" class="menu-toggle col-default">
                        <i class="fa fa-newspaper-o"> </i>
                        <span>Utility</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="<?php echo base_url(); ?>Konfigurasi_system/user">User / Pengguna</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>Konfigurasi_system/konfigurasi_instansi">Profil Instansi</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>Konfigurasi_system/backup_database">Backup / Restore Database</a>
                        </li>

                    </ul>
                </li>
            <?php endif; ?>
            <li>
                <a href="<?php echo base_url(); ?>logout">
                    <i class="fa fa-sign-out"> </i>
                    <span>Logout</span>
                </a>
            </li>

    </div>
    <div class="copyright">
        &copy; 2023 <br><small><?php echo $this->config->item('label_satker'); ?></small><br>
        <small>Version: 1.2.0 </small>
    </div>
</aside>