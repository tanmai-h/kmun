<?php
	// Initialize the session
	session_start();

	if(!isset($_SESSION['email']) || empty($_SESSION['email'])) {
		redirect('login/login.php');
	}
	else {
		//echo 's';
		
		print_r($_SESSION);
		if(strcmp($_SESSION['type'], "student") != 0){
			redirect('../../index.php');
		}
	}
	// If session variable is not set it will redirect to login page
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<title></title>
</head>
<body>
	<a href = "../../logout.php">Logout</a>
	<a href = "../change/">Change password</a>
	<a href = "../preference">Select Committee Preferences</a>
	<a href = "../change/details.php">Add Details</a>
</body>
</html>