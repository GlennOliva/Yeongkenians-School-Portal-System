<?php
session_start();
include_once('connection.php');

if (isset($_POST['edit'])) {
    $database = new Connection();
    $db = $database->open();
    try {
        $id = $_GET['id'];
        $lrn = $_POST['lrn'];
        $email = $_POST['email'];
        $contact_number = $_POST['contact_number'];
        $type = $_POST['type'];
        $status = $_POST['status'];

        $sql = "UPDATE users SET 
                lrn = :lrn,
                email = :email,
                contact_number = :contact_number,
                type = :type,
                status = :status
                WHERE id = :id";

        $stmt = $db->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':lrn', $lrn);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':contact_number', $contact_number);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);

        // Execute the statement
        $stmt->execute();

        $_SESSION['message_user'] = $stmt->rowCount() ? 'User information updated successfully' : 'No changes were made';
    } catch (PDOException $e) {
        $_SESSION['message_user'] = $e->getMessage();
    } finally {
        // Close connection
        $database->close();
    }
} else {
    $_SESSION['message_user'] = 'Fill up the edit form first';
}

header('location: manage_users.php');
?>
