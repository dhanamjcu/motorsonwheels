 <?php require_once('../resources/templates/config.php');?>
 <?php include_once(TEMPLATE_FRONT.DS.'header.php');?>  


 <?php
 
    if(isset($_GET['status'])){
        $status = $_GET['status'];
        $status = url_decode($status);

        
    }
 ?>
 
 
 <div style="background-image: url('bootstrap/img/login_bg.jpg');" class="loginBg"> 
        <div class="row">
            <div class="col-md-4 offset-md-4 login___form text-center">
                    <form method="POST" action="include/loginProcess.php">
                        <div class="text-center">
                            <a href="index.php">
                                <img src="bootstrap/img/logo.png" alt="">
                            </a>
                            <h3 class="my-2">Login Here</h3>
                           
                        </div>
                       
                         <div class="<?php echo $status['error'] ? "alert alert-danger": null ?>">
                            <h6 class="text-left">
                                <?php if(isset($status)){echo $status['error'];}?>
                            </h6>
                        </div>

                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email *" name="email"
                            value="<?= $status['email'] ?? $status['email'] ?? null ;?>" required>  
                        </div>

                        <div class="form-group">    
                            <input type="password" class="form-control"  placeholder="Password *" name="pwd" required>
                        </div>
                       
                        <button type="submit" class="btn btn-block btn-primary"name="submit">
                            <i class="fas fa-unlock-alt mr-3 text-dark" ></i>
                            LOGIN
                        </button>
                        <div class="mt-2">
                           <h6>Not member yet? Sign up for free <a href="signup.php" class="mx-2  btn-link">Join Here</a><a href="" class="btn text-danger forgotPwdBtn">Forgot Password?</a></h6>
                        </div>
                    </form>
            </div>
        </div>
 </div>
 <?php include_once('templates/forgotModal.php');?>
 <script>
    document.body.scroll = "no";
    document.body.style.overflow = 'hidden';
    document.height = window.innerHeight;       
 </script>
<?php require_once(TEMPLATE_FRONT.DS.'footer.php');?>