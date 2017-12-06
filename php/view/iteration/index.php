<!-- THIS FILE IS TO SHOW THE ITERATIONS IN WHICH THE CURRENT USER IS ACTIVE -->
<?php ini_set('display_errors', 1); ?>
<?php require(realpath($_SERVER["DOCUMENT_ROOT"]) . '/service/session.php'); ?>
<?php require(realpath($_SERVER["DOCUMENT_ROOT"]) . '/template/header.php');?>
<?php require('./iteration.php');?>

<head><title>iterations</title></head>

<div class="container">
    <div class="card bg-light mb-3" >
        <div class="card-header">
            Active Iterations
            <p><small><a>View all projects ></a></small></p>
        </div>
        <div class="card-body card-scrollable" style="overflow-y: scroll;">
            <!-- todo: call a function for the project list-->
            <?php listIterations2($e_id); ?>
        </div>
    </div>
</div>





<?php require(realpath($_SERVER["DOCUMENT_ROOT"]) . '/template/footer.php'); ?>