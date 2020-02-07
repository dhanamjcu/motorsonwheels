 <nav class="navbar navbar-expand-lg sticky-top navbar-dark">
        <div class="container">
        <a class="navbar-brand bg-light pr-1" href="index.php"  >
            <img src="bootstrap/img/logo.png" alt="logo" id="logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item active mx-3">
                <a class="nav-link" href="index.php"><i class="fas fa-home mr-1"></i> Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active mr-3">
                <a class="nav-link " href="posts.php">All Cars</a>
            </li>
            <li class="nav-item dropdown active mr-3">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Sell My Car
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                
                    <a class="dropdown-item" href="createAds.php"> 
                        Create Ads
                    </a>
                    <a class="dropdown-item" href="manageAds.php">
                        Manage Ads
                    </a>

                </div>
            </li>
            <li class="nav-item active mr-3">
                <a class="nav-link" href="#">Help</a>
            </li>
            </ul>
           <!--  -->
          
<?php 

                    if(isset($_SESSION['name'])==true){

                    //fetching wishlist 
                    $logInId = $_SESSION['id'];
                    $sql = "SELECT COUNT(id) FROM `wishlist` WHERE `user_id`= $logInId";
                    $totalWishlist = getResult($sql);
                    //print_r($totalWishlist[0]['COUNT(id)']);
?>
                        <div class="dropdown">
                            <button class="btn btn-link  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" >
                                <?php echo ucfirst($_SESSION['name']);?>
                                
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="logout.php">
                                    <i class="fas fa-sign-out-alt mr-2"></i> 
                                    Logout
                                </a>
                                <a class="dropdown-item" href="userDetails.php?action=mywishlist">
                                    <i class="fas fa-heart mr-2"></i>
                                    My wishlist
                                    <span class="badge badge-dark"><?=$totalWishlist[0]['COUNT(id)']?></span>
                                </a>
                                <a class="dropdown-item" href="userDetails.php">
                                    <i class="fas fa-user-circle mr-2"></i>
                                    Profile
                                </a>
                            </div>
                        </div>

                    <?php } else{ ?>
                        
                <div>
                    <a href="login.php" class="btn btn-link ml-2 fancy-link"><i class="fas fa-lock-open fontawesome"></i> Login</a>
                    <a href="signup.php" class="btn btn-link ml-2 fancy-link"><i class="fas fa-user-plus fontawesome"></i> Join</a>
                </div>  
                        
                   <?php }?>              

           
           

            

        </div>
        </div><!--container div -->
        </nav>
       