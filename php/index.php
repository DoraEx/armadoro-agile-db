<?php ini_set('display_errors', 1); ?>
<?php require('service/session.php');?>
<?php require('template/header.php');?>
<?php require('dashboard.php');?>

<head><title>PA - Dashboard</title></head>

<div class="container">
        <?php include('service/message_out.php');?>

	<div class="dashboard">
        <div class="module-wrap" id="projects">
            <div class="card bg-light mb-3">
                <div class="card-header">
                    Active Projects
                    <p><small><a>View all projects ></a></small></p>
                </div>
                <div class="card-body card-scrollable">
                    <!-- todo: call a function for the project list-->
                    <?php listActiveUserProjects($e_id); ?>
                </div>
            </div>
        
        </div>
        <div class="module-wrap" id="">
            <div class="card bg-light mb-3">
                <div class="card-header">
                    Unread Comments
                    <p><small><a>View all comments ></a></small></p>
                </div>
                <div class="card-body card-scrollable">
                    <!-- todo: call a function for the comments -->
                    <?php listUnreadComments($e_id); ?> 
                </div>
            </div>
        
        </div>
        <div class="module-wrap" id="">
            <div class="card bg-light mb-3">
                <div class="card-header">
                    Current Iterations
                    <p><small><a>View all iterations ></a></small></p>
                </div>
                <div class="card-body card-scrollable">
                    <!-- todo: call a function for the iterations-->
                    <?php listIterations($e_id); ?> 
                </div>
            </div>
        
        </div>
    </div>
</div>


<?php include('template/footer.php');?>
