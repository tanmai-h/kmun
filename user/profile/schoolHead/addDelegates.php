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

		if(isset($_POST['delegateList'])) {
			$errorList = "";
			$msg = "";
			$delegateArray = array();
			$flag = 1;

			if(!empty($_POST['delegateList'])) {
				$delegateList = explode("\n", $_POST['delegateList']);
				foreach($delegateList as $delegate){
					$delegate = explode("," , $delegate);
					$name = explode(" ", $delegate[0]);
					$second = "";
					for($i = 1; $i < count($name); $i++) {
						$second .= $name[$i] . ' ';
					}
					if(count($delegate) != 2) { //if no email given
						$flag = 0; break;
					}

					$name[0] = str_replace("<", "&lt", $name[0]);
					$name[0] = str_replace(">", "&gt", $name[0]);
					$second = str_replace("<", "&lt", $second);
					$second = str_replace(">", "&gt", $second);

					$delegateArray[] = array( 'firstName' => $name[0], 'lastName' => $second, 'email' => trim($delegate[1]));
				}

				foreach($delegateArray as $delegate) {
					if (!filter_var($delegate['email'], FILTER_VALIDATE_EMAIL)) {
						$msg = "all emails must be vailid!";
						$errorList = $_POST['delegateList'];
						$flag = 0;
						break;
					}
				}

				if($flag == 1) {
					// add all delegate emails to users
					define('TNAME', 'users');
					$query = "INSERT INTO " .TNAME. " (email, password, firstName, lastName, activated, school, type, headedBy, created_at) VALUES (:email, :password, :firstName, :lastName, :activated, :school, :type, :headedBy, :created_at)";

					foreach ($delegateArray as $delegate) {
						$input_array = array(':email' => $delegate['email'], ':password' => getHash($delegate['email']), ':firstName' => $delegate['firstName'], ':lastName' => $delegate['lastName'], ':activated' => 1, ':school' => $_SESSION['school'], ':type' => 'student', ':headedBy' => $_SESSION['email'] , ':created_at' => time());
						$stmt = $pdo->prepare($query);

						try {
							$stmt->execute($input_array) ;
							$_POST['delegateList'] = "";
							$msg = "Delegates added!. They can login using their email and password(same as the email currently)  or reset their passwords";

						}
						catch(PDOException $e) {
							$msg = $e->getMessage();
						}
					}
				}
				else {
					$msg = "Enter valid emails";
				}
			}
			else {
				$msg = "Can\'t be empty";
			}
		}else {
		//	$msg = "variables not set";
		}
		echo $msg;
	// If session variable is not set it will redirect to login page
	}
?>
