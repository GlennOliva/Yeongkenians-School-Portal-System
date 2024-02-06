<?php
session_start();
include_once('includes/connection.php');

if (isset($_GET['id'])) {
    try {
        $sql = "DELETE FROM tbl_subject WHERE id = '" . $_GET['id'] . "'";
        // Use the query method to execute the delete query
        $_SESSION['message'] = ($conn->query($sql)) ? 'Subject deleted successfully' : 'Something went wrong. Cannot delete member';
    } catch (PDOException $e) {
        $_SESSION['message'] = $e->getMessage();
    }

    // Close connection
    $conn->close();
} else {
    $_SESSION['message'] = 'Select member to delete first';
}

header('location: manage-subject.php');


?>
