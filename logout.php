<?php 
    include("./include/conn.php");
    include("./include/session.php");
    session_start();

    $sess_Username = $_SESSION["username"];


    session_destroy();
    
    setcookie('username',null,time()-1);
    header('location: login.php');
 ?>
