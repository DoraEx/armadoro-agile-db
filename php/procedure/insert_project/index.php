<!-- The purpose of this file is to receive the emp_id and comment_id of a comment,
and set it's read state to 1 -->

<?php ini_set('display_errors', 1); ?>
<?php require(realpath($_SERVER["DOCUMENT_ROOT"]) . '/service/session.php'); ?>

<?php
error_log("\nIn Insert Project File\n\n", 3, "/home/armando/php_log.log");

$e_id         = $_SESSION['e_id'];
$project_name = htmlentities($_POST['project_name']);
$date_due     = htmlentities($_POST['date_due']);
$date_start   = 'NOW()';

error_log("\n . $project_name . \n\n", 3, "/home/armando/php_log.log");
error_log("\n . $date_due . \n\n", 3, "/home/armando/php_log.log");

if ($e_id != null && $project_name != null) {
    error_log("\nABOUT TO RUN PROCEDURE\n\n", 3, "/home/armando/php_log.log");
    $insert_query = "CALL insert_project_proc($e_id, \"$project_name\", \"$date_due\")";
    $result = db_query($insert_query);
    error_log((string)$result . " is the result" . "\n\n", 3, "/home/armando/php_log.log");
}
?>

<?php require(realpath($_SERVER["DOCUMENT_ROOT"]) . '/template/footer.php'); ?>
<?php header('location: /view/management_console'); ?>
