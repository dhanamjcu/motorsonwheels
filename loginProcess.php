<?php

    if(isset($_POST['submit'])){
        
        require_once('../../resources/templates/config.php');

       

        $userEmail      = $_POST['email'];
        $userPwd        = $_POST['pwd'];
        
        $status['email'] = $userEmail;

        if(empty($userEmail) || empty($userPwd)){
            $status['error'] = "* fields are required";
            $status = url_encode($status);
            header("location:../login.php?status=$status");
            exit;
        }
        if(!filter_var($userEmail, FILTER_VALIDATE_EMAIL)){
            $status['error'] = "Please write valid email address";
            $status = url_encode($status);
            header("location:../login.php?status=$status");
            exit;
        }
        
        //sqli methods starts here

        $sql = "SELECT * FROM `users` WHERE `email` = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param('s', $userEmail);
        $stmt->execute();

        $result =  $stmt->get_result();
       // print_r($result->num_rows);

            if($result->num_rows < 1){
                $status['error'] = "Email not found.";
                $status = url_encode($status);
                header("location:../login.php?status=$status");
                exit;
                
            }else{

                $row = $result->fetch_assoc();
               

                $pwdHash = password_verify($userPwd, $row['password']);

                        if($pwdHash){
                            $_SESSION['id']     =   $row['id'];
                            $_SESSION['name']   =   $row['name'];
                            $_SESSION['email']  =   $row['email'];
                            $_SESSION['role']   =   $row['role'];

                            $stmt->close();
                            header('location:../index.php');
                        }else{
                            $status['error'] = "Incorrect Password";
                            $status = url_encode($status);
                            header("location:../login.php?status=$status");
                            exit;
                        }

                }           

    }else{
        header('location:../login.php');
    }



?>