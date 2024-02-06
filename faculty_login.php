<?php
// Database connection details
session_start();
include('includes/connection.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Login Form</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"> 
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
                    <h2 style="text-align: center; font-size: 24px;">FACULTY LOGIN</h2>
                    <form method="POST">
    <div class="module__wrapper__form__content__login__field-select">
        <!-- <select name="module" id="module">
            <option value="">Admin</option>
            <option value="">Faculty</option>
            <option value="">Student</option>
        </select> -->
    </div>
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
                            <a href="faculty-forgotpass.php">Forgot password?</a>
                        </div>




    <div class="module__wrapper__form__content__login__field-btn">
        <button type="submit" name="faculty_login">Login</button>
    </div>

    <div class="module__wrapper__form__content__register">
        <p>Login as Admin? <a href="admin_login.php">Admin</a> || Login as Student? <a href="index.php">Student</a></p>
    </div>

    <div class="module__wrapper__form__content__login__copyright">
        <p>Copyright 2023 &copy GENERAL FLAVIANO YENGKO SENIOR HIGH SCHOOL</p>
    </div>

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


    <?php


    //check if the submit button is clicked or not
    if(isset($_POST['faculty_login']))
    {
        $username = $_POST['email'];
        $password = $_POST['password'];

        //sql to check the user with username and password exists or not
        $sql = "SELECT * FROM tbl_faculty WHERE email = '$username' AND password = '$password'";

        //execute the sql queery
        $result = mysqli_query($conn,$sql);

        //count the rows 
        $count = mysqli_num_rows($result);

        if($count==1)
        {

            $row = mysqli_fetch_assoc($result);
            $_SESSION['faculty_id'] = $row['id'];
            
            //user is exist
            echo '<script>
            swal({
                title: "Success",
                text: "Login Successfully",
                icon: "success"
            }).then(function() {
                window.location = "./FACULTY/index.php";
            });
        </script>';

       



       
        
        exit;

        }
        else{
            //user not available
            echo '<script>
            swal({
                title: "Error",
                text: "Username or Password did not match",
                icon: "error"
            }).then(function() {
                window.location = "faculty_login.php";
            });
        </script>';
        
        exit;
        }
    }

?>
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