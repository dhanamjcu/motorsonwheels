 <?php 
 
 require_once('../../resources/templates/config.php');

 if(isset($_POST['submit'])){

    echo "<pre>";
        var_dump($_POST);
    echo "</pre>";
//exit;
    //sql

    
    $sql = "INSERT INTO `ads` (`user_id`, `cartype`, `carname`, `carmodel`, `bodytype`, `odometer`,`transmission`, `price`, `year`, `cylinder`, `engineDes`, `fuelEconomy`,`colour`, `seats`, `doors`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    
    $stmt = $db->prepare($sql);

     if(!$stmt){
      die('query failed');
     }else{
         $stmt->bind_param("sssssssssssssss", $_SESSION['id'], $_POST['vType'], $_POST['vName'], $_POST['vModel'], $_POST['vBodyType'], $_POST['odoMeter'], $_POST['transmission'], $_POST['vPrice'], $_POST['modelYr'], $_POST['cylinder'], $_POST['vEngDesc'], $_POST['economy'], $_POST['vColor'], $_POST['vSeats'],$_POST['Doors']);
    $stmt->execute();
    //echo $stmt->error;

    print_r($stmt);

        if($stmt->affected_rows > 0){

            $stmt->close();

            $sql = "SELECT MAX(id) FROM `ads` WHERE `user_id` = ?";
            $stmt = $db->prepare($sql);
            $stmt->bind_param('s',$_SESSION['id']);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            print_r($row);

            $adId = $row['MAX(id)'];
            echo $adId;

            $stmt->close();
            //validating imges


                $files = $_FILES['image'];

      
                for($i =0; $i < count($files['name']); $i++){
                        $maxSize = (1024*1024);
                        $accepted = ['jpeg','jpg','png'];
                        $ext = pathinfo($files['name'][$i],PATHINFO_EXTENSION);
                        $dir = "../uploads/";
                    
                        if($files['size'][$i] > $maxSize || $files['size'][$i] <= 0){
                            echo $files['name'][$i]."file larger than 1MB";
                            exit;
                        
                        }elseif(!in_array($ext,$accepted)){
                            echo "Only jpg, Jpeg and png file format allowed";
                            exit;
                        }else{
                                $files['name'][$i] = uniqid().".".$ext;
                                move_uploaded_file($files['tmp_name'][$i],$dir.$files['name'][$i]);
                                
                            }
                    }

                   // print_r($files['name']);

            //inserting img query

            $totalImg = count($files['name']);


            for($j = 0; $j < $totalImg; $j++){

                $fileName = $files['name'][$j];
                echo "<br>";

                $sql = "INSERT INTO `adimg` (`user_id`,`ads_id`,`imgname`) VALUES(?,?,?)";
                $stmt = $db->prepare($sql);
                    if(!$stmt){
                        die('query error');
                    }
                $stmt->bind_param('sss', $_SESSION['id'], $adId , $fileName);
                $stmt->execute();

                 if(!$stmt->affected_rows > 0){
                      echo $fileName.'not uploaded';
                 }

            }
            $status['success'] = "Congarts! Your Ads Has been Created ";
            $status = url_encode($status);

            header('location:../createAds.php?status='.$status);




        }
     
     } 





 }


 
