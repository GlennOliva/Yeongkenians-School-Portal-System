<?php


	session_start();
	include_once('connection.php');

	if(isset($_POST['add'])){
		$database = new Connection();
		$db = $database->open();
		try{
			// make use of prepared statement to prevent SQL injection
			$stmt = $db->prepare("INSERT INTO enrollment_form (first_name, middle_name, last_name, gender, email, contact_number, strand, date_enrolled, mother_name, mother_occupation, mother_contact_no, father_name, father_occupation, father_contact_no, lrn, year_level, section, civil_status, religion, birth_date, address) VALUES (:first_name, :middle_name, :last_name, :gender, :email, :contact_number, :strand, :date_enrolled, :mother_name, :mother_occupation, :mother_contact_no, :father_name, :father_occupation, :father_contact_no, :lrn, :year_level, :section,  :civil_status, :religion, :birth_date, :address)");

			// if-else statement in executing our prepared statement
			$_SESSION['message'] = ($stmt->execute(array(
				':first_name' => $_POST['first_name'],
				':middle_name' => $_POST['middle_name'],
				':last_name' => $_POST['last_name'],
				':gender' => $_POST['gender'],
				':email' => $_POST['email'],
				':contact_number' => $_POST['contact_number'],
				':strand' => $_POST['strand'],
				':date_enrolled' => $_POST['date_enrolled'],
				':mother_name' => $_POST['mother_name'],
				':mother_occupation' => $_POST['mother_occupation'],
				':mother_contact_no' => $_POST['mother_contact_no'],
				':father_name' => $_POST['father_name'],
				':father_occupation' => $_POST['father_occupation'],
				':father_contact_no' => $_POST['father_contact_no'],
				':lrn' => $_POST['lrn'],
				':year_level' => $_POST['year_level'],
				':section' => $_POST['section'],
				':civil_status' => $_POST['civil_status'],
				':religion' => $_POST['religion'],
				':birth_date' => $_POST['birth_date'],
				':address' => $_POST['address'],
			))) ? 'Member added successfully' : 'Something went wrong. Cannot add student';	
	    
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

	header('location: manage_students.php');
	
?>
