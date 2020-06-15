
 $(document).ready(function(){

     function basename() {
         let filepath = $(location).attr('pathname');
         basname = filepath.replace(/\\/g, '/').replace(/.*\//, '');
         return basname;
     }

    $('.profileUpdateForm').submit(function(e){
        e.preventDefault();
        if (basename() == 'userDetails.php') {
            url = 'admin/include/profileUpdate.php';
        } else if (basename() == 'profile.php') {
            url = 'include/profileUpdate.php';
        }
       
        let fd = new FormData(this);
        $.when(updateProfile(fd,url)).done(function(res){
            if(res.status == 'success'){
                $('.profileUpdateMsg').html(alertMsgBox("Profile updated successfully" ,'success'));
            }else{
                $('.profileUpdateMsg').html(alertMsgBox("No changes made!",'warning'));
            }

        });
        
    });

     $('.profileUpdatePicForm').submit(function(e){
        e.preventDefault();
         if (basename() == 'userdetails.php') {
             url = 'admin/include/profileUpdate.php';
         } else if (basename() == 'profile.php') {
             url = 'include/profileUpdate.php';
         }
        
       
        let fd = new FormData(this);
        $('.profileUpdatePicForm button').text('uploading...');
        $.when(updateProfile(fd,url)).done(function (res) {
            if (res.status == 'success') {
                $('.profileUpdatePicMsg').html(alertMsgBox('Pic updated successfully', 'success'));
            } else {
                $('.profileUpdatePicMsg').html(alertMsgBox(res.status, 'warning'));
            }
                $('.profileUpdatePicForm button').text('Update Picture');

        });
        
    });

   /*******************************image preview function****************************************************** */
     $('.profileImageChange').click(function(){
         $(".profileUpdatePicForm [name='profileImg']").click();
        });

     $(".profileUpdatePicForm [name='profileImg']").change(function(e){
        if(e.target.files[0]){
            let reader =  new FileReader();
            reader.onload = function(e){    
                $('.profileImageChange img').attr('src', e.target.result);
             }
             reader.readAsDataURL(e.target.files[0]);
        }

    });
///*******image previews functions ends here************** */

    function updateProfile(FormData ,url){
        return $.ajax({
            url:url,
            type: 'POST',
            data : FormData,
            dataType : 'JSON',
            contentType: false,
            cache: false,
            processData: false
        });
    }

    $('.changePwdForm').submit(function(e){
        e.preventDefault();
        let fd = new FormData(this);
        console.log(basename());
        if (basename() == 'changePassword.php') {
            url = 'admin/include/changePwdProcess.php';
        } else if (basename() == 'cPwd.php') {
            url = 'include/changePwdProcess.php';
        }
        
        $('.changePwdForm [name="cPwdSubmit"]').addClass('disabled');
        $('.changePwdForm [name="cPwdSubmit"]').text('Please Wait...');
        $.when(updateProfile(fd,url)).done(function(res){
            if(res.status == 'success'){
                $('.pwdUpdateMsg').html(alertMsgBox('password has been updated', 'success'));
            }else{
                $('.pwdUpdateMsg').html(alertMsgBox(res.status, 'warning'));
            }
            $('.changePwdForm')[0].reset();
            $('.changePwdForm [name="cPwdSubmit"]').removeClass('disabled');
            $('.changePwdForm [name="cPwdSubmit"]').text('Update Password');
           
        });
        
    });


    function alertMsgBox(msg,status){
        return `<div class="alert alert-${status} alert-dismissible fade show" role="alert">
            <strong>${msg}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>`;
    }
    
    
   
 });
