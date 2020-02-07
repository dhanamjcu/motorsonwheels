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


    /*Scroll to top when arrow up clicked END*/
    $('.home-filter-div .carSearchBtn').click(function (e) {
        $targetVal = $(e.target).text().toLowerCase();

        //fetching new car from server
        $.ajax({
            url: 'include/filterVehicle.php',
            type: 'POST',
            data: {
                cartype: $targetVal
            },
            dataType: 'JSON',
            success: function (response) {
                let Text = `<i class ='fas fa-car text-dark' ></i> ${response.count} Cars <i class = 'fas fa-chevron-right float-right mt-2 text-dark'></i>`;
                $('.countCar').html(Text);
            }
        });

    });
/********************************************************************************************************** */















    //************************************************************************************************* */



    //select car function start here
    $('.filter-form .carname').change(function (e) {

        let optionVal = $(e.target).hasClass('carname');
        if ($(e.target).hasClass('carname')) {
            let carName = $('.carname').val();
            //first ajax request
            $.ajax({
                url: 'include/carName.php',
                type: 'POST',
                data: {
                    carName: carName
                },
                dataType: "JSON",
                success: function (data) {

                    let carmodel = $('.carmodel');
                    $('.carmodel option').remove();
                    carmodel.append(`<option value=''>Select Model</option>`);
                    data.forEach(modelName => {
                        carmodel.append(`<option value='${modelName}'>${modelName}</option>`);
                    });

                }

            });
            //first ajax request ends here

        }
    });
    //select car function ends here

    $('.filter-form .carmodel').change(function (e) {

        if ($(e.target).hasClass('carmodel')) {
            let carModel = $('.carmodel').val();
            let carName = $('.filter-form .carname').val();
            //first ajax request
            $.ajax({
                url: 'include/carName.php',
                type: 'POST',
                data: {
                    carName: carName,
                    carModel: carModel,
                },
                dataType: "JSON",
                success: function (data) {

                    let bodytype = $('.bodyType');

                    $('.bodyType option').remove();
                    bodytype.append(`<option value=''>Select Body Type</option>`);

                    data.forEach(bodyname => {
                        if (bodyname != '') {
                            bodytype.append(`<option value='${bodyname}'>${bodyname}</option>`);
                        }

                    });

                }

            });
            //second ajax request ends here

        }
    });



    //view modal


    $('.viewData').click((e) => {
        let adId;
        if ($(e.target).hasClass('viewData')) {
            adId = $(e.target).data('ad-value');

        }
        //method

        $.ajax({
            url: "include/singleAd.php",
            method: "post",

            data: {
                adId: adId
            },
            success: function (data) {
                $('#showViewContent').html(data);
            }

        });



        $('#viewDetailsModal').modal('show');
    });

    // show modal


    $('.delete').click(e => {
        let deleteId;
        if ($(e.target).hasClass('delete')) {
            deleteId = $(e.target).data('ad-value');

            let deleteHtml = "<h2 class='text-center text-danger'>Are you sure?</h2>";

            $(".deleteModal .btn-danger").attr('data-delete-value', deleteId);

            $(".deleteModal").modal('show');

            $('.deleteModal .modal-body').html(deleteHtml);
        }
    });
    //delete funciton
    $('.deleteModal .btn-danger').click(e => {
        if ($(e.target).data('delete-value')) {
            let deleteId = $(".deleteModal .btn-danger").attr('data-delete-value');

            $.ajax({
                url: 'include/manageAdsProcess.php',
                type: 'POST',
                data: {
                    deleteId: deleteId
                },
                dataType: "JSON",


            }).done(function (data) {
                $(e.target).attr('disabled', true);
                let abc = $(e.target).parent().parent().parent().parent();
                $('abc .modal-body').html('hello wold');

                setTimeout(function () {
                    location.reload();
                    $(abc).modal('hide');

                }, 500)
            });



        }

    });

    //wishlist function

    $('.addWishlist').click(function (e) {

        let adId = $(e.target).data('ad-value');

        $.ajax({
            url: 'include/wishlist.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                wishlist: adId
            },
            success: function (response) {
                if (response.login == false) {
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

    $('.enquiryBtn').click(function (e) {
        let adId = $(e.target).data('ad-value');
        $formAdVal = $('#enquiryModal .advalue').val(adId);
        console.log($formAdVal);
        $('#enquiryModal').modal('show');
    });

    $('#enquiryModal').submit(function (e) {
        e.preventDefault();
        console.log('i m tiggered');
    });


});



      $('.home-filter-div .carSearchBtn').click(e=>
        {
                carType = $(e.target).text().toLowerCase();
                carName = $('.filter-form .carname').val()
               
                fetchcarType = fetchCarType();
                fetchcarType.done((response)=>{
                btnValChange(response);
                });
        });

        function fetchCarType(){
                return $.ajax({
                        url:'include/filterVehicle.php',
                        type:'Post',
                        data:   {
                                cartype: carType,
                                carName:carName
                                },
                        dataType:'JSON',
                });
        } 

        function btnValChange(response){
                let Text = `<i class ='fas fa-car text-dark' ></i> ${response.count} Cars <i class = 'fas fa-chevron-right float-right mt-2 text-dark'></i>`;
                $('.countCar').html(Text);
        }


        $('.filter-form .carname').change(function (e) {
              let optionVal = $(e.target).hasClass('carname');
              carName = $('.carname').val();
              cartype = $('#carSearch').val();
              
              if ($(e.target).hasClass('carname')) {
                      let carName = $('.carname').val();
                      let fetchingCar = fetchCarType();
                      let setCarModel = fetchCarModel();
                      
                //       setcarmodel
                      setCarModel.done(response=>{
                        displayCarModel(response);    
                      });
                //fetching car      
                      fetchingCar.done(response=>{
                        btnValChange(response);
                      });

              }
        });

//fetching model information
        function fetchCarModel(){
                return $.ajax({
                        url: 'include/carName.php',
                        type:'POST',
                        data: {carName:carName},
                        dataType: "JSON",

                });
        }

        function displayCarModel(response){
                let carmodel = $('.carmodel');
                $('.carmodel option').remove();
                carmodel.append(`<option value=''>Select Model</option>`);
                response.forEach(modelName => {
                        carmodel.append(`<option value='${modelName}'>${modelName}</option>`);
                });

        }



        $('.filter-form .bodyType').change(function(){
                let bodytype = $('.filter-form .bodyType').val();
                console.log(bodytype);
                
                let fetchBodyType = bodyTypeCar();
               
                
                fetchBodyType.done(function(response){
                        btnValChange(response);
                });
                
        });
               
        function bodyTypeCar(){
                return $.ajax({
                        url:'include/filterVehicle.php',
                        type:'POST',
                        data:{
                                cartype: cartype,
                                bodytype:bodytype
                                
                        },
                        dataType:'JSON'
                });

        }
       

/*
      $('.home-filter-div .carSearchBtn').click(e => {
          carType = $(e.target).text().toLowerCase();
          carName = $('.filter-form .carname').val()

          fetchcarType = fetchCarType();
          fetchcarType.done((response) => {
              btnValChange(response);
          });
      });

      function fetchCarType() {
          return $.ajax({
              url: 'include/filterVehicle.php',
              type: 'Post',
              data: {
                  cartype: carType,
                  carName: carName
              },
              dataType: 'JSON',
          });
      }

      function btnValChange(response) {
          let Text = `<i class ='fas fa-car text-dark' ></i> ${response.count} Cars <i class = 'fas fa-chevron-right float-right mt-2 text-dark'></i>`;
          $('.countCar').html(Text);
      }


      $('.filter-form .carname').change(function (e) {
          let optionVal = $(e.target).hasClass('carname');
          carName = $('.carname').val();
          cartype = $('#carSearch').val();

          if ($(e.target).hasClass('carname')) {
              let carName = $('.carname').val();
              let fetchingCar = fetchCarType();
              let setCarModel = fetchCarModel();

              //       setcarmodel
              setCarModel.done(response => {
                  displayCarModel(response);
              });
              //fetching car      
              fetchingCar.done(response => {
                  btnValChange(response);
              });

          }
      });

      //fetching model information
      function fetchCarModel() {
          return $.ajax({
              url: 'include/carName.php',
              type: 'POST',
              data: {
                  carName: carName
              },
              dataType: "JSON",

          });
      }

      function displayCarModel(response) {
          let carmodel = $('.carmodel');
          $('.carmodel option').remove();
          carmodel.append(`<option value=''>Select Model</option>`);
          response.forEach(modelName => {
              carmodel.append(`<option value='${modelName}'>${modelName}</option>`);
          });

      }



      $('.filter-form .bodyType').change(function () {
          let bodytype = $('.filter-form .bodyType').val();
          console.log(bodytype);

          let fetchBodyType = bodyTypeCar();


          fetchBodyType.done(function (response) {
              btnValChange(response);
          });

      });

      function bodyTypeCar() {
          return $.ajax({
              url: 'include/filterVehicle.php',
              type: 'POST',
              data: {
                  cartype: cartype,
                  bodytype: bodytype

              },
              dataType: 'JSON'
          });

      }
