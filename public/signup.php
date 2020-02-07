 <?php require_once('../resources/templates/config.php');?>
 <?php include_once(TEMPLATE_FRONT.DS.'header.php');?>  

 <?php
 
    if(isset($_GET['status'])){
        $status = $_GET['status'];

        $status = url_decode($status);
        
        if(isset($status['success'])){
            $error_class = 'success';
            $status['error'] = $status['success'];
        }else{
            $error_class = 'danger';
        }
        
       
    }
 
 ?>
 
 
 <div style="background-image: url('bootstrap/img/login_bg.jpg');" class="loginBg"> 
        <div class="row">
            <div class="col-md-4 offset-md-4 login___form text-center py-2 px-5">
                    <form method="POST" action='include/signupProcess.php'>
                       
                        <div class="text-center">
                            <a href="index.php">
                                <img src="bootstrap/img/logo.png" alt="">
                            </a>
                            <h3 class="my-1">Join Now!</h3>
                           
                        </div>

                         <div class="<?php echo $status['error'] ? "alert alert-$error_class": null ?>">
                            <h6 class="text-left">
                                <?php if(isset($status)){echo $status['error'];}?>
                            </h6>
                        </div>

                        <div class="form-group">
                           
                            <input type="text" class="form-control" placeholder="Your Full Name *" name="userName" 
                            value="<?= $status['name'] ?? $status['name'] ?? null; ?>" 
                            required>
                           
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Enter email *" name="userEmail" value="<?= $status['email'] ?? $status['email'] ?? null ;?>" required>  
                        </div>
                        <div class="form-group">
                            
                            <input type="password" class="form-control" placeholder="Password *" name="userPwd" required>
                        </div>
                        <div class="form-group">
                            
                            <input type="password" class="form-control"  placeholder="Confrim Password *" name="confirmPwd" required>
                        </div>
                        <!-- <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div> -->
                        <button type="submit" class="btn-primary  btn-block btn" name="submit"><i class="far fa-hand-point-right mr-3 text-dark"></i>REGISTER HERE</button>
                        <div>
                            <h6 class="mt-2">Already member ?
                            <a href="login.php" class="btn-link">Login Here</a>
                            </h6>
                        </div>
                    </form>
            </div>
        </div>
 </div>
 <script>
    document.body.scroll = "no";
    document.body.style.overflow = 'hidden';
    document.height = window.innerHeight;       
 </script>
<?php require_once(TEMPLATE_FRONT.DS.'footer.php');?>