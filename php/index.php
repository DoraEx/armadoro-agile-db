<?php
	require('session.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Project Agile - Dashboard</title>
		<link rel="stylesheet" type="text/css" href="css/main.css">
	</head>
	<body>
		<?php include('header.php');?>
		<div class="container">
		<h1>Welcome <?php echo $user_name ?></h1>
		<p>You are a 
		<?php 
			if($_SESSION['e_role'] == "PM") 
				echo "project manager";
			else 
				echo "developer";
				
		?>
		.</p>
</div>
	</body>
</html>