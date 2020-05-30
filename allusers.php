<?php require_once('../../resources/templates/config.php');?>
<?php include_once(TEMPLATE_BACK.DS.'header.php');?>  

<?php
    
    $baseUrl = 'allusers.php';
   // $orderBy = "ORDER BY (CASE WHEN `ads`.`status` = 'pending' THEN 1 ELSE `ads`.`status` END)";
    $perPage = 4;



    $paginationSql = "SELECT COUNT(id) FROM `users`";
    $paginationResult = getResult($paginationSql);
   
    $totalRows = $paginationResult[0]['COUNT(id)'];

    $sql = "SELECT * FROM `users`";
    
    $rows = getResult($sql);
    
    $counter = 0;

    $carSql = "SELECT `carname` FROM `cars` GROUP BY `carname` ORDER BY `carname` ASC";
    $carRows = getResult($carSql);

    /* echo "<pre>";
    print_r($rows);
    echo "</pre>";
 */
   
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
                            <li class="breadcrumb-item active">Users</li>
                            <li class="breadcrumb-item active">All Users</li>
                        </ol>
                    </nav>
                 
            <div id="SortContent">

                <table class="table table-striped table-sm table-dark table-hover table-responsive{-sm|-md|-lg|-xl} allAds">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Pic</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Satuts</th>
                            
                            <!-- <th scope="col">Action</th> -->
                            <th scope="col">View</th>
                        </tr>
                    </thead>
                        
                    <tbody id="fetchedResult">
                        <?php foreach($rows as $row):?>
                            
                            <tr>
                                <td><?= $counter = $counter+1?></td>
                                <td>
                        <?php 
                            if(!empty($row['pic'])){
                                $pic =$row['pic'];
                                echo "<img src='cars/profile/$pic' width='100px' class='rounded'>";
                        }else{
                                echo "<img src='cars/profile/profile-placeholder.png' width='100px' class='rounded'>";
                        }
                        ?>        
                               
                                
                                </td>
                                <td><?=ucwords($row['name']);?></td>
                                <td><a href="mailto:<?=$row['email']?>" class="text-light"><?=strtolower($row['email']);?></a></td>
                                <td><?=ucwords($row['phone']);?></td>

                        <?php 
                            if(strtolower($row['role']) == 'admin'){
                                $bgColor = 'bg-warning';
                                
                            }
                            else{
                                $bgColor = 'bg-success';
                                
                            }
                        ?>
                                <td data-status="<?=$row['ads_id']?>" class="status <?=$bgColor?> text-light" ><?=ucwords($row['role']);?></td>
                                <td><?=dateCreate($row['created_at'])?></td>
                                
                                <td><a href="user.php?userid=<?=$row['id']?>" class="btn btn-primary ">View</a></td>
                                
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                    </table>
             
                        <div class="adminPage">
                            <?php
                            
                                isset($currentPage) ? $currentPage : $currentPage = 1;
                            
                                $pagination =  new Pagination(array(
                                    'baseUrl'       =>  $baseUrl,
                                    'totalRows'     =>  $totalRows,
                                    'perPage'       =>  $perPage,
                                    'currentPage'   =>  $currentPage,
                                    
                                ));
                               
                            ?>             
                        </div>
            
                  
                    </div><!--sort content-->
                </div><!-- col div-->
            </div><!-- row div-->
        </div>    <!--container div-->

</div>   
<!-- Modal -->
<div class="modal fade" id="dateRangeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">Select Date Range</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control dateinput" placeholder="start date" name="startDate">
                    </div>
                </div>
                
               
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control dateinput" placeholder="end date" name="endDate">
                    </div>
                </div>
            </div>   
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
        
    </div>
  </div>
</div>


<!-- Extra large modal -->
<div class="modal fade " id="Admin_loadSingleView" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
        
      </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-warning statusChange" data-action="Pending" data-id=null>Pending</button>  
            <button type="button" class="btn btn-success statusChange" data-action="approved" data-id=null>Approve</button>                       
            <button type="button" class="btn btn-danger statusChange" data-action="rejected" data-id="">Reject</button>                        
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
  </div>
</div>

<!-- small modal for date range -->





<?php require_once(TEMPLATE_BACK.DS.'footer.php');?>