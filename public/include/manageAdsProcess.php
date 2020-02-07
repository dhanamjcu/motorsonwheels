<?php
    require_once('../../resources/templates/config.php');
    if(isset($_POST['deleteId'])){

         $deleteId = $_POST['deleteId'];

         $query = "DELETE FROM `ads` WHERE `ads`.`id` = ? AND `ads`.`user_id`=?";
         $stmt = $db->prepare($query);
         $stmt->bind_param('is',$deleteId,$_SESSION['id']);
         $stmt->execute();
        
         $stmt->close();

         //delete all images related with this ad
         $query = "DELETE FROM `adimg` WHERE `adimg`.`ads_id` = ? AND `adimg`.`user_id`=?";
         $stmt = $db->prepare($query);
         $stmt->bind_param('is',$deleteId,$_SESSION['id']);
         $stmt->execute();
         $stmt->close();


        $status['success'] = 'You advertisment has been deleted';
        
        echo json_encode($status);
        exit;


         
    }




?>