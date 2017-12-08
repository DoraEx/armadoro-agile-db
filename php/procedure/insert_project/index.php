<!-- The purpose of this file is to receive the emp_id and comment_id of a comment,
and set it's read state to 1 -->

<?php ini_set('display_errors', 1); ?>
<?php require(realpath($_SERVER["DOCUMENT_ROOT"]) . '/service/session.php'); ?>

<?php


$e_id = $_SESSION['e_id'];
$project_name = $_POST['project_name'];
$date_start = 'NOW()';
$date_due = $_POST['date_due'];


if ($e_id != null && $project_name != null) {
    $insert_query = "CALL insert_project_proc($e_id, \"$project_name\", \"$date_due\")";
    $result = db_query($insert_query);\
    // error_log((string)$result, 3, "/home/ubuntu/php_log.log");
}
?>

<?php require(realpath($_SERVER["DOCUMENT_ROOT"]) . '/template/footer.php'); ?>
<?php header('location: /view/management_console'); ?>
