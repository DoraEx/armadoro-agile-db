
<?php
// POPULATE PROJECTS ()
// ///////////////////////////////////////////////////////////////////
// ///////////////////////////////////////////////////////////////////
function populate_projects($in_e_id) {
    $get_projects_query = <<< MARKER
    SELECT DISTINCT p.project_name AS project_name, p.project_id AS project_id
    FROM active_projects p
    JOIN project_manager m ON p.project_manager = m.emp_id
    WHERE $in_e_id = m.emp_id
UNION
    SELECT DISTINCT p2.project_name AS project_name, p2.project_id AS project_id
	  FROM active_projects p2
    JOIN project_developer d ON d.project_id = p2.project_id
    WHERE $in_e_id = d.developer_emp_id;
MARKER;
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
    LEFT JOIN iteration i ON i.iteration_id = t.iteration_id
    WHERE t.project_id = $in_project_id;
MARKER;
    $db_output = db_query($query_string);
    while ($row = mysqli_fetch_array($db_output)) {
        $task_name = $row['task_name'];
        $iteration_name = $row['iteration_name'];
        $status_id = $row['status_id'];
        $size_id = $row['size_id'];
        $description = $row['description'];
        $task_info_out = <<<MARKER
        <ul class="list-group">
            <li class="list-group-item active"> <strong>Task: </strong> $task_name</li>
            <li class="list-group-item "> <strong>Task: </strong> $iteration_name</li>
            <li class="list-group-item "> <strong>Task: </strong> $status_id</li>
            <li class="list-group-item "> <strong>Task: </strong> $size_id</li>
            <li class="list-group-item "> <strong>Task: </strong> $description</li>
        </ul>
MARKER;
        echo ($task_info_out);
    }
}
// ///////////////////////////////////////////////////////////////////




// SHOW ALL TASKS FOR DEV()
// ///////////////////////////////////////////////////////////////////
// ///////////////////////////////////////////////////////////////////
function show_all_tasks_for_dev($in_e_id) { 
    $query_string = <<< MARKER
    SELECT t.task_id, t.task_name, t.create_date, t.completed_date, t.project_id, t.iteration_id, t.status_id, t.size_id, t.description, i.iteration_name
    FROM task t
    JOIN task_developer d ON t.task_id = d.task_id
    LEFT JOIN iteration i ON t.iteration_id = i.iteration_id
    WHERE d.emp_id = $in_e_id
    ORDER BY iteration_id DESC, create_date DESC;
MARKER;
    $db_output = db_query($query_string);
    while ($row = mysqli_fetch_array($db_output)) {
        $task_name = $row['task_name'];
        $iteration_name = $row['iteration_name'];
        $status_id = $row['status_id'];
        $size_id = $row['size_id'];
        $description = $row['description'];
        $task_info_out = <<<MARKER
        <ul class="list-group">
            <li class="list-group-item active"> <strong>Task: </strong> $task_name</li>
            <li class="list-group-item "> <strong>Task: </strong> $iteration_name</li>
            <li class="list-group-item "> <strong>Task: </strong> $status_id</li>
            <li class="list-group-item "> <strong>Task: </strong> $size_id</li>
            <li class="list-group-item "> <strong>Task: </strong> $description</li>
        </ul>
MARKER;
        echo ($task_info_out);
    }
}
// ///////////////////////////////////////////////////////////////////





// SHOW RIGHT()
// ///////////////////////////////////////////////////////////////////
// ///////////////////////////////////////////////////////////////////
function show_right($in_e_id) {
    $e_id = $_SESSION['e_id'];
    $part1 = <<<MARKER
    <!-- RIGHT SIDE FOR TASKS OF USER IF DEV -->
    <div id="toledo-right" class="col-md-6">
        <h3>Tasks of user (dev)</h3>
        <div class="toledo-dash-long well pre-scrollable">        
MARKER;
    echo($part1);

    $part2 = <<<MARKER
                    <div class="card-body">
MARKER;
    echo($part2);

    show_all_tasks_for_dev($in_e_id);

    $part3 = <<<MARKER
        </div>
    </div>
MARKER;
    echo($part3);
}
?>
