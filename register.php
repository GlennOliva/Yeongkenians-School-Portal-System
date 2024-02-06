<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$error = "";
$lrnnumberValue = isset($_POST["lrnnumber"]) ? $_POST["lrnnumber"] : "";
$emailValue = isset($_POST["email"]) ? $_POST["email"] : "";
$mobileValue = isset($_POST["mobile"]) ? $_POST["mobile"] : "";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $lrnnumber = $_POST["lrnnumber"];
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];
    $password = $_POST["password"];
    $confirm = $_POST["confirm"];

    // Check if password and confirm password match
    if ($password !== $confirm) {
        $error = "Error: Password and Confirm Password do not match.";
    } else {
        // Check if LRN and email already exist
        $checkExistingQuery = "SELECT id, lrn, email FROM users WHERE lrn = '$lrnnumber' OR email = '$email'";
        $result = $conn->query($checkExistingQuery);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if ($row["lrn"] === $lrnnumber && $row["email"] === $email) {
                $error = "Error: LRN and Email already exist. Choose different LRN and Email.";
            } elseif ($row["lrn"] === $lrnnumber) {
                $error = "Error: LRN already exists. Choose a different LRN.";
            } elseif ($row["email"] === $email) {
                $error = "Error: Email already exists. Choose a different Email.";
            }
        } else {
            // Hash the password for security (you should use a more secure hashing method)
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert data into the database
            $sql = "INSERT INTO users (lrn, email, contact_number, password, confirm_password, type)
                    VALUES ('$lrnnumber', '$email', '$mobile', '$hashedPassword', '$hashedPassword', 'user')"; // Assuming 'user' is the default type

            if ($conn->query($sql) === TRUE) {
                // Registration successful, you can also redirect using JavaScript if needed
                echo "<script>alert('Registration successful!');</script>";
                header('Location: index.php');
            } else {
                $error = "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}

// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
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
                    
                    <div><h4><span><i class="fa fa-user-plus"></i> Register your account</h4></div>
                    <form method="POST">
                        <div class="module__wrapper__form__content__login__field-input js-username">
                            <input type="text" name="lrnnumber" value="<?php echo $lrnnumberValue; ?>" required>
                            <label for="lrnnumber">LRN Number</label>
                        </div>
                        <div class="module__wrapper__form__content__login__field-input js-email">
                            <input type="text" name="email" value="<?php echo $emailValue; ?>" required>
                            <label for="email">Email Address</label>
                        </div>
                        <div class="module__wrapper__form__content__login__field-input js-mobile">
                            <input type="text" name="mobile" value="<?php echo $mobileValue; ?>" required>
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
                            <button type="submit">Register</button>
                        </div>
                    </form>

                    <div class="module__wrapper__form__content__register">
                        <p>Log in to your account. <a href="index.php">Click here</a></p>
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