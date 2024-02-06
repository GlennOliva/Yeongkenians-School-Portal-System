<?php
include('includes/connection.php');
session_start();

if(isset($_POST['login-btn']))
{
    if(!empty(trim($_POST['email'])) && !empty(trim($_POST['password'])))
    {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pasword  = mysqli_real_escape_string($conn, $_POST['password']);


        $sql = "SELECT * FROM tbl_admin WHERE email='$email' AND password = '$pasword' LIMIT 1";
        $res = mysqli_query($conn,$sql);

        if(mysqli_num_rows($res) > 0)
        {
            $row = mysqli_fetch_array($res);
            if($row['verify_status']== "1")
            {
                $_SESSION['authenticated'] = TRUE;
                $_SESSION['auth_admin'] = [
                    'email' => $row['email'],
                    'id' => $row['id'] 
                ];
                $_SESSION['status'] = "You are Logged in Success!";
                header("Location: admin/index.php");
                exit(0);
            }
            else
            {
                $_SESSION['status'] = "Please verify your Email so that you can login!";
                header("Location: admin_login.php");
                exit(0);
            }
        }
        else
        {
            $_SESSION['status'] = "Invalid Email or Password!";
            header("Location: admin_login.php");
            exit(0);
        }
    }
    else
    {
        $_SESSION['status'] = "All fields are mandatory";
        header("Location: admin_login.php");
        exit(0);
    }
   
}

?>