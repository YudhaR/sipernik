<aside id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="#skins" data-toggle="tab">REFERENSI</a></li>
                <li role="presentation"><a href="#settings" data-toggle="tab">UTILITY</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                    <ul class="demo-choose-skin">
                        <li>
                            <ul class="setting-list">
                                <li>
                                    <a href="<?php echo base_url(); ?>Referensi/jabatan">Jabatan</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>Referensi/pegawai">Data Pegawai</a>
                                </li>
                                <p>SISTIM</p>
                                <li>
                                    <a class="col-red" href="<?php echo base_url(); ?>Konfigurasi_system/user">User / Pengguna</a>
                                </li>
                                <li>
                                    <a class="col-red" href="<?php echo base_url(); ?>Konfigurasi_system/konfigurasi_instansi">Profil Instansi</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="settings">
                    <div class="demo-settings">
                        <p>DATABASE</p>
                        <ul class="setting-list">
                            <li>
                                <span><a href="<?php echo base_url(); ?>Konfigurasi_system/backup_database">Backup / Restore Database</a></span>
                            </li>
                        </ul>
                        
                    </div>
                </div>
            </div>
        </aside>