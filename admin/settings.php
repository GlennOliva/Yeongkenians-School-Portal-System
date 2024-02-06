<?php
session_start();

// Include your connection file and any necessary functions
include('includes/connection.php');


?>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/settings.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Settings</title>
</head>
<body>
    <header>
        <img src="images/logo.png" alt="">
        <a href="studenthome.html">ADMIN PORTAL</a>
        <div class="logout">
            <a href="index.php">
                <span class="ttr-icon"><i class="fa fa-sign-out"></i></span>
            </a>
        </div>
    </header>

    <main>
        <!-- Include the sidebar -->
        <?php include 'sidebar.php'; ?>

        <section>
            <div class="container-fluid">
                <div>
                    <h4>
                        <span><i class="fa fa-gear"></i>
                        Settings
                    </h4>
                    <hr>
                </div>
                <form method="post">
                    <h3>Change Password</h3>
                    <?php if (isset($error)) : ?>
                        <div class="error"><?php echo $error; ?></div>
                    <?php endif; ?>
                    <div class="module__wrapper__form__content__login__field-input js-currentpass">
                        <label for="currentpass">Enter Current Password</label>
                        <input type="password" name="currentpass" required>
                    </div>
                    <div class="module__wrapper__form__content__login__field-input js-newpass">
                        <label for="newpass">Enter New Password</label>
                        <input type="password" name="newpass" required>
                    </div>
                    <div class="module__wrapper__form__content__login__field-input js-confirmpass">
                        <label for="password">Confirm New Password</label>
                        <input type="password" name="confirmnewpass" required>
                    </div>


                      <div class="module__wrapper__form__content__login__field-input js-currentpass">
                        <label for="currentpass">Enter Current Email</label>
                        <input type="text" name="currentemail" required>
                    </div>
                    <div class="module__wrapper__form__content__login__field-input js-newpass">
                        <label for="newpass">Enter New Email</label>
                        <input type="text" name="newemail" required>
                    </div>
                    <div class="module__wrapper__form__content__login__field-input js-confirmpass">
                        <label for="password">Confirm New Email</label>
                        <input type="text" name="confirmemail" required>
                    </div>


                    
                    <div>
                        <button type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <!-- Include the SweetAlert script here -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>
</html>



<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the form is submitted

    // Validate the form fields (you may need to add more validation)
    $currentPassword = mysqli_real_escape_string($conn, $_POST['currentpass']);
    $newPassword = mysqli_real_escape_string($conn, $_POST['newpass']);
    $confirmNewPassword = mysqli_real_escape_string($conn, $_POST['confirmnewpass']);
    $currentEmail = mysqli_real_escape_string($conn, $_POST['currentemail']);
    $newEmail = mysqli_real_escape_string($conn, $_POST['newemail']);
    $confirmEmail = mysqli_real_escape_string($conn, $_POST['confirmemail']);

    // Access admin details from the session
    $adminDetails = $_SESSION['auth_admin'];
    $adminId = $adminDetails['id'];

    // Validate the current password (you might want to enhance this with actual password hashing)
    // For demonstration purposes, I'm assuming plain text passwords here
    $sql = "SELECT * FROM tbl_admin WHERE id = '$adminId' AND password = '$currentPassword' AND email = '$currentEmail'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Current password and email are correct

        // Validate and compare new password and confirm new password
        if ($newPassword === $confirmNewPassword) {
            // Update the password and email in the database
            $updateSql = "UPDATE tbl_admin SET password = '$newPassword', email = '$newEmail' WHERE id = '$adminId'";
            mysqli_query($conn, $updateSql);

            echo '<script>
                swal({
                    title: "Success",
                    text: "Password and Email Successfully Updated",
                    icon: "success"
                }).then(function() {
                    window.location = "settings.php";
                });
            </script>';
            exit;
        } else {
            echo '<script>
                swal({
                    title: "Error",
                    text: "New Password and Confirm Password Didn\'t match",
                    icon: "error"
                }).then(function() {
                    window.location = "settings.php";
                });
            </script>';
            exit;
        }
    } else {
        echo '<script>
            swal({
                title: "Error",
                text: "Current Password or Email is Incorrect",
                icon: "error"
            }).then(function() {
                window.location = "settings.php";
            });
        </script>';
        exit;
    }
}
?>
