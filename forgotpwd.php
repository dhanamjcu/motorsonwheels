<?php
    require_once('../resources/templates/config.php');
    include_once(TEMPLATE_FRONT.DS.'header.php');



    if(isset($_GET['token']) && isset($_GET['email'])){?>
        <div class="row">
            <div class="col-md-4 offset-md-4 login___form text-center py-2 px-5">
                        <div class="text-center mt-3">
                            <a href="index.php">
                                <img src="bootstrap/img/logo.png" alt="">
                            </a>
                            <h3 class="my-1">Reset Password</h3>
                        </div>
                        <div class="statusMsg"></div>
                    <form method="POST" action='include/resetpwdProcess.php' id="resetPasswordForm">
                        <input type="hidden" name="email" value="<?php echo $_GET['email'];?>">  
                        <input type="hidden" name="token" value="<?php echo $_GET['token'];?>">  
                       
                        <div class="form-group">
                            
                            <input type="password" class="form-control" placeholder="New Password *" name="newPwd" required>
                        </div>
                        <div class="form-group">
                            
                            <input type="password" class="form-control"  placeholder="Confrim Password *" name="conPwd" required>
                        </div>
                        <!-- <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div> -->
                        <div class="loaderDiv"></div>
                        <button type="submit" class="btn-primary  btn-block btn mb-3" name="resetSubmit"><i class="far fa-hand-point-right mr-3 text-dark"></i>Reset</button>
                       
                    </form>
            </div>

<?php    }else{
        echo 'invalid request';
    }
?>

 <!-- footer -->
     <?php require_once(TEMPLATE_FRONT.DS.'footer.php');?>