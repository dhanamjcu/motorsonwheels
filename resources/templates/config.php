<?php

    ob_start();
    session_start();

    defined('DS') ? NULL :define('DS',DIRECTORY_SEPARATOR);
    defined('TEMPLATE_FRONT') ? NULL :define('TEMPLATE_FRONT',__DIR__.DS."front");
    defined('TEMPLATE_BACK') ? NULL :define('TEMPLATE_BACK',__DIR__.DS."back");

    define('DB_HOST','localhost');
    define('DB_USER','root');
    define('DB_PASS','');
    define('DB_NAME','motorOnWheels');

    $db= new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    if(!$db){
        die('connection error'. $db->connect_errno);
    }
//setting money format
    setlocale(LC_MONETARY,"en_US");


    require_once('arrayList.php');
    require_once('function.php');

?>