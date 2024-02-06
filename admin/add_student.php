<?php
session_start();
include 'includes/connection.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

// Initialize variables
$email = $contactNumber = $status = $createdat = '';

if (isset($_SESSION['auth_admin']['id'])) {
    $admin_id = $_SESSION['auth_admin']['id'];

    $sql = "SELECT * FROM tbl_admin WHERE id = '$admin_id'";
    $res = mysqli_query($conn, $sql);

    if ($res) {
        $count = mysqli_num_rows($res);

        if ($count > 0) {
            $row = mysqli_fetch_assoc($res);
            $email = $row['email'];
            $contactNumber = $row['phone'];
            $status = $row['verify_status'];
            $createdat = $row['created_at'];
        } else {
            echo "No records found for admin ID: $admin_id";
        }
    } else {
        echo "Query failed: " . mysqli_error($conn);
    }
} else {
    echo "Admin not authenticated or ID not set in the session.";
}
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
        <a href="dashboard.php">ADMIN PORTAL</a>
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
                        <span><i class="fa fa-user"></i> Add Student</h4>
                    <hr>
                </div>


                <form method="POST" action="">
                        <!-- Update input names based on the database fields -->
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Last Name:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="lastname">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">First Name:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="firstname">
                            </div>
                        </div>


                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Middle Name:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="middlename">
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
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Strand/Track</label>
                            </div>
                            <div class="col-sm-10">
           
								<select name="strand" class="form-control" >
									<option value="stem" >Stem</option>
									<option value="humms" >Humms</option>
                                    <option value="abm" >Abm</option>
                                    <option value="gas" >Gas</option>
                                    <option value="tvl" >Tvl</option>
								</select>

                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Civil Status</label>
                            </div>
                            <div class="col-sm-10">
           
								<select name="civil_status" class="form-control" >
									<option value="single" >Single</option>
									<option value="divorce" >Divorce</option>
                                    <option value="married" >Married</option>
                                    <option value="widowed" >Widowed</option>
								</select>

                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Grade Level</label>
                            </div>
                            <div class="col-sm-10">
           
								<select name="grade_level" class="form-control" >
									<option value="grade_11" >Grade 11</option>
									<option value="grade_12" >Grade 12</option>
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
                                <input type="date" class="form-control" name="date_enrolled">
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
                                <label class="control-label" style="position:relative; top:7px;">Semester:</label>
                            </div>
                            <div class="col-sm-10">
                              
                                <select name="semester" class="form-control">
                                    <option value="First">First Sem</option>
                                    <option value="Second">Second Sem</option>
                                    <option value="Summer">Summer</option>
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

                       

                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Password:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password">
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
                $password = $_POST['password'];
                $semester = $_POST['semester'];
                $verify_token = md5(rand());


                $sql = "INSERT INTO tbl_student SET lastname = '$lastname' , firstname = '$firstname', middlename = '$middlename' , gender = '$gender' , email = '$email' , contact_number = '$contact_number'
    , strand = '$strand' , civil_status = '$civil_status' , grade_level = '$grade_level', date_enrolled = '$date_enrolled', lrn = '$lrn', year_level = '$year_level'
    , section = '$section', religion = '$religion' , birth_date = '$birth_date', address = '$address', semester = '$semester' , password = '$password' , verify_token = '$verify_token' ";


            //execute the query
            $result = mysqli_query($conn,$sql);

            //check if the data is inserted or not
            if($result==TRUE)
            {
                sendEmail($email, $lrn, $password, $firstname);
                //DATA inserted successfully
                echo '<script>
                swal({
                    title: "Success",
                    text: "Student Successfully Inserted",
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
                            text: "Failed to insert student",
                            icon: "error"
                        }).then(function() {
                            window.location = "manage_students.php";
                        });
                    </script>';
                    exit;
            }
            }


            function sendEmail($to, $lrn, $password, $firstname)
            {
                $mail = new PHPMailer(true);
            
                try {
                    // Server settings
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'clientportal54@gmail.com';
                    $mail->Password   = 'yyqp pbgt mkbz vgys'; 
                    $mail->SMTPSecure = 'tls';
                    $mail->Port       = 587;
            
                    // Recipients
                    $mail->setFrom('clientportal54@gmail.com', $firstname); // Replace 'Your Name' with your desired sender name
                    $mail->addAddress($to);
            
                    // Content
                    $mail->isHTML(true);
                    $mail->Subject = 'Your Account Details';
                    $mail->Body    = "Dear $firstname,<br><br>Your LRN: $lrn<br>Your Password: $password<br><br>Thank you for registering!";
            
                    $mail->send();
                } catch (Exception $e) {
                    // Handle exception (you can log it or display an error message)
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
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
