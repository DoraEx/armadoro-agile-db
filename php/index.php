<?php
	require('service/session.php');
?>


<?php include('template/header.php');?>

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

<?php include('template/footer.php');?>
