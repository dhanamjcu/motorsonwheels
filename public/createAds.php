 <?php require_once('../resources/templates/config.php');?>
 <?php include_once(TEMPLATE_FRONT.DS.'header.php');?>  

<!-- navbar -->
<?php include_once(TEMPLATE_FRONT.DS.'nav.php');?>  

<?php 
    isLogIn();

        if(isset($_GET['status'])){

            $status = $_GET['status'];
            $status = url_decode($status);
        }
        
    
?>




<div class="container-fluid adContainer">
<div class="container mb-5">
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="index.php" ><i class="fas fa-home mr-2"></i>Home</a></li>
            <li class="breadcrumb-item active">Create Ads</li>
        </ol>
    </nav>

       <?php if(isset($status['success'])):?>

            <div class="alert alert-success">
                <?php echo $status['success']?>
            </div> 

        <?php endif; 
        
        //sql

        $sql = "SELECT `carname` FROM  `cars` GROUP BY `carname` ORDER BY `carname`";
        $rows = fetchResult($sql);
      //print_r($rows);
        
        
        
        ?>
   
     <form method="Post" action="include/createAdsProcess.php" enctype="multipart/form-data" class="filter-form" > 

         

        <div class="form-row py-5">


            <div class="form-group col-md-3">
                <label for="cartype">Type</label>
                <select  class="form-control" required name="vType">
                   
                    <option value='used'>Used</option>
                    <option value='new'>New</option>
                </select>
            </div>

            <div class="form-group col-md-3">
                <label for="vehiclename">Vehicle Name</label>
                <select  class="form-control carname" required name="vName">
                     <option value="">Choose Brand</option>
                    <?php
                        foreach($rows as $row){
                               echo "<option value='$row[0]'>".ucfirst($row[0])."</option>";
                          }
                       ?>   
                </select>
            </div>
<!-- modeldiv -->
            <div class="form-group col-md-3">
                <label for="vehiclemodel">Model</label>
                <select  class="form-control carmodel" required name="vModel">
                    <option value="" selected>Choose Model</option>
                     
                </select>
            </div>

<!-- model date -->
            
            <div class="form-group col-md-3">
                <label for="cartype">Model Year</label>
                <select  class="form-control" name="modelYr">
                <?php 
                    $curYear = date('Y');
                        for( $year=date('Y'); $year>=1980;  $year--){
                            echo "<option value='$year'>$year</option>";
                        }
                ?>
                </select>
            </div>

            <!-- bodytype div -->

            <div class="form-group col-md-3">
                <label for="vehicletype">Vehicle Body Type</label>
                <select  class="form-control bodyType" name="vBodyType" required>
                    <option value="" selected>Choose Body Type</option>
                    <?php showOptions($bodyType);?>
                </select>
            </div>

            <!-- tramission div -->
            <div class="form-group col-md-3">
                <label for="transmission">Transmission</label>
                <select  class="form-control" name="transmission" required>
                    <option value="" selected>Choose...</option>
                    <option value='automatic'>Automatic</option>
                    <option value='Manual'>Manual</option>
                </select>
            </div>

            <!-- odometer -->
       
            <div class="form-group col-md-3">
                <label for="ottometer">OdoMeter</label>
                <input type="number" class="form-control" id="" placeholder="ran kilometer/miles" name="odoMeter">
            </div>
<!-- cylinder -->
            <div class="form-group col-md-3">
                <label for="cylinder">Cylinder</label>
                <input type="number" name="cylinder" class="form-control" id="" placeholder="" min=1 required>
            </div>

<!-- no of seates -->
            <div class="form-group col-md-3">
                <label for="">No. of seats</label>
                <input type="number" name="vSeats" class="form-control" id="" placeholder="3 seats" required min=1>
            </div>

 <!-- no of seates -->
            <div class="form-group col-md-3">
                </i><label for="">No. of Doors </label>
                <input type="number" name="Doors" class="form-control" id="" placeholder="2 doors" required min=2>
            </div>
            <!-- cylinder -->

            <div class="form-group col-md-3">
                <label for="economy">Economy</label>
                <input type="number" name="economy" class="form-control" id="" placeholder="eg.10km/Ltr." min=1 required>
            </div>
<!-- price -->
             <div class="form-group col-md-3">
                <label for="">Car Price</label>
                <input type="number" name="vPrice" class="form-control" id="" placeholder="enter price" required min=100>
                <!-- <small class="text-danger">*Min price start from 100 AUD.</small> -->
            </div>           
 <!--color  -->

            <div class="form-group col-md-3">
                <label for="cartype">Color</label>
                <select  class="form-control " name="vColor" required>
                    <option value="" selected>Choose...</option>
                    <?php
                        showOptions($colorList) . "<i>wer</i>";
                    ?>
                    
                </select>
            </div>

            <!--engine description  -->

             <div class="form-group col-md-3">
                <label for="engineDesc">Engine Description</label>
                <input type="text" class="form-control" name="vEngDesc" required>
               
            </div>

            
            
             <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Upload</span>
                </div>
               
                <div class="custom-file">
                    
                    <input type="file" class="custom-file-input" name="image[]"  multiple max=5 required >
                    <label class="custom-file-label" for="inputGroupFile01">images..</label>
                </div>
             </div>
             <small class="text-danger">** 1 image size should be under 1 MB and all file total size must be under 8MB</small>


        </div>
     
        <button type="submit" class="btn btn-primary btn-lg mb-5" name="submit">Post Ad</button>
    </form>  

      
    
</div>
</div>

<!-- footer -->


<?php require_once(TEMPLATE_FRONT.DS.'footer.php');?>
