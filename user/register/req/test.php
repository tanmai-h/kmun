<?php 
	require_once('config.php');

	function getAll() {
		global $pdo;
		$stmt = $pdo->prepare("SELECT * FROM `crap`");
		$stmt->execute();

		return $stmt->fetchAll();
	}

	$fetched = getAll();
	foreach ($fetched as $user) {
		echo '<span> id: ', $user['id'], ', email: ', $user['email'], ', pass: ', $user['password'], '</span><br />';
	}
?>