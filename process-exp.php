<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
 include 'db_connect.php';
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
session_id("jobadd");
 $experience_id=0;
 $update=false;
 $job="";
 $period="";
	if (isset($_POST['submit'])) {
	// Escape user inputs for security
		$job = mysqli_real_escape_string($link, $_REQUEST['job']);
		$period = mysqli_real_escape_string($link, $_REQUEST['period']);

		// Attempt insert query execution
		$sql = "INSERT INTO experience ( job, period,user_id) VALUES (' '$job',$period', 1)";
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
		$experience_id= $_GET['delete'];
		$sql="DELETE FROM experience WHERE experience_id=$experience_id";
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
		$experience_id= $_GET['edit'];
		$update=true;
		$result = $link->query("SELECT * FROM experience WHERE experience_id=$experience_id") or die($link->error);
		$sql="SELECT FROM experience WHERE experience_id=$experience_id";
		if($result->num_rows==1){
			$row=$result->fetch_array();
			$job=$row['job'];
			$period=$row['period'];
		}
	}

	if (isset($_POST['update'])) {
		$experience_id= $_POST['experience_id'];
		$job=$_POST['job'];
		$period=$_POST['period'];

		$link->query("UPDATE experience SET job='$job', period='$period' WHERE experience_id='$experience_id'") or die($link->error);
		
		    //echo "Records added successfully.";
		    $_SESSION['message']='UPDATED';
		    $_SESSION['msg_type']='warning';
		    
		
		header("Location:admin-panel.php");
		return;
		
	}
// Close connection
mysqli_close($link);

 

?>