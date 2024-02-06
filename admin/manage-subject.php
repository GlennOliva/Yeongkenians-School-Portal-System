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
    <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <title>Profile</title>
  </head>
  <body>
  
      <header>
          <img src="images/logo.png" alt="">
          <a href="dashboard.html">ADMIN PORTAL</a>
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
            Manage Subjects & Strands
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
            <button class="btn" onclick="openAddModal()">Add Subject</button>
         <!-- Add Student Modal -->
         <div id="addModal" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="closeAddModal()">&times;</span>
                        <h3>Add Subject</h3>
                        <!-- Add your form for adding a student here -->
                        <!-- Make sure to include necessary form fields -->
                                                
                        <form method="POST" action="">
                        <!-- Update input names based on the database fields -->
                   
                        
                       
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Subject Name</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="subject_name">
                            </div>
                        </div>
                        
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Strand/Track</label>
                            </div>
                            <div class="col-sm-10">
           
								<select name="strand" class="form-control" >
									<option value="stem_11" >Stem 11</option>
                                    <option value="stem_12" >Stem 12</option>
									<option value="humms_11" >Humms 11</option>
                                    <option value="humms_12" >Humms 12</option>
                                    <option value="abm_11" >Abm 11</option>
                                    <option value="abm_12" >Abm 12</option>
                                    <option value="gas_11" >Gas 11</option>
                                    <option value="gas_12" >Gas 12</option>
                                    <option value="tvl_11" >Tvl 11</option>
                                    <option value="tvl_12" >Tvl 12</option>
								</select>

                            </div>
                        </div>



                        <div class="row form-group">
    <div class="col-sm-2">
        <label class="control-label" style="position:relative; top:7px;">Teacher</label>
    </div>
    <div class="col-sm-10">
        <select name="teacher" class="form-control" >

            <?php
            $sql2 = "SELECT * FROM tbl_faculty";
            //execute the query
            $res = mysqli_query($conn, $sql2);

            //count the rows to check if executed or not
            $count = mysqli_num_rows($res);

            if($count > 0 )
            {
                while($row = mysqli_fetch_assoc($res))
                {   
                    $faculty_id = $row['id'];
                    $lastname = $row['lastname'];
                    $firstname = $row['firstname'];
                    $middlename = $row['middlename'];
                    ?>

<option value="<?php echo $faculty_id; ?>"><?php echo $lastname . ' ' . $firstname . ' ' . $middlename; ?></option>
                    

                    <?php
                }
            }
            else
            {
                //we don't have faculty member
                ?>
                <option value="0" >No Faculty Found</option>                                    

                <?php
            }
            ?>
        </select>
        <input type="hidden" name="fid" value="<?php echo $faculty_id; ?>">
    </div>
</div>



<div class="row form-group">
    <div class="col-sm-2">
        <label class="control-label" style="position:relative; top:7px;">Student</label>
    </div>
    <div class="col-sm-10">
        <select name="student" class="form-control" >

            <?php
            $sql2 = "SELECT * FROM tbl_student";
            //execute the query
            $res = mysqli_query($conn, $sql2);

            //count the rows to check if executed or not
            $count = mysqli_num_rows($res);

            if($count > 0 )
            {
                while($row = mysqli_fetch_assoc($res))
                {   
                    $student_id = $row['id'];
                    $lastname = $row['lastname'];
                    $firstname = $row['firstname'];
                    $middlename = $row['middlename'];
                    ?>

<option value="<?php echo $student_id; ?>"><?php echo $lastname . ' ' . $firstname . ' ' . $middlename; ?></option>
                    

                    <?php
                }
            }
            else
            {
                //we don't have faculty member
                ?>
                <option value="0" >No Student Found</option>                                    

                <?php
            }
            ?>
        </select>
        <input type="hidden" name="sid" value="<?php echo $student_id; ?>">
    </div>
