<?php
	require_once(__DIR__ . '/../req/connect.php');
	require_once(__DIR__ . '/../req/utility.php');

	$msg = "";
	define('TNAME', LOGIN_TABLE);

	$query = "SELECT email, activated, active_hash FROM " .TNAME. " WHERE email = :email ";
	$stmt = $pdo->prepare($query);
	$stmt->bindParam(':email', $_GET['email']);

	if($stmt->execute()) {
		if($stmt->rowCount() == 0) {
			$msg = 'This link is broken.';
		}
		else {
			$fetched = $stmt->fetch();
			if($fetched['activated'] == 1) {
				$msg = 'Your account has already been activated. Head over to' . '<a href = "http://2018.kmun.in">KMUN</a>to login';
			}
			else {
				if(password_verify($_GET['tokenHash'],  $fetched['active_hash'])) {
					unset($query);
					unset($stmt);
					$query = "UPDATE " . TNAME . " SET activated = 1, active_hash = null WHERE email = :email";
					$stmt = $pdo->prepare($query);
					$stmt->bindParam(':email', $_GET['email']);

					try {
						$stmt->execute();
						$msg = 'Your account with the email ' . $_GET['email'] . ' has been successfully activated!' . '<br />Head over to' . '<a href = "http://2018.kmun.in">KMUN</a>to login';
					}
					catch(PDOException $e){
						
						$msg = 'Cant activate ' . $e->getMessage() ;
					}
				}
				else {
					$msg = 'This link is broken.';
				}
			}
		}
	}
	else {
		$msg = 'Can\'t execute';
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<title>KMUN 2018</title>
</head>
<body>
	<span><?php echo $msg ?></span>
</body>
</html>