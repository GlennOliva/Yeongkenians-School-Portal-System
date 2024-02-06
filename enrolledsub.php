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
    <title>Enrolled Subject</title>
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
                        Enrolled Subject
                </h4>
                <hr>
            </div>

            <table>
                <tr>
                    <th>ID</th>
                    <th>SUBJECT</th>
                    <th>SECTION</th>
                    <th>TEACHER NAME</th>
                    <th>TIME</th>
                    <th>DAY</th>
                </tr>

                <?php
// Assuming you have stored the student ID in a session variable
if (isset($_SESSION['student_id'])) {
    $student_id = $_SESSION['student_id'];

    // Fetch data from the enrolled_subjects table with JOIN to get section and faculty information
    $query = "SELECT e.*, s.section, f.lastname AS faculty_lastname, f.firstname AS faculty_firstname, f.middlename AS faculty_middlename
              FROM tbl_subject e
              INNER JOIN tbl_student s ON e.student_id = s.id
              INNER JOIN tbl_faculty f ON e.faculty_id = f.id
              WHERE e.student_id = '$student_id'";
    $result = mysqli_query($conn, $query);
    $ids = 1;

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $ids++ . "</td>";
        echo "<td>{$row['subject_name']}</td>";
        echo "<td>{$row['section']}</td>";
        echo "<td>{$row['faculty_lastname']} {$row['faculty_firstname']} {$row['faculty_middlename']}</td>";
        echo "<td>{$row['time']}</td>";
        echo "<td>{$row['day']}</td>";
        echo "</tr>";
    }
}
?>


            </table>

          

            
        </div>
    </section>
</main>






</body>
</html>   