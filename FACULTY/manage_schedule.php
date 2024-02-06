<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('includes/connection.php');
?>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/profile.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Class Schedule</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>






    
</head>

<body>


<?php
if(!isset($_SESSION['faculty_id']))
{
    echo '<script>
                                    swal({
                                        title: "Error",
                                        text: "You must login first before you proceed!",
                                        icon: "error"
                                    }).then(function() {
                                        window.location = "../faculty_login.php";
                                    });
                                </script>';
                                exit;
}

?>

    <header>
        <img src="logo.png" alt="">
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
                <h4>
                    <span><i class="fa fa-list"></i> Class Schedule</span>
                </h4>
                <hr>

                <div>
                <form action="" method="post">
    <button type="button" onclick="exportToPdf()">Export to PDF</button>
</form>

</div>


                <!-- Display all records in a table -->
                <table id="enrolledSubjectsTable">
                    <tr>
                        <th>Subject</th>
                        <th>Time</th>
                        <th>Day</th>
                    </tr>

                    <?php
if (isset($_SESSION['faculty_id'])) {
    $faculty_id = $_SESSION['faculty_id'];
    $query = "SELECT DISTINCT  subject_name, time, day FROM tbl_subject WHERE faculty_id = '$faculty_id'";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['subject_name']}</td>";
            echo "<td>{$row['time']}</td>";
            echo "<td>{$row['day']}</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No records found</td></tr>";
    }

    // Close the database connection
    $conn->close();
}
?>


                </table>

                <!-- Your modals and other content here -->

            </div>
        </section>
    </main>

    <script>
    function exportToPdf() {
    var element = document.getElementById('enrolledSubjectsTable');
    html2pdf(element, {
        margin: 10,
        filename: 'class_schedule.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
    });
}

</script>







</body>

</html>


       



<style>


        form {
            width: 80%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        input, select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

         /* Style for the modal container */
         .modal {
            display: none; /* Hidden by default */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }

        /* Style for the modal content */
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        /* Style for the close button */
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
    </style> 
