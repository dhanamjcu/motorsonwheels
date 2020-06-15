<?php
     require_once('../../../resources/templates/config.php');
    

     if(isset($_POST['sortname']) || isset($_POST['sortCarName']) ||isset($_POST['cartype']) ||isset($_POST['status']) ||isset($_POST['sortDate']) ||isset($_POST['currentPage']) || isset($_POST['startDate']) || isset($_POST["endDate"])):
        
          $status        = isset($_POST['status']) ? trim($_POST['status']) : null;
          $currentPage   = isset($_POST['currentPage']) ? trim($_POST['currentPage']) : 1;
          $sortDate      = isset($_POST['sortDate']) ? trim($_POST['sortDate']):null;
          $cartype       = isset($_POST['cartype']) ? trim($_POST['cartype']) : null;
          $sortCarName   = isset($_POST['sortCarName']) ? trim($_POST['sortCarName']) :null;
          $sortname      = isset($_POST['sortname']) ? trim($_POST['sortname']) :null;
          $startDate     = isset($_POST['startDate']) ? trim($_POST['startDate']) :null;
          $endDate       = isset($_POST['endDate']) ? trim($_POST['endDate']) : null;
         
          
          $perPage = 15;
          $offset = ($currentPage-1)*$perPage;
         
          $sql = "SELECT `ads`.`id` AS 'ads_id' ,`ads`.`created_at` AS 'adsDate',`users`.`id` AS 'user_id' ,ads.*,users.* FROM ads INNER JOIN users ON `users`.`id` = `ads`.`user_id`" ;
//echo $sql;
          //this query for total row counts

          $rowsCount = getResult($sql);
          $totalRows = count($rowsCount);

          $conditions = array();

          if(!empty($startDate)){
               empty($endDate) ? $endDate = date('y-m-d') : $endDate;
               
               $startDate = createTimeFormat($startDate); 
               $endDate = createTimeFormat($endDate); 

               if($startDate > $endDate){
                    echo 'Date range not valid';
                    exit;
               }
               echo "<h6 class='text-center bg-secondary p-2'>Showing result <strong>$startDate</strong> to <strong>$endDate</strong></h6>";
               $sql = "SELECT `ads`.`id` AS 'ads_id',`ads`.`created_at` AS 'adsDate',`users`.`id` AS 'user_id' ,ads.*,users.* FROM ads INNER JOIN users ON `users`.`id` = `ads`.`user_id` WHERE `ads`.`created_at` BETWEEN '$startDate'
               AND LAST_DAY('$endDate')";
               $rowsCount = getResult($sql);
               $totalRows = count($rowsCount);

          }

          if(!empty($status)){
               $conditions[] = "CASE WHEN `ads`.`status` = '$status' THEN 1 ELSE `ads`.`status` END";
          }
          if(!empty($sortCarName)){
               $conditions[] = "CASE WHEN `ads`.`carname` = '$sortCarName' THEN 1 ELSE `ads`.`carname` END";
          }
          if(!empty($cartype)){
               $conditions[] = "CASE WHEN `ads`.`cartype` = '$cartype' THEN 1 ELSE `ads`.`cartype` END";
          }
          if(!empty($sortname)){
               $conditions[] = "`users`.`name` $sortname";
          }
          if(!empty($sortDate)){
               $conditions[] = "`ads`.`created_at` $sortDate";
          }
          
         
          if(count($conditions) > 0){   
               
               $sql .= " ORDER BY " . implode(' , ', $conditions )." LIMIT  $offset , $perPage";
                      
          }else{
               $sql .= " ORDER BY (CASE WHEN `ads`.`status` = 'pending' THEN 1 ELSE `ads`.`status` END), ads.created_at DESC LIMIT  $offset , $perPage";
          }   
         
    
          $rows = getResult($sql);
     
          //counter for indexing
          $counter       =    0;
          ?>
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
               <tbody>     
                    <?php foreach($rows as $row):
                         $counter = $counter+1
                         ?>   
          
                         
                         <tr>
                              <td><?= $counter+($currentPage-1)*$perPage?></td>
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
                                  
                    $pagination =  new Pagination(array(
                        'baseUrl'       =>  'ads.php',
                        'totalRows'     =>   $totalRows,
                        'perPage'       =>   $perPage,
                        'currentPage'   =>   $currentPage,
                        
                    ));
                  
                ?>             
            </div>
            
<?php endif; ?>