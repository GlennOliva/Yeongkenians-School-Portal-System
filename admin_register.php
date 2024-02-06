<?php

include('./includes/connection.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
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

                    <div><h4><span><i class="fa fa-user-plus"></i> Register Admin Account</h4></div>


                    <?php
                        if(isset($_SESSION['status']))
                        {
                            echo "<h4>".$_SESSION['status']."</h4>";
                            unset($_SESSION['status']);
                        }

                    ?>
                  <form method="POST" action="code.php">
    <div class="module__wrapper__form__content__login__field-input js-name">
        <input type="text" name="name" value="" required>
        <label for="name">Full Name</label>
    </div>

    <div class="module__wrapper__form__content__login__field-input js-email">
        <input type="text" name="email" value="" required>
        <label for="email">Email Address</label>
    </div>

    <div class="module__wrapper__form__content__login__field-input js-mobile">
        <input type="text" name="mobile" value="" required>
        <label for="mobile">Mobile Number</label>
    </div>

    <div class="module__wrapper__form__content__login__field-input js-password">
        <input type="password" name="password" required>
        <label for="password">Password</label>
    </div>

    <div class="module__wrapper__form__content__login__field-input js-confirm">
        <input type="password" name="confirm" required>
        <label for="confirm">Confirm Password</label>
    </div>

    <div class="module__wrapper__form__content__login__field-btn">
        <button type="submit" name="register_btn">Register</button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const nameInput = document.querySelector('.js-name input');
            const emailInput = document.querySelector('.js-email input');
            const mobileInput = document.querySelector('.js-mobile input');
            const passwordInput = document.querySelector('.js-password input');
            const confirmInput = document.querySelector('.js-confirm input');

            nameInput.addEventListener('focus', () => {
                focusState(nameInput);
            });

            nameInput.addEventListener('blur', () => {
                blurState(nameInput);
            });

            emailInput.addEventListener('focus', () => {
                focusState(emailInput);
            });

            emailInput.addEventListener('blur', () => {
                blurState(emailInput);
            });

            mobileInput.addEventListener('focus', () => {
                focusState(mobileInput);
            });

            mobileInput.addEventListener('blur', () => {
                blurState(mobileInput);
            });

            passwordInput.addEventListener('focus', () => {
                focusState(passwordInput);
            });

            passwordInput.addEventListener('blur', () => {
                blurState(passwordInput);
            });

            confirmInput.addEventListener('focus', () => {
                focusState(confirmInput);
            });

            confirmInput.addEventListener('blur', () => {
                blurState(confirmInput);
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


                    <div class="module__wrapper__form__content__register">
                        <p>Log in to your account. <a href="admin_login.php">Click here</a></p>
                    </div>  
                    <?php if (!empty($error)): ?>
                        <script>
                            alert("<?php echo $error; ?>");
                        </script>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
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



