<style type="text/css">
    .table *{cursor: pointer;border:none;box-shadow: none}
    .card .body {padding:10px;margin-bottom:0px;}
    .card {border-radius:15px;margin-bottom:5px;}
    .card a{color:#fff;font-weight: bold}
</style>
	<div id="new_submit">
    <?php 
        foreach ($data as $val) {
                if ($val->status=="0") {
                    $status="<span class='badge bg-orange font-10 pull-right'>Terkirim</span>";
                }else{
                    $status="<span class='badge bg-blue font-10 pull-right'>Dibaca</span>";
                }
                if ($this->session->userdata('sess_userid')==$val->user_source){
                    $color="bg-light-green";
                    $pull="pull-right";
                    $saya="Saya";
                }else{
                    $color="bg-cyan";
                    $pull="pull-left";
                    $saya=$val->nama_source;
                }
                echo '<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 '.$pull.'">';
                echo     '<div class="card '.$color.'">';
                echo      '<div class="body">';
                $date=date_create($val->tgl_kirim);
                echo        '<p class="font-10">'.$saya.' <span class="pull-right">'.$date->format('d M Y  - h:i:s').'</span>
                           <br><a><span class="font-14">'.$val->isi.'</span></a>'.$status.'</p>';
               echo  '</div></div></div>';
        }
    ?>
    </div>