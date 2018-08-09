<?php
	require_once(__DIR__.'/../../req/connect.php');
	require_once(__DIR__.'/../../req/utility.php');
	// Initialize the session
	session_start();

	if(!isset($_SESSION['email']) || empty($_SESSION['email'])) {
		redirect('../../login/');
	}
	else {
		if(strcmp($_SESSION['type'], "headDelegate") != 0){
			redirect('../../index.php');
		}
		echo '<br />';
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
</head>
<body>
	<a href = "../../logout.php">Logout</a>
	<a href = "addDelegates.php">Click here to Add Delegates</a>
	
	<a href = "../change/">Change password</a>
	<a href = "../preference">Select Committee Preferences</a>
	<a href = "../change/details.php">Add Details</a>
</body>
</html>