<!DOCTYPE html>
<html lang="en">
<?php          session_start(); 
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"> 
    <script src="js/app.js" defer></script>
</head>
<body>
    <section class="module">
        <div class="module__wrapper">
            <div class="module__wrapper__seal">
                <div class="module__wrapper__seal__fixed">
                    <img src="images/logo.png" alt="">
                </div>
            </div>
            <div class="module__wrapper__form">
                <div class="module__wrapper__form__header">
                    <div class="module__wrapper__form__header__border">
                        <img src="images/logo.png" alt="">
                    </div>
                </div>
                <div class="module__wrapper__form__content">
                    <div class="module__wrapper__form__content__title">
                        <h1><span>Hi,</span> Yengkonians!</h1>
                    </div>
                    
                <div><h4><span><i class="fa fa-unlock"></i> Student Forgot Password</h4></div>

                <?php
                        if(isset($_SESSION['status']))
                        {
                            ?>
                                <div class="alert alert-success">
                                    <h5><?=$_SESSION['status'];?></h5>
                                </div>

                            <?php
                            unset($_SESSION['status']);
                        }

                    ?>


                <form action="student-reset-password.php" method="post">
                <div class="module__wrapper__form__content__login__field-input js-email">
                            <input type="text" name="email"  required>
                            <label for="lrn">EMAIL</label>
                </div>
                    
                    <div class="module__wrapper__form__content__login__field-btn">
                        <button type="submit" name="reset_btn">Reset Password</button>
                    </div>
                    <div class="module__wrapper__form__content__register">
                        <p>Log in your account. <a href="index.php">Click here</a> 
                        </p>
                    </div> 

                    </form>