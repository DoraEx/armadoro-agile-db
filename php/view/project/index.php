
    <!--body content here-->
<?php ini_set('display_errors', 1); ?>
<?php require(realpath($_SERVER["DOCUMENT_ROOT"]).'/service/session.php'); ?>
<?php require(realpath($_SERVER["DOCUMENT_ROOT"]).'/service/wrappers.php'); ?>
<?php $_SESSION['page'] = 'PROJECT DETAIL'; ?>
<?php require(realpath($_SERVER["DOCUMENT_ROOT"]).'/template/header.php'); ?>
<?php require(realpath($_SERVER["DOCUMENT_ROOT"])."/view/project/project.php"); ?>
<?php
if(!isset($_SESSION['e_id']) or !isset($_SESSION['project_id'])) { header('location: /'); }
?>
<head><title>PROJECT DASHBOARD</title></head>



<div class="container">
    <div class="row">
        <div class="col-md-6 well toledo-dash">
                    <div class="card-header">
                        <strong>Project Info</strong>
                        <p><small><a>View all projects ></a></small></p>
                    </div>
                    <div class="card-body pre-scrollable">
                        <!-- todo: call a function for the project list-->
                        <?php list_project_details($_SESSION['project_id']); ?>
                    </div>     
        </div>
        

        <div class="col-md-6  well toledo-dash">           
                    <div class="card-header">
                    <strong>Iterations</strong>
                        <p><small><a>View all iterations></a></small></p>
                    </div>
                    <div class="card-body pre-scrollable">
                        <?php list_project_iterations($_SESSION['project_id']); ?>
                    </div>
        </div>        
         
        <div style="clear:both"></div>
        <hr>
        <div style="clear:both"></div>
        

        <div class="col-md-6  well toledo-dash" id="">
                    <div class="card-header">
                    <strong>Tasks</strong>
                        <p><small><a>View all tasks ></a></small></p>
                    </div>
                    <div class="card-body pre-scrollable">
                        <?php list_project_tasks($_SESSION['project_id']); ?>
                    </div>
        </div>
            
           

        <div class="col-md-6  well toledo-dash" id="">
                
                    <div class="card-header">
                    <strong>Comments</strong>
                        <p><small><a>View all comments ></a></small></p>
                    </div>
                    <div class="card-body pre-scrollable">
                        <?php list_project_comments($_SESSION['project_id']); ?>
                    </div>
        </div>

        
    </div>
</div>

<?php require(realpath($_SERVER["DOCUMENT_ROOT"]) . '/template/footer.php'); ?>
