<?php 
    require(realpath($_SERVER["DOCUMENT_ROOT"]).'/service/session.php');
    require(realpath($_SERVER["DOCUMENT_ROOT"])."/template/header.php");
    require(realpath($_SERVER["DOCUMENT_ROOT"])."/view/task/task.php")
?>
    <!--body content here-->

    <div class="container">
        <?php get_task_info(); ?>
        <br/>
        <?php get_comments_for_task();?>
        <form method="post" action="submit_comment.php">
            <label>New Comment:</label>
            <br/>
            <input type="hidden" name='task_id' value="<?php echo $_GET['task_id']; ?>">
            <textarea id="input-comment" name="comment_text" rows="3"></textarea>
            <input id="submit-comment" type="submit" value="Submit">
        </form>
    </div>
<?php
    require(realpath($_SERVER["DOCUMENT_ROOT"])."/template/footer.php");
?>