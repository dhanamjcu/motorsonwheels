 <?php require_once('../resources/templates/config.php');?>
 <?php include_once(TEMPLATE_FRONT.DS.'header.php');?>  

 <!-- navbar -->
<?php include_once(TEMPLATE_FRONT.DS.'nav.php');?>  


<?php
  /*       
    if(isset($_GET['q'])){
           
           
            //print_r($rows);
    }else{
        $message = "No Result found";
        die;
    }
     */
        
    

?>

<div class="container mb-2">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="index.php" ><i class="fas fa-home mr-2"></i>Home</a></li>
            <li class="breadcrumb-item active">Search Results</li>
        </ol>
    </nav>

    

 
     <?php 
            if(isset($_GET['q'])):
                 $rows = url_decode($_GET['q']);

            foreach($rows as $row):
                $adId =$row['id'];
                $query = "SELECT `imgname` FROM `adimg` WHERE `ads_id` = $adId";
                $images = getResult($query);

    
        ?>
        <div class="ads p-3 mt-4">
        <div class="row">
            <div class="col-md-6"> 

            
                <div id="sliderm<?=$row['id']?>" class="carousel slide" data-ride="carousel">
                      <div class="carousel-inner">  
                        <div class="carousel-item active">
                                <img src="uploads/<?=$images[0]['imgname']?>" class="d-block w-100 rounded" alt="...">
                        </div>
                        
                            <?php  for($i=1; $i < count($images); $i++){ ?>
                       
                       
                            <div class="carousel-item">
                                    <img src="uploads/<?=$images[$i]['imgname'] ;?>" class="d-block w-100 rounded" alt="...">
                            </div>
                                
                       
                            <?php }  ?>
                         </div>
                          <a class="carousel-control-prev" href="#sliderm<?=$row['id']?>" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#sliderm<?=$row['id']?>" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>

                         
                        
                        
                           
                        
                       
                </div>



            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="float-left">2019 <?php echo $row['carname']." "; echo $row['carmodel']?>  Auto</h4>
                        
                    </div>
                    <div class="col-md-4">
                         <h4 class="float-right">Price: <?="$ ".number_format($row['price'])?></h4>
                    </div>
                </div>
                
               
                <table class="table table-striped table-dark">
                    <tr>
                        <td>Condition</td>
                        <th><?=$row['cartype']?></th> 
                    </tr>
                    <tr>
                        <td>Odometer</td>
                        <th><?=number_format($row['odometer'])?> Km</th> 
                    </tr>
                    <tr>
                        <td>Transmission</td>
                        <th><?=$row['transmission']?></th> 
                    </tr>
                    <tr>
                        <td>Body Type</td>
                        <th><?=$row['bodytype']?></th> 
                    </tr>
                    <tr>
                        <td>Engine</td>
                        <th><?=$row['cylinder']?>Cyl 2.0L Turbo Diesel</th> 
                    </tr>
                    <tr>
                        <td>Economy</td>
                        <th><?=$row['fuelEconomy']?> Km/Ltr.</th> 
                    </tr>

                </table>
                                   
                

                
                
            </div>
        </div><!---row-->
    </div>
       
                        <?php   endforeach; 
                    
                        else:
                            echo '<div class="alert alert-info"><h5>No car found. Find Again </h5></div>';
                                    include('include/indexForm.php');
                                endif;
                            
                        ?>
    
        
</div>    



<!-- model -->



<div class="modal fade viewDetailsModal" tabindex="-1" id="viewDetailsModal">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="showViewContent">
        <p>Modal body text goes here.</p>
      </div>
    </div>
  </div>
</div>


<!-- delete modal -->

<div class="modal deleteModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <input type="button" class="btn btn-danger" data-delete-value value="Delete">
      </div>
    </div>
  </div>
</div>


<!-- //enquiry model -->

<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#enquiryModal" data-whatever="@mdo">Open modal for @mdo</button> -->


<div class="modal fade" id="enquiryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Contact Us</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
        <input type="hidden" value=""  class="advalue" name="adId">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Your Name:</label>
            <input type="text" class="form-control" id="recipient-name" name="name">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Your Email:</label>
            <input type="email" class="form-control" id="recipient-name" name="email">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Your Phone:</label>
            <input type="text" class="form-control" id="recipient-name" name="contact">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text" name="message"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

        <button type="submit" class="btn btn-primary" name="enqSubmit">Send message</button>
      </div>
      </form>
    </div>
  </div>
</div>







    <!-- footer -->
     <?php require_once(TEMPLATE_FRONT.DS.'footer.php');?>