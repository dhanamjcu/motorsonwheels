<?php require_once('../../resources/templates/config.php');?>
<?php include_once(TEMPLATE_BACK.DS.'header.php');?>  


<div class="containe-fluid">
   
    <?php include_once(TEMPLATE_BACK.DS.'admin_top_nav.php');?>
    <?php include_once(TEMPLATE_BACK.DS.'sidebar.php');?>
        
    <div class="main-content admin_main_content" id="admin_main_content" >
       
        <div class="conatiner">
            <div class="row">
            <div class="delModelStatus col-md-12 text-center"></div>
                <div class="col-md-6">
                    <ul class="nav nav-tabs navList " id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Car Model</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Car & Logo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Car Bodytype</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        
                        <?php include('include/addCar.php')?>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <?php include('include/addLogo.php')?>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <?php include('include/bodytype.php')?>
                        </div>
                    </div>
                </div><!--col div-->

                <div class="col-md-6">
                        <?php include('include/allCars.php');?>
                
                </div>

      
            </div>  <!--row Div--->
        </div><!--container Div--->       
    </div><!--maincontent-->
</div><!----fluiddiv>


 <!-- footer -->

<?php require_once(TEMPLATE_BACK.DS.'footer.php');?>

 <!-- ------------------------------------------------------------------------------------ -->

<div class="modal text-center" tabindex="-1" role="dialog" id="confirmModal">
  <div class="modal-dialog" role="document">

    <form id="deletFormModal">
        <div class="modal-content">
            <div class="modal-body ">
                <h3 class="text-dark">Modal body text goes here.</h3>
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </form>

  </div>
</div>