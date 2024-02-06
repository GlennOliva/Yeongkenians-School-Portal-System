<?php
session_start();
include 'includes/connection.php';




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/profile.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Profile</title>
</head>
<body>
    <header>
        <img src="images/logo.png" alt="">
        <a href="dashboard.php">STUDENT PORTAL</a>
        <div class="logout">
            <a href="index.php">
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
                        <span><i class="fa fa-user"></i> Pre Registration Form</h4>
                    <hr>
                </div>


                <form method="POST" action="" enctype="multipart/form-data">
                        <!-- Update input names based on the database fields -->
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Full_name:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="full_name">
                            </div>
                        </div>
                        
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Strand:</label>
                            </div>
                            <div class="col-sm-10">
           
								<select name="strand" class="form-control" >
									<option value="stem" >Stem</option>
									<option value="humms" >Humms</option>
                                    <option value="abm" >Abm</option>
									<option value="tvl" >Tvl</option>
                                    <option value="gas" >Gas</option>
								</select>

                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">School Year:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="school_year">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Semester:</label>
                            </div>
                            <div class="col-sm-10">
           
								<select name="semester" class="form-control" >
									<option value="first_sem" >First Sem</option>
									<option value="second_sem" >Second Sem</option>
                                    <option value="summer" >Summer</option>
								</select>

                            </div>
                        </div>
                        

                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Year Standing:</label>
                            </div>
                            <div class="col-sm-10">
           
								<select name="standing" class="form-control" >
									<option value="grade_11" >Grade_11</option>
									<option value="grade_12" >Grade_12</option>
								</select>

                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Registration Status:</label>
                            </div>
                            <div class="col-sm-10">
           
								<select name="reg_status" class="form-control" >
									<option value="regular" >Regular</option>
									<option value="irregular" >Irregular</option>
								</select>

                            </div>
                        </div>
                      
            


                        <div class="modal-footer">
                <button type="submit" name="add" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
                </form>
            </div>
                </div>
            </div>


            <?php
            if(isset($_POST['add']))
            {
                $full_name = $_POST['full_name'];
                $strand = $_POST['strand'];
                $school_year = $_POST['school_year'];
                $semester = $_POST['semester'];
                $standing = $_POST['standing'];
                $reg_status = $_POST['reg_status'];
                $student_id = $_SESSION['student_id'];
                




                $sql = "INSERT INTO tbl_pregistration SET full_name = '$full_name' , strand = '$strand' , school_year = '$school_year' , semester = '$semester'
    , standing = '$standing' , reg_status = '$reg_status' , student_id = '$student_id'";


            //execute the query
            $result = mysqli_query($conn,$sql);

            //check if the data is inserted or not
            if($result==TRUE)
            {
                //DATA inserted successfully
                echo '<script>
                swal({
                    title: "Success",
                    text: "Student Successfully Register",
                    icon: "success"
                }).then(function() {
                    window.location = "pre_registration.php";
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
                            text: "Failed to Register student",
                            icon: "error"
                        }).then(function() {
                            window.location = "pre_registration.php";
                        });
                    </script>';
                    exit;
            }
            }
            
            ?>
          
          

                <!-- Additional Features -->


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
