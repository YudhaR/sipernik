<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title><?php echo $this->config->item('title_page');?> | Login Page</title>
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
  <meta content="" name="description" />
  <meta content="" name="author" />
  <link href="<?php echo base_url();?>resources/plugin/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
  <link href="<?php echo base_url();?>resources/plugin/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?php echo base_url();?>resources/plugin/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
  <link href="<?php echo base_url();?>resources/css/animate.min.css" rel="stylesheet" />
  <link href="<?php echo base_url();?>resources/css/style.css" rel="stylesheet" />
  <link href="<?php echo base_url();?>resources/css/style-responsive.css" rel="stylesheet" />
  <link href="<?php echo base_url();?>resources/css/theme/default.css" rel="stylesheet" id="theme" />
  <script src="<?php echo base_url();?>resources/plugin/pace/pace.min.js"></script></head>
<body class="pace-top" style="background:url(<?php echo base_url();?>resources/img/bglogin.jpg) no-repeat" >
  <div id="page-loader" class="fade in"><span class="spinner"></span></div>
  <div id="page-container" class="fade">
        <div class="login">
            <div class="col-sm-6 logoposisi">
              <img src="<?php echo base_url();?>resources/img/login_logo.png" data-id="login-pn-jakarta-timur" alt="" />
            </div>
            <div class="col-sm-6">
            <div class="news-feed">
                <div class="news-image">
                    
                </div>
                <div class="news-caption">
                    <h4 class="caption-title"><h4><i class="fa fa-envelope text-success"></i>Sistem Persuratan Elektronik</h4></h4><strong><?php echo $this->config->item('label_satker');?></strong><br>
                    <p>
                        Masukkan Username dan Password e-Surat anda untuk pengelolaan Surat secara Elektronik
                    </p>
                    
                </div>
            </div>
            <div class="left-body">               
                <div class="login-content">
                 <?php if ($error=='1'): ?>
                    <div class="row">
                      
                             <div class="col-sm-12">
                                      <div class="alert alert-danger alert-dismissible">
                                        <h4><i class="icon fa fa-ban"></i> Maaf!</h4>
                                        Username atau password salah, silahkan ulangi kembali.
                                      </div>
                            </div>
                    </div>
                <?php endif ?>
                 <?php
                            $attributes = array('name' => 'login', 'id' => 'login_frm','class'=>'margin-bottom-0');
                            echo form_open(base_url().'login/validation_credential',$attributes);?>
                        <div class="form-group">
                            <input type="text" class="form-control input-lg " placeholder="Username" name="username" required />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control input-lg" placeholder="Password" name="password" required />
                        </div>
                        <div class="login-buttons">
                            <button type="submit" class="btn btn-warning btn-block btn-lg">Login</button>
                            
                        </div>
                        <hr />
                        <p class="text-center">
                            &copy 2023  <?php echo $this->config->item('label_satker');?>
                        </p>
                    </form>
                </div>
            </div>
          </div>
        </div>
  </div>
  <script src="<?php echo base_url();?>resources/plugin/jquery/jquery-1.9.1.min.js"></script>
  <script src="<?php echo base_url();?>resources/js/apps.min.js"></script>
  <script>
    $(document).ready(function() {
      App.init();
    });
  </script>
</body>
</html>
