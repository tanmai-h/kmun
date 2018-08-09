<?php
	session_start();
	define('TNAME', 'users');
	
	if(!isset($_SESSION['email']) || empty($_SESSION['email'])) {
		redirect('/../../login/');
	}
	else {
		require_once(__DIR__ . '/../../req/connect.php');
		require_once(__DIR__ . '/../../req/utility.php');		
		//password
		
		if(isset($_POST['newPass'])) {
			if(!empty($_POST['newPass'])) {
				$password = $_POST['newPass'];
				$password = getHash($password);
				
				$query = "UPDATE " . TNAME . " SET `password` = :password WHERE `email` = :email";
				$input_array = array(':password' => $password, ':email' => $_SESSION['email']);
				try {
					$stmt = $pdo->prepare($query);	
					$stmt->execute($input_array);
					
					redirect('success.php');
				}
				catch(PDOException $e){
					$msg = $e->getMessage();
				}
			}
			else {
				$msg = "Can\'t be empty!";
			}
		}
	}	
?>
<!DOCTYPE html>
<html><head><meta content="width=device-width, initial-scale=1.0" name="viewport"></head>
	<body>
		<form action = "<?php  echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "post">
			<input type = "password" name = "newPass"/>
			<input type = "submit" value = "submit" />
			<span id = "error"><?php if(isset($msg)) { echo $msg; }?></span>
		</form>
	</body>	
</html>
