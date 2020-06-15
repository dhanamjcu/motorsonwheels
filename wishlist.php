<?php 
    $webpage = 'wishlist';
    require_once('../resources/templates/config.php');?>
<?php include_once(TEMPLATE_FRONT.DS.'header.php');?>  

<!-- navbar -->
<?php include_once(TEMPLATE_FRONT.DS.'nav.php');?>  

<?php
    isLogIn();  
  

    $sql = "SELECT * FROM `ads` INNER JOIN `wishlist` ON `ads`.`id`=`wishlist`.`ads_id` WHERE `wishlist`.`user_id`= ? ORDER BY `ads`.`id`";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('i',$_SESSION['id']);
    $stmt->execute();
    $result =  $stmt->get_result();
    $stmt->close();
    $rows =  $result->fetch_all(MYSQLI_ASSOC);
     //print_r($rows);
?>


<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="index.php" ><i class="fas fa-home mr-2"></i>Home</a></li>
            <li class="breadcrumb-item active">Wishlists</li>
        </ol>
    </nav>

    <div class="row my-4">
            <?php 
                for($i=0; $i < count($rows); $i++):
                    $imgs = fetchImgs($rows[$i]['ads_id']);
                   
            
            ?>
                        
        <div class="col-6 col-md-3">
            <div class="card card-wishlist my-2">
                <img class="card-img-top" src="uploads/<?=$imgs[0]['imgname'] ;?>" class="d-block w-100 rounded" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><strong><?php echo ucfirst($rows[$i]['carname'])." ".ucfirst($rows[$i]['carmodel']);?></strong></h5>
                    <h5 class="card-title "><strong><?php echo "$ ".number_format($rows[$i]['price'])?></strong></h5>
                        
                </div>
                <div class="card-wishlist__footer">
                    <a href="vehicle.php?adid=<?php echo $rows[$i]['ads_id'];?>" class="btn btn-primary ">View</a>
                    <a href="#" class="btn btn-danger wishlist__remove" data-ad-value="<?php echo $rows[$i]['id']?>">Remove</a> 
                    
                </div>
            </div>
        </div>
        <?php endfor;?>
    </div>   
</div><!---container row row-->



<!-- footer -->
    <?php require_once(TEMPLATE_FRONT.DS.'footer.php');?>