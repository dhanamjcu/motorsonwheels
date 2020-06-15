<?php 
    $webpage = 'vehicle';
    require_once('../resources/templates/config.php');?>
<?php include_once(TEMPLATE_FRONT.DS.'header.php');?>  

<!-- navbar -->
<?php include_once(TEMPLATE_FRONT.DS.'nav.php');?>  

<?php
    if(isset($_GET['adid'])){
        $adid = $_GET['adid'];
        $adid = test_input($adid);

        $sql = "SELECT * FROM `ads` WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param('i',$adid);
        $stmt->execute();
        $result =  $stmt->get_result();
        $stmt->close();
        $row =  $result->fetch_assoc(); 
        $imgs = fetchImgs($row['id']);
      
        
    }else{
        header('location:index.php');
    }

?>

<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="index.php" ><i class="fas fa-home mr-2"></i>Home</a></li>
            <li class="breadcrumb-item active">Car</li>
            <li class="breadcrumb-item active"><?php echo ucfirst($row['carname'])." ".ucfirst($row['carmodel']);?></li>
        </ol>
    </nav>

    <div class="row my-4">
        <div class="col-lg-8 col-md-6">
        <!-- carousel div -->
                <div class="wishlist_heart">
                        <a href="#" data-ad-value="<?php echo $row['id']?>" class="addWishlist" title="wishlist">

                            <?php
                                if(isset($_SESSION['id'])){
                                    $loggedId = $_SESSION['id'];
                                    $wishQuery =  "SELECT `ads_id` FROM `wishlist` WHERE `ads_id` = $adid  AND `user_id`= $loggedId";

                                    $wishlist = getResult($wishQuery);
                                    if(count($wishlist)>0){ 
                                            $wishlist[0]['ads_id'];
                                            ?>
                                        <i class="fas fa-heart fa-2x"></i>
                                    <?php }else{?>
                                            <i class="fas fa-heart fa-2x text-white"></i>
                                    <?php }
                                
                                }else{?>
                                    <i class="fas fa-heart fa-2x text-white"></i>      
                             <?php }?> 
                    
                            
                           <!--  -->
                            
                        </a>  
                    </div> 
            <div id="slider<?php echo $row['id']?>" class="carousel slide" data-ride="carousel">
                    
                    <div class="carousel-inner">  
                        <div class="carousel-item active">
                                <img src="uploads/<?=$imgs[0]['imgname'];?>" class="d-block w-100 rounded" alt="...">
                        </div>
                        
                            <?php  
                            
                            for($i=1; $i < count($imgs); $i++): ?>
                                <div class="carousel-item">
                                        <img src="uploads/<?=$imgs[$i]['imgname'] ;?>" class="d-block w-100 rounded" alt="...">
                                </div>
                                
                        
                            <?php endfor; ?>
                        </div>
                        <a class="carousel-control-prev" href="#slider<?php echo $row['id']?>" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#slider<?php echo $row['id']?>" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
    
            </div>
             <!-- carousel div ends-->
        </div>
        <div class="col-lg-4 col-md-6">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="home" aria-selected="true">Overview</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#Description" role="tab" aria-controls="profile" aria-selected="false">Description</a>
                </li>
                
            </ul>
                <div class="tab-content" id="myTabContent">
                
                <!-- overview tab content -->
                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                     <table class="table table-striped table-dark my-4">
                        <tr>
                            <td class="text-muted"><h5>Model  </h5></td>
                            <td><h5><strong><?php echo ucfirst($row['carname'])." ".ucfirst($row['carmodel']);?></strong></h5></td>
                        </tr>
                        <tr>
                            <td class="text-muted"><h5>Price  </h5></td>
                            <td><h5><strong><?php echo "$ ".number_format($row['price'])?></strong></h5></td>
                        </tr>
                        <tr>
                            <td class="text-muted"><h5>Body  </h5></td>
                            <td><h5><strong><?php echo $row['bodytype']?></strong></h5></td>
                        </tr>
                        <tr>
                            <td class="text-muted"><h5>Status  </h5></td>
                            <td><h5><strong><?php echo ucfirst($row['cartype'])?></strong></h5></td>
                        </tr>
                        <tr>
                            <td class="text-muted"><h5>Model Yr.  </h5></td>
                            <td><h5><strong><?php echo ucfirst($row['year'])?></strong></h5></td>
                        </tr>
                        <tr>
                            <td class="text-muted"><h5>Engine  </h5></td>
                            <td><h5><strong><?php echo ucfirst($row['engineDes'])?></strong></h5></td>
                        </tr>
                    </table>

                
                </div>
                <!-- overview tab content ends -->

                 <!-- description tab content -->
                <div class="tab-pane fade" id="Description" role="tabpanel" aria-labelledby="profile-tab">
                    <table class="table table-striped table-dark my-4">
                        <tr>
                            <td class="text-muted"><h5>Odometer  </h5></td>
                            <td><h5><strong><?php echo number_format($row['odometer']);?> Km</strong></h5></td>
                        </tr>
                        <tr>
                            <td class="text-muted"><h5>Transmision  </h5></td>
                            <td><h5><strong><?php echo ucfirst($row['transmission']);?></strong></h5></td>
                        </tr>
                        <tr>
                            <td class="text-muted"><h5>Economy  </h5></td>
                            <td><h5><strong><?php echo ucfirst($row['fuelEconomy']);?> Km/Ltr.</strong></h5></td>
                        </tr>
                        <tr>
                            <td class="text-muted"><h5>Cylinder</h5></td>
                            <td><h5><strong><?php echo ucfirst($row['cylinder'])?></strong></h5></td>
                        </tr>
                        <tr>
                            <td class="text-muted"><h5>Color</h5></td>
                            <td><h5><strong><?php echo ucfirst($row['colour'])?></strong></h5></td>
                        </tr>
                        <tr>
                            <td class="text-muted"><h5>Doors  </h5></td>
                            <td><h5><strong><?php echo ucfirst($row['doors'])?></strong></h5></td>
                        </tr>
                        <tr>
                            <td class="text-muted"><h5>Seats</h5></td>
                            <td><h5><strong><?php echo ucfirst($row['seats'])?></strong></h5></td>
                        </tr>
                    </table>
                </div>
                <!-- description tab content ends -->

                 <div class="row">
                    <div class="col">
                        <button class="btn btn-warning sellerEnq" data-ad-value="<?php echo $row['user_id']?>">Enquiry</button>   
                    </div>
                </div>               
           </div>
        </div>

    </div><!--row-->
</div>   <!--container close  -->
 

<!-- footer -->
<?php require_once(TEMPLATE_FRONT.DS.'footer.php');?>