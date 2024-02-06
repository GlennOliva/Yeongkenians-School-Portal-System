<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
     <link rel="stylesheet" type="text/css" href="css/manage users.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <title>Manage Users</title>
</head>
<body>
    <header>
    <img src="images/logo.png" alt="">
    <a href="#">STUDENT PORTAL</a>
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
                    <span><i class="fa fa-user-circle"></i>
                    Manage Users
                </h4>
            </div>


            <script>
        // Get the alert message from the query parameter
        const alertMessage = new URLSearchParams(window.location.search).get('alert');

        // Display an alert if there's a message
        if (alertMessage) {
            alert(alertMessage);
        }
    </script>


<!-- Add Modal -->

<button class="btn" onclick="openAddModal()">Add User</button>

<!-- Add Teacher Modal -->
<div id="addModal" class="modal" >
        <div class="modal-content">
            <span class="close" onclick="closeAddModal()">&times;</span>
            <h3>Add User</h3>
            <!-- Add your form for adding a student here -->
            <!-- Make sure to include necessary form fields -->
                                    
            <form method="POST" action="add_user.php">
            <!-- Update input names based on the database fields -->
            <div class="row form-group">
                <div class="col-sm-2">
                    <label class="control-label" style="position:relative; top:7px;">User Type:</label>
                </div>
                
                <div class="col-sm-10">
                    <select name="type" class="form-control" >
                        <option value="user">User</option>
                        <option value="teacher">Faculty</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

            <div class="row form-group" id="lrnField">
                <div class="col-sm-2">
                    <label class="control-label" style="position:relative; top:7px;">LRN:</label>
                </div>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="lrn">
                </div>
            </div>

            <div class="row form-group">
                <div class="col-sm-2">
                    <label class="control-label" style="position:relative; top:7px;">Email:</label>
                </div>
                <div class="col-sm-10">
                    <input type="email" class="form-control" name="email">
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

           
             
            <div class="row form-group">
                <div class="col-sm-2">
                    <label class="control-label" style="position:relative; top:7px;">Password:</label>
                </div>
                <div class="col-sm-10">
                    <input type="password" class="form-control" name="password">
                </div>
            </div>

            <div class="row form-group">
                <div class="col-sm-2">
                    <label class="control-label" style="position:relative; top:7px;">Confirm Password:</label>
                </div>
                <div class="col-sm-10">
                    <input type="password" class="form-control" name="confirm">
                </div>
            </div>

            
            
           
          
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" name="add" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
            </div>
    </form>
</div>
    </div>
</div>

        </div>
    </div>
<!-- End of Add Modal -->

            <!-- Edit user modal -->
            <div id="editModal<?php echo $row['id']; ?>" class="modal">
                                            <!-- Make the edit modal here  -->

                    <div class="modal-content">
                        <span class="close" onclick="closeEditModal('<?php echo $row['id']; ?>')">&times;</span>
                        <h3>Edit User</h3>
                        <!-- Update the action URL based on your backend script for editing -->
                        <form method="POST" action="edit_faculty.php?id=<?php echo $row['id']; ?>">
                            <!-- Update input names based on the database fields -->
                            <!-- Add your form fields here with the current values as default -->
                            <div class="row form-group">
                                <div class="col-sm-2">
                                    <label class="control-label" style="position:relative; top:7px;">Lrn:</label>
                                </div>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="lrn" value="<?php echo $row['lrn']; ?>">
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
                           
                            
                           
                           
                                        <!-- Repeat the above structure for other form fields -->
                                        <!-- ... (other form fields) ... -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" onclick="closeEditModal('<?php echo $row['id']; ?>')"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                                            <button type="submit" name="edit" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Update</button>
                                        </div>
                                    </form>
                                </div>

                                
                                   
                                </div>
<!-- End of edit user modal  -->
  <!-- Display of the faculty records -->
  <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                        
                            <th>Lrn</th>
                            <th>Email</th>
                            <th>Contact Number</th>
                            <th>User Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $conn = new mysqli("localhost", "root", "", "student");

                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $result = $conn->query("SELECT * FROM users");

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['lrn']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['contact_number']; ?></td>
                                    <td><?php echo $row['type']; ?></td>
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
                            <h5 class="modal-title" id="deleteModalLabel">Delete User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="deleteRecordId" name="deleteRecordId" value="">
                            <p>Are you sure you want to delete this user record?</p>
                            <br>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-danger" href="delete_user.php?id=<?php echo $row['id']; ?>">Delete</a>
                        </div>
                    </div>
                </div>
            </div>


                <!-- Edit Student Modal -->
                <div id="editModal<?php echo $row['id']; ?>" class="modal">
                                <!-- Make the edit modal here  -->

                    <div class="modal-content">
                        <span class="close" onclick="closeEditModal('<?php echo $row['id']; ?>')">&times;</span>
                      
                        <h3>Edit User</h3>
                        <!-- Update the action URL based on your backend script for editing -->
                        <form method="POST" action="edit_user.php?id=<?php echo $row['id']; ?>">
                            <!-- Update input names based on the database fields -->
                            <!-- Add your form fields here with the current values as default -->
                            <div class="row form-group">
                                <div class="col-sm-2">
                                    <label class="control-label" style="position:relative; top:7px;">Lrn:</label>
                                </div>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="lrn" value="<?php echo $row['lrn']; ?>">
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
                                    <input type="number" class="form-control" name="contact_number" value="<?php echo $row['contact_number']; ?>">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-sm-2">
                                    <label class="control-label" style="position:relative; top:7px;">User Type:</label>
                                </div>
                                <div class="col-sm-10">
                                    <select name="type" class="form-control">
                                        <option value="user" <?php echo ($row['type'] == 'user') ? 'selected' : ''; ?>>User</option>
                                        <option value="teacher" <?php echo ($row['type'] == 'teacher') ? 'selected' : ''; ?>>Teacher</option>
                                        <option value="admin" <?php echo ($row['type'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                                    </select>   
                            
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-sm-2">
                                    <label class="control-label" style="position:relative; top:7px;">Status:</label>
                                </div>
                                <div class="col-sm-10">
                                    <select name="status" class="form-control">
                                        <option value="active" <?php echo ($row['status'] == 'active') ? 'selected' : ''; ?>>Active</option>
                                        <option value="inactive" <?php echo ($row['status'] == 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                              
                                    </select>   
                            
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
            </section>
        </main>

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


</body>
</html>
