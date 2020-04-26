<?php $webpage = 'approve';?>
<?php require_once('../resources/templates/config.php');?>
<?php include_once(TEMPLATE_FRONT.DS.'header.php');?>  
 

<?php 
    if(isset($_GET['adId']) && isset($_GET['token'])):
        $sql =  "SELECT * FROM `adapprove` WHERE `ad_id` = ? AND `token` = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param('is',$_GET['adId'] ,$_GET['token']);
        $stmt->execute();
        $result = $stmt->get_result();
       

        if($result->num_rows > 0):
            if(!isset($_SESSION['id'])):
                include('include/loginCheckTemplate.php');
            endif;
            if(isset($_SESSION['id']) && $_SESSION['role']=='admin'):
                $adId  = $_GET['adId'];
                echo "<div class='container'>";
                include('templates/singleView.php');

            ?>
                    <div class="row mt-5">
                        <div class="col-8 m-auto">
                            <div class="d-flex justify-content-center">
                                <form id="approveSubmitForm" action="include/approveProcess.php" method="POST">
                                    <input type="hidden" name="approveSubmitForm">
                                    <input type='hidden' name="adid" value="<?php echo $_GET['adId'];?>">
                                    <input type='submit' class="btn btn-primary m-1" value="Accept" name="changeStatus">
                                    <input type='submit' class="btn btn-danger m-1" value="Reject" name="changeStatus">  
                                </form>
                            </div>
                        </div>   
                    </div>
                </div>    
            <?php
            else:
                    $status['msg'] = 'Unauthorized Personnal';   
            endif;
        else:    
            $status['msg'] = 'Invalid token';
            echo $status['msg'];
        endif;
        
    else:
        header('location:index.php');
    endif;


?>
<!-- footer -->

<?php require_once(TEMPLATE_FRONT.DS.'footer.php');?>

