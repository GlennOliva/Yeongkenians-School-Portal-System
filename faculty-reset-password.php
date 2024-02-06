<?php
include('includes/connection.php');
session_start();


//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function send_pasword_reset($get_name, $get_email , $token)
{       
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'clientportal54@gmail.com';
        $mail->Password   = 'yyqp pbgt mkbz vgys';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('clientportal54@gmail.com', $get_name);
        $mail->addAddress($get_email);
        $mail->isHTML(true);
        $mail->Subject = 'Reset Password';

        $email_template = "
        <h2>You have registered as Faculty</h2>
        <h5>You are receiving this email because we received a password reset request for your account!</h5>
        <br/><br/>
        <a href='http://localhost/student/faculty-password-change.php?token=$token&email=$get_email'>Click this!</a>
        ";

        $mail->Body = $email_template;
        $mail->send();
        echo 'Message has been sent';

}

if(isset($_POST['reset_btn']))
{
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $token = md5(rand());


    $check_email = "SELECT * FROM tbl_faculty WHERE email = '$email' LIMIT 1";
    $res = mysqli_query($conn,$check_email);

    if(mysqli_num_rows($res) > 0)
    {
        $row = mysqli_fetch_array($res);
        $get_name = $row['firstname'];
        $get_email = $row['email'];

        $update_token = "UPDATE tbl_faculty SET verify_token = '$token' WHERE email = '$get_email' LIMIT 1";
        $res2 = mysqli_query($conn,$update_token);

        if($res2 == true)
        {
            send_pasword_reset($get_name, $get_email , $token);
            $_SESSION['status'] = "We emailed you reset password to your gmail!";
            header("Location: faculty-forgotpass.php");
            exit(0);
        }
        else
        {
            $_SESSION['status'] = "Something went wrong";
            header("Location: faculty-forgotpass.php");
            exit(0);
        }
    }
    else
    {
        $_SESSION['status'] = "No Email Found!";
        header("Location: faculty-forgotpass.php");
        exit(0);
    }
}
else
{

}


if(isset($_POST['updatepass_btn']))
{
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm = mysqli_real_escape_string($conn, $_POST['confirm']);
    $token = mysqli_real_escape_string($conn, $_POST['password_token']);

    if(!empty($token))
    {
        if(!empty($email) && !empty($password) && !empty($confirm))
        {
            // Process password update
            $check_token = "SELECT verify_token FROM tbl_faculty WHERE verify_token = '$token' LIMIT 1";
            $check_token_res = mysqli_query($conn,$check_token);

            if(mysqli_num_rows($check_token_res) > 0)
            {
                if($password == $confirm)
                {
                    $update_password = "UPDATE tbl_faculty SET password = '$password' WHERE verify_token = '$token' LIMIT 1";
                    $update_password_run = mysqli_query($conn,$update_password);

                    if($update_password_run)
                    {
                        $_SESSION['status'] = "Updated password successfully!";
                        header("Location: faculty_login.php");
                        exit(0);
                    }
                    else
                    {
                        $_SESSION['status'] = "Did not update the password!";
                        header("Location: faculty-password-change.php?token=$token&email=$email");
                        exit(0);
                    }
                }
                else
                {
                $_SESSION['status'] = "Password and Confirm Password not match";
                header("Location: faculty-password-change.php?token=$token&email=$email");
                exit(0);
                }
            }
            else
            {
                $_SESSION['status'] = "Invalid token!";
                header("Location: faculty-password-change.php?token=$token&email=$email");
                exit(0);
            }
        }
        else
        {
            // Handle the case where password or confirm is empty
            $_SESSION['status'] = "All fielsd are required!";
        header("Location: faculty-password-change.php?token=$token&email=$email");
        exit(0);
        }
    }
    else
    {
        $_SESSION['status'] = "No Token Available!";
        header("Location: faculty-password-change.php");
        exit(0);
    }
}




?>