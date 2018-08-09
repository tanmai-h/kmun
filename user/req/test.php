<?php 
	require_once('connect.php');
	
	/*
	function getAll() {
		global $pdo;
		$stmt = $pdo->prepare("SELECT * FROM `crap`");
		$stmt->execute();

		return $stmt->fetchAll();
	}

	$fetched = getAll();
	foreach ($fetched as $user) {
		echo '<span> id: ', $user['id'], ', email: ', $user['email'], ', pass: ', $user['password'], '</span><br />';
	}*/
	
	if(isset($_POST['commitee'])) {
		echo $_POST['commitee'];
	}
?>
<html>
	<body>
		<form method = "post" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
		<select name = "commitee"> 
			<option value = "sec">sec</option>
			<option value = "uns">uns</option>
			<option value = "gen">gen</option>
		</select>
		<input type = "submit" value = "submit" />
		</form>
	</body>
</html>