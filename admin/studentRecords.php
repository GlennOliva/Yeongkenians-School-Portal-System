<?php
include 'functions.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student = array(
        'full_name' => $_POST['full_name'],
        'student_id' => $_POST['student_id'],
        'dob' => $_POST['dob'],
        'gender' => $_POST['gender'],
        'address' => $_POST['address'],
        'phone_number' => $_POST['phone_number'],
        'email' => $_POST['email'],
        'grade' => $_POST['grade'],
        'section' => $_POST['section'],
        'strand' => $_POST['strand'],
        'adviser' => $_POST['adviser'],
        'enrollment_date' => $_POST['enrollment_date'],
        'student_status' => $_POST['student_status'],
        'parent_name' => $_POST['parent_name'],
        'parent_contact' => $_POST['parent_contact'],
        'parent_occupation' => $_POST['parent_occupation'],
        'parent_email' => $_POST['parent_email'],
        'update_history' => array(),
    );

    if (!isset($_SESSION['students'])) {
        $_SESSION['students'] = array();
    }

    $_SESSION['students'][] = $student;

    header("Location: viewstudentrecords.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="studentRecords.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Student Records</title>
</head>
<body>

<header>
    <img src="images/logo.png" alt="">
    <a href="#">Student Portal</a>
    <div class="logout">
        <a href="index.html">
            <span class="ttr-icon"><i class="fa fa-sign-out"></i></span>
        </a>
    </div>
</header>

<main>
    <aside>
        <ul>
             <li><a href="admindashboard.php"class="ttr-material-button">
                      <span class="ttr-icon"><i class="fa fa-home"></i></span>
                      <span class="ttr-label">Dashboard</span></a>
                  </li>
                  <li><a href="profile.php"class="ttr-material-button">
                      <span class="ttr-icon"><i class="fa fa-user-circle"></i></span>
                      <span class="ttr-label">Profile</span></a>
                  </li>
                  <li>
                      <a href="students.php" class="ttr-material-button">
                        <span class="ttr-icon"><i class="fa fa-book"></i></span>
                          <span class="ttr-label">Student</span></a>
                    </li>
                    <li>
                      <a href="faculty.php" class="ttr-material-button">
                        <span class="ttr-icon"><i class="fa fa-trophy"></i></span>
                          <span class="ttr-label">Faculty</span></a>
                    </li>
                    <li>
                      <a href="studentRecords.php" class="ttr-material-button">
                        <span class="ttr-icon"><i class="fa fa-book"></i></span>
                          <span class="ttr-label"></span>Student records</a>
                    </li>
                    <li>
                      <a href="manage users.php" class="ttr-material-button">
                        <span class="ttr-icon"><i class="fa fa-gear"></i></span>
                          <span class="ttr-label">Settings</span></a>
                    </li>
        </ul>
    </aside>
    <section>
        <div class="container-fluid">
            <div>
                <h4>
                    <center>Add Student Record</center>
                </h4>
            </div>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="full_name">Full Name:</label>
        <input type="text" name="full_name" required>

    <label for="student_id">Student ID:</label>
    <input type="text" id="student_id" name="student_id" required>

    <label for="dob">Date of Birth:</label>
    <input type="date" id="dob" name="dob" required>

    <label for="gender">Gender:</label>
    <select id="gender" name="gender" required>
        <option value="male">Male</option>
        <option value="female">Female</option>
    </select>

    <label for="address">Address:</label>
    <input type="text" id="address" name="address" required>

    <label for="phone_number">Phone Number:</label>
    <input type="text" id="phone_number" name="phone_number" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="grade">Grade/Class:</label>
    <input type="text" id="grade" name="grade" required>

    <label for="section">Section:</label>
    <input type="text" id="section" name="section" required>

    <label for="strand">Strand or Course:</label>
    <input type="text" id="strand" name="strand" required>

    <label for="adviser">Adviser:</label>
    <input type="text" id="adviser" name="adviser" required>

    <label for="enrollment_date">Enrollment Date:</label>
    <input type="date" id="enrollment_date" name="enrollment_date" required>

    <label for="student_status">Student Status:</label>
    <select id="student_status" name="student_status" required>
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
    </select>

    <label for="parent_name">Parent/Guardian Name:</label>
    <input type="text" id="parent_name" name="parent_name" required>

    <label for="parent_contact">Parent/Guardian Contact:</label>
    <input type="text" id="parent_contact" name="parent_contact" required>

    <label for="parent_occupation">Parent/Guardian Occupation:</label>
    <input type="text" id="parent_occupation" name="parent_occupation" required>

    <label for="parent_email">Parent/Guardian Email:</label>
    <input type="email" id="parent_email" name="parent_email" required>
                <button type="submit">Add Student</button>
            </form>
        </div>
    </section>
</main>
</body>
</html>
