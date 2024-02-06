<!DOCTYPE html>
<html lang="en">
<?php          session_start(); ?>
<?php
include('config.php');
?>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/grades.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

    <!-- Bootstrap CSS -->


    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->

    <title>Grades</title>
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
                      <span><i class="fa fa-trophy"></i>
                      Grades
                    </h4>
                    <hr>
                    </div>
                   
                    
                    <div class="card">
    <div class="card-body">

    <form action="" method="post" style="display: flex;">
    <label for="schoolYear" style="padding-right: 20px">School Year:</label>
    <select name="schoolYear" id="schoolYear">
        <?php
        // Fetch distinct school years from tbl_grade
        $sqlSchoolYears = "SELECT DISTINCT school_year FROM tbl_grade";
        $resSchoolYears = mysqli_query($con, $sqlSchoolYears);

        while ($rowSchoolYear = mysqli_fetch_assoc($resSchoolYears)) {
            $selected = (isset($_POST['schoolYear']) && $_POST['schoolYear'] == $rowSchoolYear['school_year']) ? 'selected' : '';
            echo "<option value='{$rowSchoolYear['school_year']}' {$selected}>{$rowSchoolYear['school_year']}</option>";
        }
        ?>
    </select>
    <button type="submit" name="apply" style="margin-left: 20px">Search</button>
</form>

<table class="table" id="gradesTable">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Teacher</th>
            <th scope="col">Subject</th>
            <th scope="col">1st Semester</th>
            <th scope="col">2nd Semester</th>
            <th scope="col">Average</th>
            <th scope="col">Remarks</th>
        </tr>
    </thead>
    <tbody>

        <?php
        if (isset($_SESSION['student_id']) && isset($_POST['apply'])) {
            $student_id = $_SESSION['student_id'];
            $selectedSchoolYear = mysqli_real_escape_string($con, $_POST['schoolYear']);

            $query = mysqli_query($con, "SELECT g.*, s.lrn, f.lastname , f.firstname , f.middlename
                                   FROM tbl_grade g
                                   INNER JOIN tbl_student s ON g.student_id = s.id
                                   INNER JOIN tbl_faculty f ON g.faculty_id = f.id
                                   WHERE g.student_id = $student_id AND g.school_year = '$selectedSchoolYear'");
            $i = 1;
            while ($row = mysqli_fetch_assoc($query)) {
                ?>
                <tr>
                    <th scope="row"><?= $i++ ?>.</th>
                    <td><?php echo $row['lastname'] . ' ' . $row['firstname'] . ' ' . $row['middlename']; ?></td>
                    <td><?= $row['subject'] ?></td>
                    <td><?= $row['first_grade'] ?></td>
                    <td><?= $row['second_grade'] ?></td>
                    <td><?= $row['average'] ?></td>
                    <td><?= $row['remarks'] ?></td>
                </tr>
        <?php
            }
        }
        ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
        <script>
    function exportToPdf() {
        var element = document.getElementById('gradesTable');
        var tableWidth = element.offsetWidth; // Get the width of the table

        html2pdf(element, {
              
            margin: 2,
            filename: 'grades.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait', width: tableWidth },
            pagebreak: { mode: 'avoid-all' } // Add this line to avoid page breaks
        });
    }
</script>





</script>


        </tbody>
      </table>

      <button class="btn" style="background-color: green; color: white; font-size: 16px; padding: 10px; margin-top: 2% " onclick="exportToPdf()">Generate PDF for Grade</button>















                    
                
  

