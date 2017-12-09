<?php 
   ini_set('display_errors', 1); require(realpath($_SERVER["DOCUMENT_ROOT"]).'/service/session.php');
    require(realpath($_SERVER["DOCUMENT_ROOT"])."/template/header.php");
    ?>

    <div class="container">
        <?php 
            $emp_id = $_SESSION['e_id'];
            $task_id = $_POST['task_id'];
            $comment_text = $_POST['comment_text'];
            if(isset($_POST['parent_comment_id'])) {
                $parent_comment_id = $_POST['parent_comment_id'];
            }
                
            if(isset($parent_comment_id)) {
                //insert reply, trigger will alert parents
                $query = <<<MARKER
                INSERT INTO comment 
                values(null, $parent_comment_id, $emp_id, $task_id, now(), "$comment_text");
MARKER;

                header('Location: /view/task/?task_id='.$task_id);
            } else {
                $query = <<<MARKER
                INSERT INTO comment 
                values(null, null, $emp_id, $task_id, now(), "$comment_text");
MARKER;
                //get the id of id of last inserted comment
                $comment_id = insert_return_id($query);                                
                //get an array of pm and dev ids
                $emp_array = array();
                //get the pm's id
                $get_pm = <<<MARKER
                SELECT project_manager
                FROM (SELECT project_id
                        FROM task
                        WHERE task_id = $task_id) as pid
                JOIN project p
                ON pid.project_id = p.project_id;
MARKER;
                $result = db_query($get_pm);
                $pm = mysqli_fetch_array($result);
                
                if($emp_id != $pm['project_manager']) {
                    array_push($emp_array, $pm['project_manager']);
                }
                
                //get all the dev ids
                $get_dev = <<<MARKER
                SELECT emp_id 
                FROM task_developer
                WHERE task_id = $task_id;
MARKER;
                $result = db_query($get_dev);
                while($dev = mysqli_fetch_array($result)){
                    array_push($emp_array, $dev['emp_id']);
                }
                
                //loop to insert into unread comment
                foreach($emp_array as $emp) {
                    $insert_unread = <<<MARKER
                        INSERT INTO unread_comment
                        VALUES ($emp, $comment_id);
                        
MARKER;
                    $result = db_query($insert_unread);
                }
                
                var_dump($result);
                //header('Location: /view/task/?task_id='.$task_id);
                
            }
        
            
            
        ?>
    </div>

<?php       
    require(realpath($_SERVER["DOCUMENT_ROOT"])."/template/footer.php");
?>