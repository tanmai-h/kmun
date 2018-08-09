<?php


?>
<!DOCTYPE html>
<html>
<head>
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<title>Reset password</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<script>
		function validateEmail(email) {
			var pattern = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
	
			return pattern.test($.trim(email));
		}
		$('document').ready(function() {	
			
			$('#submit').on('click', function(event) {
				event.preventDefault();
				
				var email = $('#email').val();
				
				console.log(validateEmail(email));
				if(validateEmail(email) == false) {
					$('#error').html('Enter a valid email!');
				}
				else {
					$('#submit').attr('value', 'Processing');
					$.ajax({
						type : "POST",
						url : "sendEmail.php",
						data : {email: email, captcha: grecaptcha.getResponse()},
						success: function(result) {
							if(result === "OK"){
								window.location.href = "emailSent.html"
							}
							else {
								$('#submit').attr('value','Send reset link');
								$('#error').html(result);
							}
						}
					});
				}
			});
		});
	</script>
	<style> form {text-align: center;} .g-recaptcha {margin-left: 38%;}</style>
</head>
<body>
	<form method = "post">
		<input type = "email" name = "email" id = "email" placeholder = "Email" style = "padding: .4%;"/><br /><br />
		<div class="g-recaptcha" data-sitekey = "6LcIYV0UAAAAAC7edvDPvp5qbAySVgk6yWImGwYi"></div><br /><br />
		<span id = "error"></span>
		<input type = "submit" name = "submit" id = "submit" value = "Send reset Link" />
	</form>
</body>
</html><?php

?>