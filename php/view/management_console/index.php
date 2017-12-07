
<?php ini_set('display_errors', 1); ?>
<?php require(realpath($_SERVER["DOCUMENT_ROOT"]) . '/service/session.php'); ?>
<?php $_SESSION['page'] = 'MANAGEMENT CONSOLE'; ?>
<?php require(realpath($_SERVER["DOCUMENT_ROOT"]) . '/template/header.php');?>
<?php require(realpath($_SERVER["DOCUMENT_ROOT"]) . '/view/management_console/management_console.php');?>
<head><title>PROJECT SELECTION</title></head>
<?php $e_id = $_SESSION['e_id']; ?>
<?php require(realpath($_SERVER["DOCUMENT_ROOT"]) . '/template/footer.php'); ?>




<!-- ADD PROJECT SECTION/////////////////////////// -->
<!-- ////////////////////////////////////////////// -->
<div style="text-align: center;">
    <form action="/view/management_console" method="GET">
            <div class="form-group">
                <input type="text" name="add_project" value="true" style="display: none;">
                <label for="submit1">Click To Add New Project:</label>
            </div>
            <input id="submit1" type="submit" value="New Project">
    </form>
</div>










<div class="container">
    <div class="row well">
        <div class="offset-md-2 col-md-8 toledo-dash well">
                    

        <form method="POST" action="/procedure/insert_project/index.php">
            <!-- E_ID (HIDDEN) -->
            <input type="text" name="e_id" value=<?php echo("\"" . $_SESSION['e_id'] . "\""); ?> style="display: none">
            <!-- PROJECT NAME  -->
            <div class="form-group">    
                <label for="p-name-text">Project Name</label>
                <input id="p-name-text" name="project_name" type="text" class="form-control" placeholder="Enter Project Name">
            </div>
            <!-- DATE DUE -->
            <div class="form-group">
                <label for="date-get">Due Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input id="date-get" name="date_due" type="date" class="form-control">
                <small class="form-text text-muted">You can change it later.</small>
            </div>
            <button type="submit" class="btn btn-primary">Add Project</button>
      </form>





        </div>
    </div>
</div>












<?php
if (isset($_GET['add_project'])) {
    display_add_project_form();
    
}

?>
<!-- ////////////////////////////////////////////// -->
<!-- ////////////////////////////////////////////// -->



<br>
<br>
<br>



<!-- ADD TASK SECTION ///////////////////////////// -->
<!-- ////////////////////////////////////////////// -->
<div style="text-align: center;">
    <form action="/view/project" method="GET">
            <div class="form-group">
                <label for="sel1">Select Project:</label>
                <select class="form-control" id="sel1" name="project_id">
                    
                    <?php populate_projects($e_id) ?>
                    <!-- FROM PHP -->
                </select>
            </div>
            <input type="submit" value="OK">
    </form>
</div>
<?php
if (isset($_GET['add_task'])) {
    echo('add task form');
}

?>
<!-- ////////////////////////////////////////////// -->
<!-- ////////////////////////////////////////////// -->




<?php require(realpath($_SERVER["DOCUMENT_ROOT"]) . '/template/footer.php'); ?>

