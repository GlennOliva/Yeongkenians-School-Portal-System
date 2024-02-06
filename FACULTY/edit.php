<?php
	session_start();
	include_once('connection.php');

	if(isset($_POST['edit'])){
		$database = new Connection();
		$db = $database->open();
		try{
			$id = $_GET['id'];
			$first_name = $_POST['first_name'];
			$middle_name = $_POST['middle_name'];
			$last_name = $_POST['last_name'];
			$gender = $_POST['gender'];
			$email = $_POST['email'];
			$contact_number = $_POST['contact_number'];
			$strand = $_POST['strand'];
			$date_enrolled = $_POST['date_enrolled'];
			$mother_name = $_POST['mother_name'];
			$mother_occupation = $_POST['mother_occupation'];
			$mother_contact_no = $_POST['mother_contact_no'];
			$father_name = $_POST['father_name'];
			$father_occupation = $_POST['father_occupation'];
			$father_contact_no = $_POST['father_contact_no'];

			$sql = "UPDATE enrollment_form SET 
					first_name = '$first_name',
					middle_name = '$middle_name',
					last_name = '$last_name',
					gender = '$gender',
					email = '$email',
					contact_number = '$contact_number',
					strand = '$strand',
					date_enrolled = '$date_enrolled',
					mother_name = '$mother_name',
					mother_occupation = '$mother_occupation',
					mother_contact_no = '$mother_contact_no',
					father_name = '$father_name',
					father_occupation = '$father_occupation',
					father_contact_no = '$father_contact_no'
					WHERE id = '$id'";

			// if-else statement in executing our query
			$_SESSION['message'] = ($db->exec($sql)) ? 'enrollment updated successfully' : 'No changes were made';

		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}

		// close connection
		$database->close();
	}
	else{
		$_SESSION['message'] = 'Fill up edit form first';
	}

	header('location: manage_students.php');
?>
