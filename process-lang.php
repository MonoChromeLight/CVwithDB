<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
 include 'db_connect.php';
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
session_id("languageadd");
 //session_start();
 $language_id=0;
 $update=false;
 $language="";
 $level="";
	if (isset($_POST['submit'])) {
	// Escape user inputs for security
		$language = mysqli_real_escape_string($link, $_REQUEST['language']);
		$level = mysqli_real_escape_string($link, $_REQUEST['level']);

		// Attempt insert query execution
		$sql = "INSERT INTO languages (level, language, user_id) VALUES ('$level', '$language', 1)";
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
		$language_id= $_GET['delete'];
		$sql="DELETE FROM languages WHERE language_id=$language_id";
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
		$language_id= $_GET['edit'];
		$update=true;
		$result = $link->query("SELECT * FROM languages WHERE language_id=$language_id") or die($link->error);
		$sql="SELECT FROM languages WHERE language_id=$language_id";
		if($result->num_rows==1){
			$row=$result->fetch_array();
			$language=$row['language'];
			$level=$row['level'];
		}
	}

	if (isset($_POST['update'])) {
		$language_id= $_POST['language_id'];
		$language=$_POST['language'];
		$level=$_POST['level'];

		$link->query("UPDATE languages SET language='$language', level='$level' WHERE language_id='$language_id'") or die($link->error);
		
		    //echo "Records added successfully.";
		    $_SESSION['message']='UPDATED';
		    $_SESSION['msg_type']='warning';
		    
		
		header("Location:admin-panel.php");
		return;
		
	}
// Close connection
mysqli_close($link);

 

?>