<?php require_once('../../resources/templates/config.php');?>
<?php include_once(TEMPLATE_BACK.DS.'header.php');?>  


<div class="containe-fluid">
   
    <?php include_once(TEMPLATE_BACK.DS.'admin_top_nav.php');?>
    <?php include_once(TEMPLATE_BACK.DS.'sidebar.php');?>
        <div class="container"></div>
            <div class="main-content admin_main_content" id="admin_main_content" >
                <?php include_once('home.php');?>
            </div>
        </div>
    
</div>




 <!-- footer -->

<?php require_once(TEMPLATE_BACK.DS.'footer.php');?>
