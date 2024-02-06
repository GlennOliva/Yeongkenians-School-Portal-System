<?php
include('includes/connection.php');
session_start();

if(isset($_GET['token']))
{
    $token = $_GET['token'];
    $sql = "SELECT verify_token , verify_status FROM tbl_admin WHERE verify_token='$token' LIMIT 1";
    $res = mysqli_query($conn, $sql);

    if(mysqli_num_rows($res) > 0)
    {
        $row = mysqli_fetch_array($res);
        //echo ;
        if($row['verify_status'] == "0")
        {
            $click_token = $row['verify_token'];
            $sql2 = "UPDATE tbl_admin SET verify_status = '1' WHERE verify_token='$click_token' LIMIT 1";
            $res2 = mysqli_query($conn,$sql2);

            if($res2==true)
            {
                $_SESSION['status'] = "Your Account has been Verified Successfully";
                header("Location: admin_login.php");
                exit(0);
            }
            else
            {
                $_SESSION['status'] = "Verification failed";
            header("Location: admin_login.php");
            exit(0);
            }
        }
        else
        {
            $_SESSION['status'] = "Email Already Verified. Please Login";
            header("Location: admin_login.php");
            exit(0);
        }
    }
    else
    {
        $_SESSION['status'] = "This token does not exist";
        header("Location: admin_login.php");
    }
}
else
{
    $_SESSION['status'] = "Not Allowed";
    header("Location: admin_login.php");
}
?>