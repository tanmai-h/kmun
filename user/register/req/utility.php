<?php
	function generateRandomString($length = 10) {
	   return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)))),1,$length);
	}

	function redirect($page) {
		header('location: ' . $page);
	}

	function getHash($str) {
		return password_hash($str, PASSWORD_DEFAULT);
	}
?>