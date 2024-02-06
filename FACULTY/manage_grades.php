<!DOCTYPE html>
<html lang="en">
<?php          session_start(); 
include('includes/connection.php');
?>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/profile.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Manage Grades</title>
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
          <img src="../FACULTY/logo.png" alt="">
          <a href="dashboard.html">FACULTY PORTAL</a>
          <div class="logout">
            <a href="../index.php">
              <span class="ttr-icon"><i class="fa fa-sign-out"></i></span>
            </a>
  
            </div>
      </header>

      <main>
       <?php include 'sidebar.php'; ?>

      
  
          <section>
      <div class="container-fluid">
        <div>
          <h4>
            <span><i class="fa fa-user"></i>
            Manage Grades
          </h4>
          <hr>
          </div>

          <?php 
            
                if(isset($_SESSION['message'])){
                    ?>
                    <div class="alert alert-info text-center" style="margin-top:20px;">
                        <?php echo $_SESSION['message']; ?>
                    </div>
                    <?php

                    unset($_SESSION['message']);
                }
            ?>
        


          <!-- Add a student modal here that opens up add modal  -->

          <!-- Display the list of students here  -->
            <!-- Add a student modal button -->
            <button class="btn" onclick="openAddModal()">Add Grades</button>
         <!-- Add Student Modal -->
         <div id="addModal" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="closeAddModal()">&times;</span>
                        <h3>Add Grades</h3>
                        <!-- Add your form for adding a student here -->
                        <!-- Make sure to include necessary form fields -->
                                                
                        <form method="POST" action="">
                        <!-- Update input names based on the database fields -->
                     
                        
                        <div class="row form-group">
    <div class="col-sm-2">
        <label class="control-label" style="position:relative; top:7px;">Subject</label>
    </div>
    <div class="col-sm-10">
        <select name="subject" class="form-control">

            <?php

            if(isset($_SESSION['faculty_id']))
            {
                $faculty_id = $_SESSION['faculty_id'];

                // Adjust the JOIN condition based on your database schema
                $sql2 = "SELECT DISTINCT subject_name
                         FROM tbl_subject
                         WHERE faculty_id = '$faculty_id'
                         ORDER BY subject_name"; // You can adjust the ORDER BY clause based on your preference

                // Execute the query
                $res = mysqli_query($conn, $sql2);

                // Count the rows to check if executed or not
                $count = mysqli_num_rows($res);

                if($count > 0 )
                {
                    while($row = mysqli_fetch_assoc($res))
                    {   
                        $subject_name = $row['subject_name'];
                        ?>

                        <option value="<?php echo $subject_name; ?>" ><?php echo $subject_name; ?></option>

                        <?php
                    }
                }
                else
                {
                    // No subjects found for the faculty
                    ?>
                    <option value="0" >No Subjects Found</option>                                    

                    <?php
                }
            }
            else
            {
                // Faculty_id not set in the session
                ?>
                <option value="0" >Faculty ID not set</option>

                <?php
            }
            
            ?>
        </select>
        <input type="hidden" name="fid" value="<?php echo $faculty_id; ?>">
    </div>
</div>






                        

   
<div class="row form-group">
    <div class="col-sm-2">
        <label class="control-label" style="position:relative; top:7px;">Student Lrn</label>
    </div>
    <div class="col-sm-10">
        <select name="lrn" class="form-control">

            <?php

            if (isset($_SESSION['faculty_id'])) {
                $faculty_id = $_SESSION['faculty_id'];

                // Adjust the JOIN condition based on your database schema
                $sql2 = "SELECT f.student_id, s.lrn FROM tbl_subject f
                         INNER JOIN tbl_student s ON f.student_id = s.id
                         WHERE f.faculty_id = $faculty_id";

                // execute the query
                $res = mysqli_query($conn, $sql2);

                // count the rows to check if executed or not
                $count = mysqli_num_rows($res);

                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $student_id = $row['student_id'];
                        $lrn = $row['lrn'];

                        ?>

                        <option value="<?php echo $student_id; ?>"><?php echo $lrn; ?></option>

                    <?php
                    }
                } else {
                    // no students found for the faculty
                    ?>
                    <option value="0">No Students Found</option>

                <?php
                }
            } else {
                // faculty_id not set in the session
                ?>
                <option value="0">Faculty ID not set</option>

            <?php
            }
            ?>
        </select>
        <?php if (isset($student_id)) { ?>
            <input type="hidden" name="sid" value="<?php echo $student_id; ?>">
        <?php } ?>
    </div>
