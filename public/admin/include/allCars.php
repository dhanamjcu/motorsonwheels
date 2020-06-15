 
 <?php 
    require_once('../../resources/templates/config.php');

        $pageQuery = "SELECT COUNT(*) FROM `cars`";
        $result = $db->query($pageQuery);
        $row = $result->fetch_assoc();
        $total = $row['COUNT(*)'];
        $perPage = 10;
        $offSet = '';
        $totalPage = ceil($total/$perPage);
        $pageNo = 0;

    if(isset($_GET['page'])){
        $pageNo =  $_GET['page'];
        if($pageNo == 1){
            $pageNo = 0;
        }else{
            $offSet = ($perPage*$pageNo)-$perPage;
        }
        
        $sql = "SELECT * FROM `cars` LIMIT $offSet , $perPage";
       
    }else{
         $sql = "SELECT * FROM `cars` LIMIT 10";
    }

    $rows = getResult($sql);
     $index = 0;
    
     
    
     
?>
 
 
 
<div class="text-center bg-dark text-warning mb-4 p-1 d-flex justify-content-around">
    <h3 class="mt-1">All Car List</h3>
   <!--  <form class="form-inline">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">Find</button>
    </form> -->
</div>


<table class="table table-striped table-dark table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Model</th>
            <th scope="col">Body Type</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($rows as $row){ 
            
            ?>
            <tr>  
                <td><?php echo $index = $index+1?></td>
                <td>
                <img src="" alt="">
                <?= ucfirst($row['carname'])?></td>
                <td><?= ucfirst($row['carmodel'])?></td>
                <td><?= ucfirst($row['bodytype'])?></td>
                <td class="d-flex justify-content-between">
                    <button type="button" class="btn btn-link btn-danger modelDelBtn" title="delete" data-index="<?= $row['id'];?>"><i class="fas fa-trash-alt text-danger "></i>
                    </button>
                </td>
            <tr>
        <?php } ?>
    </tbody>
</table>

<div class="pagination text-center">
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-end">
            <?php
                if($pageNo == 0 ){  
                    $pageNo = 1; 
                }else{
                    $pageNo = $pageNo-1;
                    echo "<li class='page-item'><a class='page-link ' href='cars.php?page=$pageNo' ><i class='fas fa-angle-left'></i></a></li>";
                    $pageNo = $pageNo+1;
                }

                for($i=1; $i<=$totalPage; $i++):
                    $pageNo == 0 ? $pageNo = 1 :$pageNo;

                   
                    if($pageNo == $i ){
                        echo "<li class='page-item active'><a class='page-link   ' href='cars.php?page=$i'>$i</a></li>";
                    }else{
                        echo "<li class='page-item '><a class='page-link   ' href='cars.php?page=$i'>$i</a></li>";
                    }
                   
                endfor;

                if($totalPage != $pageNo){
                    $pageNo = $pageNo+1;
                    echo "<li class='page-item'><a class='page-link ' href='cars.php?page=$pageNo' ><i class='fas fa-angle-right'></i></a></li>";
                }
            
            ?>
            
          
        </ul>
    </nav>
</div>