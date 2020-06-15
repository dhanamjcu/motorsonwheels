<?php
    require_once('../../../resources/templates/config.php');

    if(isset($_POST['cPwdSubmit'])):
        $oldPwd     =   $_POST['oldPwd'];
        $newPwd     =   $_POST['newPwd'];
        $conPwd     =   $_POST['confrimPwd'];
        $id         =   $_SESSION['id'];
        
        $sql = "SELECT `password` FROM `users` WHERE `id` = $id";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
       
        if(empty($_POST['oldPwd']) || empty($_POST['newPwd']) || empty($_POST['confrimPwd'])){
            $update['status'] = 'Empty fields';
            echo json_encode($update);
            exit;
        }elseif($_POST['newPwd'] !== $_POST['confrimPwd']){
            $update['status'] = 'Both password didn\'t match.';
            echo json_encode($update);
            exit;
        }elseif(!password_verify($oldPwd, $row['password'])){
            $update['status'] = 'Old password didn\'t match.';
            echo json_encode($update);
            exit;
        }else{
            $pwdHash = password_hash($newPwd, PASSWORD_DEFAULT);
            $sql = "UPDATE `users` SET `password` = ? WHERE `id` = $id";
            $stmt = $db->prepare($sql);
            $stmt->bind_param('s', $pwdHash);
            $stmt->execute();
            if($stmt->affected_rows){
                $update['status'] = "success";
                echo json_encode($update);
                exit;
            }
           
        }        

    endif;
?>