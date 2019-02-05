<?php
require_once("db_connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Curriculum Vitae</title>
	
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
   <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
	<header>
		<a id="login" href="admin-panel.php">login</a>
		<div class="wave">

  			<svg viewBox="0 0 500 200" preserveAspectRatio="xMinYMin meet">
  			<path d="M0,90 C160,200 210,0 500,90 L500,00 L0,0 Z" style="stroke: none; fill: #c5d5c5;"></path>
  			<path d="M0,70 C160,200 210,0 500,90 L500,00 L0,0 Z" style="stroke: none; fill: #9fa9a3;"></path>
  			</svg>
		</div>
		<div id="profile-img" class="col-md-8"></div> 
		<?php

				$query = "SELECT fname,lname, position FROM users";
				$name = "s";
				$result = $conn->query($query);

				if ($result->num_rows > 0) {
				    // output data of each row
				    while($row = $result->fetch_assoc()) {
				     echo '<div id="name">'. $row["fname"]." ".$row["lname"].'</div><br/>';
				     echo '<div id="position">'. $row["position"].'</div><br/>';
				    }
				} else {
				    echo "0 results";
				}
				
				?>

		
		
		
	</header>
	<div class="container main">
		<div class="row">
			<div class="col-md-4 sidebar">
				<h2>Contacts</h2>
				<?php 
				$query = "SELECT email,phone,location,website FROM users";
				 
				$result = $conn->query($query);

				if ($result->num_rows > 0) {
				    // output data of each row
				    while($row = $result->fetch_assoc()) {
				        echo $row["email"]. "<br>";
				        echo $row["phone"]. "<br>";
				        echo $row["location"]. "<br>";
				        echo $row["website"]. "<br>";
				    }
				} else {
				    echo "0 results";
				}
				
				?>


				<!-- contacts END-->
				<h2>Skills</h2>
				<?php

				$query = "SELECT skill,percentage FROM skills";
				 
				$result = $conn->query($query);

				if ($result->num_rows > 0) {
				    // output data of each row
				    while($row = $result->fetch_assoc()) {
				        echo $row["skill"]. " - " . $row["percentage"]. "<br>";
				    }
				} else {
				    echo "0 results";
				}
				
				?>
			

				<h2>Languages</h2>

							<?php

				$query = "SELECT language,level FROM languages";
				 
				$result = $conn->query($query);

				if ($result->num_rows > 0) {
				    // output data of each row
				    while($row = $result->fetch_assoc()) {
				        echo $row["language"]. " - " . $row["level"]. "<br>";
				    }
				} else {
				    echo "0 results";
				}
				
				?>
			</div>
			<div class="col-md-8 main">
				<h2>Experience</h2>
							<?php

				$query = "SELECT job,period FROM experience";
				 
				$result = $conn->query($query);

				if ($result->num_rows > 0) {
				    // output data of each row
				    while($row = $result->fetch_assoc()) {
				        echo $row["period"]. " - " . $row["job"]. "<br>";
				    }
				} else {
				    echo "0 results";
				}
				?>

				<h2>Education</h2>
							<?php

				$query = "SELECT school,period FROM education";
				 
				$result = $conn->query($query);

				if ($result->num_rows > 0) {
				    // output data of each row
				    while($row = $result->fetch_assoc()) {
				        echo $row["period"]. " - " . $row["school"]. "<br>";
				    }
				} else {
				    echo "0 results";
				}
				$conn->close();
				?>
			</div>
		</div>
	</div>
	<footer>
		<div class="copyright">Designed by ChrisEm</div>
	</footer>
</html>

