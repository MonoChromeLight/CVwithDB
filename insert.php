<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
//$conn = mysqli_connect("localhost", "root", "", "cv-db");
 include 'db_connect.php';
// Check connection
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 session_start();
$first_name = "";
$last_name = "";
$position = "";
$email = "";
$phone = "";
$location= "";
$website = "";


 if(isset($_POST['save'])){
// Escape user inputs for security
$first_name = mysqli_real_escape_string($conn, $_REQUEST['first_name']);
$last_name = mysqli_real_escape_string($conn, $_REQUEST['last_name']);
$position = mysqli_real_escape_string($conn, $_REQUEST['position']);
$email = mysqli_real_escape_string($conn, $_REQUEST['email']);
$phone = mysqli_real_escape_string($conn, $_REQUEST['phone']);
$location= mysqli_real_escape_string($conn, $_REQUEST['location']);
$website = mysqli_real_escape_string($conn, $_REQUEST['website']);


 
// Attempt insert query execution
//$sql = "INSERT INTO user (Fname, Lname, Email, user_id) VALUES ('$first_name', '$last_name', '$email',2)";
 //$sql = "INSERT INTO users 
//                    SET fname= '$first_name', lname='$last_name', email='$email'";

$sql = "UPDATE users 
                    SET fname= '$first_name', lname='$last_name',position='$position', email='$email',phone='$phone',
                    location='$location', website='$website'
                    WHERE user_id=1";
if(mysqli_query($conn, $sql)){
    echo "Records added successfully.";
    header("Location:admin-panel.php");
	return;
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}
 }
// Close connection
mysqli_close($conn);
?>