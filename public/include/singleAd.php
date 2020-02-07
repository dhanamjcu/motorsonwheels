<?php

 if(isset($_POST['adId'])){
    require_once('../../resources/templates/config.php');
    $adId = $_POST['adId'];

       
    $sql = "SELECT * FROM `ads` JOIN adimg ON `ads`.id = `adimg`.`ads_id` WHERE `ads`.`id` = $adId " ;
        $rows = getResult($sql);
       
       echo "<pre>";
      // var_dump($rows);
        echo "</pre>";

       

?>







        <div class="ads p-3 mt-4">
        <div class="row">
            <div class="col-md-6"> 



                 <div id="slider<?=$row['id']?>" class="carousel slide" data-ride="carousel">
                      <div class="carousel-inner">  
                        <div class="carousel-item active">
                                <img src="uploads/<?=$rows[0]['imgname']?>" class="d-block w-100 rounded" alt="...">
                        </div>
                        
                            <?php  for($i=1; $i < count($rows); $i++){ ?>
                       
                       
                            <div class="carousel-item">
                                    <img src="uploads/<?=$rows[$i]['imgname'] ;?>" class="d-block w-100 rounded" alt="...">
                            </div>
                                
                       
                            <?php }  ?>
                         </div>
                          <a class="carousel-control-prev" href="#slider<?=$row['id']?>" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#slider<?=$row['id']?>" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>

                         
                        
                        
                           
                        
                       
                </div>











            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="float-left">2019 <?php echo $rows[0]['carname']." "; echo $rows[0]['carmodel']?>  Auto</h4>
                        
                    </div>
                    <div class="col-md-4">
                         <h4 class="float-right">Price: <?="$ ".number_format($rows[0]['price'])?></h4>
                    </div>
                </div>
                
               
                <table class="table table-striped table-dark">
                    <tr>
                        <td>Condition</td>
                        <th><?=$rows[0]['cartype']?></th> 
                    </tr>
                    <tr>
                        <td>Odometer</td>
                        <th><?=number_format($rows[0]['odometer'])?> Km</th> 
                    </tr>
                    <tr>
                        <td>Transmission</td>
                        <th><?=$rows[0]['transmission']?></th> 
                    </tr>
                    <tr>
                        <td>Body Type</td>
                        <th><?=$rows[0]['bodytype']?></th> 
                    </tr>
                    <tr>
                        <td>Engine</td>
                        <th><?=$rows[0]['cylinder']?>Cyl 2.0L Turbo Diesel</th> 
                    </tr>
                    <tr>
                        <td>Economy</td>
                        <th><?=$rows[0]['fuelEconomy']?> Km/Ltr.</th> 
                    </tr>

                </table>
                <button class="btn">Edit</button>
               
                <button class="btn">Delete</button>
            </div>
        </div><!---row-->
    </div>
       

    
        
</div>    








   



 <?php }?>

  