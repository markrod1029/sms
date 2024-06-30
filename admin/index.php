<?php
session_start();
if (!isset($_SESSION["role"])) {
	header("Location: login.php");
	exit();

} else if ( isset($_SESSION["role"]) && $_SESSION["role"] === 'admin') {
	header("Location: home.php");

} else if ( isset($_SESSION["role"]) && $_SESSION["role"] === 'student') {
	header("Location: ../home.php");

}

?>
