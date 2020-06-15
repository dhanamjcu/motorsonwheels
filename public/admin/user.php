<?php require_once('../../resources/templates/config.php');?>
<?php include_once(TEMPLATE_BACK.DS.'header.php');?>  

<?php isAdmin();?>

<?php
    if(isset($_GET['userid'])):
        $userid = $_GET['userid'];
        $sql = "SELECT * FROM `users` WHERE `id` = ?";
       $row =  getSingleView($sql,$userid);
      

        if(empty($userid)):
            header('location:allusers.php');
        endif;
    else:
        header('location:allusers.php');
    endif;    
?>

<div class="containe-fluid">
   
    <?php include_once(TEMPLATE_BACK.DS.'admin_top_nav.php');?>
    <?php include_once(TEMPLATE_BACK.DS.'sidebar.php');?>

    <div class="main-content admin_main_content" id="admin_main_content" >

        <div class="container">
            <div class="row">
                 <div class="col-md-12">
                     <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-dark">
                            <li class="breadcrumb-item active"><a href="index.php" ><i class="fas fa-home mr-2"></i>Home</a></li>
                            <li class="breadcrumb-item active">Change Password</li>
                        </ol>
                    </nav>

                    <!-- profile content -->
                </div><!-- col div-->
                <div class="col-md-8 ">
                    <div class="card">
                        <div class="card-body">
                            <div class="row  pt-2 bg-secondary text-light ">
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-3"><p class="float-left">Name</p></div>
                                        <div class="col-9"><h6 class=""><?=ucwords($row['name'])?></h6></div>
                                    </div> 
                                </div>
                                <div class="col-sm-6 ">
                                    <div class="row">
                                        <div class="col-3">Role</div>
                                        <div class="col-9"><h6 class=""><?=$row['role']?></h6></div>
                                    </div> 
                                </div>
                            </div>
                            <div class="row  pt-2 bg-dark text-light ">
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-3"><p class="float-left">Phone</p></div>
                                    <div class="col-9"><h6 class=""><?=$row['phone']?></h6></div>
                                </div> 
                            </div>
                            <div class="col-sm-6 ">
                                <div class="row">
                                    <div class="col-3">Email</div>
                                    <div class="col-9"><h6 class=""><?=$row['email']?></h6></div>
                                </div> 
                            </div>
                        </div>
                            
                            
                    </div>
              </div><!--user detail col ends here>
                    
                    
                </div><!--row div-->
            </div><!--  container -->
        </div><!--main content-->
</div><!--container fluid-->


<?php require_once(TEMPLATE_BACK.DS.'footer.php');?>