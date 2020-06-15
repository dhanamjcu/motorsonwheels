<?php require_once('../../resources/templates/config.php');?>
<?php include_once(TEMPLATE_BACK.DS.'header.php');?>  

<?php
    
    $baseUrl = 'ads.php';
    $orderBy = "ORDER BY (CASE WHEN `ads`.`status` = 'pending' THEN 1 ELSE `ads`.`status` END), ads.created_at DESC";
    $perPage = 15;

    $paginationSql = "SELECT COUNT(id) FROM `ads`";
    $paginationResult = getResult($paginationSql);
   
    $totalRows = $paginationResult[0]['COUNT(id)'];

    $sql = "SELECT `ads`.`id` AS 'ads_id' ,`ads`.`created_at` AS 'adsDate',`users`.`id` AS 'user_id' ,ads.*,users.* FROM ads INNER JOIN users ON `users`.`id` = `ads`.`user_id` $orderBy LIMIT $perPage";
//echo $sql;
    $rows = getResult($sql);
    
    $counter = 0;

    $carSql = "SELECT `carname` FROM `cars` GROUP BY `carname` ORDER BY `carname` ASC";
    $carRows = getResult($carSql);
   
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
                            <li class="breadcrumb-item active">Ads</li>
                        </ol>
                    </nav>
            <div class="rounded">
                <form id="tsorterFrm">
                    <table class="table table-sm  table-dark col-md-10 offset-1">
                        <tr>
                            <th></th>
                            <th>Sort By :</th>
                            <th>
                                <select name="sortname" id="" class="form-control-sm tsorter">
                                    <option value="">name</option>
                                    <option value="ASC">A-Z</option>
                                    <option value="DESC">Z-A</option>
                                    
                                </select>
                            </th>
                            <th>
                                <select name="sortCarName" id="" class="form-control-sm tsorter">
                                    <option value="">Car Name</option>
                                    <?php foreach($carRows as $carname): ?>
                                        <option value="<?=$carname['carname']?>"><?=ucwords($carname['carname'])?></option>
                                    <?php endforeach;?>
                                </select>
                            </th>
                            <th>
                                <select name="cartype" id="" class="form-control-sm tsorter">
                                    <option value="">car condition</option>
                                    <option value="new">New</option>
                                    <option value="used">Used</option>
                                    
                                </select>
                            </th>
                            <th>
                                <select name="status" id="" class="form-control-sm tsorter">
                                    <option value="">Status</option>
                                    <option value="approved">Approved</option>
                                    <option value="pending">pending</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </th>
                            <th>
                                <select name="sortDate"  class="form-control-sm tsorter">
                                    <option value="">Uploaded</option>
                                    <option value="DESC">Latest</option>
                                    <option value="ASC">Older</option>
                                    
                                </select>
                            </th>
                           <th>
                                <a href="#" title="select range" class="datePicker">
                                    <i class="fas fa-calendar-alt fa-2x "></i>
                                </a>
                            </th>
                            <th><input type="reset" class="btn btn-sm btn-success" value="Reset"></th>
                        </tr>
                    </table>
                    <input type="hidden" id="startDate" value='' name="startDate">
                    <input type="hidden" id="endDate" value='' name="endDate">
                </form>   
            </div>                
            <div id="SortContent">

                <table class="table table-striped table-sm table-dark table-hover table-responsive{-sm|-md|-lg|-xl} allAds">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Car Type</th>
                            <th scope="col">Car Name 
                                
                            </th>
                            <th scope="col">Email</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Satuts</th>
                            <th scope="col">Uploaded </th>
                            <!-- <th scope="col">Action</th> -->
                            <th scope="col">View</th>
                        </tr>
                    </thead>
                        
                    <tbody id="fetchedResult">
                        <?php foreach($rows as $row):?>
                            
                            <tr>
                                <td><?= $counter = $counter+1?></td>
                                <td><?=ucwords($row['name']);?></td>
                                <td><?=ucwords($row['cartype']);?></td>
                                <td><?=ucwords($row['carname']);?></td>
                                <td><a href="mailto:<?=$row['email']?>" class="text-light"><?=strtolower($row['email']);?></a></td>
                                <td><?=ucwords($row['phone']);?></td>

                        <?php 
                            if(strtolower($row['status']) == 'pending'){
                                $bgColor = 'bg-warning';
                                
                            }elseif(strtolower($row['status']) == 'rejected'){
                                    $bgColor = 'bg-danger';
                                
                            }
                            else{
                                $bgColor = 'bg-success';
                                
                            }
                        ?>
                                <td data-status="<?=$row['ads_id']?>" class="status <?=$bgColor?> text-light" ><?=ucwords($row['status']);?></td>

                                <td><?=dateCreate($row['adsDate']);?></td>
                                
                                <td><a href="#" class="btn btn-primary openSingleView" data-ad-id="<?=$row['ads_id']?>">View</a></td>
                                
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