
<?php ini_set('display_errors', 1); ?>
<?php require(realpath($_SERVER["DOCUMENT_ROOT"]) . '/service/session.php'); ?>
<?php $_SESSION['page'] = 'MANAGEMENT CONSOLE'; ?>
<?php require(realpath($_SERVER["DOCUMENT_ROOT"]) . '/template/header.php');?>
<?php require(realpath($_SERVER["DOCUMENT_ROOT"]) . '/view/project_selection/project_selection.php');?>
<head><title>PROJECT SELECTION</title></head>
<?php $e_id = $_SESSION['e_id']; ?>




<?php require(realpath($_SERVER["DOCUMENT_ROOT"]) . '/template/footer.php'); ?>

