<?php


function url_encode($str){
   $str = serialize($str);
   $str = urlencode($str);
   return $str;
}

function url_decode($str){
   return unserialize(urldecode($str));;
}

function isLogIn(){
   if(!isset($_SESSION['id'])){
      header('location:login.php');
   }
}

function showOptions($array){
   foreach($array as $value){
      echo "<option value='$value'>".ucfirst($value)."</option>";
   }
}


function fetchResult($sql){
      global $db;
      $stmt = $db->prepare($sql);
      $stmt->execute();

      $result = $stmt->get_result();
      $rows = $result->fetch_all();
      return $rows;
}

function getResult($sql){
   global $db;
    $result = $db->query($sql);
    $rows =$result->fetch_all(MYSQLI_ASSOC);
    return $rows;
}

function delete($query){
      
}