 <?php 

    require_once('../../resources/templates/config.php');

    if(isset($_POST['submit'])){
       
        //image validations
        $files = $_FILES['image'];
        $photo = new Photoupload(array(
            'maxSize'    => 1024*1024,
            'fileType'   => array('jpeg','jpg','png'),
            'uploadPath' => '../uploads/',
            'fileName'   => $files  
        ));

        
        $imgUpload = json_decode($photo->response); 

        if(isset($imgUpload->upload)){
            if($imgUpload->upload){
                $totalImg = count($imgUpload->filesname);
            }else{
                echo json_encode($imgUpload); 
            exit;
            }
        }
        //image validation ends here
 
    $sql = "INSERT INTO `ads` (`user_id`, `cartype`, `carname`, `carmodel`, `bodytype`, `odometer`,`transmission`, `price`, `year`, `cylinder`, `engineDes`, `fuelEconomy`,`colour`, `seats`, `doors`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    
    $stmt = $db->prepare($sql);

    if(!$stmt){
      die('query failed');
    }else{
         $stmt->bind_param("sssssssssssssss", $_SESSION['id'], $_POST['vType'], $_POST['vName'], $_POST['vModel'], $_POST['vBodyType'], $_POST['odoMeter'], $_POST['transmission'], $_POST['vPrice'], $_POST['modelYr'], $_POST['cylinder'], $_POST['vEngDesc'], $_POST['economy'], $_POST['vColor'], $_POST['vSeats'],$_POST['Doors']);

        $stmt->execute();


        if($stmt->affected_rows > 0){
            $status['description'] = true;
            $stmt->close();

            $sql = "SELECT MAX(id) FROM `ads` WHERE `user_id` = ?";
            $stmt = $db->prepare($sql);
            $stmt->bind_param('s',$_SESSION['id']);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
           
            $adId = $row['MAX(id)'];
           
            $stmt->close();
          

            for($j = 0; $j < $totalImg; $j++):

                $fileName = $imgUpload->filesname[$j];

                //inserting images

                $sql = "INSERT INTO `adimg` (`user_id`,`ads_id`,`imgname`) VALUES(?,?,?)";
                $stmt = $db->prepare($sql);
                    if(!$stmt){
                        die('query error');
                    }
                $stmt->bind_param('sss', $_SESSION['id'], $adId , $fileName);
                $stmt->execute();

                if(!$stmt->affected_rows > 0){
                        $status['msg'] = $fileName.'not uploaded';
                        echo json_encode($status);
                        exit;
                }

            endfor;

               $status['imgupload'] = true;
               
          
                $token = createToken(25);
                $tokenSql = "INSERT INTO `adapprove` (`ad_id`,`token`) VALUES(?,?)";
                $stmt = $db->prepare($tokenSql);
                    if(!$stmt){
                        die('query error');
                    }
                $stmt->bind_param('is', $adId , $token);
                $stmt->execute();
               
                    //invoking mail class sending mail
               
                    $body    = "<a href='http://localhost/motorOnWheels/public/approve.php?token=$token&adId=$adId'>Approve</a>";
                        $mail = new Mailsend(array(
                            'host' => Mailconfig::$Host,
                            'Username' => Mailconfig::$Username,
                            'Password' => Mailconfig::$Password,
                            'Port' => Mailconfig::$Port,
                            'subject'   => 'New Post',
                            'title'     => 'New Post arrived',
                            'addAddress' => Mailconfig::$Username,
                           // 'maildebug'=> true,
                            'body'  => $body
                    ));
                          
                            if($mail->response){
                               
                                $stmt->close();
                                $updateTokensql = "UPDATE `adapprove` SET `mailsent` = '1' WHERE  `ad_id` = ? AND `token`= ?";
                                
                                $stmt = $db->prepare($updateTokensql);
                                    if(!$stmt){
                                        die('query error');
                                    }
                                $stmt->bind_param('is',$adId,$token);
                                $stmt->execute();
                                $stmt->close();
                                $status['mail'] = true;
                               
                                
                            } else{
                                $status['mail'] = $mail->response;
                            } 

                             $status['msg'] = true;
                             //print_r($status);
                             echo json_encode($status);
                             exit;

        }
     
    } 





 }


 
