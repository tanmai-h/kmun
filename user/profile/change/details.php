<?php
	session_start();

	if(!isset($_SESSION['email']) || empty($_SESSION['email'])) {
		redirect('login/login.php');
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script>
		$('document').ready(function(){
			$('#submit').on('click', function(event) {
				event.preventDefault();
				var numMuns = $('#numMuns').val(),
				phone = $('#phone').val();
				numAwards = $('#numAwards').val(),
				info = $('#info').val();
				
				if(!$.isNumeric(phone) || phone.length != 10) {
					$('#error').html('10 digit phone number !');
				}
				else {
					$('#error').html('');
					if( $.isNumeric(numMuns) && $.isNumeric(numAwards) && numAwards >= 0 && numMuns >= 0) {
						$.ajax({
							type:  "POST",
							url : "addDet.php",
							data:{phone: phone, numAwards: numAwards, numMuns: numMuns, info: info},
							success: function(result){
								$('#error').html(result);
							}
						});
						}
					else {
						$('#error').html('Need to be positive numbers!');
					}
				}
			});
		});
	</script>
</head>
<body>
	<a href = "../../index.php"> Head back to profile </a>
	<form >
		<span class = "text">Phone: </span><input id = "phone" type = "number" /><br /><br />
		<span class = "text">Number of muns attended: </span><input id = "numMuns" type = "number" /><br /><br />
		<span class = "text">Number of awards won: </span><input id = "numAwards" type = "number" /><br /><br />
		<span class = "text">Tell us more about your past muns</span><br /><br /><textarea id = "info"rows = "5" cols = "50"></textarea>
		<br /><br /><input type = "submit" id = "submit" />  <span id = "error"></span>
	</form>
</body>
</html>