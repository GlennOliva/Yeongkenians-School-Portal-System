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
    <title>Announcement</title>
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
                        <span><i class="fa fa-user"></i> Announcement For School </h4>
                    <hr>
                </div>


                <!-- Add this dropdown/select element to your HTML form -->
<!-- Update the name attribute of the select element -->



<!-- Rest of your HTML form -->
<form action="" method="post">

<div>
    <label for="recipient">Announcement For</label>
    <select name="recipient" id="recipient">
        <option value="student">Student</option>
        <option value="faculty">Faculty</option>
    </select>
</div>

    <div>
        <label for="email">Message For Announcement</label>
        <textarea name="message" id="" cols="50" rows="10"></textarea>
    </div>

    <button type="submit" name="submit" class="btn btn-success" id="finalSubmitButton" style="margin: 0 auto; background-color: green; color: white; font-size: 18px; padding: 10px; border-radius: 12px; cursor: pointer;">
        <span class="glyphicon glyphicon-check"></span> Send Announcement
    </button>
</form>



                

                <?php
                
                if (isset($_POST['submit'])) {
                    $message = $_POST['message'];
                    $recipient = isset($_POST['recipient']) ? $_POST['recipient'] : '';

                
                    // Check if the recipient option is valid
                    if ($recipient === 'student') {
                        $sql = "INSERT INTO tbl_studentannounce (message, created_at) VALUES (?, CURRENT_TIMESTAMP)";
                    } elseif ($recipient === 'faculty') {
                        $sql = "INSERT INTO tbl_facultyannounce (message, created_at) VALUES (?, CURRENT_TIMESTAMP)";
                    } else {
                        // Handle invalid recipient option
                        echo '<script>
                                swal({
                                    title: "Error",
                                    text: "Invalid recipient option",
                                    icon: "error"
                                }).then(function() {
                                    window.location = "announce-faculty.php";
                                });
                            </script>';
                        exit;
                    }
                
                    $stmt = mysqli_prepare($conn, $sql);
                
                    if ($stmt) {
                        // Bind parameters and execute the statement
                        mysqli_stmt_bind_param($stmt, "s", $message);
                        $result = mysqli_stmt_execute($stmt);
                
                        if ($result) {
                            echo '<script>
                                    swal({
                                        title: "Success",
                                        text: "Announcement Sent!",
                                        icon: "success"
                                    }).then(function() {
                                        window.location = "announce-faculty.php";
                                    });
                                </script>';
                            exit;
                        } else {
                            echo '<script>
                                    swal({
                                        title: "Error",
                                        text: "Message not sent",
                                        icon: "error"
                                    }).then(function() {
                                        window.location = "announce-faculty.php";
                                    });
                                </script>';
                            exit;
                        }
                    } else {
                        // Handle statement preparation error
                        echo "Error in preparing statement: " . mysqli_error($conn);
                        exit;
                    }
                }
                
                
                
                ?>

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
