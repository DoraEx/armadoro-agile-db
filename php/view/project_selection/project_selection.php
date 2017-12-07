<?php
ini_set('display_errors', 1);

//Checking Redirect Conditions
if(!isset($_SESSION['e_id'])) { header('location: /'); }



// LIST PROJECT TASKS()
//-   -   -   -   -   -   -   -   -   -   -   -   -   -
function populate_projects($in_e_id) {
    $projects_query = <<<MARKER
    SELECT DISTINCT p.project_name AS project_name, p.project_id AS project_id
    FROM active_projects p
    JOIN project_manager m ON p.project_manager = m.emp_id
    WHERE 1 = m.emp_id
UNION
    SELECT DISTINCT p2.project_name AS project_name, p2.project_id AS project_id
	FROM active_projects p2
    JOIN project_developer d ON d.project_id = p2.project_id
    WHERE 1 = d.developer_emp_id;
MARKER;

    $result = db_query($projects_query);
    while ($projects_row = mysqli_fetch_array($result)) {
        $p_name = $projects_row['project_name'];
        $p_id = $projects_row['project_id'];
        
        $projects_output = <<<MARKER
            <option value="$p_id">$p_name</option>
MARKER;
        echo($projects_output);
    }
}
//-   -   -   -   -   -   -   -   -   -   -   -   -   -