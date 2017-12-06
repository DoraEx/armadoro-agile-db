<?php
    function get_employee_link($id, $name) {
        return "<form method=\"post\" action=\"/view/profile/index.php\"><input type=\"hidden\" name=\"profile_id\" value=\"$id\"><input name=\"employee\" class=\"btn btn-link\" type=\"submit\" value=\"$name\"></form>"; 
        }
    function get_iteration_link($id, $name) {
        return "<button name=\"iteration\" class=\"btn btn-link\" type=\"submit\" value=\"$id\" form=\"iteration-form\">$name</button>";
    }
    function get_project_link($id, $name) {
        return "<form method=\"post\" action=\"/view/project/index.php\"><input type=\"hidden\" name=\"project_id\" value=\"$id\"><input name=\"project\" class=\"btn btn-link\" type=\"submit\" value=\"$name\"></form>";        
    }
    function get_task_link($id, $name) {
        return "<form method=\"post\" action=\"/view/task/index.php\"><input type=\"hidden\" name=\"task_id\" value=\"$id\"><input name=\"task\" class=\"btn btn-link\" type=\"submit\" value=\"$name\"></form>"; 
    }
    function display_card_with_header($header, $body) {
        echo "<div class='card mb-3 comment-card'><div class='card-header'>";
        echo $header;
        echo "</div><div class='card-body'>";
        echo $body;
        echo "</div></div>";
    }
    function display_card($body) {
        echo "<div class='card mb-3 comment-card'><div class='card-body'>";
        echo $body;
        echo "</div></div>";
    }
?>