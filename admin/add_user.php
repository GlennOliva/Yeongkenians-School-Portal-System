<?php
session_start();
include_once('connection.php');

if (isset($_POST['add'])) {
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm'];

    // Check if password and confirm password match
    if ($password !== $confirmPassword) {
        $_SESSION['message'] = 'Error: Password and Confirm Password do not match.';
        header('location: manage_users.php?alert=' . urlencode($_SESSION['message']));
        exit();
    }

    $database = new Connection();
    $db = $database->open();

    try {
        // Check if the email already exists
        $checkEmailQuery = "SELECT COUNT(*) as count FROM users WHERE email = :email";
        $checkEmailStmt = $db->prepare($checkEmailQuery);
        $checkEmailStmt->bindParam(':email', $_POST['email']);
        $checkEmailStmt->execute();
        $result = $checkEmailStmt->fetch(PDO::FETCH_ASSOC);

        if ($result['count'] > 0) {
            $_SESSION['message'] = 'Error: Email already exists. Choose a different email.';
        } else {
            // Email is not found, proceed with user insertion

            $stmt = $db->prepare("INSERT INTO users (type, lrn, email, contact_number, password, confirm_password, status) 
                VALUES (:type, :lrn, :email, :contact_number, :password, :confirm_password, :status)");

            // Hash the password using a secure hashing algorithm (e.g., bcrypt)
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $_SESSION['message'] = ($stmt->execute(array(
                ':type' => $_POST['type'],
                ':lrn' => $_POST['lrn'],
                ':email' => $_POST['email'],
                ':contact_number' => $_POST['contact_number'],
                ':password' => $hashedPassword,
                ':confirm_password' => $hashedPassword,
                ':status' => 'active' // You might want to customize this based on your requirements
            ))) ? 'User added successfully' : 'Something went wrong. Cannot add user';
        }
    } catch (PDOException $e) {
        $_SESSION['message'] = $e->getMessage();
    }

    // Close connection
    $database->close();

    // Redirect with a query parameter
    header('location: manage_users.php?alert=' . urlencode($_SESSION['message']));
    exit();
} else {
    $_SESSION['message'] = 'Fill up the add form first';
    header('location: manage_users.php?alert=' . urlencode($_SESSION['message']));
    exit();
}
?>
