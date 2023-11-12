<style type="text/css">
    tr{cursor: pointer}
</style>
<table class="table table-striped table-hover" >
    <thead>
        <col width="20px">
        <col width="">
        <col width="10px">
        <tr class="bg-red align-center">
            <th colspan="3" class="align-center font-20"><i class="fa fa-comment animated infinite swing"> </i> CHAT</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($data)>0) {
            foreach ($data as $val) {
                 if ($this->session->userdata('sess_userid')!= $val->userid) :
                    $onclick = "window.open('".base_url('Chat/detil_chat/'.base64_encode($this->encrypt->encode($val->userid)))."','_parent')";
                    echo '<tr onclick="'.$onclick.'">';
                    echo    '<td><img style="border-radius:50%" width="40px" height="40px" src="'.base_url().'/upload/pegawai/'.$val->foto.'"></img></td>';
                    echo    '<td>'.$val->nama.'</td>';
                    echo   '<td></td>';
                    echo '</tr>';
                endif;
             } 
         }else{
                echo '<tr>';
                echo  '<td colspan="3">Tidak ada user online</td>';
                echo '</tr>';
         }?>
    </tbody>
</table>