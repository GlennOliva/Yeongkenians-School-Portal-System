<?php
// delete_grades.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have a database connection
    $conn = new mysqli("localhost", "root", "", "student");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the grades ID to delete
    $gradesID = $_POST["gradesDeleteID"];

    // Delete the record from the grades table
    $sql = "DELETE FROM grades WHERE id='$gradesID'";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
        header('Location: manage_grades.php');
    } else {
        echo "Error deleting record: " . $conn->error;
        header('Location: manage_grades.php');
    }

    // Close the database connection
    $conn->close();
}
?>
