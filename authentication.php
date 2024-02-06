<?php
session_start();

if(!isset($_SESSION['authenticated']))
{
    $_SESSION['status'] = "Please Login to acess Admin Dashboard";
    header("Location: admin_login.php");
    exit(0);
}

?>