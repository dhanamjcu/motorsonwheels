<?php

require_once('../../resources/templates/config.php');
$submitted = false;

 if(isset($_POST['carType']) || isset($_POST['carName']) || isset($_POST['carModel']) || isset($_POST['cBodyType']) || isset($_POST['filterSubmit'])) {
  
 
    if(isset($_POST['carType'])){
         $cartype = $db->escape_string($_POST['carType']);
         if($cartype == 'all' || empty($cartype)){
            $cartype ='';
         }
 
    }

    if(isset($_POST['carName'])){
      $carname = $db->escape_string($_POST['carName']);
    }
    if(isset($_POST['carModel'])){
      $carmodel = $db->escape_string($_POST['carModel']);
    }
    if(isset($_POST['cBodyType'])){
      $cBodyType = $db->escape_string($_POST['cBodyType']);
    }
    
      if(isset($_POST['filterSubmit'])){

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
     
      if (count($conditions) > 0) {
        $sql .= " WHERE " . implode(' AND ', $conditions );
      }
      echo $sql; exit;
  
   $result = $db->query($sql);

   
   if(!$submitted){

            $rows = $result->fetch_assoc();
            $response['count'] = $rows['COUNT(id)'];
            echo json_encode($response);
            exit;
   }else{

        if($result->num_rows > 0){
            
         
         $rows =$result->fetch_all(MYSQLI_ASSOC);
         $rows = url_encode($rows);
         header('location:../search.php?q='.$rows); 
      }else{
         header('location:../search.php');
      }
   }



   
}
