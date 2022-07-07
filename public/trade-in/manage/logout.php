<?php
	include_once('asset/php/database.php');
	session_start();
	session_destroy();
	session_unset($_SESSION['id']);
	session_unset($_SESSION['name']);
	header("Location:login.php");
?>