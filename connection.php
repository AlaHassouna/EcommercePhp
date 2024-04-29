<?php
    session_start();
    $con=mysqli_connect("localhost","root","","store");
    define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/store/'); //Define the absolute path to this file.
    define('SITE_PATH','http://127.0.0.1/store/');

    define('PRODUCT_IMAGE_SERVER_PATH',SERVER_PATH.'media/product/');
    define('PRODUCT_IMAGE_SITE_PATH',SITE_PATH.'media/product/');
?>