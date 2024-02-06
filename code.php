<?php
session_start();
include('./includes/connection.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';


function sendemail_verify($email, $full_name, $verify_token)
{
    $mail = new PHPMailer(true);

        // Enable verbose debug output
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;

        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'clientportal54@gmail.com';
        $mail->Password   = 'yyqp pbgt mkbz vgys'; 
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('clientportal54@gmail.com', $full_name);
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Email verification for admin';

        $email_template = "
        <h2>You have registered as Admin</h2>
        <h5>Verify your email address to Login with the below given link</h5>
        <br/><br/>
        <a href='http://localhost/student/verify-email.php?token=$verify_token'>Click this!</a>
        ";

        $mail->Body = $email_template;
        $mail->send();
        echo 'Message has been sent';
    
}


if(isset($_POST['register_btn']))
{
    $full_name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    $verify_token = md5(rand());
    // sendemail_verify("$email","$full_name","$verify_token");
    // echo "sent!";

    // email exist or not
    $check_email_query = "SELECT email FROM tbl_admin WHERE email='$email' LIMIT 1";
    $res = mysqli_query($conn, $check_email_query);

   if(mysqli_num_rows($res))
   {
        $_SESSION['status'] = "Email already Exist";
        header("location: admin_register.php");
   }
   else
   {
        $sql = "INSERT INTO tbl_admin (email,full_name,phone,password,confirm_password,verify_token) VALUES ('$email','$full_name','$mobile','$password','$confirm','$verify_token')";
        $res2 = mysqli_query($conn,$sql);

        if($res2 == true)
        {
            sendemail_verify("$email","$full_name","$verify_token");
            $_SESSION['status'] = "Registration Successfully! please verify your email addresss";
        header("location: admin_register.php");
        }
        else
        {
            $_SESSION['status'] = "Registration failed";
        header("location: admin_register.php");
        }
   }
    
}
?>