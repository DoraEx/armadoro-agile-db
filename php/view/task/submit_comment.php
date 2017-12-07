<?php 
    require(realpath($_SERVER["DOCUMENT_ROOT"]).'/service/session.php');
    require(realpath($_SERVER["DOCUMENT_ROOT"])."/template/header.php");
    ?>

    <div class="container">
        <?php 
            $emp_id = $_SESSION['e_id'];
            $task_id = $_POST['task_id'];
            $comment_text = $_POST['comment_text'];
            $query = <<<MARKER
                INSERT INTO comment 
                values(null, null, $emp_id, $task_id, now(), "$comment_text");
MARKER;
        
            $result = db_query($query);
            echo "Your comment has been submitted";
            var_dump($_SESSION, $_POST);
            header('Location: /view/task/?task_id='.$task_id);
        ?>
    </div>

<?php       
    require(realpath($_SERVER["DOCUMENT_ROOT"])."/template/footer.php");
?>