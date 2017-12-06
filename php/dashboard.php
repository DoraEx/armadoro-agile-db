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
        
        //added by Armando
        $comment_read_pk = $comment['emp_id'] . " " . $comment['comment_id'];
        //added by Armando
    
        $author_tag = "<button name='author' class='btn btn-link' type='submit' value='". $comment['author_id']. "'>".$comment['author']. "</button>";
        echo "<div class='card mb-3 comment-card'><div class='card-header'>"; 
        echo $author_tag;

        //added by Armando
        echo "<button id=\"$comment_read_pk\" onClick=\"remove_comment(this.id)\" style=\"float: right;\">remove</button>";
        //added by Armando
        
        echo "</div><div class='card-body'>";
        echo "<p>" . $comment['comment_text'];
        echo "</p></div></div>";
    }
}
//todo: function to grab a list of the logged in users iterations


?>