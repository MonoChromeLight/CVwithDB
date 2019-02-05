<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
 include 'db_connect.php';
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
session_id("skilladd");
 session_start();
 $skill_id=0;
 $update=false;
 $skill="";
 $percentage="";
	if (isset($_POST['submit'])) {
	// Escape user inputs for security
		$skill = mysqli_real_escape_string($link, $_REQUEST['skill']);
		$percentage = mysqli_real_escape_string($link, $_REQUEST['percentage']);

		// Attempt insert query execution
		$sql = "INSERT INTO skills (percentage, skill, user_id) VALUES ('$percentage', '$skill', 1)";
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
		$skill_id= $_GET['delete'];
		$sql="DELETE FROM skills WHERE skill_id=$skill_id";
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
		$skill_id= $_GET['edit'];
		$update=true;
		$result = $link->query("SELECT * FROM skills WHERE skill_id=$skill_id") or die($link->error);
		$sql="SELECT FROM skills WHERE skill_id=$skill_id";
		if($result->num_rows==1){
			$row=$result->fetch_array();
			$skill=$row['skill'];
			$percentage=$row['percentage'];
		}
	}

	if (isset($_POST['update'])) {
		$skill_id= $_POST['skill_id'];
		$skill=$_POST['skill'];
		$percentage=$_POST['percentage'];

		$link->query("UPDATE skills SET skill='$skill', percentage='$percentage' WHERE skill_id='$skill_id'") or die($link->error);
		
		    //echo "Records added successfully.";
		    $_SESSION['message']='UPDATED';
		    $_SESSION['msg_type']='warning';
		    
		
		header("Location:admin-panel.php");
		return;
		
	}
// Close connection
mysqli_close($link);

 

?>