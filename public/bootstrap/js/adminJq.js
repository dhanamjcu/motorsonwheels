$(document).ready(function(){
    //to capitalize first charc of string
    String.prototype.capitalize = function () {
        return this.charAt(0).toUpperCase() + this.slice(1);
    }

    /***************************date range*******************************************/
    $('#tsorterFrm .datePicker').click(function(){
        
        $('.dateinput').datepicker({
            beforeShow: function (input, inst) {
                $(document).off('focusin.bs.modal');
            },
            onClose: function () {
                $(document).on('focusin.bs.modal');
            },
            changeYear: true,
            changeMonth: true,
            showOtherMonths: true,
            maxDate : new Date()

        });
        $('#dateRangeModal').modal('show');
       
    });

    $('#dateRangeModal form').submit(function(e){
        e.preventDefault();
        let startDate   =   $('#dateRangeModal input[name ="startDate"]').val();
        let endDate     =   $('#dateRangeModal input[name ="endDate"]').val();
            if(startDate>endDate){
                alert('Start Date must be less than End Date');
                return;
            }
        let formData = new FormData(this);
        $('#tsorterFrm input[name ="startDate"]').val(startDate);
        $('#tsorterFrm input[name ="endDate"]').val(endDate);
        $.when(sortTable(formData)).done(function(response){
            $('#SortContent').html(response); 
            $('#dateRangeModal form')[0].reset();
            $('#dateRangeModal').modal('hide');
        });
    });

    /************************sort function************************** */
    
            $('.tsorter').on('change',function(){
              
                let tsorterFrm = $('#tsorterFrm')[0];
                let formData = new FormData(tsorterFrm);
                
                $.when(sortTable(formData)).done(function (response) {
                    $('#SortContent').html(response);  
                });  
            });
       

    $('#SortContent').click(function(e){
        if ($(e.target).data('index')){
            e.preventDefault();
            let currentPage = $(e.target).data('index');
            //  alert(currentPage);
            let tsorterFrm = $('#tsorterFrm')[0];
            let formData = new FormData(tsorterFrm);
            formData.append('currentPage', JSON.stringify(currentPage));

            $.when(sortTable(formData)).done(function (response) {
                $('#SortContent').html(response);
            });    

        }
        
            
            
          
        });

        function sortTable(formData){
            return $.ajax({
                url:'include/sortTableProcess.php',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false
            });
        } 


    /****************************************************************/

    $('.statusChange').click(function(){
        let changedVal = $(this).data('action');
        let adId = $(this).data('id');
        $.when(updateAdStatus(adId,changedVal)).done(function(response){
            if(response.status == 'success'){
                let changeStatus =  $('.allAds .status');

                $.each(changeStatus,function(elem,value){
                    if($(value).data('status') == adId){
                        $(this).text(changedVal.capitalize());
                        $(this).removeClass(function (index, css) {
                            return (css.match(/\bbg-\S+/g) || []).join(' ');
                           
                        });
                            if (changedVal == 'approved') {
                                $(this).addClass('bg-success');
                            } else if (changedVal == 'rejected') {
                                $(this).addClass('bg-danger');
                            } else if (changedVal == 'pending') {
                                $(this).addClass('bg-warning');
                            } else {
                                $(this).addClass('bg-warning');
                            }     
                            alert(`Status changed to ${changedVal}`);
                    }
                });
                       
           }
       });
      
    });

    function updateAdStatus(adId = null, changedVal = 'pending'){
        return $.ajax({
            url: 'include/adAction.php',
            type:'POST',
            data:{
                adId : adId,
                changedVal: changedVal,
                updateSubmit:'updateSubmit'
            },
            dataType:'JSON'
        });
    }
  

    /***********************/
    $('#logoUpload').submit(function(e){
        e.preventDefault();
        let formData = new FormData(this);
    //JSON obj
        formData.append('logoUpload', JSON.stringify('logoUpload'));
        $.when(
            uploadImg(formData)
        ).done(function (response) {
            if(response.status == 'success'){
                $('#logoUpload')[0].reset();
                let Text = alertBox("New car brand added.",'success');
                $('.logoStatus').html(Text);
            }else{
                let Text = alertBox(response.status);
                $('.logoStatus').html(Text);
            }

        });
        
    });

////******bodytype*********************** */

    $('#uploadBodyType').submit(function(e) {
        e.preventDefault();
        let fd = new FormData(this);
        //JSON obj
        fd.append('bodytype', JSON.stringify('bodytype'));
        $.when(
            uploadImg(fd)
        ).done(function(response) {
            if (response.status == 'success') {
                $('#uploadBodyType')[0].reset();
                let Text = alertBox("New car brand added.", 'success');
                $('.bodyTypeStatus').html(Text);
            } else {
                let Text = alertBox(response.status);
                $('.bodyTypeStatus').html(Text);
            }

        });
    });


    /*******************************************************************/

    $('.modelDelBtn').click(function(e){
        let delId = $(this).data('index');
        $('#confirmModal .modal-body').html(DeleteModal(delId, 'Want to remove car model?','modelDeleteSubmit','data-index'));
        $('#confirmModal').modal('show');
    });
 /*******************************delete logo**********************************************************/


    $('.logoDelBtn').click(function(){
        let delLogo = $(this).data('logo-index');
        $('#confirmModal .modal-body').html(DeleteModal(delLogo, 'Want to remove logo?', 'logoDeleteSubmit', 'data-logo-index'));
        $('#confirmModal').modal('show');
    });
   
    /*****************************delete bodytype************************************************ */
    $('.bodytypeDelBtn').click(function(){
        let bodytypeId = $(this).data('bodytype-index');
        $('#confirmModal .modal-body').html(DeleteModal(bodytypeId, 'Want to remove bodytype?', 'bodytypeDelSubmit', 'data-bodytype-index'));
        $('#confirmModal').modal('show');
    });

 /******************************delete car model******************************************/
    $('#deletFormModal').submit(function(e){
        e.preventDefault();
        let formData = new FormData(this);
        // formData.append('modelDeleteSubmit', JSON.stringify('modelDeleteSubmit'));
        let dataIndex = $('[data-index-value]').val();
        deleteSubmit(formData, dataIndex);
        
    });


/*********************************single view* on modal******************************************************/
    $('#SortContent').click(function(e){
        
        if ($(e.target).hasClass('openSingleView')){
            let id = $(e.target).data('ad-id');

            $.when(loadSingleView(id)).done(function (response) {
                $('#Admin_loadSingleView .statusChange').attr('data-id', id);
                $('#Admin_loadSingleView .modal-body').html(response);
                $('#Admin_loadSingleView').modal('show');
            }); 
        }
        
    });

    function loadSingleView(adId){
        return $.ajax({
            url: 'singleView.php',
            type:'POST',
            data:{
                id:adId,
                singleView:'singleView'
            },
        });
    }




});//document  ready ends here

