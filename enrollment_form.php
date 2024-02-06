<!DOCTYPE html>
<html lang="en">
<?php          session_start(); ?>
<?php 
// Include your database connection details
include 'includes/connection.php';


?>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/enrolledsub.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <title>Student Announce</title>
  </head>
  <body>
  
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
          <!--  include the sidebar-->
          <?php include 'sidebar.php'; ?>

          <section>
            <div class="container-fluid">
              <div>
                <h4>
                  <span><i class="fa fa-book"></i>
                  Announcements
                </h4>
                <hr>
                </div>
            
                <table>
                  <tr>
                  <th>ID</th>
                  <th>Announce Message</th>
                  <th>Time & Day</th>
                  </tr>
          
                <tr>

             
<?php
                    // Assuming you have stored the student ID in a session variable
                    if (isset($_SESSION['student_id'])) {
                        $student_id = $_SESSION['student_id'];

                        // Fetch data from the enrolled_subjects table
                        $query = "SELECT * FROM tbl_studentannounce";
                        $result = mysqli_query($conn, $query);
                        $ids = 1;

                        while ($row = mysqli_fetch_assoc($result)) {
                          echo "<tr>";
                          echo "<td>" . $ids++ . "</td>";
                          echo "<td>{$row['message']}</td>";
                          echo "<td>{$row['created_at']}</td>";
                          // Move the button outside the echo statement
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

<style>


main {
  display: flex;
}

/* Sidebar styling */
.sidebar {
  background-color: #34495e;
  padding: 20px;
  color: white;
  min-width: 250px;
}

.sidebar a {
  display: block;
  color: white;
  text-decoration: none;
  margin-bottom: 10px;
}

.sidebar a:hover {
  text-decoration: underline;
}

/* Content styling */
section {
  flex: 1;
  padding: 20px;
}

.container-fluid {
  max-width: 800px;
  margin: 0 auto;
}

h4 {
  color: #3498db;
}

hr {
  border: 1px solid #ecf0f1;
}

/* Form styling */
div {
  margin-bottom: 15px;
}

label {
  display: block;
  font-weight: bold;
  margin-bottom: 5px;
}

input[type="text"] {
  width: 100%;
  padding: 8px;
  box-sizing: border-box;
}



</style>



