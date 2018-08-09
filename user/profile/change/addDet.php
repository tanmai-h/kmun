<?php
	require_once(__DIR__.'/../../req/connect.php');
	require_once(__DIR__.'/../../req/utility.php');
	
	session_start();
	define('TNAME', 'details');
	
	if(isset($_POST['phone']) && isset($_POST['numAwards']) && isset($_POST['numMuns']) && isset($_POST['info'])) {
		//if(!empty($_POST['phone']) && !empty($_POST['numAwards']) && !empty($_POST['numMuns']) && !empty($_POST['info'])) {
			
			$query = "INSERT INTO " . TNAME . " (email, phone, muns, awards, info) VALUES (:email, :phone, :muns, :awards, :info)";
			$stmt = $pdo->prepare($query);
			
			try {
				$in = array(':email' => $_SESSION['email'], ':phone' => $_POST['phone'], ':muns' => $_POST['numMuns'], ':awards' => $_POST['numAwards'], ':info' => $_POST['info']);
				$stmt->execute($in);
				
				$msg =  'Details Added!';
			}
			catch(PDOException $e) {
				$msg =  $e->getMessage();
			}
		/*}
		else {
			$msg =  'All values required';
		}*/
	}
	else {
		$msg =  'Variables not set';
	}
	
	echo $msg;
?>