/****************************Model*********************************************/
$('#addCarModel').submit(function (e) {
    e.preventDefault();
    let fd = new FormData(this);
    //JSON obj
   
    fd.append('carModelSubmit', JSON.stringify('carModelSubmit'));
    $.when(
        uploadImg(fd)
    ).done(function (response) {
        if (response.status == 'success') {
            $('#addCarModel')[0].reset();
            let Text = alertBox("New car model added.", 'success');
            $('.bodyModelStatus').html(Text);
        } else {
            let Text = alertBox(response.status);
            
            $('.bodyModelStatus').html(Text);
        }

    });
});


function uploadImg(formData){
    return $.ajax({
        url: "include/carAction.php",
        type: "POST",
        dataType:'JSON',
        data: formData,
        contentType: false,
        cache: false,
        processData: false
    });
}

function alertBox(alertMsg,alertType="warning"){
   return `
        <div class="alert alert-${alertType} alert-dismissible fade show" role="alert">
                ${alertMsg}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button> 
        </div>
  `;
}

function DeleteModal(id=null,msg,submitName,indexValue){
    return `
        <input type="hidden" name="delId" value="${id}">
        <input type="hidden" name="${submitName}" value="${submitName}">
        <input type="hidden" value="${indexValue}" data-index-value>
        <h3>${msg}</h3>  
    `;
}

function deleteSubmit(formData,dataIndex){
        $.when(
            uploadImg(formData)
        ).done(function (response) {
            if (response.status == 'success') {
                let Text = alertBox("Car model removed.", 'success');
                $('.delModelStatus').html(Text);
                $('['+dataIndex+'=' + response.id + ']').parent().parent().remove();
                $('#confirmModal').modal('hide');
            } else {
                let Text = alertBox(response.status);
                $('.delModelStatus').html(Text);
            }
            $('#deletFormModal')[0].reset();
            $('#confirmModal').modal('hide');
            window.scrollTo(0, 50); 
        });
   
}
