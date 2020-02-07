$(document).ready(function () {

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

    
    /*********************************************************************************************************/
       
    //cartype

      $('.home-filter-div .carSearchBtn').click((e) => {
        let carType = $(e.target).text().toLowerCase();
             
        let carName = $('filter-form .carname').val();
        let carModel = $('.filter-form .carmodel').val();
        let cBodyType = $('.filter-form .bodyType').val();


        //ajax invoking;

        $.when(
              
                fetchBarndCount(carType, carName, carModel, cBodyType)
        ).done((resCount)=>{
                btnValChange(JSON.parse(resCount));
        });
        
        
      });

    //changing carmodel dropdown
     $('.filter-form .carname').change(function (e) {

      //  let optionVal = $(e.target).hasClass('carname');
                if ($(e.target).hasClass('carname')) {
                        let carType = $('.filter-form #carSearch').val();
                        let carName = $('.filter-form .carname').val();
                        let carModel = $('.filter-form .carmodel').val();
                        let cBodyType = $('.filter-form .bodyType').val();
                       
                        //invoking ajax mmethod;

                        $.when(
                                fetchCarModel(carName), 
                                fetchBarndCount(carType, carName, carModel, cBodyType)
                                ).done((res,resCount) => {
                                        setCarModel(res[0]);
                                        btnValChange(JSON.parse(resCount[0]));

                        });
                        
                }
        });

        //changing carbodytype dropdown
         $('.filter-form .carmodel').change(function (e) {

                if ($(e.target).hasClass('carmodel')) {
                        let carType = $('.filter-form #carSearch').val();
                        let carName = $('.filter-form .carname').val();
                        let carModel = $('.filter-form .carmodel').val();
                        let cBodyType = $('.filter-form .bodyType').val();


                        $.when(
                                fetchCarBodyType(carName, carModel),
                                fetchBarndCount(carType, carName, carModel, cBodyType)
                                ).done(function (res,resCount) {
                                        setCarBodyType(res[0]);
                                        btnValChange(JSON.parse(resCount[0]));
                                
                        });
                }
        });

        //fetching car count by bodytype

         $('.filter-form .bodyType').change(function (e) {

                if ($(e.target).hasClass('bodyType')) {

                        let carType = $('.filter-form #carSearch').val();
                        let carName = $('.filter-form .carname').val();
                        let carModel = $('.filter-form .carmodel').val();
                        let cBodyType = $('.filter-form .bodyType').val();

                         $.when(
                                 fetchBodyTypeCount(carType, carName, carModel, cBodyType)                               
                         ).done(function (resCount) {
                                btnValChange(JSON.parse(resCount));

                         });
                 } 
         });


//all index form ajax method

         //fetching car by condition eg. new, used;
        
        function carCondition(carType = null, carName = null, carModel = null, cBodyType = null){
                return $.ajax({
                        url: 'include/filterVehicle.php',
                                type: 'POST',
                                data: {
                                        carType: carType,
                                        carName: carName,
                                        carModel: carModel,
                                        cBodyType: cBodyType
                                        },
                                dataType: "JSON"
                });
        }

        function fetchCarModel(carName) {
                return $.ajax({
                        url: 'include/carName.php',
                        type: 'POST',
                        data: {
                                carName: carName
                      
                        },
                        dataType: "JSON"
                });
        }

  //fetching carmodel;

        function fetchCarBodyType(carName ,carModel) {
                return $.ajax({
                        url: 'include/carName.php',
                        type: 'POST',
                        data: {
                                carName: carName,
                                carModel: carModel,

                        },
                        dataType: "JSON"
                });
        }

  //fetchin car count by brand name;
        function fetchBarndCount(carType = null, carName = null, carModel = null, cBodyType = null){
                return $.ajax({
                        url:'include/filterVehicle.php',
                        type:'POST',
                        data:{
                                carType:carType,
                                carName:carName,
                                carModel:carModel,
                                cBodyType:cBodyType
                        },
                        datyaType:'JSON'
                });
        }
//fetching car count by bodytype;
        function fetchBodyTypeCount(carType = null, carName = null, carModel = null, cBodyType = null) {
                return $.ajax({
                        url: 'include/filterVehicle.php',
                        type: 'POST',
                        data: {
                                carType: carType,
                                carName: carName,
                                carModel: carModel,
                                cBodyType: cBodyType
                        },
                        datyaType: 'JSON'
                });
        }



        function setCarModel(res) {
            let carmodel = $('.carmodel');
            $('.carmodel option').remove();
            carmodel.append(`<option value=''>Select Model</option>`);
            res.forEach(modelName => {
                    carmodel.append(`<option value='${modelName}'>${modelName}</option>`);
            });
        }


        function setCarBodyType(res) {
            let bodytype = $('.bodyType');
            $('.bodyType option').remove();
            bodytype.append(`<option value=''>Select Body Type</option>`);
            res.forEach(bodyname => {
                    if (bodyname != '') {
                        bodytype.append(`<option value='${bodyname}'>${bodyname}</option>`);
                    }
            });
        }


        function btnValChange(resCount) {
                let Text = `<i class ='fas fa-car text-dark' ></i> ${resCount['count']} Cars <i class = 'fas fa-chevron-right float-right mt-2 text-dark'></i>`;
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

                let adId = $(e.target).data('ad-value');

                $.ajax({
                        url:'include/wishlist.php',
                        type:'POST',
                        dataType:'JSON',
                        data:{wishlist:adId},
                        success:function(response){
                                if(response.login == false){
                                        location.href = "login.php";
                                } else if (response.status == 'added') {
                                        $(e.target).text('Wishlisted');
                                } else if (response.status == 'removed') {
                                        $(e.target).text('Add To Wishlist');
                                }

                               // console.log(response.status);
                        }
                });
        });


 //enquiry modal
 
                $('.enquiryBtn').click(function(e){
                       let adId =  $(e.target).data('ad-value');
                       $formAdVal = $('#enquiryModal .advalue').val(adId);
                       console.log($formAdVal);
                       $('#enquiryModal').modal('show');
                });

                $('#enquiryModal').submit(function (e) {
                        e.preventDefault();
                         console.log('i m tiggered');
                });
        
       
});