<?php
   require_once('../../../resources/templates/config.php');

   //logo upload

    if(isset($_POST['logoUpload']) && isset($_POST['carname'])):
        $file = $_FILES['logo'];
        $carname = $db->real_escape_string($_POST['carname']);
        if(empty($carname) || empty($file['name'])){
            $addCar['status'] = 'Empty fields';
            echo json_encode($addCar);
            exit;
            
        } 
        $imgUploadStatus = ImgUpload($file,$carname);
        $imgUploadStatus = json_decode($imgUploadStatus);

       
        
        if($imgUploadStatus->upload){
            $carImgName =  $imgUploadStatus->name;
            $carname = strtolower($carname);
            $sql = "INSERT INTO `carbrands` (`brandname`,`logo`) VALUES('$carname','$carImgName')";
            
            $result =  $db->query($sql);
            
            if($result){
                $addCar['status'] = 'success';
                echo json_encode($addCar);
                exit;
            }

        }else{
                $addCar['status'] = $imgUploadStatus->name;
                echo json_encode($addCar);
                exit;
        }

    endif;//isset if
       
                       
    if(isset($_POST['bodytype']) && isset($_POST['bodytypename'])){
        
        $file = $_FILES['bodyTypeImg'];
        
        $carname = $db->real_escape_string($_POST['bodytypename']); 
         if(empty($carname) || empty($file['name'])){
            $addCar['status'] = 'Empty fields';
            echo json_encode($addCar);
            exit;
           
        } 
        $imgUploadStatus = ImgUpload($file,$carname);
        $imgUploadStatus = json_decode($imgUploadStatus);
      
        if($imgUploadStatus->upload == true){
            $carImgName =  $imgUploadStatus->name;
            $carname = strtolower($carname);
            $sql = "INSERT INTO `bodytype` (`bodytype`,`bodyimg`) VALUES('$carname','$carImgName')";
            
            $result =  $db->query($sql);
            
            if($result){
                $addCar['status'] = 'success';
                echo json_encode($addCar);
                exit;
            }
        }else{
                $addCar['status'] = $imgUploadStatus->name;
                echo json_encode($addCar);
                exit;
        }
                      
}   

///////////////////////model///////////////////////////////////////////////

if(isset($_POST['carModelSubmit']) && isset($_POST['carmodel'])){
   escapeString($_POST);
    if(emptyFields($_POST)){
        $addCar['status'] = 'Empty Fields';
        echo json_encode($addCar);
        exit;
    }

    $sql = "SELECT * FROM `cars` WHERE `carname` = ? AND `carmodel` = ? AND `bodytype`=?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('sss',$_POST['carname'], $_POST['carmodel'],$_POST['bodytype']);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows){
        $stmt->close();
        $addCar['status'] = 'This Car combination already exist';
        echo json_encode($addCar);
        exit;
    }else{
            $sql = "INSERT INTO `cars` (`carname`,`carmodel`,`bodytype`) VALUES (?,?,?)";
            $stmt =  $db->prepare($sql);
            $stmt->bind_param('sss',$_POST['carname'], $_POST['carmodel'],$_POST['bodytype']);
            $result =$stmt->execute();
            $stmt->close();

            if($result == true){
                $addCar['status'] = 'success';
                echo json_encode($addCar);
                exit;
            }else{
                $addCar['status'] = 'Something Went Wrong';
                echo json_encode($addCar);
                exit;
            }
    }
     

}




/////////////////////////////////////delete model//////////////////////////////////////////////////////////////////
if(isset($_POST['modelDeleteSubmit'])){
    $sql = "DELETE FROM `cars` WHERE `cars`.`id` = ?";
    $id = $_POST['delId'];
    delCarfunc($sql,$id);
}
//*************************************delete logo*************************************************************** */
if(isset($_POST['logoDeleteSubmit'])){
    //echo 'landed on right place';
    $sql = "DELETE FROM `carbrands` WHERE `carbrands`.`brand_id` = ?";
    $id = $_POST['delId'];
    delCarfunc($sql,$id);
}
//*************************************delete car bodytype*************************************************************** */
    if(isset($_POST['bodytypeDelSubmit'])){
        $sql = "DELETE FROM `bodytype` WHERE `bodytype`.`id` = ?";
        $id = $_POST['delId'];
        delCarfunc($sql,$id);
        

    }

//////////////////////////////image uploading function/////////////////////////////////////////////////

function delCarfunc($sql,$id){
        global $db;
        $stmt = $db->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        
        $result = $stmt->affected_rows;
        if($result == true){
            $deleteModel['status'] = 'success';
            $deleteModel['id'] = $id;
            echo json_encode($deleteModel);
            exit;
        }else{
            $deleteModel['status'] = 'Something Went Wrong';
            echo json_encode($deleteModel);
            exit;
        }
}

function ImgUpload($file,$carname){
            $fileSize   = $file['size'];
            $maxSize    = 1024*512;
            $fileAllowed = array('jpg','jpeg','png');
            if(empty($file['name'])):
                $error['name'] = 'empty fields';
                $error['upload'] = 'false';
                return json_encode($error);
            else:
                $fileName  = $file['name'];
                $ext = pathinfo($fileName,PATHINFO_EXTENSION);
                $ext = strtolower($ext);
                    if(!in_array($ext, $fileAllowed)):
                        $error['name']= 'Only jpeg, png, jpg allowed';
                        $error['upload'] = false;
                        return json_encode($error);
                    elseif($fileSize > $maxSize || $fileSize <= 0 ):
                        $error['name'] = 'Only 512KB allowed';
                        $error['upload'] = false;
                        return json_encode($error);
                    else:
                        $changeFileName = strtolower($carname).'.'.$ext;
                        $upload = '../cars/logos/';
                        if(file_exists($upload.$changeFileName)):
                           unlink($upload.$changeFileName);
                        endif;
                        if( move_uploaded_file($file['tmp_name'],$upload.$changeFileName)):
                             $error['name'] = $changeFileName;
                             $error['upload'] = true;
                             return json_encode($error);
                        else:
                             $error['name'] ='something went wrong please try again';
                             $error['upload'] = false;
                             return json_encode($error);
                        endif;
                    endif;//ext checking if      
            endif;

}

?>