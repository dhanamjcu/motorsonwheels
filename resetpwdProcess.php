<?php

    require_once(realpath('../../resources/templates/config.php'));

    if(isset($_POST['resetSubmit'])){
     //print_r($_POST);exit;
        $email      =   $_POST['email'];
        $newPwd     =   $_POST['newPwd'];
        $conPwd     =   $_POST['conPwd'];
        $token      =   $_POST['token'];

        $email = test_input($email); 
        $token = test_input($token); 

         if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $status['msg'] = "Invalid email format";
            echo json_encode($status);
            exit;
        }
        if(empty($newPwd) || empty($conPwd)){
            $status['msg'] = "all fields required";
            echo json_encode($status);
            exit;
        }

        $tokensql = "SELECT `token` FROM `users` WHERE `token` = ? AND `email` = ?";
        $stmt = $db->prepare($tokensql);
        if(!$stmt){
            die('query error');
        }
        $stmt->bind_param('ss',$token,$email);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows < 1){
           
            $stmt->close();
            $status['msg'] = "Invalid token";
            echo json_encode($status);
            exit;
        }

        if(userExist($email)){
                 if($_POST['newPwd'] !== $_POST['conPwd']){
                    $status['msg'] = 'Both password didn\'t match.';
                    echo json_encode($status);
                    exit;
                }else{
                    $pwdHash = password_hash($newPwd, PASSWORD_DEFAULT);
                    $sql = "UPDATE `users` SET `password` = ? WHERE `email` = ? AND `token` = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param('sss', $pwdHash,$email,$token);
                    $stmt->execute();
                    
                    if($stmt->affected_rows){
                        $stmt->close();
                        $updateTokensql = "UPDATE `users` SET `token` = '' WHERE  `email` = ?";
                                            
                        $stmt = $db->prepare($updateTokensql);
                            if(!$stmt){
                                die('query error');
                            }
                        $stmt->bind_param('s',$email);
                        $stmt->execute();
                        
                        if($stmt->affected_rows > 0):
                            $status['msg'] = true;
                            echo json_encode($status);
                            exit;
                        endif;
                    }
                
                }  
            
        }else{
            $status['msg'] = "Email doesn't exist";
            echo json_encode($status);
            exit;
         }
        
       
       
             

    }


?>