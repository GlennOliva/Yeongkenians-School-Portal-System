<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have a database connection
    $conn = new mysqli("localhost", "root", "", "student");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the ID to be deleted
    $deleteID = $_POST['deleteID'];

    // SQL to delete the record
    $sql = "DELETE FROM enrolled_subjects WHERE id = '$deleteID'";

    if ($conn->query($sql) === TRUE) {
        // Record deleted successfully
        echo "Record deleted successfully";
        header('Location: manage_schedule.php');
    } else {
        // Error deleting record
        echo "Error deleting record: " . $conn->error;
        header('Location: manage_schedule.php');
    }   

    // Close the database connection
    $conn->close();
}
?>
