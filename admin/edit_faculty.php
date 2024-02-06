<?php
session_start();
include_once('connection.php');

if (isset($_POST['edit'])) {
    $database = new Connection();
    $db = $database->open();
    try {
        $id = $_GET['id'];
        $full_name = $_POST['full_name'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $birth_date = $_POST['birth_date'];
        $contact_number = $_POST['contact_number'];
        $civil_status = $_POST['civil_status'];
        $address = $_POST['address'];
        $religion = $_POST['religion'];

        $sql = "UPDATE faculty SET 
                full_name = :full_name,
                gender = :gender,
                email = :email,
                birth_date = :birth_date,
                contact_number = :contact_number,
                civil_status = :civil_status,
                address = :address,
                religion = :religion
                WHERE id = :id";

        $stmt = $db->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':full_name', $full_name);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':birth_date', $birth_date);
        $stmt->bindParam(':contact_number', $contact_number);
        $stmt->bindParam(':civil_status', $civil_status);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':religion', $religion);
        $stmt->bindParam(':id', $id);

        // Execute the statement
        $stmt->execute();

        $_SESSION['message_faculty'] = $stmt->rowCount() ? 'Faculty information updated successfully' : 'No changes were made';
    } catch (PDOException $e) {
        $_SESSION['message_faculty'] = $e->getMessage();
    } finally {
        // Close connection
        $database->close();
    }
} else {
    $_SESSION['message'] = 'Fill up the edit form first';
}

header('location: faculty.php');
?>
