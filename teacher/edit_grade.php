<?php
// edit_grades.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have a database connection
    $conn = new mysqli("localhost", "root", "", "student");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get data from the edit form
    $gradesID = $_POST["gradesEditID"];
    $studentID = $_POST["gradesEditStudentID"];
    $subject = $_POST["gradesEditSubject"];
    $firstGrading = $_POST["gradesEdit1stGrading"];
    $secondGrading = $_POST["gradesEdit2ndGrading"];
    $thirdGrading = $_POST["gradesEdit3rdGrading"];
    $fourthGrading = $_POST["gradesEdit4thGrading"];
    $average = $_POST["gradesEditAverage"];
    $remarks = $_POST["gradesEditRemarks"];

    // Validate and sanitize input if needed

    // Update the record in the grades table
    $sql = "UPDATE grades SET student_id='$studentID', subject='$subject', 1st_grading='$firstGrading', 
            2nd_grading='$secondGrading', 3rd_grading='$thirdGrading', 4th_grading='$fourthGrading', 
            average='$average', remarks='$remarks' WHERE id='$gradesID'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
