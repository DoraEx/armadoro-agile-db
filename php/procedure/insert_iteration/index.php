<?php ini_set('display_errors', 1); ?>
<?php require(realpath($_SERVER["DOCUMENT_ROOT"]) . '/service/session.php'); ?>

<?php
$iteration_name   = htmlentities($_POST['iteration_name']);
$date_start       = htmlentities($_POST['date_start']);
$date_end         = htmlentities($_POST['date_end']);
$project_id       = htmlentities($_POST['project_id']);

if ($e_id != null && $iteration_name != null && strlen($iteration_name) > 0) {
    $insert_query = "INSERT INTO iteration VALUES ($project_id, null, \"$iteration_name\", \"$date_start\", \"$date_end\")";
    $result = db_query($insert_query);
}
?>

<?php require(realpath($_SERVER["DOCUMENT_ROOT"]) . '/template/footer.php'); ?>


<?php header('location: /view/management_console'); ?>
