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
                        <span><i class="fa fa-user"></i> Add Faculty</h4>
                    <hr>
                </div>


                <form method="POST" action="" enctype="multipart/form-data">
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
                                <label class="control-label" style="position:relative; top:7px;">Upload Image:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" accept="image/jpg, image/jpeg, image/png, image/webp" name="image">
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
                $civil_status = $_POST['civil_status'];
                $birth_date = $_POST['birth_date'];
                $address = $_POST['address'];
                $password = $_POST['password'];
                $verify_token = md5(rand());


                //upload the image if selected
            if(isset($_FILES['image']['name']))
            {
                //get the details of the selected image
                $image_name = $_FILES['image']['name'];

                //check if the imaage selected or not.
                if ($image_name != "") {
                    // Image is selected
                    // Rename the image
                    $ext_parts = explode('.', $image_name);
                    $ext = end($ext_parts);
                
                    // Create a new name for the image
                    $image_name = "Faculty-Profile" . rand(0000, 9999) . "." . $ext;
                
                    // Upload the image
                
                    // Get the src path and destination path
                
                    // Source path is the current location of the image
                    $src = $_FILES['image']['tmp_name'];
                
                    // Destination path for the image to be uploaded
                    $destination = "images/profile/" . $image_name;
                
                    // Upload the food image
                    $upload = move_uploaded_file($src, $destination);
                
                    // Check if the image uploaded or not
                    if ($upload == false) {
                        // Failed to upload the image
                        echo '<script>
                            swal({
                                title: "Error",
                                text: "Failed to upload image",
                                icon: "error"
                            }).then(function() {
                                window.location = "add_faculty.php";
                            });
                        </script>';
                
                        die();
                        exit;
                    } else {
                        // Image uploaded successfully
                    }
                }
                

            }
            else
            {
                $image_name = ""; 
            }


                $sql = "INSERT INTO tbl_faculty SET lastname = '$lastname' , firstname = '$firstname', middlename = '$middlename' , gender = '$gender' , email = '$email' , contact_number = '$contact_number'
    , civil_status = '$civil_status' , birth_date = '$birth_date', address = '$address', password = '$password', image = '$image_name' , verify_token = '$verify_token'";


            //execute the query
            $result = mysqli_query($conn,$sql);

            //check if the data is inserted or not
            if($result==TRUE)
            {
                //DATA inserted successfully
                sendEmail($email, $password, $firstname);
                echo '<script>
                swal({
                    title: "Success",
                    text: "Faculty Successfully Inserted",
                    icon: "success"
                }).then(function() {
                    window.location = "manage-faculty.php";
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
                            window.location = "manage-faculty.php";
                        });
                    </script>';
                    exit;
            }
            }


            function sendEmail($to, $password, $firstname)
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
                    $mail->setFrom('clientportal54@gmail.com', 'Admin'); // Replace 'Your Sender Name' with your desired sender name
                    $mail->addAddress($to);
            
                    // Content
                    $mail->isHTML(true);
                    $mail->Subject = 'Your Account Details';
                    $mail->Body    = "Dear $firstname,<br><br>Your Email: $to<br>Your Password: $password<br><br>Thank you for registering!";
            
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
