<?php
	require_once(__DIR__.'/../../req/connect.php');
	require_once(__DIR__.'/../../req/utility.php');
	
	$msg = "";
	define('TNAME', 'users');
	
	if(isset($_POST['password']) && isset($_POST['email'])) {
		if(!empty($_POST['email']) && !empty($_POST['password'])){
			$hashed = getHash($_POST['password']);
			$query = "UPDATE " . TNAME . " SET password = :password, activated = :activated, reset_identifier = :re WHERE email = :email";
			$in = array(':password' => $hashed, ':activated' => 1, ':email' => $_POST['email'], ':re' => NULL);
			
			$stmt = $pdo->prepare($query);
			try {
				$stmt->execute($in);
				$msg = "OK";
			}
			catch(PDOException $e) {
				$msg = $e->getMessage();
			}
		}
		else {
			$msg = "Password can`'t be empty";
		}
	}
	else {
		$msg = "variables not set";
	}
	echo $msg;
?>