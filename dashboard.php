<?php

session_start();
include('includes/connection.php');

?>

<!DOCTYPE html>
<html lang="en">






<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Dashboard</title>
  </head>
  <body>

  <?php
if(!isset($_SESSION['student_id']))
{
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
            <a href="student-logout.php">
              <span class="ttr-icon"><i class="fa fa-sign-out"></i></span>
            </a>
  
            </div>
      </header>

      <?php
          if (isset($_SESSION['student_id'])) {
            $student_id = $_SESSION['student_id'];
          $sqlCount = "SELECT  * FROM tbl_student WHERE id = '$student_id'";
         
$resultCount = mysqli_query($conn, $sqlCount);
if ($resultCount) {
    // Fetch the count
    $rowCount = mysqli_fetch_assoc($resultCount);
    $year_level = $rowCount['year_level'];
    $student_name = $rowCount['email'];
    $semester = $rowCount['semester'];
    $strand = $rowCount['strand'];
    $grade_level = $rowCount['grade_level'];
    $firstname = $rowCount['firstname'];

} else {
    // Handle the case where the query failed
    echo "Query failed: " . mysqli_error($conn);
}
}
?>
      
  
      <main>
          <!--  include the sidebar-->
            <?php include 'sidebar.php'; ?>
          <section>
      <div class="container-fluid">
        <div>
          <h4>
            <span><i class="fa fa-user-circle"></i>
            Hi <?php echo $firstname;?>  

       
          </h4>
          <hr>
          </div>


          
      
      
      <div class="row">
      <div class="col-md-6 col-log-3 col-xl-3 col-sm-6 col-12">
        <div class="widget-card widget-bg1">
          <div class="wc-item">
            <h4 class="wc-title"><?php echo $year_level;?></h4>
              <span class="wc-des">Current Academic Year</span>
              <span class="wc-stats">
              <i class="fa fa-calendar"></i></span>
              </i>
            </span>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-log-3 col-xl-3 col-sm-6 col-12">
        <div class="widget-card widget-bg2">
          <div class="wc-item">
            <h4 class="wc-title"><?php echo $semester;?></h4>
              <span class="wc-des">Current Semester</span>
              <span class="wc-stats">
              <i class="fa fa-bars"></i></span>
              </i>
            </span>
          </div>
        </div>
      </div>

      <?php
if (isset($_SESSION['student_id'])) {
    $student_id = $_SESSION['student_id'];

    // Fetch student information
    $sqlStudent = "SELECT * FROM tbl_student WHERE id = '$student_id'";
    $resultStudent = mysqli_query($conn, $sqlStudent);

    if ($resultStudent) {
        $rowStudent = mysqli_fetch_assoc($resultStudent);
        $year_level = $rowStudent['year_level'];
        $student_name = $rowStudent['email'];
        $semester = $rowStudent['semester'];
        $strand = $rowStudent['strand'];
        $grade_level = $rowStudent['grade_level'];
    } else {
        // Handle the case where the query failed
        echo "Query failed for student information: " . mysqli_error($conn);
    }

    // Fetch enrollment status
    $sqlEnroll = "SELECT * FROM tbl_subject WHERE student_id = '$student_id'";
    $resultEnroll = mysqli_query($conn, $sqlEnroll);

    if ($resultEnroll) {
        // Check if there are any rows
        if ($rowEnroll = mysqli_fetch_assoc($resultEnroll)) {
            $status = $rowEnroll['status'];
        } else {
            // Set the status to "Not Enrolled" if no results were found
            $status = "Not Enrolled";
        }
    } else {
        // Handle the case where the query failed
        echo "Query failed for enrollment status: " . mysqli_error($conn);
    }
}
?>

<div class="col-md-6 col-log-3 col-xl-3 col-sm-6 col-12">
    <div class="widget-card widget-bg3">
        <div class="wc-item">
            <h4 class="wc-title"><?php echo $status; ?></h4>
            <span class="wc-des">Status</span>
            <span class="wc-stats">
                <i class="fa <?php echo ($status == 'Not Enrolled') ? 'fa-times-circle-o' : 'fa-check-circle-o'; ?>"></i>
            </span>
        </div>
    </div>
</div>


      <div class="col-md-6 col-log-3 col-xl-3 col-sm-6 col-12">
        <div class="widget-card widget-bg4">
          <div class="wc-item">
            <h4 class="wc-title"><?php echo $strand?> - <?php echo $grade_level;?></h4>
              <span class="wc-des">Strand & Grade Level</span>
              <span class="wc-stats">
              <i class="fa fa-graduation-cap"></i></span>
              </i>
            </span>
          </div>
        </div>
      </div>
    </section>
  </main>
</body>
</html>