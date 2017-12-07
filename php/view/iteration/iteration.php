<?php
// LIST ITERATIONS()
// -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -
// -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -
function listIterations2($id) {
    //from employee_active_iterations table
    $get_iterations_query = <<<MARKER
    SELECT DISTINCT project_id, iteration_id, iteration_name, date_start, date_end, project_manager, project_name
    FROM employee_active_iterations 
    WHERE project_manager = "$id" OR developer_emp_id = "$id";
MARKER;

    $get_iter_progress_query = <<<MARKER
    SELECT * FROM iteration_progress
    WHERE iteration_id = 
    ORDER BY time DESC
    LIMIT 1;
MARKER;

    $result = db_query($get_iterations_query);
    
    while($iteration_row = mysqli_fetch_array($result)) {
        $iteration_pk = $iteration_row['iteration_id'];
        
        $get_iter_progress_query = <<<MARKER
        SELECT * FROM iteration_progress
        WHERE iteration_id = $iteration_pk
        ORDER BY time DESC
        LIMIT 1;
MARKER;
        $project_manager_id = $iteration_row["project_manager"];
        $get_manager_name_query = <<<MARKER
        SELECT CONCAT(first_name, " ", last_name) AS full_name 
        FROM employee
        WHERE emp_id=$project_manager_id;
MARKER;


        $result2 = db_query($get_iter_progress_query);
        $progress_row = mysqli_fetch_array($result2);

        $result3 = db_query($get_manager_name_query);
        $manager_row = mysqli_fetch_array($result3);

        $author_tag = "<button name='author' class='btn btn-link' type='submit' value='". $iteration_row['iteration_id']. "'>".$iteration_row['iteration_name']. "</button>";
        echo "<div class='card mb-3 comment-card'><div class='card-header'>"; 
        echo $author_tag;
        echo "<button id=\"$iteration_pk\" onClick=\"iteration_button_onclick(this.id)\" style=\"float: right;\">go</button>";
        
        echo "<div class='card-body'>";
        echo "<p>" . $iteration_row['date_start'] . " - " . $iteration_row['date_end'];
        echo "</p></div>";

        echo "<div class='card-body'>";
        echo "<p>" . "Project Name: " . $iteration_row['project_name'];
        echo "</p></div>";

        echo "<div class='card-body'>";
        echo "<p>" . "Project Manager: " . $manager_row['full_name'];
        echo "</p></div>";

        echo "<div class='card-body'>";
        echo "<p>" . "Total tasks: " . $progress_row['total_tasks'];
        echo "</p></div>";

        echo "<div class='card-body'>";
        echo "<p>" . "Open tasks: " . $progress_row['open_tasks'];
        echo "</p></div>";
        
        echo "</div></div>";
    }
}
// -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -
?>


<!-- project_id iteration_id time total_tasks open_tasks -->