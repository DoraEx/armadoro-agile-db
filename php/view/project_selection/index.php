
<?php ini_set('display_errors', 1); ?>
<?php require(realpath($_SERVER["DOCUMENT_ROOT"]) . '/service/session.php'); ?>
<?php $_SESSION['page'] = 'ITERATION'; ?>
<?php require(realpath($_SERVER["DOCUMENT_ROOT"]) . '/template/header.php');?>
<?php require(realpath($_SERVER["DOCUMENT_ROOT"]) . '/view/project_selection/project_selection.php');?>
<head><title>PROJECT SELECTION</title></head>
<?php $e_id = $_SESSION['e_id']; ?>

<form action="/view/project" method="GET">
        <div class="form-group">
            <label for="sel1">Select list (select one):</label>
            <select class="form-control" id="sel1" name="project_id">
                
                <?php populate_projects($e_id) ?>
                <!-- FROM PHP -->
            </select>
        </div>
        <input type="submit" value="OK">
</form>




<?php require(realpath($_SERVER["DOCUMENT_ROOT"]) . '/template/footer.php'); ?>

