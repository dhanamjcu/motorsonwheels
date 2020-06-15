<?php
$webpage = 'filterVehicle';
require_once('../resources/templates/config.php');
   $submitted = false;

   if(isset($_REQUEST['carType']) || isset($_REQUEST['carName']) || isset($_REQUEST['carModel']) || isset($_REQUEST['cBodyType']) || isset($_REQUEST['filterSubmit']) || isset($_REQUEST['minPrice']) || isset($_REQUEST['maxPrice']) || isset($_REQUEST['keyword']) || isset($_REQUEST['page'])) {
   
      isset($_REQUEST['page']) ? $currentPage = $_REQUEST['page'] : $currentPage = 1;
      $perpage = 10;
      $offSet = ($perpage * $currentPage)-$perpage;

      $LIMIT = " LIMIT  $offSet , $perpage";
            
   
  
   if(isset($_REQUEST['carType'])){
      $cartype = $db->escape_string($_REQUEST['carType']);
      $cartype == 'all' ? $cartype = '': $cartype;
   }
   if(isset($_REQUEST['currentPage'])){
      $currentPage = $db->escape_string($_REQUEST['currentPage']);
   }else{
      $currentPage = 1;
   }
   if(isset($_REQUEST['carName'])){
   $carname = $db->escape_string($_REQUEST['carName']);
   }
   if(isset($_REQUEST['carModel'])){
   $carmodel = $db->escape_string($_REQUEST['carModel']);
   }
   if(isset($_REQUEST['cBodyType'])){
   $cBodyType = $db->escape_string($_REQUEST['cBodyType']);
   }
   if(isset($_REQUEST['minPrice'])){
   (int)$minPrice = $db->escape_string($_REQUEST['minPrice']);
   }
   if(isset($_REQUEST['maxPrice'])){
   (int)$maxPrice = $db->escape_string($_REQUEST['maxPrice']);
   }

   if(isset($_REQUEST['keyword']) && !empty($_REQUEST['keyword']) && isset($_REQUEST['filterSubmit'])){
      $keyword = $_REQUEST['keyword'];
      $sql = "SELECT * FROM `ads` WHERE MATCH(cartype,carname,carmodel,transmission,price,year,fuelEconomy,colour,seats,doors) AGAINST ('$keyword')";
      $submitted = true;
   }

   elseif(isset($_REQUEST['filterSubmit'])){

      $sql = "SELECT * FROM `ads`";
      $submitted = true;
            
   }else{
      $sql = "SELECT COUNT(id) FROM `ads`";   
   }
  
   
   $conditions = array();

   if(!empty($cartype)){
      $conditions[] = "cartype='$cartype'";
   }
   if(!empty($carname)) {
      $conditions[] = "carname='$carname'";
   }
   if(!empty($carmodel)) {
      $conditions[] = "carmodel='$carmodel'";
   }
   if(!empty($cBodyType)){
         $conditions[] = "bodytype='$cBodyType'";
      }
   if(!empty($minPrice) && empty($maxPrice)){
      $conditions[] = "price <= $minPrice";
   }
   if(empty($minPrice) && !empty($maxPrice)){
      $conditions[] = "price <= $maxPrice";
   }
   if(!empty($minPrice) && !empty($maxPrice)){
      if($minPrice < $maxPrice){
         $conditions[] = "price BETWEEN  $minPrice AND $maxPrice";
      }
      
   }
      
   if (count($conditions) > 0 && empty($keyword)) {
      $sql .= " WHERE " . implode(' AND ', $conditions );  
   }

   //echo $sql;
   
   $result = $db->query($sql);
   
   if(!$submitted){
     
      $rows = $result->fetch_assoc();
      $response['count'] = $rows['COUNT(id)'];
      echo json_encode($response);
      exit;
   }else{
      if($result->num_rows > 0){
         $rows = $result->fetch_all(MYSQLI_ASSOC);
         $totalRows = count($rows);
         $sql .= " LIMIT $offSet, $perpage";
         $result = $db->query($sql);
         $rows = $result->fetch_all(MYSQLI_ASSOC);
      }
         include_once('search.php');
   }



   
}
