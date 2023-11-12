<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<?php 
/*if ($this->agent->is_mobile()!=1) {
                    exit('Access denied');
          }
 */   ;?>
<head>
        <meta charset="utf-8" />
        <title>ASAP</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Aplikasi Persuratan dan ordner" name="Aplikasi Manajemen Umum" />
        <meta content="" name="Puji Wiyono, S.Kom" />
        <link href="<?php echo base_url() ?>resources/plugins/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link rel="shortcut icon" href="favicon.ico" /> 
        <link href="<?php echo base_url(); ?>resources/css/animate.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>resources/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>resources/css/custom.css" rel="stylesheet">
</head>      

<body style="background-image:url(<?php echo base_url(); ?>resources/images/bg.jpg">
    
    <div class="">
        <div id="wrapper">
            <div id="login" class="animate shake">
                <section class="login_content">
                <img src='resources/images/logo.png' style='width:100px;height:125px;'>
                <h3></h3>
                <br>
                    <h2><strong><font color="black">APLIKASI SURAT DAN ADMINSTRASI KESEKRETARIATAN</font></strong></h2>
                    <H5><strong><font color="black">PENGADILAN NEGERI PASAMAN BARAT</font></strong></H5>
                    <?php
                        $attributes = array('name' => 'login', 'id' => 'login_frm','class'=>'login-form');
                        echo form_open(base_url().'login/validation_credential',$attributes);
                    ?>
                        <H2><strong>LOGIN</strong></h2>
                 
                        <div>
                            <input style="width:80%;margin:auto" class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Nama Pengguna" name="username" required/>                  
                        </div>
                        <div>
                            <input style="width:80%;margin:auto" class="form-control form-control-solid placeholder-no-fix form-group" type="password" autocomplete="off" placeholder="Kata Sandi" name="password" required/>                            
                        </div>
                        <div/>
                        <br />
                            <input type="submit" class="btn btn-primary submit" value="Login">
                            
                        </div>
                        <div class="clearfix"></div>                     
                            <br />
                            <div>
                                <p><strong>Copyright &copy; Pengadilan Negeri Pasaman Barat 2017</strong></p>
                            </div>
                        </div>
                    </form>
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
            
        </div>
    </div>

</body>
</html>