<?php
	
	require_once(__DIR__.'/../req/connect.php');
	require_once(__DIR__.'/../req/utility.php');
	if(isset($_SESSION['email']) && !empty($_SESSION['email'])) {
		redirect('../index.php');
	}
	$email = $password = $hashed = $time = $activated = $msg = 0;
	define('TNAME', LOGIN_TABLE);

	if(isset($_POST['email']) && isset($_POST['password'])) {
		$email = $_POST['email'];
		$password = $_POST['password'];
		
		if(!empty($email) && !empty($password)) {
			global $pdo;
			$query = "SELECT id, email, firstName, lastName, school, type, activated, password FROM " . TNAME . " WHERE email = :email";
			$stmt = $pdo->prepare($query);
			$stmt->bindParam(':email', $email);

			try {
				$stmt->execute();
				
				if($stmt->rowCount() == 0) {
					$msg = 'Invalid Credentials';
				}
				else {
					$fetched = $stmt->fetch();
					if($fetched['activated'] == 0) {
						$msg = 'Account not activated';
					}
					else {
						if(password_verify($password, $fetched['password'])) {
							session_start();
							$_SESSION['firstName'] = $fetched['firstName'];
							$_SESSION['lastName'] = $fetched['lastName'];
							$_SESSION['school'] = $fetched['school'];
							$_SESSION['email'] = $fetched['email'];
							$_SESSION['type'] = $fetched['type'];
							//redirect('../index.php');
							$msg = 'OK';
						}	
						else {
							$msg = 'Invalid Credentials';
						}
					}
				}
			}
			catch(PDOException $e) {
				$msg = $e->getMessage();
			}
		}
		else {
			$msg = "All details required!";
		}
	}
	echo $msg;
?>