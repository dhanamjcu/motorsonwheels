<?php
    $btSql = "SELECT * FROM `bodytype`";
    $btResult = $db->query($btSql);
    $btRows = $btResult->fetch_all(MYSQLI_ASSOC);
    $index = 0;
?>


<div class="text-center bg-dark text-warning mb-3 p-1">
        <h3 class="mt-1">Body Type</h3>
</div>
<div class="bodyTypeStatus">
 </div>
<form action="include/carAction.php" method="POST" enctype="multipart/form-data" id="uploadBodyType" class="text-center">
    <div class="form-row">

        <div class="form-group col-md-6">
        
          <!--   <img src="cars/logos/logoplaceholder.png" alt="logo" class='thumpDisplay' > -->
            <input type="file" name="bodyTypeImg" id="bodyTypeImg"  class=" imgFile form-control" >
        </div>       


        <div class="form-group col-md-6">
            <input type="text" placeholder="bodytype" name="bodytypename" class="form-control">
        </div>

            
            
    </div>  
    <div class="text-center mt-2"> 
        <div class="btn-group" role="group" aria-label="Basic example">
            <input type="submit" class="btn btn-primary" value="Upload">
            <input type="reset" class="btn btn-info" value="Cancel">  
        </div> 
    </div>    
    
</form>


<table class="table table-striped table-dark table-hover mt-5">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Bodytype</th>
            <th scope="col">Type Name</th>
            <th scope="col">Action</th>
            
        </tr>
    </thead>
    <tbody>
        <?php foreach($btRows as $row){ 
            
            ?>
            <tr>  
                <td><?php echo $index = $index+1?></td>
                <td>
                <img src="cars/logos/<?php echo $row['bodyimg']?>" alt="" class="showLogo">
                </td>
                <td><?= ucfirst($row['bodytype'])?></td>
                
                <td class="d-flex justify-content-between">
                    <a href="#" title="delete" class="bodytypeDelBtn" data-bodytype-index="<?= $row['id']?>"> <i class="fas fa-trash-alt text-danger"></i></a>
                </td> 
            <tr>
        <?php } ?>
    </tbody>
</table>