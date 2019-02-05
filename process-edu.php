<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
 include 'db_connect.php';
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
session_id("schooladd");
 //session_start();
 $education_id=0;
 $update=false;
 $school="";
 $period="";
	if (isset($_POST['submit'])) {
	// Escape user inputs for security
		$period = mysqli_real_escape_string($link, $_REQUEST['period']);
		$school = mysqli_real_escape_string($link, $_REQUEST['school']);


		// Attempt insert query execution
		$sql = "INSERT INTO education (period, school, user_id) VALUES ('$period', '$school', 1)";
		if(mysqli_query($link, $sql)){
		    //echo "Records added successfully.";
		    $_SESSION['message']='Success';
		    $_SESSION['msg_type']='success';
		    
		} else{
		    //echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
		    $_SESSION['message']="error";
		}
		header("Location:admin-panel.php");
		return;
	}


	if (isset($_GET['delete'])) {
		$education_id= $_GET['delete'];
		$sql="DELETE FROM education WHERE education_id=$education_id";
		if(mysqli_query($link, $sql)){
		    //echo "Records added successfully.";
		    $_SESSION['message']='No success';
		    $_SESSION['msg_type']='danger';
		    header("Location:admin-panel.php");
		} else{
		    //echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
		    $_SESSION['message']="error";
		}
		//header("Location:admin-panel.php");
		//return;
	}

	if (isset($_GET['edit'])) {
		$education_id= $_GET['edit'];
		$update=true;
		$result = $link->query("SELECT * FROM education WHERE education_id=$education_id") or die($link->error);
		$sql="SELECT FROM education WHERE education_id=$education_id";
		if($result->num_rows==1){
			$row=$result->fetch_array();
			$school=$row['school'];
			$period=$row['period'];
		}
	}

	if (isset($_POST['update'])) {
		$education_id= $_POST['education_id'];
		$school=$_POST['school'];
		$period=$_POST['period'];

		$link->query("UPDATE education SET school='$school', period='$period' WHERE education_id='$education_id'") or die($link->error);
		
		    //echo "Records added successfully.";
		    $_SESSION['message']='UPDATED';
		    $_SESSION['msg_type']='warning';
		    
		
		header("Location:admin-panel.php");
		return;
		
	}
// Close connection
mysqli_close($link);

 

?>