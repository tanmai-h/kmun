<?php
	require_once(__DIR__ . '/../../req/connect.php');
	require_once(__DIR__ . '/../../req/utility.php');
	
	
	define('TNAME', LOGIN_TABLE);
	$msg = "";
	$email = $_GET['email'];
	$token = $_GET['token'];
	
	$query = "SELECT activated, reset_identifier FROM " . TNAME . " WHERE email = :email";
	$stmt = $pdo->prepare($query);
	$stmt->bindParam(':email', $email);

	if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
		try {
			$stmt->execute();
			if($stmt->rowCount() == 0) {
				$msg = "This link is broken";
			}
			else {
				$fetched = $stmt->fetch();
				if(password_verify($token, $fetched['reset_identifier'])) {
					unset($query);
					
					//show password input
				?> 
				<!DOCTYPE html>
				<html>
				<head>
					<meta content="width=device-width, initial-scale=1.0" name="viewport">
	 <!-- Bootstrap CSS File -->
				<link href="../../../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
					<title>Reset password</title>
					<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
					<script> 
						$('document').ready( function() {
							$('#submit').on('click', function(event) {
								event.preventDefault();
								
								var password = $('#password').val();
								var email = "<?php echo $email; ?>";

								if($.trim(password) === "") {
									$('#error').html('New password can\'t be empty');
								}
								else {
									$('#submit').attr('value', 'Processing');
									$.ajax({
										type : "POST",
										url : "performReset.php",
										data : {password: password, email: email},
										success: function(result) {
											if(result === "OK"){
												window.location.href = "succes.html"
											}
											else {
												$('#submit').attr('value','Reset');
												$('#error').html(result);
											}
										}
									});
								}
							});
						});
					</script>
					<style>form {text-align: left; padding:20px 20px 0 20px;}</style>
				</head>
				<body>
					<form method = "post">
						<input type = "password" class="form-control" style = "padding: .4%;" name = "password" id = "password" placeholder = "New password" style = "padding: .4%;"/><br /><br />
						<span id = "error"></span>
						<input type = "submit" class="btn btn-success" name = "submit" id = "submit" value = "Reset" />
					</form>
				</body>
				</html>
				<?php 
				}
				else {
					$msg = "This link is broken";
				}
			}
		}
		catch(PDOException $e) {
			$msg = $e->getMessage();
		}
	}
	else {
		$msg = "This link is broken";
	}
	
	echo $msg;
?>