<!-- The purpose of this file is to receive the emp_id and comment_id of a comment,
and set it's read state to 1 -->

<?php ini_set('display_errors', 1); ?>
<?php require(realpath($_SERVER["DOCUMENT_ROOT"]) . '/service/session.php'); ?>

<?php
var_dump($_POST);



$task_name = $_POST['task_name'];
$create_date = 'NOW()';
$project_id = $_POST['project_id'];
$status_id = $_POST['status_id'];
$size_id = $_POST['size_id'];
$description = $_POST['description'];

var_dump($task_name);
var_dump($create_date);
var_dump($project_id);
var_dump($status_id);
var_dump($size_id);
var_dump($description);


if ($e_id != null && $task_name != null) {
    $insert_query = "INSERT INTO task VALUES (null, \"$task_name\", now(), null, $project_id, null, \"$status_id\", \"$size_id\", \"$description\")";
    $result = db_query($insert_query);
    error_log((string)$result, 3, "/home/ubuntu/php_log.log");
    var_dump($result);
}
?>

<?php require(realpath($_SERVER["DOCUMENT_ROOT"]) . '/template/footer.php'); ?>


<?php //header('location: /view/management_console'); ?>
<!-- task_id  task_name  create_date  completed_date  project_id  iteration_id  status_id  size_id  description -->
