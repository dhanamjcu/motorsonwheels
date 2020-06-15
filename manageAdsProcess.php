<?php
    require_once('../../resources/templates/config.php');
    if(isset($_POST['deleteId'])){

         $deleteId = $_POST['deleteId'];

         $query = "DELETE FROM `ads` WHERE `ads`.`id` = ? AND `ads`.`user_id`=?";
         $stmt = $db->prepare($query);
         $stmt->bind_param('is',$deleteId,$_SESSION['id']);
         $stmt->execute();
        
         $stmt->close();

        //fetch all images related with this ads
        $fetchImgQuery = "SELECT `imgname` FROM adimg WHERE `ads_id` = $deleteId";
        $imgRows = fetchResult($fetchImgQuery);
        
        foreach($imgRows as $img){
           $imgPath = realpath("../uploads/$img[0]");
           unlink($imgPath);
        }

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