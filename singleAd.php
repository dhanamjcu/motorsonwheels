<?php

if(isset($_POST['adId'])){
   require_once('../../resources/templates/config.php');
   $adId = $_POST['adId'];


include('../templates/singleView.php');



}?>

  