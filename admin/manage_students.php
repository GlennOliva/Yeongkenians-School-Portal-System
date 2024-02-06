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
            Manage Students
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

         


                    </div>
                </div>

                <form action="" method="post" style="width: 10%;" display: flex;>
    <label for="entries">Show entries:</label>
    <input type="number" name="entries" id="entries" value="<?php echo isset($_POST['entries']) ? intval($_POST['entries']) : 10; ?>" min="1">
    <button type="submit" name="apply">Apply</button>
</form>


                <form action="" method="post" style="float: right; margin-bottom: 2%;">
    <input type="text" name="searchInput" id="searchInput" placeholder="Search by Name or LRN" style="width: 75%;" value="<?php echo isset($_POST['searchInput']) ? htmlspecialchars($_POST['searchInput']) : ''; ?>">
    <button type="submit" name="search">Search</button>
</form>



<?php
$entriesPerPage = isset($_POST['entries']) ? intval($_POST['entries']) : 10;
$currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($currentPage - 1) * $entriesPerPage;

$conn = new mysqli("localhost", "root", "", "student");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION['auth_admin']['id'])) {
    $admin_id = $_SESSION['auth_admin']['id'];

    // Use the search term in the query
    $searchTerm = isset($_POST['searchInput']) ? $_POST['searchInput'] : '';
    $result = $conn->query("SELECT * FROM tbl_student WHERE 
        CONCAT(lastname, ' ', firstname, ' ', middlename) LIKE '%$searchTerm%' OR
        lrn LIKE '%$searchTerm%'
        LIMIT $offset, $entriesPerPage
    ");
    $ids = $offset + 1;

    if ($result->num_rows > 0) {
        ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>LRN</th>
                    <th>Full_Name</th>
                    <th>Strand/Track</th>
                    <th>Grade Level</th>
                    <th>Date Enrolled</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $ids++; ?></td>
                        <td><?php echo $row['lrn']; ?></td>
                        <td><?php echo $row['lastname'] . ' ' . $row['firstname'] . ' ' . $row['middlename']; ?></td>
                        <td><?php echo $row['strand']; ?></td>
                        <td><?php echo $row['grade_level']; ?></td>
                        <td><?php echo $row['date_enrolled']; ?></td>
                        <td><?php echo $row['status']; ?></td>
    
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
                            <h5 class="modal-title" id="deleteModalLabel">Delete Student</h5>
                    
                        </div>

                        <div class="modal-body">
                            <input type="hidden" id="deleteRecordId" name="deleteRecordId" value="">
                            <p>Are you sure you want to delete this student record?</p>
                        </div>
                        <br>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-default" onclick="cancelDelete()">Cancel</button>
                            <a class="btn btn-danger" href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
                        </div>
                    </div>
                </div>
            </div>


                <!-- Edit Student Modal -->
                <div id="editModal<?php echo $row['id']; ?>" class="modal">
                                <!-- Make the edit modal here  -->

                    <div class="modal-content">
                        <span class="close" onclick="closeEditModal('<?php echo $row['id']; ?>')">&times;</span>
                        <h3>Edit Student</h3>
                        <!-- Update the action URL based on your backend script for editing -->
                        <form method="POST" >
                            <!-- Update input names based on the database fields -->
                            <!-- Add your form fields here with the current values as default -->
                            <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">lastname:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="lastname" value="<?php echo $row['lastname']; ?>">
                            </div>
                        </div>
                        

                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Firstname:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="firstname" value="<?php echo $row['firstname']; ?>">
                            </div>
                        </div>


                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">middlename:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="middlename" value="<?php echo $row['middlename']; ?>">
                            </div>
                        </div>


                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Gender:</label>
                            </div>
                            <div class="col-sm-10">
           
                            <select name="gender" class="form-control">
                                        <option value="male" <?php echo ($row['gender'] == 'male') ? 'selected' : ''; ?>>Male</option>
                                        <option value="female" <?php echo ($row['gender'] == 'female') ? 'selected' : ''; ?>>Female</option>
                                    </select>

                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Email:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="email" value="<?php echo $row['email']; ?>">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Contact Number:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="contact_number" value="<?php echo $row['contact_number']; ?>">
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

                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Civil Status</label>
                            </div>
                            <div class="col-sm-10">
           
								<select name="civil_status" class="form-control" >
									<option value="single" <?php echo ($row['civil_status'] == 'single') ? 'selected' : ''; ?> >Single</option>
									<option value="divorce" <?php echo ($row['civil_status'] == 'divorce') ? 'selected' : ''; ?> >Divorce</option>
                                    <option value="married" <?php echo ($row['civil_status'] == 'married') ? 'selected' : ''; ?> >Married</option>
                                    <option value="widowed" <?php echo ($row['civil_status'] == 'widowed') ? 'selected' : ''; ?> >Widowed</option>
								</select>

                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Grade Level</label>
                            </div>
                            <div class="col-sm-10">
           
								<select name="grade_level" class="form-control" >
									<option value="grade_11" <?php echo ($row['grade_level'] == 'grade_11') ? 'selected' : ''; ?> >Grade 11</option>
									<option value="grade_12" <?php echo ($row['grade_level'] == 'grade_12') ? 'selected' : ''; ?> >Grade 12</option>
								</select>

                            </div>
                        </div>

                        <!-- <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">School Year</label>
                            </div>
                            <div class="col-sm-10">
           
								<select name="school_year" class="form-control" >
									<option value="2023" >2023</option>
									<option value="2024" >2024</option>
                                    <option value="2025" >2025</option>
                                    <option value="2026" >2026</option>
								</select>

                            </div>
                        </div> -->

                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Date Enrolled:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="date_enrolled" value="<?php echo $row['date_enrolled']; ?>">
                            </div>
                        </div>
                        
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">LRN:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="lrn" value="<?php echo $row['lrn']; ?>">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Year Level:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="year_level" value="<?php echo $row['year_level']; ?>">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Section:</label>
                            </div>
                            <div class="col-sm-10">
                                <!-- <input type="text" class="form-control" name="section"> -->
                                <select name="section" class="form-control" >
                                    <option value="A" <?php echo ($row['section'] == 'A') ? 'selected' : ''; ?> >A</option>
                                    <option value="B" <?php echo ($row['section'] == 'B') ? 'selected' : ''; ?>>B</option>
                                    <option value="C"<?php echo ($row['section'] == 'C') ? 'selected' : ''; ?>>C</option>
                                    <option value="D"<?php echo ($row['section'] == 'D') ? 'selected' : ''; ?>>D</option>
                                    <option value="E"<?php echo ($row['section'] == 'E') ? 'selected' : ''; ?>>E</option>


                                </select>
                            </div>
                        </div>
                     
                        
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Religion:</label>
                            </div>
                            <div class="col-sm-10">
                              
                                <select name="religion" class="form-control">
                                    <option value="catholic" <?php echo ($row['religion'] == 'catholic') ? 'selected' : ''; ?>>Roman Catholic</option>
                                    <option value="muslim" <?php echo ($row['religion'] == 'muslim') ? 'selected' : ''; ?>>Islam</option>
                                    <option value="christian"<?php echo ($row['religion'] == 'christian') ? 'selected' : ''; ?>>Christian</option>
                                </select>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Semester:</label>
                            </div>
                            <div class="col-sm-10">
                              
                                <select name="semester" class="form-control">
                                    <option value="First" <?php echo ($row['semester'] == 'First') ? 'selected' : ''; ?>>First Sem</option>
                                    <option value="Second" <?php echo ($row['semester'] == 'Second') ? 'selected' : ''; ?>>Second Sem</option>
                                    <option value="Summer"<?php echo ($row['semester'] == 'Summer') ? 'selected' : ''; ?>>Summer</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Birth Date:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="birth_date" value="<?php echo $row['birth_date']; ?>">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Address:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="address" value="<?php echo $row['Address']; ?>">
                            </div>
                        </div>


                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Status:</label>
                            </div>
                            <div class="col-sm-10">
                              
                                <select name="status" class="form-control">
                                    <option value="Active" <?php echo ($row['status'] == 'First') ? 'selected' : ''; ?>>Active</option>
                                    <option value="Inactive" <?php echo ($row['status'] == 'Second') ? 'selected' : ''; ?>>Inactive</option>
                                </select>
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
                $lastname = $_POST['lastname'];
                $firstname = $_POST['firstname'];
                $middlename = $_POST['middlename'];
                $gender = $_POST['gender'];
                $email = $_POST['email'];
                $contact_number = $_POST['contact_number'];
                $strand = $_POST['strand'];
                $civil_status = $_POST['civil_status'];
                $grade_level = $_POST['grade_level'];
                $date_enrolled = $_POST['date_enrolled'];
                $lrn = $_POST['lrn'];
                $year_level = $_POST['year_level'];
                $section = $_POST['section'];
                $religion = $_POST['religion'];
                $birth_date = $_POST['birth_date'];
                $address = $_POST['address'];
                $semester = $_POST['semester'];
                $status = $_POST['status'];
             


                $sql = "UPDATE tbl_student 
                SET lastname = '$lastname',
                    firstname = '$firstname',
                    middlename = '$middlename',
                    gender = '$gender',
                    email = '$email',
                    contact_number = '$contact_number',
                    strand = '$strand',
                    civil_status = '$civil_status',
                    grade_level = '$grade_level',
                    date_enrolled = '$date_enrolled',
                    lrn = '$lrn',
                    year_level = '$year_level',
                    section = '$section',
                    religion = '$religion',
                    birth_date = '$birth_date',
                    semester = '$semester',
                    address = '$address',
                    status = '$status'
                WHERE id = $id";
        


            //execute the query
            $result = mysqli_query($conn,$sql);

            //check if the data is inserted or not
            if($result==TRUE)
            {
                //DATA inserted successfully
                echo '<script>
                swal({
                    title: "Success",
                    text: "Student Successfully Update",
                    icon: "success"
                }).then(function() {
                    window.location = "manage_students.php";
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
                            text: "Failed to Update student",
                            icon: "error"
                        }).then(function() {
                            window.location = "manage_students.php";
                        });
                    </script>';
                    exit;
            }
            }
            
            ?>

                                
                                   
                                </div>
                        <?php
                            }
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

        function cancelDelete() {
        // Close the modal using Bootstrap modal function
        $('#deleteModal').modal('hide');
        
        // Redirect back to the "Manage Faculty" section
        window.location.href = 'manage_students.php';
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