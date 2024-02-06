<!DOCTYPE html>
<html>
<?php          session_start(); ?>
<head>
	<meta charset="utf-8">
	<title>Manage Enrollment</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
<div class="container">
	<h1 class="page-header text-center">Manage Students</h1>
	<div class="row">
		<div class="col-sm-8 col-med-offset-2">
			<a href="#addnew" class="btn btn-primary" data-toggle="modal"><span class="glyphicon glyphicon-plus"></span> Add Student Record </a>
            <?php 
                session_start();
                if(isset($_SESSION['message'])){
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
				<th>First Name</th>
				<th>Middle Name</th>
				<th>Last Name</th>
				<th>Gender</th>
				<th>Email</th>
				<th>Contact Number</th>
				<th>Strand</th>
				<th>Date Enrolled</th>
				<th>Mother Name</th>
				<th>Mother Occupation</th>
				<th>Mother Contact No</th>
				<th>Father Name</th>
				<th>Father Occupation</th>
				<th>Father Contact No</th>
				<th>Action</th>
			</thead>

				<tbody>
					<?php
						//include our connection
						include_once('connection.php');

						$database = new Connection();
    					$db = $database->open();
						try{	
						    $sql = 'SELECT * FROM enrollment_form';
							foreach ($db->query($sql) as $row) {
								?>
								<tr>
									<td><?php echo $row['id']; ?></td>
									<td><?php echo $row['first_name']; ?></td>
									<td><?php echo $row['middle_name']; ?></td>
									<td><?php echo $row['last_name']; ?></td>
									<td><?php echo $row['gender']; ?></td>
									<td><?php echo $row['email']; ?></td>
									<td><?php echo $row['contact_number']; ?></td>
									<td><?php echo $row['strand']; ?></td>
									<td><?php echo $row['date_enrolled']; ?></td>
									<td><?php echo $row['mother_name']; ?></td>
									<td><?php echo $row['mother_occupation']; ?></td>
									<td><?php echo $row['mother_contact_no']; ?></td>
									<td><?php echo $row['father_name']; ?></td>
									<td><?php echo $row['father_occupation']; ?></td>
									<td><?php echo $row['father_contact_no']; ?></td>
									<td>
										<a href="#edit_<?php echo $row['id']; ?>" class="btn btn-success btn-sm" data-toggle="modal"><span class="glyphicon glyphicon-edit"></span> Edit</a>
										<a href="#delete_<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span> Delete</a>
									</td>
									<?php include('edit_delete_modal.php'); ?>
								</tr>
								<?php
							}
						}
						catch(PDOException $e){
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
<?php include('add_modal.php'); ?>
<script src="jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>