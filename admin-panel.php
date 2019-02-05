<?php
include 'db_connect.php';
require_once 'process-skill.php';
require_once 'process-lang.php';
require_once 'process-edu.php';
require_once 'process-exp.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="assets/css/admin-style.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
</head>
<body>
	<header>
		<a id="login" href="index.php">back</a>
	</header>
<?php 
if (isset($_SESSION['message'])): { ?>
	<div class="alert alert-<?=$_SESSION['msg_type']?>">
<?php
	echo $_SESSION['message'];
	unset($_SESSION['message']);
}?>
</div>
<?php  endif;?>

<?php
			$result = $conn->query("SELECT fname,lname,position,email,phone,location,website FROM users") or die($conn->error);

				if ($result->num_rows > 0) {
			    // output data of each row
			    while($row = $result->fetch_assoc()) {?>

<div class="container">
	<div class="col-md-12">

		<form action="insert.php" method="post">
			<input type="text" name="first_name" value="<?php echo $row["fname"]; ?>">
			<label for=""> <?php echo $row["fname"]; ?></label><br/>
			<input type="text" name="last_name" value="<?php echo $row["lname"]; ?>">
			<label for=""> <?php echo $row["lname"]; ?></label><br/>
			<input type="text" name="position" value="<?php echo $row["position"]; ?>">
			<label for=""> <?php echo $row["position"]; ?></label><br/>
			<input type="text" name="email" value="<?php echo $row["email"]; ?>">
			<label for=""> <?php echo $row["email"]; ?></label><br/>
			<input type="text" name="phone" value="<?php echo $row["phone"]; ?>">
			<label for=""> <?php echo $row["phone"]; ?></label><br/>
			<input type="text" name="location" value="<?php echo $row["location"]; ?>">
			<label for=""> <?php echo $row["location"]; ?></label><br/>
			<input type="text" name="website" value="<?php echo $row["website"]; ?>">
			<label for=""> <?php echo $row["website"]; ?></label><br/>
			<input type="submit" name="save" value="Submit" class="btn btn-primary"><br/>
		</form>
	</div>
<?php
			    }
			} else {
			    echo "0 results";
			}
			
			?>
	<div class="results">

<!-- Skills section-->
		<ul id="skills">
			<h2>Skills</h2>
		<?php
			$result = $conn->query("SELECT skill,percentage,skill_id FROM skills") or die($conn->error);

				if ($result->num_rows > 0) {
			    // output data of each row
			    while($row = $result->fetch_assoc()) {?>
			        <li class="row">  
						<div class="col-md-8">
			        	<?php echo $row["skill"]. " - " . $row["percentage"]; ?>
			        	</div>
			        	<div class="col-md-4">
			        	<a href="admin-panel.php?edit=<?php echo $row['skill_id']; ?>"
							class="btn btn-info">Edit			        		
			        	</a>
			        	<a href="admin-panel.php?delete=<?php echo $row['skill_id']; ?>"
							class="btn btn-danger">Delete			        		
			        	</a>
			        	</div>
			        </li><br>

			<?php
			    }
			} else {
			    echo "0 results";
			}
			function pre_r ($array) {
				echo '<pre>';
				print_r($array);
				echo '</pre>';
			}
			?>
		</ul>
	</div>
	<form id="skill-form" action="process-skill.php" method="post">
		<div class="row">
			<input type="hidden" name="skill_id" value="<?php echo $skill_id; ?>">
			<div class="col-md-3">
				<label for="">Skill: </label><input type="text" name="skill" value="<?php echo $skill; ?>"><br/>
			</div>
			<div class="col-md-3">
				<label for="">Percent: </label><input type="text" name="percentage" value="<?php echo $percentage; ?>"><br/>
			</div>
			<div class="col-md-3">
				<?php 
				if ($update):
				?>
					<input type="submit" name="update" value="Update" class="btn btn-primary"><br/>
				<?php else: ?>
					<input type="submit" name="submit" value="Submit" class="btn btn-info"><br/>
				<?php endif; ?>
			</div>	
		</div>
	</form>

