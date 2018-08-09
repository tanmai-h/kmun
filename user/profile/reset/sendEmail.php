<?php
	require __DIR__ . '/../../req/mailgun-php/vendor/autoload.php';
	require_once(__DIR__ . '/../../req/utility.php');
	require_once(__DIR__ . '/../../req/connect.php');
	use Mailgun\Mailgun;
	
	define('TNAME', 'users');
	
	if(isset($_POST['email']) && isset($_POST['captcha'])) {
		
		if(!empty($_POST['email']) || !empty($_POST['captcha'])) {
			$url = 'https://www.google.com/recaptcha/api/siteverify';
			$data = array(
				'secret' => '6LcIYV0UAAAAACI3LtlKHVPok3BcWzrii6qmbNvh',
				'response' => $_POST["captcha"]
			);
			$options = array(
				'http' => array (
					'header' => "Content-Type: application/x-www-form-urlencoded\r\n"."User-Agent:MyAgent/1.0\r\n",
					'method' => 'POST',
					'content' => http_build_query($data)					
				)
			);	
			$context  = stream_context_create($options);
			$verify = file_get_contents($url, false, $context);
			$captcha_success = json_decode($verify);
			
			if ($captcha_success->success == true) {			
				$email = $_POST['email'];
				
				$query = "SELECT firstName,lastName, email, activated FROM " . TNAME . " WHERE email = :email";
				$stmt = $pdo->prepare($query);
				$stmt->bindParam(':email', $email);
				
				try {
					$stmt->execute();
					
					if($stmt->rowCount() > 0) {
						$fetched = $stmt->fetch();
						unset($query);
						$reset_identifier = generateRandomString(128);
						$reset_hash = getHash($reset_identifier); 
						
						$query = "UPDATE " . TNAME . " SET reset_identifier = :reset_identifier WHERE email = :email";
						$stmt = $pdo->prepare($query);
						$stmt->bindParam(':email', $email);
						$stmt->bindParam(':reset_identifier', $reset_hash);
						
						try {
							$stmt->execute();
							
							///send reset email
																
							$mgClient = new Mailgun('key-f1f2a5605d9099f7a643d60748d7e18d');
							$domain = "kmun.in";

							$url = "http://2018.kmun.in/user/profile/reset/reset.php?email=" . $_POST['email'] . "&token=" . $reset_identifier;

							$subject = "KMUN 2018 Reset your password";
							$name = $fetched['firstName'] . ' ' . $fetched['lastName'];
							
							$htmlpre = '<!DOCTYPE html><html><head><meta charset = "utf-8"></head><body><h4>Hi ' . $name . '<br /><br />';
							$content_plain = '<div>It looks like you wanted to change your password. We just wanted to make sure that it was really you.<br /><br />Click <a href = "' . $url . '">here</a> to change your password.<br /><br />If the link doesn\'t work, try copying this URL and pasting it in your browser\'s address bar: '. $url . '<br /><br />If you didn\'t want to change your password, please let us know by replying to this email.<br /><br />With warm regards,<em>KMUN Tech</em>';
							$htmlpost = '</body></html>';
							
							// Make the call to the client.
							$result = $mgClient->sendMessage($domain, array(
								'from'    => 'KMUN Tech <support@kmun.in>',
								'to'      => $name . '<' . $_POST['email'] . '>',
								'subject' => $subject,								
								'html'    => $htmlpre . $content_plain . $htmlpost
							));
							echo 'OK';
						}
						catch(PDOException $e) {
							echo $e->getMessage();
						}
					}
					else {
						redirect('emailSent.html');
					}
				}
				catch(PDOException $e) {
					echo $e->getMessage();
				}
			}
			else {
				echo "You're a bot";
			}
		}
		else {
	
			echo 'Email and captcha must be filled!';
		}
	
	}
	else {
		echo 'Email and captcha not set!';
	}
?>