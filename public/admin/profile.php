<?php require_once('../../resources/templates/config.php');?>
<?php include_once(TEMPLATE_BACK.DS.'header.php');?>  

<?php
    isAdmin();
    $loginId = $_SESSION['id'];
    $sql = "SELECT * FROM `users` WHERE `id` = '$loginId'";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();
  
   
?>



<div class="containe-fluid">
   
    <?php include_once(TEMPLATE_BACK.DS.'admin_top_nav.php');?>
    <?php include_once(TEMPLATE_BACK.DS.'sidebar.php');?>

    <div class="main-content admin_main_content" id="admin_main_content" >
       
        <div class="conatiner">
            <div class="row">
                <div class="col-md-12">
                     <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-dark">
                            <li class="breadcrumb-item active"><a href="index.php" ><i class="fas fa-home mr-2"></i>Home</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </nav>

                    <!-- profile content -->
                </div><!-- col div-->

                 <div class="col-md-8 order-2 order-sm-1 my-2 my-md-0">
                        <div class="profileUpdateMsg"></div>
                        <div class="card">
                            <div class="card-header card-header-primary">
                            <h4 class="card-title">Edit Profile</h4>
                            
                            </div>
                                <div class="card-body">
                                <form action="" class="profileUpdateForm">
                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label>Email address</label>
                                        <input type="text" class="form-control" value="<?= isset($row['email']) ? $row['email'] : null ?>" name='email'>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label >Phone</label>
                                        <input type="text" class="form-control" value="<?= isset($row['phone']) ? $row['phone'] : null ?>" name='phone'>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        <label >Full Name</label>
                                        <input type="text" class="form-control" value="<?= isset($row['name']) ? $row['name'] : null ?>" name='fullName'>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        <label >Address</label>
                                        <input type="text" class="form-control" value="<?= isset($row['address']) ? $row['address'] : null ?>" name='address'>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                        <label >State</label>
                                        <input type="text" class="form-control" value="<?= isset($row['state']) ? $row['state'] : null ?>" name='state'>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                        <label >City</label>
                                        <input type="text" class="form-control" value="<?= isset($row['city']) ? $row['city'] : null ?>" name='city'>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                        <label >Country</label>
                                        <input type="text" class="form-control" value="<?= isset($row['country']) ? $row['country'] : null ?>" name='country'>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                        <label >Postal Code</label>
                                        <input type="text" class="form-control" value="<?= isset($row['zip']) ? $row['zip'] : null ?>" name='zip'>
                                        </div>
                                    </div>
                                </div>
                                    <input type="hidden" name="profileSubmit">
                                    <input type="hidden" name="id" value="<?=$row['id']?>">
                                    <button type="submit" class="btn btn-primary float-right">Update Profile</button>
                                   
                                </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 order-1 order-sm-2">
                        <div class="profileUpdatePicMsg"></div>
                        <div class="card card-profile">
                            <div class="card-avatar">
                            <a href="javascript:;" class="profileImageChange" title='click to change'>
                                <?php 
                                if($row['pic']){
                                   $img = $row['pic'];
                                    
                                    echo "<img class='img-thumbnail' src='cars/profile/$img' width='100%' img='profilepic'>";
                                }else{
                                    echo "<img class='img-thumbnail' src='cars/profile/profile-placeholder.png' width='100%'>";
                                }
                                ?>
                                
                            </a>
                            </div>
                            <div class="card-body">
                                <form action="include/profileUpdate.php" enctype="multipart/form-data" class="profileUpdatePicForm" method="POST">
                                <!-- <h6 class="card-category text-gray">CEO / Co-Founder</h6>
                                <h4 class="card-title">Alec Thompson</h4>
                                <p class="card-description">
                                    Don't be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...
                                </p> -->
                                    <input type="hidden" name="profilePicSubmit">
                                    <input type="file" name="profileImg" class="form-control d-none">
                                    <button type="submit" name="profilePicSubmit" class="btn btn-primary btn-block">Update Picture</button>
                                    
                                </form>

                            </div>
                        </div>
                    </div>

            </div><!-- row div-->
        </div>    <!--container div-->

</div> 



<?php require_once(TEMPLATE_BACK.DS.'footer.php');?>