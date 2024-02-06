
<?php
// Handle form submission for editing
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editID'])) {

    $conn = new mysqli("localhost", "root", "", "student");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Assuming the form data is submitted
    $editID = $_POST['editID'];
    $editSubjects = $conn->real_escape_string($_POST['editSubjects']);
    $editSchedcode = $conn->real_escape_string($_POST['editSchedcode']);
    $editSection = $conn->real_escape_string($_POST['editSection']);
    $editInstructor = $conn->real_escape_string($_POST['editInstructor']);
    $editSchedule = $conn->real_escape_string($_POST['editSchedule']);
    $editYears = $conn->real_escape_string($_POST['editYears']);

    // Update the record in the database
    $sql = "UPDATE enrolled_subjects 
            SET subject_name = '$editSubjects', 
                schedcode = '$editSchedcode', 
                section = '$editSection', 
                instructor = '$editInstructor', 
                schedule = '$editSchedule', 
                year = '$editYears' 
            WHERE id = $editID";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        header('Location: manage_schedule.php');
    } else {
        echo "Error updating record: " . $conn->error;
        header('Location: manage_schedule.php');
    }

    // Close the database connection
    $conn->close();
}
?>
