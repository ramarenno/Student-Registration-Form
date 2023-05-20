<?php
require_once('config.php');

if(isset($_POST)){

	if(isset($_POST['gender'])) {
		$type = 0;

		if($_POST['gender'] == "Male")
			$type = 1;
		if($_POST['gender'] == "Female")
			$type = 0;
	}

	$full_name = $_POST['full_name'];
	$email = $_POST['email'];
	$gender = isset($_POST['gender']) ? $_POST['gender'] : "";

	$sql = "INSERT INTO students (full_name, email, gender) VALUES(?,?,?)";
	$stmtinsert = $db->prepare($sql);
	$result = $stmtinsert->execute([$full_name, $email, $gender]);

	if($result) {
		echo 'Successfully saved.';
	} else {
		echo 'There were errors while saving the data.';
	}
} else {
	echo 'No data';
}
?>