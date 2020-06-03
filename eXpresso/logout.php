<?php
	ob_start();
	session_start();
	$_SESSION = array(); // Katharismos metablhtwn
	session_destroy(); // Katastrofh tou session
	setcookie (session_name(), '', time()-300); // Katastrofh tou cookie
	header("Location: index.php");
	exit();
?>
