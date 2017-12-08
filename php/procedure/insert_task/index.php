<?php ini_set('display_errors', 1); ?>
<?php require(realpath($_SERVER["DOCUMENT_ROOT"]) . '/service/session.php'); ?>

<?php

$task_name = $_POST['task_name'];
$create_date = 'NOW()';
$project_id = $_POST['project_id'];
$status_id = $_POST['status_id'];
$size_id = $_POST['size_id'];
$description = $_POST['description'];


if ($e_id != null && $task_name != null && strlen($task_name) > 0) {
    $insert_query = "INSERT INTO task VALUES (null, \"$task_name\", now(), null, $project_id, null, \"$status_id\", \"$size_id\", \"$description\")";
    $result = db_query($insert_query);
}
?>

<?php require(realpath($_SERVER["DOCUMENT_ROOT"]) . '/template/footer.php'); ?>


<?php header('location: /view/management_console'); ?>