<!-- Skills section END-->
<!-- Languages section-->
		<ul id="languages">
			<h2>Languages</h2>
		<?php
			$result = $conn->query("SELECT language,level,language_id FROM languages") or die($conn->error);

				if ($result->num_rows > 0) {
			    // output data of each row
			    	while($row = $result->fetch_assoc()) {
		?>
				        <li class="row">  
							<div class="col-md-8">
				        	<?php echo $row["language"]. " - " . $row["level"]; ?>
				        	</div>
				        	<div class="col-md-4">
				        	<a href="admin-panel.php?edit=<?php echo $row['language_id']; ?>"
								class="btn btn-info">Edit			        		
				        	</a>
				        	<a href="admin-panel.php?delete=<?php echo $row['language_id']; ?>"
								class="btn btn-danger">Delete			        		
				        	</a>
				        	</div>
				        </li><br>

			<?php
			   	 }
				} else {
			    echo "0 results";
				}
			
			?>
		</ul>
	
	<form id="language-form" action="process-lang.php" method="post">
		<div class="row">
			<input type="hidden" name="language_id" value="<?php echo $language_id; ?>">
			<div class="col-md-4">
				<label for="">Language: </label><input type="text" name="language" value="<?php echo $language; ?>"><br/>
			</div>
			<div class="col-md-4">
				<label for="">Level: </label><input type="text" name="level" value="<?php echo $level; ?>"><br/>
			</div>
			<div class="col-md-4">
			<?php 
			if ($update):
			?>

			
				<input type="submit" name="update" value="Update" class="btn btn-primary"><br/>
			<?php else: ?>
				<input type="submit" name="submit" value="Submit" class="btn btn-info"><br/>
			

			<?php endif; ?>	
			</div>
		</div>
	</form>

<!-- Languages section END-->
<!-- Education section-->
	<ul id="education">
		<h2>Education</h2>
		<?php
			$result = $conn->query("SELECT period,school,education_id FROM education") or die($conn->error);

				if ($result->num_rows > 0) {
			    // output data of each row
			    while($row = $result->fetch_assoc()) {?>
			        <li class="row">  
						<div class="col-md-8">
			        	<?php echo $row["school"]. " - " . $row["period"]; ?>
			        	</div>
			        	<div class="col-md-4">
			        	<a href="admin-panel.php?edit=<?php echo $row['education_id']; ?>"
							class="btn btn-info">Edit			        		
			        	</a>
			        	<a href="admin-panel.php?delete=<?php echo $row['education_id']; ?>"
							class="btn btn-danger">Delete			        		
			        	</a>
			        	</div>
			        </li><br>

		<?php
			    }
			} else {
			    echo "0 results";
			}
			
			?>
		</ul>
	
	<form id="school-form" action="process-edu.php" method="post">
		<div class="row">
				<input type="hidden" name="education_id" value="<?php echo $education_id; ?>">
			<div class="col-md-4">
				<label for="">School: </label><input type="text" name="school" value="<?php echo $school; ?>"><br/>
			</div>
			<div class="col-md-4">
				<label for="">Period: </label><input type="text" name="period" value="<?php echo $period; ?>"><br/>
			</div>
			<div class="col-md-4">
				<?php 
				if ($update):
				?>
					<input type="submit" name="update" value="Update" class="btn btn-primary"><br/>
				<?php else: ?>
					<input type="submit" name="submit" value="Submit" class="btn btn-info"><br/>
				<?php endif; ?>	
			</div>
		</div>
	</form>
<!-- Education section END-->
<!-- Experience section-->
		<ul id="experience">
			<h2>Experience</h2>
		<?php
			$result = $conn->query("SELECT job,period,experience_id FROM experience") or die($conn->error);

				if ($result->num_rows > 0) {
			    // output data of each row
			    	while($row = $result->fetch_assoc()) {
		?>
				        <li class="row">  
							<div class="col-md-8">
				        	<?php echo $row["job"]. " - " . $row["period"]; ?>
				        	</div>
				        	<div class="col-md-4">
				        	<a href="admin-panel.php?edit=<?php echo $row['experience_id']; ?>"
								class="btn btn-info">Edit			        		
				        	</a>
				        	<a href="admin-panel.php?delete=<?php echo $row['experience_id']; ?>"
								class="btn btn-danger">Delete			        		
				        	</a>
				        	</div>
				        </li><br>

			<?php
			   	 }
				} else {
			    echo "0 results";
				}
			
			?>
		</ul>
	
	<form id="job-form" action="process-exp.php" method="post">
		<div class="row">
			<input type="hidden" name="experience_id" value="<?php echo $experience_id; ?>">
			<div class="col-md-3">
				<label for="">Job: </label><input type="text" name="job" value="<?php echo $job; ?>"><br/>
			</div>
			<div class="col-md-3">
				<label for="">Period: </label><input type="text" name="period" value="<?php echo $period; ?>"><br/>
			</div>
			<div class="col-md-3">
			<?php 
			if ($update):
			?>

			
				<input type="submit" name="update" value="Update" class="btn btn-primary"><br/>
			<?php else: ?>
				<input type="submit" name="submit" value="Submit" class="btn btn-info"><br/>
			

			<?php endif; ?>	
			</div>
		</div>
	</form>

<!-- Experience section END-->		

		
</div>
<footer></footer>
</body>
</html>

