<?php 
    require(realpath($_SERVER["DOCUMENT_ROOT"]).'/service/session.php');
    $_SESSION['page'] = "REPLY COMMENT";
    require(realpath($_SERVER["DOCUMENT_ROOT"])."/template/header.php");
?>
<div class="container">

    <form method="post" action="submit_comment.php">
            <label>Reply to Comment:</label>
            <br/>
            <input type="hidden" name='task_id' value="<?php echo $_POST['task_id']; ?>">
            <input type="hidden" name='parent_comment_id' value="<?php echo $_POST['parent_comment_id']; ?>">
            <textarea id="input-comment" name="comment_text" rows="3"></textarea>
            <input id="submit-comment" type="submit" value="Submit Reply">
        </form>
</div>

<?php
    require(realpath($_SERVER["DOCUMENT_ROOT"])."/template/footer.php");
?>
