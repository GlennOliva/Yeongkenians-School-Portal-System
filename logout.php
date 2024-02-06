<?php
session_start();

if(isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === TRUE)
{
    unset($_SESSION['authenticated']);
    unset($_SESSION['auth_admin']);
    $_SESSION['status'] = "You are logged out successfully!";
    header("Location: admin_login.php");
    exit(0);
}
else
{
    $_SESSION['status'] = "You are already logged out";
    header("Location: admin_login.php");
    exit(0);
}
?>
