<?php
	require('service/dbconf.php');
	session_start();

	if(isLoggedIn()) {
		header('location: login/');
	}

	function isLoggedIn(){
		if(!isset($_SESSION['e_id'])) {
			return true;
		} else 
			return false;
	}
