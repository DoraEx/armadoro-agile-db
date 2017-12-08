
<?php
// POPULATE PROJECTS ()
// ///////////////////////////////////////////////////////////////////
// ///////////////////////////////////////////////////////////////////
function populate_projects($in_e_id) {
    $get_projects_query = "CALL get_user_projects($in_e_id)";
    $result = db_query($get_projects_query);
    while ($retrieved_row = mysqli_fetch_array($result)) {
        $p_id = $retrieved_row['project_id'];
        $p_name = $retrieved_row['project_name'];
        $project_to_output = <<<MARKER
        <option value="$p_id">$p_name</option>
MARKER;
        echo($project_to_output);
    }
}
// ///////////////////////////////////////////////////////////////////





// SHOW ALL TASKS FOR PROJECT()
// ///////////////////////////////////////////////////////////////////
// ///////////////////////////////////////////////////////////////////
function show_all_tasks_for_project($in_project_id) { 
    $query_string = <<< MARKER
    SELECT t.task_id, t.task_name, t.create_date, t.completed_date, t.project_id, t.iteration_id, t.status_id, 
            t.size_id, t.description, i.iteration_name
    FROM task t
    JOIN iteration i ON i.iteration_id = t.iteration_id
    WHERE t.project_id = $in_project_id;
MARKER;
    $db_output = db_query($query_string);
    var_dump($db_output);
    while ($row = mysqli_fetch_array($db_output)) {
        $task_name = $row['t.task_name'];
        $iteration_name = $row['t.iteration_name'];
        $status_id = $row['t.status_id'];
        $size_id = $row['t.size_id'];
        $description = $row['t.description'];
        $task_info_out = <<<MARKER
        <ul class="list-group">
            <li class="list-group-item active"> <strong>Task: </strong> $task_name</li>
            <li class="list-group-item "> <strong>Task: </strong> $iteration_name</li>
            <li class="list-group-item "> <strong>Task: </strong> $status_id</li>
            <li class="list-group-item "> <strong>Task: </strong> $size_id</li>
            <li class="list-group-item "> <strong>Task: </strong> $description</li>
        </ul>
MARKER;
        echo($task_info_out);
        // Free result set
    $db_output->close();
    }
}
// ///////////////////////////////////////////////////////////////////

?>
