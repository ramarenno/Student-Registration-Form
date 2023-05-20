<?php
require_once('config.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>User Registration | PHP</title>
	<link rel="stylesheet" type="text/css" ">
</head>
<body>

<div>
	<form action="registration.php" method="post">
		<div>
			
			<div>
				<div>
					<h1>Registration</h1>
					<p>Fill up the form with correct values.</p>

					<hr>

					<label for="full_name"><b>Full Name</b></label>
					<input id="full_name" type="text" name="full_name" required>

					<br>

					<label for="email"><b>Email Address</b></label>
					<input id="email"  type="email" name="email" required>

					<br>

					<input type="radio" id="gender1" name="gender" value="1">
					<label for="gender1">Male</label><br>

					<input type="radio" id="gender2" name="gender" value="2">
					<label for="gender2">Female</label><br>

					<hr >
					<input type="submit" id="register" name="create" value="Sign Up">
				</div>
			</div>
		</div>
	</form>

	<?php
		$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		// Create the database if it doesn't exist
		$sql = "CREATE DATABASE IF NOT EXISTS $db_name";
		if ($conn->query($sql) === TRUE) {
			echo "Database created successfully";
		} else {
			echo "Error creating database: " . $conn->error;
		}

		// Select the database
		$conn->select_db($db_name);

		// Create the students table if it doesn't exist
		$sql = "CREATE TABLE IF NOT EXISTS students (
			id INT(11) AUTO_INCREMENT PRIMARY KEY,
			full_name VARCHAR(255),
			email VARCHAR(255),
			gender ENUM('Male', 'Female') NOT NULL
		)";

		
		if ($conn->query($sql) === TRUE) {
			echo "Table created successfully";
		} else {
			echo "Error creating table: " . $conn->error;
		}

		

		// List Students on the page
		$sql = "SELECT * FROM students";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			echo "<h2>Registered Students</h2>";
			echo "<table>";
			echo "<tr><th>ID</th><th>Full Name</th><th>Email</th><th>Gender</th></tr>";
			while ($row = $result->fetch_assoc()) {
				echo "<tr><td>".$row['id']."</td><td>".$row['full_name']."</td><td>".$row['email']."</td><td>".$row['gender']."</td></tr>";
			}
			echo "</table>";	
		} else {
			echo "No students registered";
		}

		$conn->close();
		?>	
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript">
	$(function(){
		$('#register').click(function(e){

			var valid = this.form.checkValidity();

			if(valid){


			var full_name 	= $('#full_name').val();
			var email 		= $('#email').val();
			var gender = $('input[name=gender]:checked').val();

				e.preventDefault();	

				$.ajax({
					type: 'POST',
					url: 'process.php',
					data: {full_name: full_name,email: email,gender: gender},
					success: function(data){
					Swal.fire({
								'title': 'Successful',
								'text': data,
								'type': 'success'
								})
							
					},
					error: function(data){
						Swal.fire({
								'title': 'Errors',
								'text': 'There were errors while saving the data.',
								'type': 'error'
								})
					}
				});

				
			}else{
				
			}

			



		});		

		
	});
	
</script>

	
</body>
</html>