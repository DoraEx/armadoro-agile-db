
<?php ini_set('display_errors', 1); ?>
<?php require(realpath($_SERVER["DOCUMENT_ROOT"]) . '/service/session.php'); ?>
<?php $_SESSION['page'] = 'PROJECT SELECTION'; ?>
<?php require(realpath($_SERVER["DOCUMENT_ROOT"]) . '/template/header.php');?>
<?php require(realpath($_SERVER["DOCUMENT_ROOT"]) . '/view/project_selection/project_selection.php');?>
<head><title>PROJECT SELECTION</title></head>
<?php $e_id = $_SESSION['e_id']; ?>
<?php $_SESSION['page'] = 'LOGIN'; ?>
<br>
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



<?php require(realpath($_SERVER["DOCUMENT_ROOT"]) . '/template/footer.php'); ?>

