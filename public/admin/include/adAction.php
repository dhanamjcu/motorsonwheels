<?php
    require_once('../../../resources/templates/config.php');
     
    if(isset($_POST['updateSubmit'])):
        if(!empty($_POST['changedVal'])){
            $sql = "UPDATE `ads` SET `status` = ? WHERE `ads`.`id` = ?";
            $stmt =  $db->prepare($sql);
            $stmt->bind_param('si',$_POST['changedVal'],$_POST['adId']);
            $stmt->execute();
        
            if($stmt->affected_rows){
                $update['status'] = 'success';
                echo json_encode($update);
                exit;
            }
        }
        
    endif;


?>