</div>

                       





                        

                        
                        
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">First Semester</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="first_grade">
                            </div>
                        </div>
                        

                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Second Semester</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="second_grade">
                            </div>
                        </div>

            
          


                      



                    
                        <div class="col-sm-2">
    <label class="control-label" style="position:relative; top:7px;">School Year</label>
</div>
<div class="col-sm-10">
    <select class="form-control" name="school_year">
        <option value="2023-2024">2023 - 2024</option>
        <option value="2024-2025">2024 - 2025</option>
        <option value="2025-2026">2025 - 2026</option>
        <option value="2026-2027">2026 - 2027</option>
        <!-- Add more options as needed -->
    </select>
</div>

                   


                        
                        
                        <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" name="add" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
                </form>
            </div>
                </div>
            </div>


            <?php
if (isset($_POST['add'])) {
    $student_id = $_POST['sid'];
    $subject_name = $_POST['subject'];
    $first_grade = $_POST['first_grade'];
    $second_grade = $_POST['second_grade'];
    $average = ($first_grade + $second_grade ) / 2;
    $school_year = $_POST['school_year'];

    // Determine remarks based on average
    if ($average >= 80 && $average <= 100) {
        $remarks = "Passed";
    } elseif ($average < 75) {
        $remarks = "Failed";
    } else {
        $remarks = "";  // Add more conditions if needed
    }

    echo "Average: $average, Remarks: $remarks";

    $sql = "INSERT INTO tbl_grade 
    ( student_id, subject, first_grade, second_grade,  average, remarks, faculty_id, school_year)
    VALUES 
    ( '$student_id', '$subject_name', '$first_grade', '$second_grade', '$average', '$remarks', '$faculty_id' , '$school_year')";



    // execute the query
    $result = mysqli_query($conn, $sql);

    // check if the data is inserted or not
    if ($result == TRUE) {
        // Data inserted successfully
        echo '<script>
                swal({
                    title: "Success",
                    text: "Grade Successfully Inserted",
                    icon: "success"
                }).then(function() {
                    window.location = "manage_grades.php";
                });
            </script>';

        exit;
    } else {
        // failed to insert data
        echo '<script>
                swal({
                    title: "Error",
                    text: "Failed to insert Grades",
                    icon: "error"
                }).then(function() {
                    window.location = "manage_grades.php";
                });
            </script>';
        exit;
    }
}
?>

          



                    </div>
                </div>
          
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Subject Name</th>
                            <th>First Semester</th>
                            <th>Second Semester</th>
                            <th>Average</th>
                            <th>Remarks</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$conn = new mysqli("localhost", "root", "", "student");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM tbl_grade";



$result = $conn->query($query);

$ids = 1;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $ids++; ?></td>
            <td><?php echo $row['subject']; ?></td>
            <td><?php echo $row['first_grade']; ?></td>
            <td><?php echo $row['second_grade']; ?></td>
            <td><?php echo $row['average']; ?></td>
            <td><?php echo $row['remarks']; ?></td>

            <td>
                <button class="btn" onclick="openEditModal('<?php echo $row['id']; ?>')">Edit</button>
                <button class="btn btn-danger" onclick="openDeleteModal('<?php echo $row['id']; ?>')">Delete</button>
            </td>
        </tr>




                <!-- Add this modal inside your <body> tag -->
                <!-- Delete Modal -->
<!-- Delete Modal -->
            <div class="modal" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Delete Subject</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <input type="hidden" id="deleteRecordId" name="deleteRecordId" value="">
                            <p>Are you sure you want to delete this student record?</p>
                        </div>
                        <br>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-danger" href="delete-subject.php?id=<?php echo $row['id']; ?>">Delete</a>
                        </div>
                    </div>
                </div>
            </div>


                <!-- Edit Student Modal -->
                <div id="editModal<?php echo $row['id']; ?>" class="modal">
                                <!-- Make the edit modal here  -->

                    <div class="modal-content"> 
                        <span class="close" onclick="closeEditModal('<?php echo $row['id']; ?>')">&times;</span>
                        <h3>Edit Subject</h3>
                        <!-- Update the action URL based on your backend script for editing -->
                        <form method="POST" >
                            <!-- Update input names based on the database fields -->
                            <!-- Add your form fields here with the current values as default -->
                            <div class="row form-group">

    

<div class="row form-group">
    <div class="col-sm-2">
        <label class="control-label" style="position:relative; top:7px;">First Grade</label>
    </div>
    <div class="col-sm-10">
        <input type="number" class="form-control" name="first_grade" value="<?php echo $row['first_grade']; ?>">
    </div>
