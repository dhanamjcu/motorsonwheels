<?php 

    if(isset($_POST['carName'])){
        require_once('../../resources/templates/config.php');
        
        $carname = $_POST['carName'];
        isset($_POST['fromTable']) ?  $table = $_POST['fromTable'] : $table = null;
            
        if(!empty($_POST['carModel'])){

            $carModel = $_POST['carModel'];
            $data['carModel'] = $carModel;
            $sql =  "SELECT `bodytype` FROM `ads` WHERE `carname` = ? AND `carmodel` = ? GROUP BY 'bodytype'";
           
                if(isset($table)){
                    $sql =  "SELECT `bodytype` FROM $table WHERE `carname` = ? AND `carmodel` = ?";
                }
           
            $stmt = $db->prepare($sql);
            $stmt->bind_param('ss',$carname,$carModel);
            $stmt->execute();

        }else{

            $sql =  "SELECT `carmodel` FROM `ads` WHERE `carname` = ? GROUP BY `carmodel` ORDER BY `carmodel`";
          
                if(isset($table)){
                   
                    $sql =  "SELECT `carmodel` FROM $table WHERE `carname` = ? GROUP BY `carmodel` ORDER BY `carmodel`";
                }
           
            $stmt = $db->prepare($sql);
            $stmt->bind_param('s',$carname);
            $stmt->execute();

        }

        
        $result = $stmt->get_result();
        $rows = $result->fetch_all(); 
       
        $data['carmodel'] = [];

        for($i=0; $i< count($rows); $i++){
            array_push($data['carmodel'],$rows[$i][0]);
        }
        $data = json_encode($data['carmodel']);
        echo $data;
        exit;


    }





?>

