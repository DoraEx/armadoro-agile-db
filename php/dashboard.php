<?php
require("service/wrappers.php");


function listActiveUserProjects($id) {
    $get_projects = "select project_id, project_name from project where project_manager='" . $id ."'";
    $result = db_query($get_projects);
    echo "<ul>";
    while ($project = mysqli_fetch_array($result)) {
        echo get_project_link($project['project_id'], $project['project_name']);
    }
    echo "</ul>";
}

function listUnreadComments($id) {
    //from comment_read table
    $get_unread_comments = "select * from unread_comment_detail where emp_id = '" . $id . "'";
    $result = db_query($get_unread_comments);
    
    while ($comment = mysqli_fetch_array($result)) {
        $comment_read_pk = $comment['emp_id'] . " " . $comment['comment_id'];

        echo "<div class='card mb-3 comment-card'><div class='card-header'>"; 
        echo get_employee_link($comment['author_id'], $comment['author']);
        echo " wrote on ". $comment['date_created'];
        echo " from task ";
        echo get_task_link($comment['task_id'], $comment['task_name']);
        echo " of project ";
        echo get_project_link($comment['project_id'], $comment['project_name']);
        echo "</p>";
        echo "<button id=\"$comment_read_pk\" onClick=\"remove_comment(this.id)\" style=\"float: right;\">remove</button>";
        echo "</div><div class='card-body'>";
        echo "<p>" . $comment['comment_text'];
        echo "</p></div></div>";
    }
}

function listIterations($id) {
    //from active_iterations table
    $get_iterations_query = <<<MARKER
    SELECT DISTINCT project_id, iteration_id, iteration_name, date_start, date_end, project_manager, project_name
    FROM employee_active_iterations 
    WHERE project_manager = "$id" OR developer_emp_id = "$id";
MARKER;

    //$get_iterations_query = "SELECT DISTINCT * FROM employee_active_iterations WHERE project_manager = '" . $id . "' OR developer_emp_id = '" . $id . "'";
    $result = db_query($get_iterations_query);
    
    while($iteration = mysqli_fetch_array($result)){
        $iteration_pk = $iteration['iteration_id'];
        $iteration_tag = get_iteration_link($iteration['iteration_id'], $iteration['iteration_name']);
        echo "<div class='card mb-3 comment-card'><div class='card-header'>"; 
        echo get_iteration_link($iteration['iteration_id'], $iteration['iteration_name']);        
        echo "<button id=\"$iteration_pk\" onClick=\"iteration_button_onclick(this.id)\" style=\"float: right;\">go</button>";
        echo "</div><div class='card-body'>";
        echo "<p>" . $iteration['date_start'] . " - " . $iteration['date_end'];
        echo "</p></div></div>";
    }
}
// -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -





// ADD MANAGEMENT CONSOLE() ****PROBABLY NOT NEEDED because there's a link in the header drop down (DELETE WHEN SURE)****
// -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -
// -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -
function addManagementConsole() {
    error_log("\n\nSESSION: " . $_SESSION['e_role'] . "\n\n", 3, "/home/armando/php_log.log");
    if(isset($_SESSION['e_role']) && $_SESSION['e_role'] == 'PM') {
        $console_link = "<button name='console' class='btn btn-link' type='submit' value='Management Console'>Management Console</button>";
        echo "<div class='card mb-3 comment-card'><div class='card-header'>"; 
        echo "<form action=\"/view/management_console\">";
        echo $console_link;
        echo "</form>";
        echo "</div></div'>";
    }
}
// -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -

?>
