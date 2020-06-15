<?php
 require_once('../resources/templates/config.php');

    if(isset($_POST['submit'])){
        $files = $_FILES['file'];
        /* echo "<pre>";
            print_r($files);
        echo "</pre>"; */
    }

    $photo = new Photoupload(array(
        'maxSize'    => 1024*1024,
        'fileType'   => array('jpeg','jpg','png'),
        'uploadPath' => '../public/uploads2/',
        'fileName'   => $files  
    ));
    echo "<pre>";
            print_r($photo->response);
        echo "</pre>";
    $status = json_decode($photo->response); 

    if(isset($status->upload)){
        if($status->upload){
            $totalimgs = count($status->filesname);
        }else{
           echo json_encode($status); 
           exit;
        }
    }
    
  

    if(isset($status->filesname)){
        
         echo $totalimgs;

    }
   
       
   
?>

<form method='POST' action='<?php $_SERVER['PHP_SELF']?>' enctype='multipart/form-data'>
    
    <input type="file" name="file[]" id="file" multiple>
    <input type='submit' name='submit' value='Upload'>

</form>