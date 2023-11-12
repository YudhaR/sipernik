<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>ASAP - Aplikasi Surat Arsip dan Permintaan Barang</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link href="<?php echo base_url() ?>resources/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>resources/css/style.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>resources/css/all-themes.min.css" rel="stylesheet" />    
</head>
    <nav class="navbar bg-teal">
        <div class="col-lg-12 m-t-10">
                <div class="content text-center">
                    <div class="number" style="margin:0 auto;font-weight:bold;text-shadow: 0 1px 0 #ccc, 0 1px 0 #c9c9c9;color: #fff;border-bottom: 2px solid #fff">ARSIP SURAT</div>
                    <div class="number" style="margin:0 auto;font-weight:bold;text-shadow: 0 1px 0 #ccc, 0 1px 0 #c9c9c9;color: #fff;"><?php echo $kode."-".$nama ?></div>
                </div>
        </div>
    </nav>
    <section class="m-t-80">
        <div class="body">
                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                    <thead>
                        <tr class="bg-teal align-center">
                            <th class="align-center">No</th>
                            <th class="align-center">Nomor Surat</th>
                            <th class="align-center">Pengirim</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($data)>0){
                            $no=0;
                            foreach ($data as $r ) {
                            echo '<tr>';
                            echo '<td>'.++$no.'</td>';
                            echo '<td>'.$r->no_surat.'</td>';
                            echo '<td>'.$r->pengirim.'</td>';
                            echo '</tr>';
                            }
                        }else{
                            echo '<tr><td colspan="3">Tidak ada data</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
    </section>
</body>

</html>