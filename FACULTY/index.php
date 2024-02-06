<!DOCTYPE html>
<html lang="en">
  <?php  session_start();
  include('includes/connection.php'); 
?>
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
if(!isset($_SESSION['faculty_id']))
{
    echo '<script>
                                    swal({
                                        title: "Error",
                                        text: "You must login first before you proceed!",
                                        icon: "error"
                                    }).then(function() {
                                        window.location = "../faculty_login.php";
                                    });
                                </script>';
                                exit;
}

?>
  
      <header>
          <img src="logo.png" alt="">
          <a href="faculty.html">FACULTY PORTAL</a>
          <div class="logout">
            <a href="logout.php">
              <span class="ttr-icon"><i class="fa fa-sign-out"></i></span>
            </a>
  
            </div>
      </header>
  
      <main>

        <?php include 'sidebar.php'; ?>


        <?php
          if (isset($_SESSION['faculty_id'])) {
            $faculty_id = $_SESSION['faculty_id'];
          $sqlCount = "SELECT  * FROM tbl_faculty WHERE id = '$faculty_id'";
         
$resultCount = mysqli_query($conn, $sqlCount);
if ($resultCount) {
    // Fetch the count
    $rowCount = mysqli_fetch_assoc($resultCount);
    $email = $rowCount['email'];
    $firstname = $rowCount['firstname'];

} else {
    // Handle the case where the query failed
    echo "Query failed: " . mysqli_error($conn);
}
}
?>
         
          <section>
      <div class="container-fluid">
        <div>
          <h4>
            <span><i class="fa fa-user-circle"></i>
            Hi, <?php echo $firstname;?>    
            
          </h4>
          <hr>
          </div>
      
      <div class="row">
      <div class="col-md-6 col-log-3 col-xl-3 col-sm-6 col-12">
        <div class="widget-card widget-bg1">
          <div class="wc-item">
            <h4 class="wc-title">2023-2024</h4>
              <span class="wc-des">Current Academic Year</span>
              <span class="wc-stats">
              <i class="fa fa-calendar"></i></span>
              </i>
            </span>
          </div>
        </div>

        
      </div>

      
      <?php
if (isset($_SESSION['faculty_id'])) {
    $faculty_id = $_SESSION['faculty_id'];
    $sqlCount = "SELECT COUNT(*) as subject_count FROM tbl_subject WHERE faculty_id = '$faculty_id'";
    
    $resultCount = mysqli_query($conn, $sqlCount);

    if ($resultCount) {
        // Fetch the count
        $row = mysqli_fetch_assoc($resultCount);
        $subject_name= $row['subject_count'];
    } else {
        // Handle the case where the query failed
        echo "Query failed: " . mysqli_error($conn);
    }
}
?>


      <div class="col-md-6 col-log-3 col-xl-3 col-sm-6 col-12">
        <div class="widget-card widget-bg1">
          <div class="wc-item">
            <h4 class="wc-title"><?php echo $subject_name;?></h4>
              <span class="wc-des">Current Handle Subject</span>
              <span class="wc-stats">
              <i class="fa fa-book"></i></span>
              </i>
            </span>
          </div>

          
        </div>


        
     
      </div>


      <?php
if (isset($_SESSION['faculty_id'])) {
    $faculty_id = $_SESSION['faculty_id'];
    $sqlCount = "SELECT COUNT(*) as student_count FROM tbl_subject WHERE faculty_id = '$faculty_id'";
    
    $resultCount = mysqli_query($conn, $sqlCount);

    if ($resultCount) {
        // Fetch the count
        $row = mysqli_fetch_assoc($resultCount);
        $student_id = $row['student_count'];
    } else {
        // Handle the case where the query failed
        echo "Query failed: " . mysqli_error($conn);
    }
}
?>


      <div class="col-md-6 col-log-3 col-xl-3 col-sm-6 col-12">
        <div class="widget-card widget-bg1">
          <div class="wc-item">
            <h4 class="wc-title"><?php echo $student_id;?></h4>
              <span class="wc-des">Student</span>
              <span class="wc-stats">
              <i class="fa fa-user"></i></span>
              </i>
            </span>
          </div>
        </div>
<!-- 
  

      

      
              </i>
            </span>
          </div>
        </div>
      </div>
    </section>
  </main>
</body>
</html>