<?php
     require_once(realpath('../../resources/templates/config.php'));

     function approveStatus($status, $id){
        global  $db;
        $sql = "UPDATE `ads` SET `status` = '$status' WHERE `ads`.`id` = ?;";
        $stmt = $db->prepare($sql);
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $result = $stmt->affected_rows;
        return $result;
     }

     if(isset($_POST['approveSubmitForm']) && isset($_POST['changeStatus'])):
        $adid = $_POST['adid'];
        if($_POST['changeStatus']=='Accept'):
           $approveStatus = approveStatus('approved', $adid);
            if($approveStatus == 1):
                $status['msg'] = 'application approved';
                echo  json_encode($status);
                exit;
            else:
                $status['msg'] = 'status already approved';
                echo  json_encode($status);
                exit;
            endif;
        endif;
        if($_POST['changeStatus']=='Reject'):
           $approveStatus = approveStatus('rejected', $adid);
            if($approveStatus == 1):
                $status['msg'] = 'application rejected';
                echo  json_encode($status);
                exit;
            else:
                $status['msg'] = 'status already rejected';
                echo  json_encode($status);
                exit;
            endif;
        endif;
     endif;

     

?>