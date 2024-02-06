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
    <!-- Bootstrap JS and Popper.js -->
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
            Manage Faculty
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
          
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full_Name</th>
                            <th>Birthdate</th>
                            <th>Gender</th>
                            <th>Email Address</th>
                            <th>CivilStatus</th>  
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
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
                        $result = $conn->query("SELECT * FROM tbl_faculty WHERE 
                            CONCAT(lastname, ' ', firstname, ' ', middlename) LIKE '%$searchTerm%'
                            LIMIT $offset, $entriesPerPage
                        ");
                        $ids = $offset + 1;
                        

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                            $_SESSION['faculty_id'] = $row['id'];
                        ?>
                                <tr>
                                    <td><?php echo $ids++; ?></td>
                                    <td><?php echo $row['lastname'] . ' ' . $row['firstname'] . ' ' . $row['middlename']; ?></td>
                                    <td><?php echo $row['birth_date']; ?></td>
                                    <td><?php echo $row['gender']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['civil_status']; ?></td>
                                    <td><img src="images/profile/<?php echo $row['image'];?>" alt=""></td>
    
                                    <td>
                                        <button class="btn btn-danger" onclick="openDeleteModal('<?php echo $row['id']; ?>')">Delete</button>
                                </tr>


                <!-- Add this modal inside your <body> tag -->
                <!-- Delete Modal -->
<!-- Delete Modal -->
            <div class="modal" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Delete Faculty</h5>
                        
                        </div>

                        <div class="modal-body">
                            <input type="hidden" id="deleteRecordId" name="deleteRecordId" value="">
                            <p>Are you sure you want to delete this Faculty record?</p>
                        </div>
                        <br>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-default" onclick="cancelDelete()">Cancel</button>
                            <a class="btn btn-danger" href="delete-faculty.php?id=<?php echo $row['id']; ?>">Delete</a>
                        </div>
                    </div>
                </div>
            </div>


               
                        
                                
                                   
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