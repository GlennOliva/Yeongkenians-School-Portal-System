<!DOCTYPE html>
<html lang="en">
<?php          session_start(); ?>
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
            <button class="btn" onclick="openAddModal()">Add Student</button>
         <!-- Add Student Modal -->
         <div id="addModal" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="closeAddModal()">&times;</span>
                        <h3>Add Student</h3>
                        <!-- Add your form for adding a student here -->
                        <!-- Make sure to include necessary form fields -->
                                                
                        <form method="POST" action="add.php">
                        <!-- Update input names based on the database fields -->
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">First Name:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="first_name">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Middle Name:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="middle_name">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Last Name:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="last_name">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Gender:</label>
                            </div>
                            <div class="col-sm-10">
           
								<select name="gender" class="form-control" >
									<option value="male" >Male</option>
									<option value="female" >Female</option>
								</select>

                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Email:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="email">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Contact Number:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="contact_number">
                            </div>
                        </div>
                        <!-- <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Strand:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="strand">
                            </div>
                        </div> -->
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Date Enrolled:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="date_enrolled">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Mother Name:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="mother_name">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Mother Occupation:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="mother_occupation">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Mother Contact No:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="mother_contact_no">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Father Name:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="father_name">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Father Occupation:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="father_occupation">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Father Contact No:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="father_contact_no">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">LRN:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="lrn">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Year Level:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="year_level">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Section:</label>
                            </div>
                            <div class="col-sm-10">
                                <!-- <input type="text" class="form-control" name="section"> -->
                                <select name="section" class="form-control" >
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>


                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Strand:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="strand">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Civil Status:</label>
                            </div>
                            <div class="col-sm-10">

                                <select name="civil_status" class="form-control">
                                    <option value="single">Single</option>
                                    <option value="married">Married</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Religion:</label>
                            </div>
                            <div class="col-sm-10">
                              
                                <select name="religion" class="form-control">
                                    <option value="catholic">Roman Catholic</option>
                                    <option value="muslim">Islam</option>
                                    <option value="christian">Christian</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Birth Date:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="birth_date">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Address:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="address">
                            </div>
                        </div>
                        <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" name="add" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
                </form>
            </div>
                </div>
            </div>
          



                    </div>
                </div>
          
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>LRN</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Year</th>
                            <th>Section</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $conn = new mysqli("localhost", "root", "", "student");

                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $result = $conn->query("SELECT * FROM enrollment_form");

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['lrn']; ?></td>
                                    <td><?php echo $row['first_name']; ?></td>
                                    <td><?php echo $row['middle_name']; ?></td>
                                    <td><?php echo $row['last_name']; ?></td>
                                    <td><?php echo $row['year_level']; ?></td>
                                    <td><?php echo $row['section']; ?></td>
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
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="text" id="deleteRecordId" name="deleteRecordId" value="">
                            <p>Are you sure you want to delete this student record?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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
                        <form method="POST" action="edit.php?id=<?php echo $row['id']; ?>">
                            <!-- Update input names based on the database fields -->
                            <!-- Add your form fields here with the current values as default -->
                            <div class="row form-group">
                                <div class="col-sm-2">
                                    <label class="control-label" style="position:relative; top:7px;">First Name:</label>
                                </div>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="first_name" value="<?php echo $row['first_name']; ?>">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-sm-2">
                                    <label class="control-label" style="position:relative; top:7px;">Middle Name:</label>
                                </div>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="middle_name" value="<?php echo $row['middle_name']; ?>">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-2">
                                    <label class="control-label" style="position:relative; top:7px;">Last Name:</label>
                                </div>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="last_name" value="<?php echo $row['last_name']; ?>">
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
                                    <label class="control-label" style="position:relative; top:7px;">Strand:</label>
                                </div>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="strand" value="<?php echo $row['strand']; ?>">
                                </div>
                            </div>
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
                                    <label class="control-label" style="position:relative; top:7px;">Mother Name:</label>
                                </div>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="mother_name" value="<?php echo $row['mother_name']; ?>">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-2">
                                    <label class="control-label" style="position:relative; top:7px;">Mother Occupation:</label>
                                </div>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="mother_occupation" value="<?php echo $row['mother_occupation']; ?>">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-2">
                                    <label class="control-label" style="position:relative; top:7px;">Mother Contact No:</label>
                                </div>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="mother_contact_no" value="<?php echo $row['mother_contact_no']; ?>">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-2">
                                    <label class="control-label" style="position:relative; top:7px;">Father Name:</label>
                                </div>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="father_name" value="<?php echo $row['father_name']; ?>">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-2">
                                    <label class="control-label" style="position:relative; top:7px;">Father Occupation:</label>
                                </div>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="father_occupation" value="<?php echo $row['father_occupation']; ?>">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-2">
                                    <label class="control-label" style="position:relative; top:7px;">Father Contact No:</label>
                                </div>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="father_contact_no" value="<?php echo $row['father_contact_no']; ?>">
                                </div>
                            </div>
                                        <!-- Repeat the above structure for other form fields -->
                                        <!-- ... (other form fields) ... -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" onclick="closeEditModal('<?php echo $row['id']; ?>')"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                                            <button type="submit" name="edit" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Update</button>
                                        </div>
                                    </form>
                                </div>

                                
                                   
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