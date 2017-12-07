
    <!--body content here-->
<?php ini_set('display_errors', 1); ?>
<?php require(realpath($_SERVER["DOCUMENT_ROOT"]).'/service/session.php'); ?>
<?php require(realpath($_SERVER["DOCUMENT_ROOT"]).'/service/wrappers.php'); ?>
<?php $_SESSION['page'] = 'PROJECT DETAIL'; ?>
<?php require(realpath($_SERVER["DOCUMENT_ROOT"]).'/template/header.php'); ?>
<?php require(realpath($_SERVER["DOCUMENT_ROOT"])."/view/project/project.php"); ?>

<head><title>PROJECT DASHBOARD</title></head>

<div class="container">
    <div class="row">
        <div class="col-md-6 pre-scrollable">
            
                
                    <div class="card-header">
                        Project Info
                        <p><small><a>View all projects ></a></small></p>
                    </div>
                    <div class="card-body card-scrollable">
                        <!-- todo: call a function for the project list-->
                        <?php list_project_details($_SESSION['project_id']); ?>
                    </div>     
            
        </div>
        

        <div class="col-md-6">           
                    <div class="card-header">
                        Iterations
                        <p><small><a>View all iterations></a></small></p>
                    </div>
                    <div class="card-body card-scrollable">
                        <?php list_project_iterations($_SESSION['project_id']); ?>
                    </div>
        </div>        
         

            
        <div class="col-md-6" id="">
                    <div class="card-header">
                        Tasks
                        <p><small><a>View all tasks ></a></small></p>
                    </div>
                    <div class="card-body card-scrollable">
                        <?php list_project_tasks($_SESSION['project_id']); ?>
                    </div>
        </div>
            
           

        <div class="col-md-6" id="">
                
                    <div class="card-header">
                        Comments
                        <p><small><a>View all comments ></a></small></p>
                    </div>
                    <div class="card-body card-scrollable">
                        <?php list_project_comments($_SESSION['project_id']); ?>
                    </div>
        </div>

        
    </div>
</div>

<?php require(realpath($_SERVER["DOCUMENT_ROOT"]) . '/template/footer.php'); ?>
