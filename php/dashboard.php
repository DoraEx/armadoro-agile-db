<?php
//todo: fix it go get active projects
function listActiveUserProjects($id) {
    $get_projects = "select project_id, project_name from project where project_manager='" . $id ."'";
    $result = db_query($get_projects);
    $projects = mysqli_fetch_assoc($result);
    $length = count($result);
    
    echo "<ul>";
    for($i = 0; $i < $length; $i++) {
        echo "<li><button name='project' class='btn btn-link' type='submit' value='" . $projects['project_id'] ."'>". $projects['project_name'] . "</button></li>";
    }
    echo "</ul>";
    
}
//todo: function to grab a list of the logged in users  unread comments

function listUnreadComments($id) {
    //from comment_read table
    $get_unread_comments = "select * from unread_comment_detail where emp_id = '" . $id . "'";
    $result = db_query($get_unread_comments);
    
    while($comment = mysqli_fetch_array($result)){
        echo "<div class='card mb-3'><div class='card-header'>"; 
        echo  "On task ".$comment['task_name'] ."from project " .$comment['project_name'].", " . $comment['author'] . " wrote:" ;
        echo "</div><div class='card-body'>";
        echo "<p>" . $comment['comment_text'];
        echo "</p></div></div>";
    }
}
//todo: function to grab a list of the logged in users iterations


?>