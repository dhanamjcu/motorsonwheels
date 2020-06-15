<?php
    require_once('../../resources/templates/config.php');
    if(isset($_POST['wishlist'])){
        
        if(!isset($_SESSION['id'])){
            $response['login'] = false;
            echo json_encode($response);
            exit;
        }else{
            $sql = "SELECT `id` FROM `wishlist` WHERE `user_id` = ? AND ads_id = ?";
            $stmt = $db->prepare($sql);
            $stmt->bind_param('ii',$_SESSION['id'],$_POST['wishlist']);
            $stmt->execute();
            $result = $stmt->get_result();
            //print_r($result);
            //exit;
            if($result->num_rows > 0){
                $stmt->close();
                $sql = "DELETE FROM `wishlist` WHERE `user_id` = ? AND ads_id = ?";
                $stmt = $db->prepare($sql);
                $stmt->bind_param('ii',$_SESSION['id'],$_POST['wishlist']);
                $stmt->execute();
                $response['status'] = "removed";
                echo json_encode($response);
                exit;
                
            }else{
                $stmt->close();
                $sql = "INSERT INTO `wishlist` (`user_id`,ads_id) VALUES(?,?)";
                $stmt = $db->prepare($sql);
                $stmt->bind_param('ii',$_SESSION['id'],$_POST['wishlist']);
                $stmt->execute();
                $stmt->close();
                $response['status'] = "added";
                echo json_encode($response);
                exit;
                  
                    
            }
        }
        
       
    }elseif(isset($_POST['wishlistRemove'])){
            $sql = "DELETE FROM `wishlist` WHERE id = ?";
            $stmt = $db->prepare($sql);
            $stmt->bind_param('i',$_POST['wishlistRemove']);
            if($stmt->execute()){
                $response['status'] = "removed";
                echo json_encode($response);
                exit;
            }
            
    }

?>