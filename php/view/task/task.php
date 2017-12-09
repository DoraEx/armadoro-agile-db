<?php
    ini_set('display_errors', 1);
    require(realpath($_SERVER["DOCUMENT_ROOT"])."/service/queries.php");
    require(realpath($_SERVER["DOCUMENT_ROOT"])."/service/wrappers.php");    
    
  
    if(!isset($_GET['task_id'])){
      header('location: /');
    } else {  
        function get_task_info() {
            //get info for single task
            $task = mysqli_fetch_array(get_task_details($_GET['task_id']));
            echo "<h3>".$task['task_name']."</h3>";
            echo "<span class=\"badge badge-success\">".$task['size']."</span>";
            echo "<span class=\"badge badge-info\">".$task['status']."</span>";
            echo display_card($task['description']);
            
        }
        
        function get_comments_for_task() {
            $comments = get_task_comments($_GET['task_id']);
            echo "<h4>Comments</h4>";
            while($comment = mysqli_fetch_array($comments)) {
                if(is_null($comment['parent_comment_id'])) {
                    display_comment($comment);
                    find_child_comments($comment['comment_id'], 1);
                }
            }
        
        }
        
        function display_comment($comment) {
            $header = get_employee_link($comment['emp_id'], $comment['author']) . "<form class=\"hidden-form-btn\" method=\"post\" action=\"reply_comment.php\"><input type=\"hidden\" name=\"task_id\" value=\"".$_GET['task_id']."\"><input type=\"hidden\" name=\"parent_comment_id\" value=\"".$comment['comment_id']."\"><input class=\"btn btn-primary reply-btn\" type=\"submit\" value=\"reply\"></form>";
            $body = $comment['comment_text'];
            display_card_with_header($header, $body);
        }
        
        function find_child_comments($id, $i) {
            $i++;
            $comments = get_child_comments($id);
            while($comment = mysqli_fetch_array($comments)) {
                for($index = 0; $index < $i; $index++) {
                    echo"<div class=\"indent-comment\"></div>";
                }
                display_comment($comment);
                find_child_comments($comment['comment_id'], $i);
            }
        }
    }
?>