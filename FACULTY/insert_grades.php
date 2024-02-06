<?php
// Assuming you have a database connection established
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure arrays are not empty
    if (!empty($_POST['student_id'])) {
        // Get the count of rows
        $rowCount = count($_POST['student_id']);

        // Loop through the rows
        for ($i = 0; $i < $rowCount; $i++) {
            $instructor = $_POST['instructor'][$i];
            $student_id = $_POST['student_id'][$i];
            $subject = $_POST['subject'][$i];
            $first_grading = $_POST['1st_grading'][$i];
            $second_grading = $_POST['2nd_grading'][$i];
            $third_grading = $_POST['3rd_grading'][$i];
            $fourth_grading = $_POST['4th_grading'][$i];
            $average = $_POST['average'][$i];
            $remarks = $_POST['remarks'][$i];

            $sql = "INSERT INTO grades (instructor, student_id, subject, 1st_grading, 2nd_grading, 3rd_grading, 4th_grading, average, remarks) 
                    VALUES ('$instructor', '$student_id', '$subject', '$first_grading', '$second_grading', '$third_grading', '$fourth_grading', '$average', '$remarks')";
            
            if ($conn->query($sql) !== TRUE) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        echo "Grades added successfully";
        header('Location: manage_grades.php');
    } else {
        echo "No data submitted.";
        header('Location: manage_grades.php');
    }
}

$conn->close();
?>
