<?php 
    $webpage = 'userdetails';
    require_once('../resources/templates/config.php');
    include_once(TEMPLATE_FRONT.DS.'header.php');
     isLogIn();
?>

<!-- navbar -->
<?php include_once(TEMPLATE_FRONT.DS.'nav.php');?> 



   
    <div class="main-content admin_main_content " id="admin_main_content" >

        <div class="container">
            <div class="row">
                 <div class="col-md-12">
                     <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-dark">
                            <li class="breadcrumb-item active"><a href="index.php" ><i class="fas fa-home mr-2"></i>Home</a></li>
                            <li class="breadcrumb-item active">Change Password</li>
                        </ol>
                    </nav>

                    <!-- profile content -->
                </div><!-- col div-->
                <div class="col-md-6 m-auto" style="margin-bottom:16px !important">
                    <div class="pwdUpdateMsg"></div>
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Change Password</h4>
                        </div>
                            <div class="card-body">
                                <form action="include/changePwdProcess.php" class="changePwdForm" method="POST">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Old Password</label>
                                                <input type="password" class="form-control"  name='oldPwd' required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>New Password</label>
                                                <input type="password" class="form-control"  name='newPwd' required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Confrim Password</label>
                                                <input type="password" class="form-control"  name='confrimPwd' required>
                                            </div>
                                        </div>
                                
                                    </div><!--form row-->
                                    <input type="hidden" name="cPwdSubmit">
                                   
                                    <button type="submit" class="btn btn-primary btn-block" name="cPwdSubmit">Update Password</button>
                                
                                </form>
                            </div><!--card body-->
                        </div><!--card div-->
                    </div>
                    
                </div><!--row div-->
            </div><!--  container -->
        </div><!--main content-->



<!-- footer -->
<?php require_once(TEMPLATE_FRONT.DS.'footer.php');?>