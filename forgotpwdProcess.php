<?php

    require_once(realpath('../../resources/templates/config.php'));

    if(isset($_POST['forgotSubmit'])):
        $email = $_POST['email'];

        $email = test_input($email); 
        if(empty($email)):
            $status['msg'] = "Email required";
            echo json_encode($status);
            exit;
        endif;

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $status['msg'] = "Invalid email format";
            echo json_encode($status);
            exit;
        }

       
        //checking email exist in database or not
        if(userExist($email)):
            $token = createToken(30);
            $body =  "<a href='http://localhost/motorOnWheels/public/forgotpwd.php?token=$token&email=$email'>Reset</a>";
            $mail = new Mailsend(array(
                'host' => Mailconfig::$Host,
                'Username' => Mailconfig::$Username,
                'Password' => Mailconfig::$Password,
                'Port' => Mailconfig::$Port,
                'addAddress' => $email,
                'subject'   => 'Forgot Password',
                'title'     => 'Reset Password',
                'body'  => $body
            ));
                if($mail->response):
                    $updateTokensql = "UPDATE `users` SET `token` = ? WHERE  `email` = ?";
                                    
                        $stmt = $db->prepare($updateTokensql);
                            if(!$stmt){
                                die('query error');
                            }
                        $stmt->bind_param('ss',$token,$email);
                        $stmt->execute();
                        
                        if($stmt->affected_rows > 0):
                            $status['msg'] = true;
                            echo json_encode($status);
                            exit;
                        endif;
                else:            
                        $status['msg'] = $mail->response;
                        echo json_encode($status);
                        exit;          
                endif;

        else:
            $status['msg'] = "Email doesn't not exist";
            echo json_encode($status);
            exit;
        endif;
         
        
    endif;
?>