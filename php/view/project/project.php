
<?php
ini_set('display_errors', 1);

// //Checking Redirect Conditions
// if(!isset($_SESSION['e_id']) or !isset($_SESSION['project_id'])) { header('location: /'); }
// If came to page through post, set the project_id to the posted id
if($_SERVER["REQUEST_METHOD"] == "GET") {
    $_SESSION['project_id'] = $_GET['project_id'];
}

// Grab the project_id from the Session
$project_id = $_SESSION['project_id'];





// LIST PROJECT ITERATIONS()
//-   -   -   -   -   -   -   -   -   -   -   -   -   -
function list_project_iterations($in_project_id) {
    $project_iterations_query = <<<MARKER
    SELECT iteration_name, date_start, date_end
    FROM iteration i
    WHERE i.project_id=$in_project_id;
MARKER;
    $result1 = db_query($project_iterations_query);
    while($project_iteration_row = mysqli_fetch_array($result1)) {
        $header_to_display = $project_iteration_row['iteration_name'];
        $body_to_display = $project_iteration_row['date_start'] . " " . $project_iteration_row['date_end'];
        display_card_with_header($header_to_display, $body_to_display);
    }
}
//-   -   -   -   -   -   -   -   -   -   -   -   -   -




// LIST PROJECT DETAILS()
//-   -   -   -   -   -   -   -   -   -   -   -   -   -
function list_project_details($in_project_id) {
    $project_details_query_1 = <<<MARKER
    SELECT project_name, p.date_start AS date_start, p.date_due AS date_due, concat(e.first_name, " ", e.last_name) AS full_name
    FROM project p
    JOIN employee e ON p.project_manager = e.emp_id
    WHERE p.project_id=$in_project_id;
MARKER;

    $project_details_query_2 = <<<MARKER
    SELECT open_tasks, total_tasks
    FROM project_progress
    WHERE project_id=$in_project_id
    ORDER BY time DESC
    LIMIT 1;
MARKER;



    $result2 = db_query($project_details_query_1);
    $result3 = db_query($project_details_query_2);
    $project_details_1_row = mysqli_fetch_array($result2);
    $project_details_2_row = mysqli_fetch_array($result3);

    $project_name = $project_details_1_row['project_name'];
    $date_start = $project_details_1_row['date_start'];
    $date_due = empty($project_details_1_row['date_due']) ? 'on-going' : $project_details_1_row['date_due'];
    $full_name = $project_details_1_row['full_name'];
    $total_tasks = $project_details_2_row['total_tasks'];
    $open_tasks = $project_details_2_row['open_tasks'];

    $project_detail_output = <<<MARKER
         <ul class="list-group">
         <li class="list-group-item active"><Strong>Project:</Strong> $project_name</li>
         <li class="list-group-item"><Strong>Start Date:</Strong> $date_start</li>
         <li class="list-group-item"><Strong>Project Manager:</Strong> $full_name</li>
         <li class="list-group-item"><Strong>Total Tasks:</Strong> $total_tasks</li>
         <li class="list-group-item"><Strong>Open Tasks:</Strong> $open_tasks</li>
       </ul>
MARKER;
    echo ($project_detail_output);
}
//-   -   -   -   -   -   -   -   -   -   -   -   -   -



// PROJECT_NAME()
//-   -   -   -   -   -   -   -   -   -   -   -   -   -
function project_name($in_project_id) {
    $project_name_query = <<<MARKER
    SELECT project_name
    FROM project p
    WHERE p.project_id=$in_project_id;
MARKER;
    $result = db_query($project_name_query);
    $project_name_row = mysqli_fetch_array($result);
    echo $project_name_row['project_name'];
}
//-   -   -   -   -   -   -   -   -   -   -   -   -   -






// LIST PROJECT TASKS()
//-   -   -   -   -   -   -   -   -   -   -   -   -   -
function list_project_tasks($in_project_id) {
    $project_tasks_query = <<<MARKER
    SELECT t.task_name AS task_name, t.completed_date AS completed_date, t.status_id AS status_id,
            t.size_id AS size_id, i.iteration_name AS iteration_name
    FROM task t
    LEFT JOIN iteration i ON t.iteration_id = i.iteration_id
    WHERE t.project_id = $in_project_id
    ORDER BY t.create_date DESC;
MARKER;



    $result = db_query($project_tasks_query);
    var_dump($in_project_id);
    var_dump($result);
    while ($project_tasks_row = mysqli_fetch_array($result)) {
        $iteration_name = empty($project_tasks_row['iteration_name']) ? "Not assigned to an iteration" : $project_tasks_row['iteration_name'];
        $task_name = $project_tasks_row['task_name'];
        $status_id = $project_tasks_row['size_id'];
        $size_id = $project_tasks_row['size_id'];
        $task_output = <<<MARKER

        <ul class="list-group">
        <li class="list-group-item active">$iteration_name</li>
        <li class="list-group-item">Task: $task_name</li>
        <li class="list-group-item">Status: $status_id</li>
        <li class="list-group-item">Size: $size_id</li>
      </ul>

MARKER;
        echo($task_output);
    }
}
//-   -   -   -   -   -   -   -   -   -   -   -   -   -








// LIST ALL COMMENTS()
//-   -   -   -   -   -   -   -   -   -   -   -   -   -
function list_project_comments($in_project_id) {
    $project_comments_query = <<<MARKER
    SELECT c.date_created AS date_created, CONCAT(e.first_name, ' ', e.last_name) AS full_name,
            c.comment_text AS text, t.task_id, c.comment_id
    FROM comment c
    JOIN task t ON c.task_id = t.task_id
    JOIN employee e ON c.emp_id = e.emp_id
    WHERE t.project_id = $in_project_id
    ORDER BY t.task_id DESC, c.comment_id ASC;
MARKER;



    $result = db_query($project_comments_query);
    while ($project_comments_row = mysqli_fetch_array($result)) {
        $full_name = $project_comments_row['full_name'];
        $date_created = $project_comments_row['date_created'];
        $text = $project_comments_row['text'];
        $comment_output = <<<MARKER
        <ul class="list-group">
        <li class="list-group-item active">By: $full_name</li>
        <li class="list-group-item">On: $date_created</li>
        <li class="list-group-item">Message: $text</li>
      </ul>
MARKER;
        echo($comment_output);
    }
}
//-   -   -   -   -   -   -   -   -   -   -   -   -   -










//-   -   -   -   -   -   -   -   -   -   -   -   -   -

//-   -   -   -   -   -   -   -   -   -   -   -   -   -






//-   -   -   -   -   -   -   -   -   -   -   -   -   -



//-   -   -   -   -   -   -   -   -   -   -   -   -   -
?>
