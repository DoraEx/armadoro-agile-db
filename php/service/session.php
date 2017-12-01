<?php
	require('service/dbconf.php');
	session_start();

	$user_check = $_SESSION['e_id'];
	$user_name = $_SESSION['e_name'];
	
	if(!isset($_SESSION['e_id'])) {
		header('location: login/');
	}
?>