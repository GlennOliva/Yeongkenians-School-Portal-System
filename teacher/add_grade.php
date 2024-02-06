<?php
	session_start();
	include_once('connection.php');

	if(isset($_POST['add'])){
		$database = new Connection();
		$db = $database->open();
		try{
			// make use of prepared statement to prevent SQL injection
			$stmt = $db->prepare("INSERT INTO grades (student_id, 1st_grading, 2nd_grading, 3rd_grading, 4th_grading, average, remarks) VALUES (:student_id, :1st_grading, :2nd_grading, :3rd_grading, :4th_grading, :average, :remarks)");

			// if-else statement in executing our prepared statement
			$_SESSION['message'] = ($stmt->execute(array(
				':student_id' => $_POST['student_id'],
				':1st_grading' => $_POST['1st_grading'],
				':2nd_grading' => $_POST['2nd_grading'],
				':3rd_grading' => $_POST['3rd_grading'],
				':4th_grading' => $_POST['4th_grading'],
				':average' => $_POST['average'],
				':remarks' => $_POST['remarks']
			))) ? 'Record added successfully' : 'Something went wrong. Cannot add record';	
	    
		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}

		// close connection
		$database->close();
	}

	else{
		$_SESSION['message'] = 'Fill up add form first';
	}

	header('location: manage_grades.php');
?>
