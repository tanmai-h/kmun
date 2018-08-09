<?php
	require_once(__DIR__.'/../../req/connect.php');
	require_once(__DIR__.'/../../req/utility.php');
	
	require_once(__DIR__ . '/../../req/mailgun-php/vendor/autoload.php');
	use Mailgun\Mailgun;
	
	$email = $firstName = $lastname = $password = $hashed = $msg = "";
	define('TNAME', 'users');

	if(isset($_POST['captcha']) &&  isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['school'])) {
		
		$email = trim($_POST['email']);
		$password = trim($_POST['pass']);
		$firstName = trim($_POST['firstName']);
		$lastName = trim($_POST['lastName']);
		$type = 'headDelegate';
		$school = trim($_POST['school']);
		
		
		// ADD the school head to user list as well as school Head list
		if(!empty($email) && !empty($password) && !empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['school'])) {
			// CAPTCHA
			$url = 'https://www.google.com/recaptcha/api/siteverify';
			$data = array(
				'secret' => '6LcIYV0UAAAAACI3LtlKHVPok3BcWzrii6qmbNvh',
				'response' => $_POST["captcha"]
			);
			$options = array(
				'http' => array (
					'header' => "Content-Type: application/x-www-form-urlencoded\r\n"."User-Agent:MyAgent/1.0\r\n",
					'method' => 'POST',
					'content' => http_build_query($data),
				)
			);	
			$context  = stream_context_create($options);
			$verify = file_get_contents($url, false, $context);
			$captcha_success = json_decode($verify);
			//CAPTCHA ends
			if ($captcha_success->success == true) {
				$query = "SELECT id FROM " .TNAME. " WHERE email = :email";
				$stmt = $pdo->prepare($query);
				$stmt->bindParam(':email', $email, PDO::PARAM_STR);
				$flag = 1;
				if($stmt->execute()) {	
					if($stmt->rowCount() > 0) {
						$msg = 'Email already exists';
						$flag = 0;
					}
					else {
						unset($query);
						$query = "INSERT INTO " .TNAME. " (email, firstName, lastName, password, activated, school, type, active_hash, created_at) VALUES (:email, :firstName, :lastName, :password, :activated, :school, :type, :active_hash, :created_at)";
						$stmt = $pdo->prepare($query);
						$hashed = getHash($password);
						$active_token = generateRandomString(128);
						$active_hash = getHash($active_token);
						
						$input_array = array(':email' => $email, ':firstName' => $firstName, ':lastName' => $lastName, ':password' => $hashed, 
											':activated' => 0, ':school' => $school, ':type' => $type, ':active_hash' => $active_hash, ':created_at' => time());
						if($stmt->execute($input_array)) {
							$activation_link = '<a href = "../../req/activate.php?email='.$email.'&token='.$active_token.'">Activate</a>';
							
						}
						else {
							$msg = 'cant INSERT';
						}
					}
				}
				else {
					$msg = 'Could not execute stmt';
					unset($stmt);
				}
				
				//add to schoolHead table
				//define(TNAME, 'school_head');
				if($flag == 1) { 
					unset($query);
					$query = "INSERT INTO `school_head` (email, firstName, lastName, school) VALUES (:email, :firstName, :lastName, :school)";
					$stmt = $pdo->prepare($query);
					$input_array = array(':email' => $email, ':firstName' => $firstName, ':lastName' => $lastName, ':school' => $school);
					try {
								$stmt->execute($input_array);
								// =================
								// SEND THE EMAIL!!!
								// =================

								

								$mgClient = new Mailgun('key-f1f2a5605d9099f7a643d60748d7e18d');
								$domain = "kmun.in";

								$url = "http://2018.kmun.in/user/register/activate.php?email=" . $email . "&tokenHash=" . $active_token;

								$subject = "KMUN 2018 - Confirm your account";
								$name = $firstName . ' ' . $lastName;
								
								$htmlpre = '<!DOCTYPE html><html><head><meta charset = "utf-8"></head><body><h4>Hi ' . $name . '<br /><br />';
								$content_plain = '<div>Thanks for your interest in Kumarans Model United Nations 2018! You provided us with this email address while registering on our website, but we need to make sure that this email address really belongs to you.<br /><br />Click <a href = "'. $url . '">here </a>to verify your email address.If the link doesn\'t work, try copying this URL and pasting it in your browser\'s address bar: ' . $url . '<br />Don\'t hesitate to reply to this email if you have any questions.<br /><br />With warm regards, <em>KMUN Tech</em></div>';
								$htmlpost = '</body></html>';

								// Make the call to the client.
								//$html_email = '<a href = "' . $url . '" >Confirm your email</a>'; 
								$result = $mgClient->sendMessage($domain, array(
									'from'    => 'KMUN Tech <support@kmun.in>',
									'to'      => stripslashes($name) . '<' . $_POST['email'] . '>',
									'subject' => $subject,
									//'text'    => 'Hi '.stripslashes($name).'<br />'.$content_plain
									'html'    => $htmlpre . $content_plain . $htmlpost
								));
								//redirect('../success.php');
								$msg = 'Activation Email sent!';
							}
							catch(PDOException $e) {
								$msg = $e->getMessage();
							}
					}
			}
			else {
				$msg = 'You\'re a bot, :p';
			}
	}
		else {
				$msg = "All details required";
		}
	}
	else {
		$msg = 'Variables not set';
	}
	echo $msg;
?>