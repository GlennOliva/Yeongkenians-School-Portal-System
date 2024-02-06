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
            $fullname = $row['full_name'];
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
    <link rel="stylesheet" type="text/css" href="css/admindashboard.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Admin Dashboard</title>
</head>
<body>

<header>
    <img src="images/logo.png" alt="">
    <a href="#">ADMIN PORTAL</a>
    <div class="logout">
    <a href="../logout.php">
        <span class="ttr-icon"><i class="fa fa-sign-out"></i></span>
    </a>
</div>


</header>

<main>
    <!-- Sidebar -->
    <?php include 'sidebar.php'; ?>

    <section>
        <div class="container-fluid">
            <div>
                <h4>
                    <span><i class="fa fa-user-circle"></i>
                    Welcome <?php echo $fullname;?>
                </h4>
            </div>

           

<?php
                        if(isset($_SESSION['status']))
                        {
                            ?>
                                <div class="alert alert-success">
                                    <h5><?=$_SESSION['status'];?></h5>
                                </div>

                            <?php
                            unset($_SESSION['status']);
                        }

                    ?>


<?php

$sqlCount = "SELECT COUNT(*) as total FROM tbl_student";
$resultCount = mysqli_query($conn, $sqlCount);
if ($resultCount) {
    // Fetch the count
    $rowCount = mysqli_fetch_assoc($resultCount);
    $totalStudents = $rowCount['total'];

} else {
    // Handle the case where the query failed
    echo "Query failed: " . mysqli_error($conn);
}
?>

<!-- Display the count in your HTML -->
<div class="col-md-4 col-log-4 col-xl-4 col-sm-6 col-12">
    <div class="widget-card widget-bg1">
        <div class="wc-item">
            <h4 class="wc-title"><?php echo $totalStudents;?></h4>
            <br>
            <span class="wc-des">Students</span>
            <span class="wc-stats">
                <i class="fa fa-users"></i>
            </span>
        </div>
    </div>
</div>



<?php

$sqlCount = "SELECT COUNT(*) as total FROM tbl_faculty";
$resultCount = mysqli_query($conn, $sqlCount);
if ($resultCount) {
    // Fetch the count
    $rowCount = mysqli_fetch_assoc($resultCount);
    $totalFaculty = $rowCount['total'];

} else {
    // Handle the case where the query failed
    echo "Query failed: " . mysqli_error($conn);
}
?>

<!-- Display the count in your HTML -->
<div class="col-md-4 col-log-4 col-xl-4 col-sm-6 col-12">
    <div class="widget-card widget-bg2">
        <div class="wc-item">
            <h4 class="wc-title"><?php echo $totalFaculty;?></h4>
            <br>
            <span class="wc-des">Teachers</span>
            <span class="wc-stats">
                <i class="fa fa-university"></i>
            </span>
        </div>
    </div>
</div>

<?php

$sqlCount = "SELECT COUNT(*) as total FROM tbl_subject";
$resultCount = mysqli_query($conn, $sqlCount);
if ($resultCount) {
    // Fetch the count
    $rowCount = mysqli_fetch_assoc($resultCount);
    $totalStrand = $rowCount['total'];

} else {
    // Handle the case where the query failed
    echo "Query failed: " . mysqli_error($conn);
}
?>
    <div class="col-md-4 col-log-4 col-xl-4 col-sm-6 col-12">
        <div class="widget-card widget-bg3">
            <div class="wc-item">
                <h4 class="wc-title"><?php echo $totalStrand;?></h4>
                <br>
                <span class="wc-des">Strands</span>
                <span class="wc-stats">
                    <i class="fa fa-book"></i>
                </span>
            </div>
        </div>
    </div>





            </div>
        </div>
    </section>
</main>

</body>
</html>
