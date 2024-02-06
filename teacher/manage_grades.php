<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Manage Enrollment</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1 class="page-header text-center">Manage Student Grades</h1>
        <div class="row">
            <div class="col-sm-8 col-med-offset-2">
                <a href="#addnew" class="btn btn-primary" data-toggle="modal"><span class="glyphicon glyphicon-plus"></span> Add Grades </a>
                <?php
                session_start();
                if (isset($_SESSION['message'])) {
                ?>
                    <div class="alert alert-info text-center" style="margin-top:20px;">
                        <?php echo $_SESSION['message']; ?>
                    </div>
                <?php

                    unset($_SESSION['message']);
                }
                ?>
                <table class="table table-bordered table-striped" style="margin-top:20px;">
                    <thead>
                        <th>ID</th>
                        <th>Student ID</th>
                        <th>1st Grading</th>
                        <th>2nd Grading</th>
                        <th>3rd Grading</th>
                        <th>4th Grading</th>
                        <th>Average</th>
                        <th>Remarks</th>
                        <th>Action</th>
                    </thead>

                    <tbody>
                        <?php
                        //include our connection
                        include_once('connection.php');

                        $database = new Connection();
                        $db = $database->open();
                        try {
                            $sql = 'SELECT * FROM grades';
                            foreach ($db->query($sql) as $row) {
                        ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['student_id']; ?></td>
                                    <td><?php echo $row['1st_grading']; ?></td>
                                    <td><?php echo $row['2nd_grading']; ?></td>
                                    <td><?php echo $row['3rd_grading']; ?></td>
                                    <td><?php echo $row['4th_grading']; ?></td>
                                    <td><?php echo $row['average']; ?></td>
                                    <td><?php echo $row['remarks']; ?></td>
                                    <td>
                                        <a href="#edit_<?php echo $row['id']; ?>" class="btn btn-success btn-sm" data-toggle="modal"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                                        <a href="#delete_<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span> Delete</a>
                                    </td>
                                    <?php include('edit_delete_modal_grades.php'); ?>
                                </tr>
                        <?php
                            }
                        } catch (PDOException $e) {
                            echo "There is some problem in connection: " . $e->getMessage();
                        }

                        //close connection
                        $database->close();

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php include('add_grades_modal.php'); ?>
    <script src="jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
