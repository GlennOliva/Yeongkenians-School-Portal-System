<?php 
define('HOST','localhost');
define('DBUSER','root');
define('DBPASSWORD','');
define('DB','student');

$con =mysqli_connect(HOST,DBUSER,DBPASSWORD,DB);
if($con->connect_errno)
{
    echo 'database connection error';
}
 ?>
