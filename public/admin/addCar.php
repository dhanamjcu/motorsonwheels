
<?php require_once('../../resources/templates/config.php');?>

<?php

    if(isset($_POST['submit'])){

        $carname = $_POST['carname'];
        $carmodel = $_POST['carmodel'];
        $bodytype = $_POST['bodytype'];
        print_r($_POST);

        //exit;
       
        $sql = "INSERT INTO `cars` (`carname`, `carmodel`, `bodytype`) VALUES('$carname','$carmodel' ,'$bodytype')";

        if ($db->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $db->error;
        }
    }

?>

<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
    <input type="text" placeholder="carname" name="carname">
    <input type="text" placeholder="modelname" name="carmodel">

    <select name="bodytype" id="" >
        <option value="">Body Type</option>
        <?php showOptions($bodyType);?> 
    </select>
    
    <input type="submit" value="save" name="submit">
</form>

