<!-- The purpose of this file is to receive the emp_id and comment_id of a comment, 
and set it's read state to 1 -->

<?php ini_set('display_errors', 1); ?>
<?php require(realpath($_SERVER["DOCUMENT_ROOT"]) . '/service/session.php'); ?>

<?php
$emp_id = isset($_POST['emp_id']) ? $_POST['emp_id'] : null;
$comment_id = isset($_POST['comment_id']) ? $_POST['comment_id'] : null;
if ($emp_id != null && $comment_id != null) {
    $update_query = "CALL update_comment_read($emp_id, $comment_id)";
    $result = db_query($update_query);
    error_log((string)$result, 3, "/home/armando/php_log.log");
}
?>

<?php require(realpath($_SERVER["DOCUMENT_ROOT"]) . '/template/footer.php'); ?>
