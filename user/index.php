<?php
	require_once(__DIR__.'/req/utility.php');
	// Initialize the session
	session_start();

	if(!isset($_SESSION['email']) || empty($_SESSION['email'])) {
		redirect('../');
	}
	else {
		//echo 's';
		print_r($_SESSION);
		$forwardUrl = "./profile/";
		
		if($_SESSION['type'] == 'student') 
			$forwardUrl .= "student/";
		else if($_SESSION['type'] == 'headDelegate') 
			$forwardUrl .= "schoolHead/";
		
		redirect($forwardUrl);
	}
	// If session variable is not set it will redirect to login page
	
?>