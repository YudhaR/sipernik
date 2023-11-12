<!DOCTYPE html>
<html>
<?php /*if ($this->agent->is_mobile()!=1) {
                    exit('Access denied');
          }*/
    ;?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>SIPERNIK - Aplikasi Persuratan Elektronik</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link href="<?php echo base_url() ?>resources/plugins/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>resources/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>resources/plugins/material-design-preloader/md-preloader.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>resources/css/animate.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>resources/css/style.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>resources/css/all-themes.min.css" rel="stylesheet" />    
    <link href="<?php echo base_url() ?>resources/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css">
    <link href="<?php echo base_url() ?>resources/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>resources/plugins/date_time_picker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>resources/plugins/datepicker/datepicker3.css">
    <link href="<?php echo base_url() ?>resources/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>resources/plugin/DataTables/extensions/Responsive/css/responsive.bootstrap.css" rel="stylesheet" />
    <style type="text/css">* {text-shadow: 0px 0px 1px rgba(0,0,0,0.2); text-rendering: optimizeLegibility !important; -webkit-font-smoothing: antialiased !important; } .info-box{cursor:pointer;} .wrap_load {top:0px;z-index: 999; position:fixed; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.8); overflow: hidden; text-align: center; } .wrap_load p {font-size: 13px; margin-top: 10px; font-weight: bold; color: #444; } .wrap_load .loader {position: relative; top: calc(50% - 30px); } .list .fa{font-size: 18px; padding-top: 6px; }</style>
</head>
<body class="theme-orange">

<div id="popUpWindow" class="modal fade">
        <div class="modal-dialog"> 
                <div class="modal-content">
                </div>
         </div> 
</div>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="top:30%;"> 
        <div class="modal-dialog" role="document"> 
                <div class="modal-content modal-col-red">
                        <div class="modal-header"> 
                            <h1 class="modal-title animated infinite flash" id="defaultModalLabel">Perhatian !!</h1> 
                        </div> 
                        <div class="modal-body"> Data ini akan dihapus, Apakah anda yakin ? </div>
                        <div class="modal-footer"> <a type="button" class="btn btn-link waves-effect btn-ok pull-left">YA, HAPUS SEKARANG</a> <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">TIDAK</button></div>
                 </div>
        </div>
</div> 
<div class="supreme-container">
    <div class="overlay"></div>

    <div class="wrap_load" hidden>
        <div class="loader">
            <div class="md-preloader pl-size-md">
                <svg viewbox="0 0 75 75">
                    <circle cx="37.5" cy="37.5" r="33.5" class="pl-blue" stroke-width="4" />
                </svg>
            </div>
            <p style="color:#fff;">Mohon tunggu...</p>
        </div>
    </div>

    <nav class="navbar" id="status_bar">
        <div class="container-fluid">
            <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="<?php echo base_url('Home');?>"><?php echo $this->config->item('title_page')." | ".$this->config->item('label_satker');?></a>
            <div class="" id="navbar-collapse" >
                <ul class="nav">
                    <?php if ($this->session->userdata('sess_idgroup')>= 1 &&$this->session->userdata('sess_idgroup')==$this->session->userdata('sess_jabatanid')): ?>
                        <?php if ($this->session->userdata('sess_idgroup')<= 2) {
                                  $h_disposisi = $belum_disposisi;
                              }else{
                                  $h_disposisi = $harus_disposisi;
                              }
                            ?>
                            <li class="btn btn-primary"><a href="#" onClick="jalankan('Register/surat/masuk/hrs_disposisi')"> <i class="fa fa-edit"> </i> Yang Harus Anda Disposisi <span class="disposisi"><?php echo $h_disposisi;?></span> </a></li>    
            
                    <?php endif;

/*                    echo $this->session->userdata('sess_idgroup');
                    echo $this->session->userdata('sess_jabatanid');*/

                     ?>
                    <?php /*if ($this->agent->is_mobile()==1) {
                    $btn='btn btn-primary';
                    $sign=":<br >";
                        }else{
                    $btn='btn btn-primary';
                    $sign=":<br >";
                  }*/
            ;?>
                </ul>
            </div>
        </div>
    </nav>

<!--     <nav data-toggle="collapse" data-target="#navbar-collapse" >
        <a href="javascript:void(0);" class="bars"></a>
</nav> -->
    <section>
        <?php $this->load->view('pages/left_menu') ?>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div id="konten">
                <div class="alert" style="z-index:999;position:fixed;margin:0;" hidden>
                    <div class="info-box bg-red hover-expand-effect animated bounce">
                        <div class="icon">
                            <i class="fa fa-warning animated shake"></i>
                        </div>
                        <div class="content">
                            <div class="text animated swing">ERROR !!!</div>
                             <div class="text animated shake">E-Document Wajib di Upload.<br>
                             Pastikan kembali semua kolom yang berwarna merah sudah terisi.
                             </div>
                        </div>
                    </div>
                </div>
                <?php $this->load->view($page); ?>
            </div>
        </div>
    </section>
    <section class="content" id="container_chat" hidden >
        <div class="animated slideInRight" style="right:0px;bottom:20px;position:fixed;z-index:99;width:250px;height:auto;">
            <div class="card">
                <div class="body" id="content_chat" style="padding:2px;font-size:10px;">
                                        
                </div>
            </div>
        </div>
    </section>
 

     <script src="<?php echo base_url() ?>resources/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>resources/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="<?php echo base_url() ?>resources/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="<?php echo base_url() ?>resources/plugins/bootstrap/js/bootstrap.js"></script>
    <script src="<?php echo base_url() ?>resources/plugins/bootstrap-select/js/bootstrap-select.js"></script>
    <script src="<?php echo base_url() ?>resources/plugins/node-waves/waves.js"></script> 
    <script src="<?php echo base_url() ?>resources/js/admin.js"></script>
    <script src="<?php echo base_url() ?>resources/js/pages/tables/jquery-datatable.js"></script>
    <script src="<?php echo base_url() ?>resources/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>
    <script src="<?php echo base_url() ?>resources/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
    <script src="<?php echo base_url() ?>resources/plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url() ?>resources/js/surat.js"></script>
    <script type="text/javascript">
        function jalankan(halaman,judul){ 
            $('.wrap_load').show();     
            window.open('<?php echo base_url();?>'+halaman,'_parent')
        }
        var $overlay = $('.overlay');
        $overlay.on("click", function() {
            if($('#container_chat').is(':visible')) {
                $('#container_chat').hide();
                $overlay.fadeOut();
            }
        });
    </script>
</body>
</html>