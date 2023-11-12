<style type="text/css">
    .table *{cursor: pointer;border:none;box-shadow: none}
    .card .body {padding:10px;margin-bottom:0px;}
    .card {border-radius:5px;margin-bottom:5px;}
</style>
    <?php 
        foreach ($data as $val) {
           
            	echo '<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 '.($this->session->userdata('sess_userid')==$val->user_source ? 'pull-left' : 'pull-right').'">';
              	echo     '<div class="card">';
    		    echo      '<div class="body">';

                $date=date_create($val->tgl_kirim);
                echo        '<p class="font-10">'.$val->nama_source.' <span class="pull-right">'.$date->format('d M Y  - h:i:s').'</span>
                	       <br><a><span class="font-14">"'.$val->isi.'"</span></a></p>';
               echo  '</div></div></div>';
        }
    ?>
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" style="height:100px">
    </div>
    <div class="card" style="position:fixed;bottom:48px;right:45px;width:71%;height:auto">
        <div class="body">
                 <?php echo validation_errors(); ?>  
                <form method="post" id="form_chat" >
                    <div class="row clearfix">
                        <div class="form-group">
                            <label class="col-sm-2">Kirim pesan : </label>
                            <div class="col-md-7 col-red">
                                <div class="form-line">
                                    <input class="form-control" style="margin-top:-5px;overflow: hidden; overflow-wrap: break-word; height: 32px;" placeholder="ENTER untuk kirim" id="teks_pesan" name="teks_pesan" >
                                </div>
                                <input name="file_lampiran" id="file_lampiran" type="file" multiple style="display:none">
                            </div>
                        
                             <div class="col-md-2 col-red">
                             <a id="lampiran" class="btn btn-orange"><i class="fa fa-chain"></i></a>
                                <input type="submit" class="btn bg-orange" value="Kirim">
                            </div>
                                <input type="hidden" id="user_target" name="user_target" value="<?php echo $user_target;?>">
                        </div>
                    </div>
                </form>
            </div>
    </div>
</div>
<script src="<?php echo base_url() ?>resources/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
$(function(){
    window.scrollTo(0,document.body.scrollHeight);
    $('#teks_pesan').focus();
});
var request;
$("#form_chat").submit(function(event){
   event.preventDefault();
    if (request) {
        request.abort();
    }
    var $form = $(this);
    var $inputs = $form.find("input, select, button, textarea");
    var serializedData = $form.serialize();
    $inputs.prop("disabled", true);
    request = $.ajax({
        url: "<?php echo base_url().'/Chat/submit';?>",
        type: "post",
        data: serializedData
    });

    request.done(function (response, textStatus, jqXHR){
       window.open('<?php echo base_url()."Chat/detil_chat/";?>'+ $('#user_target').val(),"_parent");
        $inputs.prop("disabled", true);
    });

    request.fail(function (jqXHR, textStatus, errorThrown){

    });
    request.always(function () {
        $inputs.prop("disabled", false);
    });

});
</script>