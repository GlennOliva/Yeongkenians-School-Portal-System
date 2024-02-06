<?php  session_start(); ?>
<?php 
// Include your database connection details
include 'includes/connection.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/profile.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Profile</title>
  </head>
  <body>
  
      <header>
          <img src="images/logo.png" alt="">
          <a href="dashboard.html">STUDENT PORTAL</a>
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
            <span><i class="fa fa-user"></i>
            Student Profile
          </h4>
          <hr>
          </div>

       <h3>Personal Details</h3>


       <?php
          if (isset($_SESSION['student_id'])) {
            $student_id = $_SESSION['student_id'];
          $sqlCount = "SELECT  * FROM tbl_student WHERE id = '$student_id'";
         
$resultCount = mysqli_query($conn, $sqlCount);
if ($resultCount) {
    // Fetch the count
    $rowCount = mysqli_fetch_assoc($resultCount);
    $strand = $rowCount['strand'];

    $gender = $rowCount['gender'];
    $birth_date = $rowCount['birth_date'];
    $religion = $rowCount['religion'];
    $civil_status = $rowCount['civil_status'];
    $lrn = $rowCount['lrn'];
    $address = $rowCount['Address'];
    $lastname = $rowCount['lastname'];
    $firstname = $rowCount['firstname'];
    $midlename = $rowCount['middlename'];

} else {
    // Handle the case where the query failed
    echo "Query failed: " . mysqli_error($conn);
}
}
?>
<div>
    <!-- Value is first_name + middle_name + last_name -->
    <label for="fullName">Full Name:</label>
    <input type="text" id="fullName" name="fullName" readonly value="<?php echo $lastname . ' ' . $firstname . ' ' . $midlename; ?>">
</div>


   <div>
    <label for="Contact">Lrn Number:</label>
    <input type="text" id="birthdate" name="lrn" readonly value="<?php echo $lrn;?>">
    </div>

   <div>
       <label for="birthdate">Birth Date:</label>
       <input type="text" id="birth_date" name="birth_date" readonly value="<?php echo $birth_date; ?>">
   </div>

   <div>
    <label for="gender">Gender:</label>
    <input type="text" id="sex" name="gender" readonly value="<?php echo $gender; ?>">
  </div>

  <div>
  <label for="Religion">Religion:</label>
  <input type="text" id="religion" name="religion" readonly value="<?php echo $religion; ?>">
  </div>

  <div>
    <label for="Status">Civil Status:</label>
    <input type="text" id="civil_status" name="civil_status" readonly value="<?php echo $civil_status; ?>">
</div>

<div>
  <label for="Address">Address:</label>
  <input type="text" id="address" name="address" readonly value="<?php echo $address; ?>">
</div>




<div>
    <label for="Contact">Strand:</label>
    <input type="text" id="father_contact_no" name="strand" readonly value="<?php echo $strand; ?>">
</div>


</section>
  </main>
</body>
</html>


<style>
  /* Add this CSS to your profile.css file or embed it in the HTML head */


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