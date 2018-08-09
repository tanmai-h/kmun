<?php
	require_once('connect.php');
	require_once('utility.php');

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
				$msg = 'This activation link has already been used';
			}
			else {
				if(password_verify($_GET['token'],  $fetched['active_hash'])) {
					unset($query);
					unset($stmt);
					$query = "UPDATE " . TNAME . " SET activated = 1, active_hash = null WHERE email = :email";
					$stmt = $pdo->prepare($query);
					$stmt->bindParam(':email', $_GET['email']);

					if($stmt->execute()) {
						$msg = 'Your account with the email ' . $_GET['email'] . ' has been successfuly activated' . 'You can now ' . '<a href = "../login/">Login</a>';
					}
					else {
						$msg = 'cant activate';
					}
				}
				else {
					$msg = 'This link is broken.';
				}
			}
		}
	}
	else {
		$msg = 'cant execute';
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>activate</title>
</head>
<body>
	<span><?php echo $msg ?></span>
</body>
</html>