<?php
session_start();
include 'includes/connection.php';

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
                        <span><i class="fa fa-user"></i> Admin Profile</h4>
                    <hr>
                </div>

                <h3>Personal Details</h3>

                <div>
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" readonly value="<?php echo $email; ?>">
                </div>

                <div>
                    <label for="contactNumber">Contact Number:</label>
                    <input type="text" id="contactNumber" name="contactNumber" readonly value="<?php echo $contactNumber; ?>">
                </div>

                <div>
                    <label for="status">Status Auth</label>
                    <input type="text" id="status" name="status" readonly value="<?php echo $status; ?>">
                </div>

                <div>
                    <label for="createdat">Created Account</label>
                    <input type="text" id="createdat" name="createdat" readonly value="<?php echo $createdat; ?>">
                </div>

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
