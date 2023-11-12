    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header bg-green">
                <h2>
                   <?php echo $title;?>
                   <div class="divider"></div>
                    <small class="col-blue">Ketik pengumuman dibawah ini kemudian klik ucapkan</small>
                </h2>
                <div <?php echo ($this->agent->browser()=="Chrome") ? $hidden="hidden" : $hidden="";  ?>><small class="col-blue animated infinite fadeIn bg-red">Maaf, Fitur ini hanya untuk browser Chrome</small></div>
                <ul class="header-dropdown m-r-0 animated flipInX">
                    <a class="btn bg-red" href="<?php echo base_url('Info/pengumuman');?>" data-toggle="modal" data-target="#popUpWindow"><i class="fa fa-question-circle-o  col-white"></i> Klik disini untuk bantuan</a>&nbsp
                </ul>                    
            </div>
            <div class="body"  <?php echo ($this->agent->browser()=="Chrome") ? $hidden="" : $hidden="hidden";  ?>>
            			<form method="post">
	                        <div class="row clearfix">
	                                <div class="col-md-6 col-red">
	                                    Isi pengumuman :
		                                <div class="input-group">
		                                    <div class="form-line">
		                                        <textarea id="isi_pengumuman" class="form-control no-resize auto-growth"  style="overflow: hidden; overflow-wrap: break-word; height: 100px;" placeholder="ENTER untuk menambah baris" rows="5"></textarea>
		                                    </div>
		                                </div>
	                                </div>
	                        </div>
                        <div class="row clearfix">
                            <div class="col-md-12 text-center">
                              <button type="submit" class="btn bg-cyan waves-effect" style="display:none">Simpan</button>
                              <button type="button" id="btn_ucapkan" onclick="ucapkan()" class="btn bg-cyan btn-lg waves-effect">Ucapkan</button>
                            </div>
                        </div>
	                    </form>
                </div>
                <audio id="pembukaan" onended="endOpening();">
                      <source src="<?php echo base_url('resources/sound').'/opening.mp3';?>" type="audio/mpeg">
                        Browser tidak support suara
                </audio>
                <audio id="closing">
                      <source src="<?php echo base_url('resources/sound').'/closing.mp3';?>" type="audio/mpeg">
                        Browser tidak support suara
                </audio>
             </form>
        </div>
    </div>
<script src="<?php echo base_url() ?>resources/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>resources/plugins/autosize/autosize.min.js"></script>
<script type="text/javascript">
var _0x8e5b=["\x74\x65\x78\x74\x61\x72\x65\x61","\x71\x75\x65\x72\x79\x53\x65\x6C\x65\x63\x74\x6F\x72\x41\x6C\x6C","\x66\x6F\x63\x75\x73","\x23\x69\x73\x69\x5F\x70\x65\x6E\x67\x75\x6D\x75\x6D\x61\x6E","\x23\x63\x6C\x6F\x73\x69\x6E\x67","\x70\x6C\x61\x79","\x67\x65\x74","\x50\x65\x6E\x67\x75\x6D\x75\x6D\x61\x6E\x20\x73\x65\x6C\x65\x73\x61\x69","\x6C\x6F\x67","\x73\x68\x6F\x77","\x23\x62\x74\x6E\x5F\x75\x63\x61\x70\x6B\x61\x6E","\x68\x69\x64\x65","\x23\x70\x65\x6D\x62\x75\x6B\x61\x61\x6E","\x50\x65\x6E\x67\x75\x6D\x75\x6D\x61\x6E\x20\x64\x69\x6A\x61\x6C\x61\x6E\x6B\x61\x6E","\x76\x61\x6C","\x43\x61\x74\x75\x72\x41\x64\x69\x53","\x73\x70\x65\x61\x6B"];$(function(){autosize(document[_0x8e5b[1]](_0x8e5b[0]));$(_0x8e5b[3])[_0x8e5b[2]]()});var parameters={onend:pegumumanSelesai,rate:0.9};function pegumumanSelesai(){var _0x2ed0x3=$(_0x8e5b[4]);_0x2ed0x3[_0x8e5b[6]](0)[_0x8e5b[5]]();console[_0x8e5b[8]](_0x8e5b[7]);$(_0x8e5b[10])[_0x8e5b[9]]()}function ucapkan(){$(_0x8e5b[10])[_0x8e5b[11]]();var _0x2ed0x5=$(_0x8e5b[12]);_0x2ed0x5[_0x8e5b[6]](0)[_0x8e5b[5]]();console[_0x8e5b[8]](_0x8e5b[13])}function endOpening(){bocoen[_0x8e5b[16]]($(_0x8e5b[3])[_0x8e5b[14]](),_0x8e5b[15],parameters)}
</script>