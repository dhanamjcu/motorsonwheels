$(document).ready(function(){
    $('#approveForm').submit(function(e){
        e.preventDefault();
        let fd =  new FormData(this);
        let url ='include/loginCheck.php';
        $.when(ajaxFormProcess(fd,url)).done(function(res){
            
            if(res.login == true){
                location.reload();
            }else{
                $('#msg').html(simpleAlert(res.error, 'danger'));
            }
        });
    });

    $('input[name="changeStatus"]').click(function(e){
        e.preventDefault();
        let btnVal = $(this).val();
        let approveForm = $('#approveSubmitForm');
        let fd =  new FormData(approveForm[0]);
        fd.append('changeStatus',btnVal);
        let url ='include/approveProcess.php';
        $.when(ajaxFormProcess(fd,url)).done(function(res){
           
            $(noticePopup(res.msg, 'success')).appendTo('body');
            $('input[name="changeStatus"]').prop('disabled', true);
            setTimeout(function(){
                $(".notice_popup").alert('close');
                $('input[name="changeStatus"]').prop('disabled', false);
            },3000);
        });
    });

});


function ajaxFormProcess(formData,url){
    return  $.ajax({
            url:url ,
            type: 'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType : 'JSON'
 
        });
}

function noticePopup(msg,alertStatus){
    return `<div class="alert alert-${alertStatus} alert-dismissible fade show notice_popup" role="alert">
  <strong>${msg}</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>`;
}

function simpleAlert(msg, alertStatus) {
    return `<div class="alert alert-${alertStatus} alert-dismissible fade show" role="alert">
    <strong>${msg}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>`;
}
