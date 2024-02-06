<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


// Check connection

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize error variable
$error = "";

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
        echo "<script>alert('Error: Password and confirm password does not match'); window.location.href = 'register.php';</script>";
    } else {
        // Check if LRN already exists
        $checkLrnQuery = "SELECT id FROM users WHERE lrn = '$lrnnumber'";
        $result = $conn->query($checkLrnQuery);

        if ($result->num_rows > 0) {
            $error = "Error: LRN already exists. Choose a different LRN.";
            echo "<script>alert('Error: LRN already exists. Choose a different LRN'); window.location.href = 'register.php';</script>";
            exit();
        } else {
            // Hash the password for security (you should use a more secure hashing method)
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert data into the database
            $sql = "INSERT INTO users (lrn, email, contact_number, password, confirm_password, type)
                    VALUES ('$lrnnumber', '$email', '$mobile', '$hashedPassword', '$confirm', 'user')"; // Assuming 'user' is the default type

            if ($conn->query($sql) === TRUE) {
                // Registration successful, you can also redirect using JavaScript if needed
                echo "<script>alert('Registration successful!'); window.location.href = 'login.php';</script>";
                exit();
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
<!-- ... (your HTML code) ... -->
<body>
    <!-- ... (your HTML code) ... -->

    <!-- Display error message if there is an error -->
    <?php if (!empty($error)): ?>
        <script>
            alert("<?php echo $error; ?>");
        </script>
    <?php endif; ?>
</body>
</html>