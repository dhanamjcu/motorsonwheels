<?php

    if(isset($_POST['submit'])){

        require_once('../../resources/templates/config.php');

       // print_r($_POST);

        $userName       = $_POST['userName'];
        $userEmail      = $_POST['userEmail'];
        $userPwd        = $_POST['userPwd'];
        $confrimPwd     = $_POST['confirmPwd'];

        $status['name'] = $userName;
        $status['email'] = $userEmail;

        if(empty($userName) || empty($userEmail) || empty($userPwd) || empty($confrimPwd)){
            $status['error'] = "* fields are required";
            $status = url_encode($status);
            header("location:../signup.php?status=$status");
            exit;
        }
        if(!filter_var($userEmail, FILTER_VALIDATE_EMAIL)){
            $status['error'] = "Please write valid email address";
            $status = url_encode($status);
            header("location:../signup.php?status=$status");
            exit;
        }
        if($userPwd !== $confrimPwd){
            $status['error'] = "Both password should be same";
            $status = url_encode($status);
            header("location:../signup.php?status=$status");
            exit;
        } 

        //sqli methods starts here

        $sql = "SELECT * FROM `users` WHERE `email` = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param('s', $userEmail);
        $stmt->execute();

        $result =  $stmt->get_result();
        print_r($result->num_rows);

            if($result->num_rows > 0){
                $status['error'] = "Email already exists.";
                $status = url_encode($status);
                header("location:../signup.php?status=$status");
                exit;
                
            }else{

                $stmt->close();

                $pwdHash = password_hash($userPwd, PASSWORD_DEFAULT);

                $sql = "INSERT INTO `users` (`name`,`email`,`password`) VALUES( ?,?,?) ";
                echo $db->error;
                $stmt = $db->prepare($sql);
                $stmt->bind_param('sss' , $userName ,$userEmail, $pwdHash);
                $stmt->execute();
                    if($stmt->affected_rows > 0){
                        $status['success'] = "Congrats! Profile has been created";
                        $status['name'] = '';
                        $status['email'] = '';
                        $status = url_encode($status);
                        header("location:../signup.php?status=$status");
                        exit;
                    }        

                }           

    }else{
        header('location:../signup.php');
    }



?>