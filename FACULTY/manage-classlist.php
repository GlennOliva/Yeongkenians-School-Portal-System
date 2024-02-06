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
    <title>Profile</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
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
                    <span><i class="fa fa-list"></i> Manage Classlist</span>
                </h4>
                <hr>

                <div>
                <form action="" method="post" style="width: 15%; display: flex; margin-top: 1%;">
    <label for="entries" style="margin-right: 2%;">Show entries:</label>
    <input type="number" name="entries" id="entries" value="<?php echo isset($_POST['entries']) ? intval($_POST['entries']) : 10; ?>" min="1">
    <button type="submit" style="margin-left: 5%;" name="apply">Apply</button>
</form>


                
    <form action="" method="post" style='float: right; width: 30%; margin-top: 1%; margin-bottom: 1%;'>
        <input type="text" id="searchInput" placeholder="Search by Name or LRN" style="width: 50%;">
        <button type="button" onclick="searchAndExport()">Search</button>
        <button type="button" onclick="exportToExcel()" >Export to Excel</button>
    </form>
</div>


                <!-- Display all records in a table -->
                <table id="enrolledSubjectsTable">
                    <tr>
                        <th>ID</th>
                        <th>Subject</th>
                        <th>Student Name</th>
                        <th>Lrn</th>
                        <th>Time</th>
                        <th>Day</th>
                    </tr>
                    

                    <?php
// Fetch records from the enrolled_subjects table with student names
if (isset($_SESSION['faculty_id'])) {
    $faculty_id = $_SESSION['faculty_id'];

    // Check if "Apply" button is pressed
    if (isset($_POST['apply'])) {
        $entriesToShow = isset($_POST['entries']) ? intval($_POST['entries']) : 10;
    
        // Assuming you have a variable $facultyId representing the faculty ID
// Replace ... with the actual value or retrieve it from somewhere
    
        // Your SQL query here with LIMIT to fetch records based on $entriesToShow and faculty_id
        $query = "SELECT tbl_subject.id, tbl_subject.subject_name, tbl_subject.student_id, tbl_subject.time, tbl_subject.day, tbl_student.lastname, tbl_student.firstname, tbl_student.middlename, tbl_student.lrn
                  FROM tbl_subject
                  JOIN tbl_student ON tbl_subject.student_id = tbl_student.id
                  WHERE tbl_subject.faculty_id = $faculty_id
                  LIMIT $entriesToShow";
    } else {
        // Assuming you have a variable $facultyId representing the faculty ID
 // Replace ... with the actual value or retrieve it from somewhere
    
        // If "Apply" button is not pressed, fetch all records based on faculty_id
        $query = "SELECT tbl_subject.id, tbl_subject.subject_name, tbl_subject.student_id, tbl_subject.time, tbl_subject.day, tbl_student.lastname, tbl_student.firstname, tbl_student.middlename, tbl_student.lrn
                  FROM tbl_subject
                  JOIN tbl_student ON tbl_subject.student_id = tbl_student.id
                  WHERE tbl_subject.faculty_id = $faculty_id";
    }
    
    

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['subject_name']}</td>";
            echo "<td>{$row['lastname']} {$row['firstname']} {$row['middlename']}</td>";
            echo "<td>{$row['lrn']}</td>"; // Displaying student name
            echo "<td>{$row['time']}</td>";
            echo "<td>{$row['day']}</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No records found</td></tr>";
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
    function searchAndExport() {
        var searchTerm = document.getElementById("searchInput").value.toLowerCase();
        var table = document.getElementById("enrolledSubjectsTable");
        var rows = table.getElementsByTagName("tr");

        // Loop through all table rows (starting from 1 to skip the header row)
        for (var i = 1; i < rows.length; i++) {
            var nameColumn = rows[i].getElementsByTagName("td")[3].textContent.toLowerCase(); // Assuming the name column is at index 3
            var lrnColumn = rows[i].getElementsByTagName("td")[4].textContent.toLowerCase(); // Assuming the LRN column is at index 4
            var subjectColumn = rows[i].getElementsByTagName("td")[1].textContent.toLowerCase(); // Assuming the subject column is at index 1

            // Check if the search term is found in the name, subject, or LRN column
            var matchFound = (
                nameColumn.indexOf(searchTerm) > -1 ||
                subjectColumn.indexOf(searchTerm) > -1 ||
                lrnColumn.indexOf(searchTerm) > -1
            );

            // Update the visibility of the row
            rows[i].style.display = matchFound ? "" : "none";
        }
    }

    function exportToExcel() {
        var table = document.getElementById("enrolledSubjectsTable");
        var wb = XLSX.utils.book_new();
        var ws = XLSX.utils.table_to_sheet(table);
        XLSX.utils.book_append_sheet(wb, ws, "EnrolledSubjects");
        var filename = "enrolled_subjects.xlsx";
        XLSX.writeFile(wb, filename);
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