</div>

<div class="row form-group">
    <div class="col-sm-2">
        <label class="control-label" style="position:relative; top:7px;">Second Grade</label>
    </div>
    <div class="col-sm-10">
        <input type="number" class="form-control" name="second_grade" value="<?php echo $row['second_grade']; ?>">
    </div>
</div>

<div class="row form-group">
    <div class="col-sm-2">
        <label class="control-label" style="position:relative; top:7px;">Third Grade</label>
    </div>
    <div class="col-sm-10">
        <input type="number" class="form-control" name="third_grade" value="<?php echo $row['third_grade']; ?>">
    </div>
</div>

<div class="row form-group">
    <div class="col-sm-2">
        <label class="control-label" style="position:relative; top:7px;">Final Grade</label>
    </div>
    <div class="col-sm-10">
        <input type="number" class="form-control" name="fourth_grade" value="<?php echo $row['fourth_grade']; ?>">
    </div>
</div>
                        
                        <input type="hidden" name="id" value="<?php echo $row['id'];?>">

                                        <!-- Repeat the above structure for other form fields -->
                                        <!-- ... (other form fields) ... -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" onclick="closeEditModal('<?php echo $row['id']; ?>')"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                                            <button type="submit" name="edit" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Update</button>
                                        </div>
                                    </form>
                                </div>


                                <?php
            if(isset($_POST['edit']))
            {
                $id = $_POST['id'];
                $first_grade = $_POST['first_grade'];
                $second_grade = $_POST['second_grade'];
                $average = ($first_grade + $second_grade ) / 2;
            
                // Determine remarks based on average
                if ($average >= 80 && $average <= 100) {
                    $remarks = "Passed";
                } elseif ($average < 75) {
                    $remarks = "Failed";
                } else {
                    $remarks = "";  // Add more conditions if needed
                }
             


                $sql = "UPDATE tbl_grade SET first_grade = '$first_grade', second_grade = '$second_grade', 
                average = '$average', remarks = '$remarks' WHERE id = $id";
        



            //execute the query
            $result = mysqli_query($conn,$sql);

            //check if the data is inserted or not
            if($result==TRUE)
            {
                //DATA inserted successfully
                echo '<script>
                swal({
                    title: "Success",
                    text: "Grade Successfully Update",
                    icon: "success"
                }).then(function() {
                    window.location = "manage_grades.php";
                });
            </script>';

            exit;
            }
            else
            {
                //failed to insert data
                echo '<script>
                        swal({
                            title: "Error",
                            text: "Failed to Update Grade",
                            icon: "error"
                        }).then(function() {
                            window.location = "manage_grades.php";
                        });
                    </script>';
                    exit;
            }
            }
            
            ?>

                                
                                   
                                </div>
                        <?php
                            }
                        } else {
                        ?>
                            <tr>
                                <td colspan='4'>No records found</td>
                            </tr>
                        <?php
                        }

                        $conn->close();
                        ?>
                    </tbody>
                </table>
       
                <style>
        /* Add your custom styles here */
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .btn {
            display: inline-block;
            padding: 8px 15px;
            margin-right: 5px;
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
        }

        .btn-danger {
            background-color: #f44336;
        }

         /* Styles for the modal */
         .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

                
        h3 {
            margin-bottom: 20px;
            font-size: 1.5em;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .modal-footer {
            margin-top: 20px;
            text-align: right;
        }

        .btn {
            padding: 10px 20px;
            font-size: 1em;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            color: #fff;
        }

        .btn-secondary {
            background-color: #ccc;
        }

        .btn-primary {
            background-color: #007bff;
        }

        /* Add more styles as needed */
    </style>
</section>
  </main>


  <script>

        
       
        function openDeleteModal(id) {
            document.getElementById('deleteModal').style.display = 'block';
            // You can store the ID of the record to be deleted in a hidden input field within the delete modal for reference
            document.getElementById('deleteRecordId').value = id;
        }
        
        // JavaScript to handle opening and closing of the modals
        function openAddModal() {
            document.getElementById('addModal').style.display = 'block';
        }

        function closeAddModal() {
            document.getElementById('addModal').style.display = 'none';
        }


        
        function openEditModal(id) {
            document.getElementById('editModal' + id).style.display = 'block';
        }

        function closeEditModal(id) {
            document.getElementById('editModal' + id).style.display = 'none';
        }
    </script>
</body>
</html>