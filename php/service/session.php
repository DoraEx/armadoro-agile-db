<?php
	require('dbconf.php');
	session_start();

	if(needToLogIn()) {
		header('location: /login/');
	} else {
        $e_id = $_SESSION['e_id'];
        $e_name = $_SESSION['e_name'];
        $e_role = $_SESSION['e_role'];
    }
	
	function needToLogIn(){
		if(!isset($_SESSION['e_id'])) {
			return true;
		} else 
			return false;
	}
?>
