
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
                <input id="submit1" type="submit" value="Click">
            </div>
           
    </form>
</div>

<?php
if (isset($_GET['add_project'])) {
    display_add_project_form($_SESSION['e_id']);
}

?>
<!-- ////////////////////////////////////////////// -->




<br><br><br><hr/><br><br><br>





<!-- ADD TASK SECTION ///////////////////////////// -->
<!-- ////////////////////////////////////////////// -->
<div style="text-align: center;">
    <form action="/view/management_console" method="GET">
            <div class="form-group">
                <input type="text" name="add_task" value="true" style="display: none;">
                <label for="submit1">Click To Add New Task:</label>
                <input id="submit1" type="submit" value="Click">
            </div>
           
    </form>
</div>

<?php
if (isset($_GET['add_task'])) {
    display_add_task_form($_SESSION['e_id']);
}
?>
<!-- ////////////////////////////////////////////// -->






<br><br><br><hr/><br><br><br>





<!-- ADD ITERATION SECTION///////////////////////// -->
<!-- ////////////////////////////////////////////// -->



<!-- ////////////////////////////////////////////// -->


<?php require(realpath($_SERVER["DOCUMENT_ROOT"]) . '/template/footer.php'); ?>

