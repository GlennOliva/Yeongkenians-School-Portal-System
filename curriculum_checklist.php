<!DOCTYPE html>
<html lang="en">
<?php          session_start(); 
include('includes/connection.php');
?>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/enrolledsub.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Currciulum Checklist</title>
  </head>
  <body>


  <?php
if(!isset($_SESSION['student_id']))
{
  $student_id = $_SESSION['student_id'];
    echo '<script>
                                    swal({
                                        title: "Error",
                                        text: "You must login first before you proceed!",
                                        icon: "error"
                                    }).then(function() {
                                        window.location = "index.php";
                                    });
                                </script>';
                                exit;
}

?>
  
      <header>
          <img src="images/logo.png" alt="">
          <a href="studenthome.html">STUDENT PORTAL</a>
          <div class="logout">
            <a href="index.php">
              <span class="ttr-icon"><i class="fa fa-sign-out"></i></span>
            </a>
  
            </div>
      </header>
  
      <main>
    <!-- include the sidebar -->
    <?php include 'sidebar.php'; ?>

    <section>
        <div class="container-fluid">
            <div>
                <h4>
                    <span><i class="fa fa-book"></i>
                        Curriculum Checklist
                </h4>
                <hr>
            </div>

            <table>
                <tr>
                    <th>ID</th>
                    <th>SUBJECT</th>
                    <th>SECTION</th>
                    <th>INSTRUCTOR ID:</th>
                    <th>TIME</th>
                    <th>DAY</th>
                </tr>

                <?php
// Assuming you have stored the student ID in a session variable
if (isset($_SESSION['student_id'])) {
    $student_id = $_SESSION['student_id'];

    // Fetch data from the enrolled_subjects table with JOIN to get section and faculty information
    $query = "SELECT e.*, s.section, f.lastname AS faculty_lastname, f.firstname AS faculty_firstname, f.middlename AS faculty_middlename
              FROM tbl_enroll e
              INNER JOIN tbl_student s ON e.student_id = s.id
              INNER JOIN tbl_faculty f ON e.faculty_id = f.id
              WHERE e.student_id = '$student_id'";
    $result = mysqli_query($conn, $query);
    $ids = 1;

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $ids++ . "</td>";
        echo "<td>{$row['subject']}</td>";
        echo "<td>{$row['section']}</td>";
        echo "<td>{$row['faculty_lastname']} {$row['faculty_firstname']} {$row['faculty_middlename']}</td>";
        echo "<td>{$row['time']}</td>";
        echo "<td>{$row['day']}</td>";
        echo "</tr>";
    }
}
?>


            </table>

            <!-- Submit Final Button -->
            <form method="post" style="text-align: center; margin-top: 3%;" onsubmit="return disableButton()">
                <button type="submit" name="submit_final" class="btn btn-success" id="finalSubmitButton" style="margin: 0 auto; background-color: green; color: white; font-size: 18px; padding: 10px; border-radius: 12px; cursor: pointer;">
                    <span class="glyphicon glyphicon-check"></span> Submit Final
                </button>
            </form>

            <?php
            // Check if the Submit Final button is clicked
            if (isset($_POST['submit_final'])) {
                // Fetch data from the enrolled_subjects table
                $query = "SELECT * FROM tbl_enroll WHERE student_id = '$student_id'";
                $result = mysqli_query($conn, $query);

                // Check if there are any rows fetched
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Insert data into tbl_finalenroll for each enrolled subject
                        $insertQuery = "INSERT INTO tbl_finalenroll (student_id, code_number, subject, strand, faculty_id, time, day, enroll_status) 
                                        VALUES ('$student_id', '{$row['code_number']}', '{$row['subject']}', '{$row['strand']}', '{$row['faculty_id']}', '{$row['time']}', '{$row['day']}', 'Enrolled')";

                        // Execute the insert query
                        $insertResult = mysqli_query($conn, $insertQuery);

                        // Check if the query was successful
                        if (!$insertResult) {
                            echo '<script>
                                    swal({
                                        title: "Error",
                                        text: "Enrollment Failed!",
                                        icon: "error"
                                    }).then(function() {
                                        window.location = "curriculum_checklist.php";
                                    });
                                </script>';
                            exit;
                        }
                    }

                    // All enrollments were successful
                    echo '<script>
                            swal({
                                title: "Success",
                                text: "Enrollment Successful!",
                                icon: "success"
                            }).then(function() {
                                window.location = "curriculum_checklist.php";
                            });
                        </script>';
                    exit;
                } else {
                    echo "No schedule data found for the student.";
                }
            }
            ?>
        </div>
    </section>
</main>






</body>
</html>   