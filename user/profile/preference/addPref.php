<?php
	require_once(__DIR__ . "/../../req/connect.php");
	require_once(__DIR__ . "/../../req/utility.php");
	
	session_start();
	define('TNAME', 'committee_pref');
	
	if(isset($_POST['committees1']) && isset($_POST['committees2']) && isset($_POST['committees3'])
		&& isset($_POST['p1c1']) && isset($_POST['p1c2']) && isset($_POST['p1c3']) && isset($_POST['p2c1']) 
		&& isset($_POST['p2c2']) && isset($_POST['p2c3']) && isset($_POST['p3c1']) && isset($_POST['p3c2']) && isset($_POST['p3c3'])) {
		
		if(!empty($_POST['committees1']) && !empty($_POST['committees2']) && !empty($_POST['committees3'])
		&& !empty($_POST['p1c1']) && !empty($_POST['p1c2']) && !empty($_POST['p1c3']) && !empty($_POST['p2c1']) 
		&& !empty($_POST['p2c2']) && !empty($_POST['p2c3']) && !empty($_POST['p3c1']) && !empty($_POST['p3c2']) && !empty($_POST['p3c3'])) {
			
			$committees1=$_POST['committees1'];
			$committees2=$_POST['committees2'];
			$committees3=$_POST['committees3'];
			$p1c1=$_POST['p1c1'];
			$p1c2=$_POST['p1c2'];
			$p1c3=$_POST['p1c3'];
			$p2c1=$_POST['p2c1'];
			$p2c2=$_POST['p2c2'];
			$p2c3=$_POST['p2c3'];
			$p3c1=$_POST['p3c1'];
			$p3c2=$_POST['p3c2'];
			$p3c3=$_POST['p3c3'];

			
			$query = "INSERT into " . TNAME . " (email, pref1, pref2, pref3) VALUES(:email, :pref1, :pref2, :pref3)";
			$stmt = $pdo->prepare($query);
			
			try {
				$pref1 = $committees1 . "," . $p1c1 . "," . $p1c2 . "," . $p1c3;
				$pref2 = $committees2 . "," . $p2c1 . "," . $p2c2 . "," . $p2c3;
				$pref3 = $committees3 . "," . $p3c1 . "," . $p3c2 . "," . $p3c3;
				
				$in = array(':email' => $_SESSION['email'], ':pref1' => $pref1, ':pref2' => $pref2, ':pref3' => $pref3);
				$stmt->execute($in);
				
				echo 'Preferences Updated!';
			}
			catch(PDOException $e) {
				echo $e->getMessage();
			}
		}
		else {
			echo 'All fields required';
		}
	}
	else {
		echo 'Variables not set';
	}
?>