</div>


                        

                        
                        
                    
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Time Sched</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="time">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Day</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="day">
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" name="add" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
                </form>
            </div>
                </div>
            </div>


            <?php
            if(isset($_POST['add']))
            {
                $student_id = $_POST['sid'];
               $faculty_id = $_POST['fid'];
                $subject_name = $_POST['subject_name'];
                $strand = $_POST['strand'];
                $time = $_POST['time'];
                $day = $_POST['day'];
             


                $sql = "INSERT INTO tbl_subject SET  subject_name = '$subject_name' , strand = '$strand' 
    , time = '$time' , faculty_id = '$faculty_id' , student_id = '$student_id' ,   day = '$day'";


            //execute the query
            $result = mysqli_query($conn,$sql);

            //check if the data is inserted or not
            if($result==TRUE)
            {
                //DATA inserted successfully
                echo '<script>
                swal({
                    title: "Success",
                    text: "Subject Successfully Inserted",
                    icon: "success"
                }).then(function() {
                    window.location = "manage-subject.php";
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
                            text: "Failed to insert Subject",
                            icon: "error"
                        }).then(function() {
                            window.location = "manage-subject.php";
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
                            <th>Faculty Id</th>
                            <th>Subject Name</th>
                            <th>Strand & Grade Level</th>
                            <th>Time</th>  
                            <th>Day</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $conn = new mysqli("localhost", "root", "", "student");

                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }


                        if (isset($_SESSION['auth_admin']['id'])) {
                            $admin_id = $_SESSION['auth_admin']['id'];
                        $result = $conn->query("SELECT * FROM tbl_subject");

                        $ids = 1;

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <tr>
                                    <td><?php echo $ids++; ?></td>
                                    <td><?php echo $current_faculty = $row['faculty_id'];?></td>
                                    <td><?php echo $row['subject_name']; ?></td>
                                    <td><?php echo $row['strand']; ?></td>
                                    <td><?php echo $row['time']; ?></td>
                                    <td><?php echo $row['day']; ?></td>
                                    
                          
    
                                    <td>
                                        <button class="btn" onclick="openEditModal('<?php echo $row['id']; ?>')">Edit</button>
                                        <!-- add a delete button here -->
                                        <button class="btn btn-danger" onclick="openDeleteModal('<?php echo $row['id']; ?>')">Delete</button>
                                </tr>
                        

                <!-- Add this modal inside your <body> tag -->
                <!-- Delete Modal -->
<!-- Delete Modal -->
            <div class="modal" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Delete Subject</h5>
                        
                        </div>

                        <div class="modal-body">
                            <input type="hidden" id="deleteRecordId" name="deleteRecordId" value="">
                            <p>Are you sure you want to delete this student record?</p>
                        </div>
                        <br>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-default" onclick="cancelDelete()">Cancel</button>
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
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Code Number:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="code_number" value="<?php echo $row['code_number']; ?>">
                            </div>
                        </div>
                        
                        
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Subject Name:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="subject_name" value="<?php echo $row['subject_name']; ?>">
                            </div>
                        </div>
                       
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Strand/Track</label>
                            </div>
                            <div class="col-sm-10">
           
								<select name="strand" class="form-control" >
									<option value="stem" <?php echo ($row['strand'] == 'stem') ? 'selected' : ''; ?> >Stem</option>
									<option value="humms"<?php echo ($row['strand'] == 'humms') ? 'selected' : ''; ?> >Humms</option>
                                    <option value="abm" <?php echo ($row['strand'] == 'abm') ? 'selected' : ''; ?> >Abm</option>
                                    <option value="gas" <?php echo ($row['strand'] == 'gas') ? 'selected' : ''; ?> >Gas</option>
                                    <option value="tvl" <?php echo ($row['strand'] == 'tvl') ? 'selected' : ''; ?> >Tvl</option>
								</select>

                            </div>
                        </div>


                     <!-- ... -->
                     <div class="row form-group">
    <div class="col-sm-2">
        <label class="control-label" style="position:relative; top:7px;">Teacher</label>
    </div>
    <div class="col-sm-10">
        <select name="teacher" class="form-control">
            <?php
            $sql2 = "SELECT * FROM tbl_faculty";
            // execute the query
            $res = mysqli_query($conn, $sql2);

            // count the rows to check if executed or not
            $count = mysqli_num_rows($res);

            if ($count > 0) {
                while ($faculty_row = mysqli_fetch_assoc($res)) {
                    $faculty_id = $faculty_row['id'];
                    $faculty_name = $faculty_row['full_name'];
                    ?>
                    <option <?php if ($row['faculty_id'] == $faculty_id) { echo "selected"; } ?> value="<?php echo $faculty_id; ?>"><?php echo $faculty_name; ?></option>
                    <?php
                }
            } else {
                // we don't have faculty members
                ?>
                <option value="0">No Faculty Member</option>
                <?php
            }
            ?>
        </select>


    </div>
</div>



<!-- ... -->

                        

                        

                       
                        
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Slots:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="slots" value="<?php echo $row['slots']; ?>">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Time & Schedule:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="time" value="<?php echo $row['time']; ?>">
                            </div>
                        </div>


                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Day</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="day" value="<?php echo $row['day']?>">
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
                $faculty_id = $_POST['teacher'];
                $id = $_POST['id'];
                $code_number = $_POST['code_number'];
                $subject_name = $_POST['subject_name'];
                $strand = $_POST['strand'];
                $slots = $_POST['slots'];
                $time = $_POST['time'];
                $day = $_POST['day'];
             


                $sql = "UPDATE tbl_subject SET code_number = '$code_number', faculty_id = '$faculty_id',  subject_name = '$subject_name', strand = '$strand',
        slots = '$slots', time = '$time', day = '$day' WHERE id = $id";



            //execute the query
            $result = mysqli_query($conn,$sql);

            //check if the data is inserted or not
            if($result==TRUE)
            {
                //DATA inserted successfully
                echo '<script>
                swal({
                    title: "Success",
                    text: "Subject Successfully Update",
                    icon: "success"
                }).then(function() {
                    window.location = "manage-subject.php";
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
                            text: "Failed to Update Subject",
                            icon: "error"
                        }).then(function() {
                            window.location = "manage-subject.php";
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

        function cancelDelete() {
        // Close the modal using Bootstrap modal function
        $('#deleteModal').modal('hide');
        
        // Redirect back to the "Manage Faculty" section
        window.location.href = 'manage-faculty.php';
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