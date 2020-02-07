 <?php 
 
 require_once('../../resources/templates/config.php');

 if(isset($_POST['editSubmit'])){

    /* echo "<pre>";
       //var_dump($_POST);
    echo "</pre>";
    */
    //exit;
    //sql

    $_POST['status'] = 'pending';
    $sql = "UPDATE `ads` SET `status` = ?, `cartype` = ?, `carname` = ?, `carmodel` = ?, `bodytype` = ?, `odometer` = ?, `transmission` = ?, `price` = ?, `year` = ?, `cylinder` = ?, `engineDes` = ?, `fuelEconomy` = ?, `colour` = ?, `seats` = ?, `doors` = ? WHERE `ads`.`id` = ? AND `ads`.`user_id` = ?;";
    
    $stmt = $db->prepare($sql);

     if(!$stmt){
      die('query failed');
     }else{
         $stmt->bind_param("sssssssssssssssii",  $_POST['status'], $_POST['vType'], $_POST['vName'], $_POST['vModel'], $_POST['vBodyType'], $_POST['odoMeter'], $_POST['transmission'], $_POST['vPrice'], $_POST['modelYr'], $_POST['cylinder'], $_POST['vEngDesc'], $_POST['economy'], $_POST['vColor'], $_POST['vSeats'],$_POST['Doors'],$_SESSION['editId'],$_SESSION['id']);
            $stmt->execute();
            //echo $stmt->error;

            print_r($stmt);
           // exit;

        if($stmt->affected_rows > 0){

            $stmt->close();

            
         
                    $status['success'] = "Your Ads Has been Updated ";
                    $status = url_encode($status);

                    header('location:../editAds.php?status='.$status);

            }          


        }
     
    





 }


 
