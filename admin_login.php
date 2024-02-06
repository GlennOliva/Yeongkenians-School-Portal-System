<?php
// Database connection details
session_start();
include('includes/connection.php');

// if(!isset($_SESSION['authenticated']))
// {
//     $_SESSION['status'] = "You are already Logged in";
//     header("Location: admin/index.php");
//     exit(0);
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Form</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   
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
                    <h2 style="text-align: center; font-size: 24px;">ADMIN LOGIN</h2>

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


<form method="POST" action="logincode.php">
    <div class="separator"></div>

    <div class="module__wrapper__form__content__login__field-input js-email">
        <input type="text" name="email" required>
        <label for="lrn">EMAIL</label>
    </div>

    <div class="module__wrapper__form__content__login__field-input js-password">
        <input type="password" name="password" required>
        <label for="password">PASSWORD</label>
    </div>

    <div class="module__wrapper__form__content__login__forgot-pass">
        <a href="forgotpass.php">Forgot password?</a>
    </div>

    <div class="module__wrapper__form__content__login__field-btn">
        <button type="submit" name="login-btn">Login</button>
    </div>

    <div class="module__wrapper__form__content__register">
        <p>Don't have an account? <a href="admin_register.php">Register here as Admin!</a></p>
    </div>

    <div class="module__wrapper__form__content__register">
        <p>Login as Student? <a href="index.php">Student</a> || Login as Teacher? <a href="faculty_login.php">Teacher</a></p>
    </div>

    <div class="module__wrapper__form__content__login__copyright">
        <p>Copyright 2023 &copy GENERAL FLAVIANO YENGKO SENIOR HIGH SCHOOL</p>
    </div>

    <!-- Add the following script at the end, just before the closing </body> tag -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const emailInput = document.querySelector('.js-email input');
            const passwordInput = document.querySelector('.js-password input');

            emailInput.addEventListener('focus', () => {
                focusState(emailInput);
            });

            emailInput.addEventListener('blur', () => {
                blurState(emailInput);
            });

            passwordInput.addEventListener('focus', () => {
                focusState(passwordInput);
            });

            passwordInput.addEventListener('blur', () => {
                blurState(passwordInput);
            });

            function focusState(element) {
                const parentEl = element.parentElement;
                parentEl.classList.add('active');
            }

            function blurState(element) {
                const parentEl = element.parentElement;
                if (!element.value) {
                    parentEl.classList.remove('active');
                }
            }
        });
    </script>
</form>

                    <?php if (!empty($error)): ?>
                        <script>
                            alert("<?php echo $error; ?>");
                        </script>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

     <script src="js/app.js" defer></script>
</body>
</html>


<style>

.module__wrapper__seal__fixed {
  position: fixed;
  width: 580px;
  height: 100%;
  background: url(logo2.png) center no-repeat;
  background-size: cover;
  display: flex;
  align-items: center;
  justify-content: center;
  -webkit-clip-path: polygon(0 0, 75% 0%, 100% 50%, 75% 100%, 0 100%, 0% 50%);
          clip-path: polygon(0 0, 75% 0%, 100% 50%, 75% 100%, 0 100%, 0% 50%);
}</style>