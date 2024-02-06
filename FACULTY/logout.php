<?php 
session_start();
unset($_SESSION['user_identifier']);
header('Location: ../index.php');
?>