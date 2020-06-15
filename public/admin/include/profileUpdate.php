<?php
    
    require_once('../../../resources/templates/config.php');

    if(isset($_POST['profileSubmit'])):
        
        //feteching data from users table
        $id         = $db->escape_string($_POST['id']);
        $city       = $db->escape_string($_POST['city']);
        $fullName   = $db->escape_string($_POST['fullName']);
        $country    = $db->escape_string($_POST['country']);
        $zip        = $db->escape_string($_POST['zip']);
        $address    = $db->escape_string($_POST['address']);
        $email      = $db->escape_string($_POST['email']);
        $phone      = $db->escape_string($_POST['phone']);
        $state      = $db->escape_string($_POST['state']);
        

        $sql = "UPDATE `users` SET `name` = ?,`email` = ?,`phone` = ?,`city` = ?,`state`= ?,`zip`=?,`country`=?,`address`=? WHERE `id` = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param('ssssssssi',$fullName,$email,$phone,$city,$state,$zip,$country,$address,$id);
        $result = $stmt->execute();
        if($stmt->affected_rows){
            $stmt->close();
            $update['status'] = 'success';
            echo json_encode($update);
            exit;
        }else{
            $update['status'] = 'no change';
            echo json_encode($update);
            exit;
        }
       
    endif;    


    if(isset($_POST['profilePicSubmit'])):
        $file = $_FILES['profileImg'];
        /* echo '<pre>';
        print_r($file);
        echo '</pre>'; */
        

        $ext =  pathinfo(strtolower($file['name']) ,PATHINFO_EXTENSION);
        $fileAllowed = array('jpg','png','jpeg');
        $maxSize = 1024*1024*2;
        $uploadPath = $_SERVER['DOCUMENT_ROOT']."MOTORONWHEELS/public/admin/cars/profile/";
       
        if(empty($file['name'])){
            $update['status'] = 'No image selected';
            $update['error'] = true;
            echo json_encode($update);
            exit;
        }elseif(!in_array($ext,$fileAllowed)){
            $update['status'] = 'Invalid format. Only jpg , jpeg & png are allowed';
            $update['error'] = true;
            echo json_encode($update);
            exit;
        }elseif($file['size'] > $maxSize || $file['size'] <= 0){
            $update['status'] = 'Pic size must be under 2 MB';
            $update['error'] = true;
            echo json_encode($update);
            exit;
        }else{
           $file['name'] = uniqid().".".$ext;
           move_uploaded_file($file['tmp_name'], $uploadPath.$file['name']);
           $fileMoved = true;
        }    

        if(isset($fileMoved)){
            if($fileMoved){
                //fetching old pic for deleting
               
                isset($_SESSION['id']) ? $id = $_SESSION['id'] : null;
                $fetchpicSql = "SELECT `pic` FROM `users` WHERE `id` = '$id'";
                $result = $db->query($fetchpicSql);
                $row = $result->fetch_assoc();
                $oldPic =  $row['pic'];
                    if(!empty($oldPic)){
                        unlink($uploadPath.$oldPic);
                    }
               
                $sql = "UPDATE `users` SET `pic` = ? WHERE `id` = ?";
                $stmt = $db->prepare($sql);
                $stmt->bind_param('si',$file['name'], $id);
                $result = $stmt->execute();
                if($stmt->affected_rows){
                    $stmt->close();
                    $update['status'] = 'success';
                    echo json_encode($update);
                    exit;
                }else{
                    $update['status'] = 'no change';
                    echo json_encode($update);
                    exit;
                }
            } 
        }

    endif;

?>