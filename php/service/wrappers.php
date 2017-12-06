<?php
    function get_employee_link($id, $name) {
        return "<button name=\"author\" class=\"btn btn-link\" type=\"submit\" value=\"$id\">$name</button>";
    }
    function get_iteration_link($id, $name) {
        return "<button name=\"iteration\" class=\"btn btn-link\" type=\"submit\" value=\"$id\">$name</button>";
    }
    function get_project_link($id, $name) {
        return "<button name=\"project\" class=\"btn btn-link\" type=\"submit\" value=\"$id\">$name</button>";        
    }
    function get_task_link($id, $name) {
        return "<button name=\"task\" class=\"btn btn-link\" type=\"submit\" value=\"$id\">$name</button>";        
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