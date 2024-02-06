<!DOCTYPE html>
<html lang="en">
<?php  session_start(); ?>
<?php 
// Include your database connection details
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
    <title>Profile Faculty</title>
  </head>
  <body>

  <?php
          if (isset($_SESSION['faculty_id'])) {
            $faculty_id = $_SESSION['faculty_id'];
          $sqlCount = "SELECT  * FROM tbl_faculty WHERE id = '$faculty_id'";
         
$resultCount = mysqli_query($conn, $sqlCount);
if ($resultCount) {
    // Fetch the coun
    $rowCount = mysqli_fetch_assoc($resultCount);
    $id = $rowCount['id'];
    $lastname = $rowCount['lastname'];
    $firstname = $rowCount['firstname'];
    $middlename = $rowCount['middlename'];
    $gender = $rowCount['gender'];
    $birth_date = $rowCount['birth_date'];
    $civil_status = $rowCount['civil_status'];
    $email = $rowCount['email'];
    $address = $rowCount['address'];
    $contactNumber = $rowCount['contact_number'];
    $current_image = $rowCount['image'];

} else {
    // Handle the case where the query failed
    echo "Query failed: " . mysqli_error($conn);
}
}
?>
  
      <header>
          <img src="logo.png" alt="">
          <a href="dashboard.php]">FACULTY PORTAL</a>
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
            <span><i class="fa fa-user"></i>
          Faculty Profile
          </h4>
          <hr>
          </div>


       <form method="POST" enctype="multipart/form-data">
                            <!-- Update input names based on the database fields -->
                            <!-- Add your form fields here with the current values as default -->
                            <div class="row form-group">
    <div class="col-sm-2">
        <label class="control-label" style="position:relative; top:7px;">Current Image</label>
    </div>
    <div class="col-sm-10" style="margin: 0 auto; text-align: center;">
        <img src="../admin/images/profile/<?php echo $current_image;?>" alt="" style="width: 150px; height: 150px; border-radius: 50%">
    </div>
</div>

<div class="row form-group">
    <div class="col-sm-2" style="margin-top: 21%;">
        <label class="control-label" style="position:relative; top:50px;" >Last name:</label>
    </div>
    <div class="col-sm-10" style="margin-top: 10%;">
        <input type="text" class="form-control" name="lastname" value="<?php echo $lastname; ?>">
    </div>
</div>

<div class="row form-group">
    <div class="col-sm-2">
        <label class="control-label" style="position:relative;" >First name:</label>
    </div>
    <div class="col-sm-10" >
        <input type="text" class="form-control" name="firstname" value="<?php echo $firstname; ?>">
    </div>
</div>

<div class="row form-group">
    <div class="col-sm-2" >
        <label class="control-label" style="position:relative;" >Middle name:</label>
    </div>
    <div class="col-sm-10" >
        <input type="text" class="form-control" name="middlename" value="<?php echo $middlename; ?>">
    </div>
</div>
                        
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Gender:</label>
                            </div>
                            <div class="col-sm-10">
           
                            <select name="gender" class="form-control">
                                        <option value="male" <?php echo ($gender == 'male') ? 'selected' : ''; ?>>Male</option>
                                        <option value="female" <?php echo ($gender == 'female') ? 'selected' : ''; ?>>Female</option>
                                    </select>

                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Email:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Contact Number:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="contact_number" value="<?php echo $contactNumber; ?>">
                            </div>
                        </div>
                        

                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Civil Status</label>
                            </div>
                            <div class="col-sm-10">
           
								<select name="civil_status" class="form-control" >
									<option value="single" <?php echo ($civil_status == 'single') ? 'selected' : ''; ?> >Single</option>
									<option value="divorce" <?php echo ($civil_status == 'divorce') ? 'selected' : ''; ?> >Divorce</option>
                                    <option value="married" <?php echo ($civil_status == 'married') ? 'selected' : ''; ?> >Married</option>
                                    <option value="widowed" <?php echo ($civil_status == 'widowed') ? 'selected' : ''; ?> >Widowed</option>
								</select>

                            </div>
                        </div>

                       

                       

                        
                        
                     
                        
                      
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Birth Date:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="birth_date" value="<?php echo $birth_date; ?>">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Address:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
                            </div>
                        </div>


                        <div class="inputBox">
            <span>Update image (required)</span>
            <input type="file" name="image" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image;?>">

                                        <!-- Repeat the above structure for other form fields -->
                                        <!-- ... (other form fields) ... -->
                                        <div class="modal-footer">
                                            <button type="submit" name="edit" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Update</button>
                                        </div>
                                    </form>
                                </div>


                                <?php
            if(isset($_POST['edit']))
            {
                $id = $_POST['id'];
                $lastname = $_POST['lastname'];
                $firstname = $_POST['firstname'];
                $middlename = $_POST['middlename'];
                $gender = $_POST['gender'];
                $email = $_POST['email'];
                $civil_status = $_POST['civil_status'];
                $contact_number = $_POST['contact_number'];
                $birth_date = $_POST['birth_date'];
                $address = $_POST['address'];
                $current_image = $_POST['current_image'];
             
                if(isset($_FILES['image']['name']))
                {
                    //get the details of the selected image
                    $image_name = $_FILES['image']['name'];
    
                    //check if the imaage selected or not.
                    if ($image_name != "") {
                        // Image is selected
                        // Rename the image
                        $ext_parts = explode('.', $image_name);
                        $ext = end($ext_parts);
                    
                        // Create a new name for the image
                        $image_name = "Faculty-Profile" . rand(0000, 9999) . "." . $ext;
                    
                        // Upload the image
                    
                        // Get the src path and destination path
                    
                        // Source path is the current location of the image
                        $src = $_FILES['image']['tmp_name'];
                    
                        // Destination path for the image to be uploaded
                        $destination = "../admin/images/profile/" . $image_name;
                    
                        // Upload the food image
                        $upload = move_uploaded_file($src, $destination);
                    
                        // Check if the image uploaded or not
                        if ($upload == false) {
                            // Failed to upload the image
                            echo '<script>
                                swal({
                                    title: "Error",
                                    text: "Failed to upload image",
                                    icon: "error"
                                }).then(function() {
                                    window.location = "profile.php";
                                });
                            </script>';
                    
                            die();
                            exit;
                        } else {
                            // Image uploaded successfully
                        }
                    }
                    
    
                }
                else
                {
                    $image_name = ""; 
                }

                $sql = "UPDATE tbl_faculty SET lastname = '$lastname' , firstname = '$firstname' , middlename = '$middlename' , gender = '$gender' , email = '$email' , contact_number = '$contact_number'
    , civil_status = '$civil_status' ,   birth_date = '$birth_date', address = '$address', image='$image_name' WHERE id = $id";


            //execute the query
            $result = mysqli_query($conn,$sql);

            //check if the data is inserted or not
            if($result==TRUE)
            {
                //DATA inserted successfully
                echo '<script>
                swal({
                    title: "Success",
                    text: "Faculty Successfully Update",
                    icon: "success"
                }).then(function() {
                    window.location = "profile.php";
                });
            </script>';

            exit;
            }
            else
            {
                //failed to insert data
                echo '<script>
                        swal({
                            title: "Error",
                            text: "Failed to Update Faculty",
                            icon: "error"
                        }).then(function() {
                            window.location = "profile.php";
                        });
                    </script>';
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