<?php
// Assuming you have a function to retrieve user details from the database
$userDetails = getUserDetails($_GET['username']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
</head>
<body>

<h2>User Details</h2>

<!-- Display User Details -->
<ul>
    <li><strong>Username:</strong> <?php echo $userDetails['username']; ?></li>
    <li><strong>Email:</strong> <?php echo $userDetails['email']; ?></li>
    <li><strong>Role:</strong> <?php echo $userDetails['role']; ?></li>
    <li><strong>Permissions:</strong> <?php echo $userDetails['permissions']; ?></li>
    <li><strong>Account Status:</strong> <?php echo $userDetails['status']; ?></li>
    <li><strong>Date of Creation:</strong> <?php echo $userDetails['created_at']; ?></li>
    <li><strong>Last Login:</strong> <?php echo $userDetails['last_login']; ?></li>
</ul>

<!-- Link to Edit User -->
<a href="edit.php?username=<?php echo $userDetails['username']; ?>">Edit User</a>

</body>
</html>
