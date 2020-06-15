<?php require_once('../../resources/templates/config.php');?>

<?php 
   
    if(isset($_POST['singleView'])){
        $sql = "SELECT `ads`.`id` AS 'ads_id' , `users`.`id` AS 'user_id' ,ads.*,users.* FROM ads INNER JOIN users ON `users`.`id` = `ads`.`user_id` WHERE `ads`.`id` = ?";

        $stmt = $db->prepare($sql);
        $stmt->bind_param('i', $_POST['id']);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $stmt->close();
       /*  echo "<pre>";
            print_r($row);
        echo "</pre>"; */
 

        $sql = "SELECT `imgname` FROM `adimg` WHERE `ads_id` = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param('i', $_POST['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $imgRows = $result->fetch_all();
          
    }
?>

<section>
    <div class="row">
        <div class="col-md-12 mb-2" >
            <div class="d-flex justify-content-between">
                <h2><?= ucwords($row['carname'])?> <?=ucwords($row['carmodel'])?> <?= $row['year']?></h2>
                <h2 class="float-right">Price : <?="&#36; ".number_format($row['price'])?></h2>
            </div>
        </div>
        <div class="col-md-12 col-sm-12">
        <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" data-interval="10000">
                 <img src="../uploads/<?= $imgRows[0][0]?>" class="d-block w-100 rounded-lg" alt="">
                </div>
                <div class="carousel-item" data-interval="10000">
                    <?php 
                        if(count($imgRows) > 1): 
                            for($j =1; $j < count($imgRows); $j++):?>        
                            <img src="../uploads/<?= $imgRows[$j][0]?>" class="d-block w-100 rounded-lg" alt=""> 
                        
                    
                    <?php endfor; endif;?>
                </div> 
            </div>
            <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        
        
        </div>
        <div class="col-md-12 col-sm-12">
           
            <table class="table table-dark table-striped table-hover  table-responsive-sm rounded-lg">
               <tbody>
                    <tr>
                        <td class="text-muted">Condition</td>
                        <th><?=ucwords($row['cartype'])?></th>
                        <td class="text-muted">Status</td>
                        <th><?=ucwords($row['status'])?></th>
                    </tr>

                    <tr>
                        <td class="text-muted">Body Type</td>
                        <th><?=ucwords($row['bodytype'])?></th>
                        <td class="text-muted">Car Model</td>
                        <th><?=ucwords($row['carmodel'])?></th>
                    </tr>  
                    
                    <tr>
                        <td class="text-muted">Odometer</td>
                        <th><?=number_format($row['odometer'])?> Km</th> 
                        <td class="text-muted">Transmission</td>
                        <th><?=ucwords($row['transmission'])?></th>
                    </tr>
                    
                    <tr>
                        <td class="text-muted">Cylinder</td>
                        <th><?=$row['cylinder']?></th>
                        <td class="text-muted">Fuel Economy</td>
                        <th><?=$row['fuelEconomy']?></th>
                    </tr>
                    
                    <tr>
                        <td class="text-muted">Color</td>
                       <th><?=ucwords($row['colour'])?></th>
                         <td class="text-muted">Seats</td>
                       <th><?=$row['seats']?></th>
                    </tr>
                    
                    <tr>
                        <td class="text-muted">Doors</td>
                        <th><?=$row['doors']?></th>
                        <td class="text-muted">Engine</td>
                        <th><?=ucwords($row['engineDes'])?></th>
                    </tr>
                   <tr class="text-center text-info">
                        <th colspan="4">Users Details</th>
                   </tr>
                    <tr>
                        <td class="text-muted">Uploaded By</td>
                        <th><?=ucwords($row['name'])?></th>
                        <td class="text-muted">Email</td>
                        <th><a class="text-light" href="mailto:<?=$row['email']?>"><?=$row['email']?></a></th>
                    </tr>
                    
                        
                    <tr>
                        <td class="text-muted">Phone</td>
                        <th><?=$row['phone']?></th>
                        <td class="text-muted">Uploaded On</td>
                        <th><?=dateCreate($row['created_at'])?></th>
                    </tr>
                    <tr>
                        <td class="text-muted">Payment</td>
                        <th>Pending</th>
                        <td class="text-muted">Last Update</td>
                        <th>Used</th>
                    </tr>
                    
                   
                </tbody>
            </table>
        </div>
    </div>
</section>








