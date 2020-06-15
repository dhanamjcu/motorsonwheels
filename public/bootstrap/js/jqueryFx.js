$(document).ready(function () {
        let carNameUrl = 'include/carName.php';
        let carCountUrl = 'filterVehicle.php';

         //to capitalize first charc of string
         String.prototype.capitalize = function () {
                 return this.charAt(0).toUpperCase() + this.slice(1);
         }
        
       
       /* Scroll to top when arrow up clicked BEGIN */
        $(window).scroll(function () {
                let height = $(window).scrollTop();
                if (height > 100) {
                        $('#back2Top').fadeIn();
                } else {
                        $('#back2Top').fadeOut();
                }
        });
        
        $("#back2Top").click(function (event) {
                event.preventDefault();
                $("html, body").animate({
                        scrollTop: 0
                }, "slow");
                return false;
        });
/******************************************changing car condition*******************************************/
        $('.home-filter-div .carSearchBtn').click(function(e){
                let carCondition = $(e.target).text().toLowerCase();
                $('.home-filter-div #carSearch').val(carCondition);
                $.each($('.carSearchBtn'),function(){
                        $(this).removeClass('btn-active');
                        $(e.target).addClass('btn-active');
                });

                let formData = new FormData(homeFilterForm);
                $.when(
                        fetchResponse(formData,carCountUrl)
                ).done((resCount) => {
                        btnValChange(resCount.count);
                });

        });
    /*********************************************************************************************************/
      
        $('.homefilter').change(function(){
                let homeFilterForm = $('#homeFilterForm')[0];
                let minPrice = parseInt($("#homeFilterForm select[name='minPrice']").val());
                let maxPrice = parseInt($("#homeFilterForm select[name='maxPrice']").val());
                let formData = new FormData(homeFilterForm);
                        if (minPrice > maxPrice && maxPrice != '') {
                                alert('Min price must be lesser than Max Price');
                                return;
                        }

                if($(this).attr('name') == 'carName'){
                        $('.carmodel').val('');
                        $('.bodyType').val('');
                        formData = new FormData(homeFilterForm);
                        $.when(
                                fetchResponse(formData, carNameUrl),
                                fetchResponse(formData, carCountUrl)
                        ).done((res, resCount) => {
                               
                                setCarModel(res);
                                btnValChange(resCount[0].count);
                        });
                       return;
                } //setting carmodel

                if ($(this).attr('name') == 'carModel'){
                        $('.bodyType').val('');
                        formData = new FormData(homeFilterForm);
                       
                        $.when(
                                fetchResponse(formData,carNameUrl),
                                fetchResponse(formData,carCountUrl)
                        ).done((res, resCount) => {
                                setCarBodyType(res);
                                btnValChange(resCount[0].count);
                        });
                }//setting carbody

                if($(this).attr('name') == 'cBodyType') {
                        fetchAjaxCount(formData);
                }
                if($(this).attr('name') == 'minPrice'){
                       fetchAjaxCount(formData);
                }
                if ($(this).attr('name') == 'maxPrice') {
                        fetchAjaxCount(formData);
                }
                
        });
        function fetchAjaxCount(formData) {
                $.when(
                        fetchResponse(formData, carCountUrl)
                ).done((resCount) => {
                        btnValChange(resCount.count);
                });
        }

    /*********************************************************************************************************/  
        function fetchResponse(formData,url) {
                return $.ajax({
                        url: url,
                        type: 'POST',
                        data: formData,
                        dataType: 'JSON',
                        contentType: false,
                        cache: false,
                        processData: false
                });
        }
  
        //setting car model create ads
      
        $('#createAdsForm .createAdsForm').change(function () {

               let carname = $('select[name="vName"]').val().toLowerCase();
               let carmodel = $('select[name="vModel"]').val().toLowerCase();
               let fd = new FormData();
               let url= 'include/carName.php';
               fd.append('carName', carname);
               fd.append('carModel',carmodel);
               fd.append('fromTable','`cars`');
               if ($(this).attr('name') === 'vName') {
                        $.when(fetchResponse(fd,url)).done(function (res) {
                                //conveting array into object
                                res = {0:res};
                                setCarModel(res);
                        });
               }
               if ($(this).attr('name') === 'vModel') {
                        $.when(fetchResponse(fd, url)).done(function (res) {
                                res = {0: res};
                               setCarBodyType(res);
                        });
               }
               
               
        });

//set model into option fields
        function setCarModel(res) {  
            let carmodel = $('.carmodel');
            $('.carmodel option').remove();
            carmodel.append(`<option value=''>Select Model</option>`);
            res[0].forEach(modelName => {
                    carmodel.append(`<option value='${modelName}'>${modelName}</option>`);
            });
        }


        function setCarBodyType(res) {
            let bodytype = $('.bodyType');
            $('.bodyType option').remove();
            bodytype.append(`<option value=''>Select Body Type</option>`);
            res[0].forEach(bodyname => {
                    if (bodyname != '') {
                        bodytype.append(`<option value='${bodyname}'>${bodyname}</option>`);
                    }
            });
        }


        function btnValChange(resCount) {
                let Text = `<i class ='fas fa-car text-dark' ></i> ${resCount} Cars <i class = 'fas fa-chevron-right float-right mt-2 text-dark'></i>`;
                $('.countCar').html(Text);
        }

   /***********************************************************************************************************/

        //view modal

        $('.viewData').click((e)=>{
                let adId;
                if($(e.target).hasClass('viewData')){
                 adId = $(e.target).data('ad-value'); 

                }
                //method

                $.ajax({
                        url: "include/singleAd.php",
                        method: "post",      
                        data:{adId:adId},
                        success:function(data){
                                $('#showViewContent').html(data);
                        }
                });
        
                $('#viewDetailsModal').modal('show');
        });
        
// show modal

        $('.delete').click( e =>{
                let deleteId;
                if($(e.target).hasClass('delete')){
                        deleteId = $(e.target).data('ad-value');
                       
                        let deleteHtml = "<h2 class='text-center text-danger'>Are you sure?</h2>";
                       
                        $(".deleteModal .btn-danger").attr('data-delete-value', deleteId);

                        $(".deleteModal").modal('show');
                       
                        $('.deleteModal .modal-body').html(deleteHtml);
                }
        });
//delete funciton
        $('.deleteModal .btn-danger').click(e=>{
                if($(e.target).data('delete-value')){
                        let deleteId = $(".deleteModal .btn-danger").attr('data-delete-value');
                        
                         $.ajax({
                                url:'include/manageAdsProcess.php',
                                type: 'POST',
                                data: { deleteId: deleteId },
                                dataType: "JSON",
                                

                        }).done(function(data){
                                
                                $(e.target).attr('disabled',true);
                                let abc= $(e.target).parent().parent().parent().parent();
                                $('abc .modal-body').html('hello wold');

                                setTimeout(function(){
                                        location.reload(); 
                                        $(abc).modal('hide');      
                                },500) 
                        }); 
      
                }
        });

//wishlist function

        $('.addWishlist').click(function(e){
                e.preventDefault();

                let adId = $(this).data('ad-value');
                let fd = new FormData();
              
                fd.append('wishlist', adId);
                $.when(fetchResponse(fd, 'include/wishlist.php')).done(function(response){
                        if(response.login == false){
                                location.href = "login.php";
                        } else if (response.status == 'added') {
                                
                                $(e.target).parent().html(`<i class="fas fa-heart fa-2x"></i>`);
                        } else if (response.status == 'removed') {
                                $(e.target).parent().html(` <i class="fas fa-heart fa-2x text-white"></i>`);
                        }

                        // console.log(response.status);
                });
               
        });
        
        $('.wishlist__remove').click(function(e){
                e.preventDefault();
                let adId = $(this).data('ad-value');
                //alert(adId);
                let fd = new FormData();
                fd.append('wishlistRemove', adId);
                $.when(fetchResponse(fd, 'include/wishlist.php')).done(function (response){
                        if (response.status == 'removed') {
                                $(e.target).parent().parent().remove();
                        }
                });
        });

  //seller enquiry
  
        $('.sellerEnq').click(function(){
                let userId = $(this).data('ad-value');
                let fd = new FormData();
                fd.append('sellerEnq', userId);
                $.when(fetchResponse(fd, 'include/enquiryProcess.php')).done(function(res){
                        
                        let contact = res.user.phone
                        if (contact =='' || contact.length < 0){
                                contact = 'Not mentioned';
                        }
                        
                        let html = enqModalBody(res.user.name,contact , res.user.email);
                        $('#SellerenquiryModal .modal-title').html('Contact to Seller');
                        $('#SellerenquiryModal .modal-body').html(html);
                        $('#SellerenquiryModal').modal('show');
                 });
        });
        function enqModalBody(name, phone,email){
                return `<h5>Seller Name  : ${name.capitalize()}</h5>
                        <h5>Seller Send mail : <a href="mailto:${email}">${email}</a></h5>
                        <h5> Seller Contact: <a href = "tel:${phone}">${phone}</a></h5 >
                `;

        }


 //enquiry modal
 
        $('.enquiryBtn').click(function(e){
                let adId =  $(e.target).data('ad-value');
                $('#FooterenquiryModal input[name="adId"]').val(adId);
                $('#FooterenquiryModal').modal('show');
        });

        $('#enquiryForm').submit(function(e){
                e.preventDefault();
                let fd = new FormData(this);
                fd.append('enqSubmit','enqSubmit');
                url = 'include/enquiryProcess.php';
                $.when(fetchResponse(fd, url)).done(function(res){
                        if(res.msg == true){
                           $('#FooterenquiryModal').modal('hide');
                           $('#enquiryForm')[0].reset();
                           let msg = `Thanks for showing Interest. We'll contact you soon!`;
                          
                           $(noticePopup(msg, 'success')).appendTo('body');
                                setTimeout(function () {
                                        $(".notice_popup").alert('close');
                                }, 4000);
                        }else{
                          $('#enqResStatus').html(simpleNoticePopup(res.msg, 'warning'));
                        }   
                });
                
        });

        //forget password modal show up

        $('.forgotPwdBtn').click(function(e){
                e.preventDefault();
                $('#forgotModal').modal({
                        show:true,
                        backdrop: false,
                        keyboard: false
                });   
                
        });

        //forget password reset form
        $('#resetPasswordForm').submit(function(e){
                e.preventDefault();
                let fd =  new FormData(this);
                fd.append('resetSubmit', 'resetSubmit');
                url = 'include/resetpwdProcess.php';
                $('#resetPasswordForm button[name="resetSubmit"]').hide();
                $('.loaderDiv').append(lodergif());
                $.when(fetchResponse(fd, url)).done(function (res) {
                        $('.loader').hide();
                        $('#resetPasswordForm button[name="resetSubmit"]').show();
                        if(res.msg == true){
                                let msg = `<p>Password has been reset. <a href='login.php' class="btn btn-primary">Login</a></p>`;
                                $('#resetPasswordForm').hide();
                                $(".statusMsg").html(msg);
                        }else{
                               $(".statusMsg").html(simpleNoticePopup(res.msg, 'warning'));
                        }
                });
        
                
        });

        //forget password modal submit buttson

        $('#forgotPwdForm').submit(function(e){
                e.preventDefault();
                let fd = new FormData(this);
                url = 'include/forgotpwdProcess.php';
                $('#forgotPwdForm').hide();
               
                $('#forgotModal .modal-body').append(lodergif());

                $.when(fetchResponse(fd, url)).done(function(res){
                        $('#forgotPwdForm').show();
                        $('#forgotModal .loader').hide();
                        if(res.msg == true){
                                $('#forgotPwdForm')[0].reset();
                                $('#forgotModal').modal('hide'); 
                                $(noticePopup('Reset Link has been sent on your registered email. Please check it out ', 'success')).appendTo('body');
                                noticeShowup(6000);
                        }else{
                                $('#forgotpwdMsg').html(simpleNoticePopup(res.msg, 'warning'));    
                        }
                        

                });
        });


      
        

        function noticePopup(msg, alertStatus) {
                return `<div class="alert alert-${alertStatus} alert-dismissible fade show notice_popup" role="alert">
                <strong>${msg}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                        </button>
                </div>`;
        }

        function simpleNoticePopup(msg, alertStatus) {
                 return `<div class="alert alert-${alertStatus} alert-dismissible fade show " role="alert">
                <strong>${msg}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                        </button>
                </div>`;
        };

        function noticeShowup(dur=4000){
                setTimeout(function () {
                        $(".notice_popup").alert('close');
                }, dur);
        }
        
        function lodergif(){
                return `<div class="loader text-center">
                                <img src="loaderDualball.gif">
                                <p>please wait...</p>       
                        </div>`;
        }
});//document ready function  bracket