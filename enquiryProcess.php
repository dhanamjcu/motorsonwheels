<?php
    require_once(realpath('../../resources/templates/config.php'));
   
    if(isset($_POST['enqSubmit'])){
       
        $email      =   $_POST['email'];
        $name       =   $_POST['name'];
        $contact    =   $_POST['contact'];
        $enqMsg     =   $_POST['message'];
        $adId       =   $_POST['adId'];
        if(empty($_POST['adId'])):
            $_POST['adId'] = 'na';
        endif;
        
       // print_r($_POST);exit;
       
        if(empty($_POST['enqSubmit'])){
            $_POST['enqSubmit'] = 'enqSubmit';
        }
        foreach($_POST as $field):
            if(empty($field)):
                $status['msg'] = "All fields required";
                echo json_encode($status);
                exit;
            endif; 
        endforeach;

       

        $name = test_input($name);
        if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
            $status['msg'] =  "Only letters and white space allowed in Name field";
            echo json_encode($status);
            exit;
        }

        $email = test_input($email);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $status['msg'] = "Invalid email format";
            echo json_encode($status);
            exit;
        }

        $contact = test_input($contact);
        if(strlen($contact) != 10){
            $status['msg'] = "Mobile no. must be in 10 digits";
            echo json_encode($status);
            exit;
        }elseif(!preg_match("/^[0-9]+$/i", $contact)){
            $status['msg'] = "Only numeric value allowed";
            echo json_encode($status);
            exit;
        }
        
        

        $enqMsg = test_input($enqMsg);

        ///////inserting data in qury table

        $sql = 'INSERT INTO `enquiry` (`adId`,`name`, `email`, `contact`, `message`) VALUES (?,?,?,?,?)';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('issss',$adId,$name,$email,$contact,$enqMsg);
        $stmt->execute();

        if($stmt->affected_rows > 0):
            $status['msg'] = true;
            echo json_encode($status);
            exit;
        else:
            $status['msg'] = $stmt->error_list;
            echo json_encode($status);
            exit;
        endif;
        
    }elseif(isset($_POST['sellerEnq'])){

        $user_id = $_POST['sellerEnq'];
        $sql = "SELECT `name`,`email`,`phone` FROM `users` WHERE `id` = ?";
       
        $stmt = $db->prepare($sql);
        $stmt->bind_param('i',$user_id);

        if($stmt->execute()){
            $result = $stmt->get_result();
            $rows = $result->fetch_assoc();

            $status['user'] = $rows;
            echo json_encode($status);
            exit;
        }
       
    }
?>