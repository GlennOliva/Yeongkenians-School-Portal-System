<?php
session_start();
include_once('includes/connection.php');

if (isset($_GET['id'])) {
    try {
        $sql = "DELETE FROM tbl_student WHERE id = '" . $_GET['id'] . "'";
        // Use the query method to execute the delete query
        $_SESSION['message'] = ($conn->query($sql)) ? 'Student deleted successfully' : 'Something went wrong. Cannot delete member';
    } catch (PDOException $e) {
        $_SESSION['message'] = $e->getMessage();
    }

    // Close connection
    $conn->close();
} else {
    $_SESSION['message'] = 'Select member to delete first';
}

header('location: manage_students.php');


?>
