<?php 
     require_once('../../resources/templates/config.php');

     $sql = "SELECT `brandname` FROM `carbrands` ORDER BY `brandname`";

     $carRows = getResult($sql);
     
     $bodyTypeSql = "SELECT `bodytype` FROM `bodytype`";
     $bodyRows = getResult($bodyTypeSql);
     
?>

<div class="text-center bg-dark text-warning mb-4 p-1">
    <h3 class="mt-1">Add Car Model</h3>
</div>

<div class="bodyModelStatus">
</div>  
                       
<form action="include/carAction.php" method="POST" enctype="multipart/form-data" id="addCarModel">
<div class="form-row">
    <div class="form-group col-md-5">
        <label for="carname">Car Name</label>
        <select name="carname" id="" class="form-control">
            <option value="">choose..</option>
            <?php
                foreach($carRows as $row){
                    echo "<option value=".$row['brandname'].">".ucfirst($row['brandname'])."</option>";
                }
            ?>
        </select>
    </div>

    <div class="form-group col-md-4">
        <label for="carmodel">Car Model</label>
        <input type="text" placeholder="modelname" name="carmodel" class="form-control">
    </div>

    <div class="form-group col-md-3">
        <label for="bodytype">Body Type</label>
        <select id="inputState" class="form-control" name="bodytype">
            <option value="" selected>Choose..</option>
        
            <?php
                foreach($bodyRows as $row){
                    echo "<option value=".$row['bodytype'].">".ucfirst($row['bodytype'])."</option>";
                }
            ?> 

        </select>
    </div>

</div>

<div class="text-center mt-2"> 
    <div class="btn-group" role="group" aria-label="Basic example">
        <input type="submit" value="save" class="btn  btn-primary" name="carModelSubmit">
        <input type="reset" class="btn btn-info" value="Cancel">  
    </div> 
</div> 
    
</form>
                   
               