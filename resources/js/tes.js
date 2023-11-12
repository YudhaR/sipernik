jQuery.fn.submitForm = function(e) {
var request;
$("#form_barang").submit(function(event){
    event.preventDefault();
    var $form = $(this);
    var $inputs = $form.find("input, select, button, textarea");
    var serializedData = $form.serialize();
    request = $.ajax({
        url: $(this).attr('action'),
        type: "post",
        data: serializedData,
        dataType:'json'
    });
    request.done(function (json){
        if (json.st='1'){
            $('.wrap_load').show();
        }else{
            $('.wrap_load').show();
        }
        $('#popUpWindow').click()
    });
});
}



