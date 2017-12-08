<?php ini_set('display_errors', 1);?>




<?php
// DISPLAY ADD PROJECT FORM
// ///////////////////////////////////////////////////////////////////
// ///////////////////////////////////////////////////////////////////
function display_add_project_form($in_e_id) {
    $add_project_form = <<<MARKER
    <div class="container">
    <div class="row well">
        <div class="offset-md-1 col-md-10 toledo-dash well">
            <form method="POST" action="/procedure/insert_project/index.php">
                <!-- E_ID (HIDDEN) -->
                <input type="text" name="e_id" value="$in_e_id" style="display: none">
                <!-- PROJECT NAME  -->
                <div class="form-group">    
                    <label for="p-name-text">Project Name</label>
                    <input id="p-name-text" name="project_name" type="text" class="form-control" placeholder="Enter Project Name">
                </div>
                <!-- DATE DUE -->
                <div class="form-group">
                    <label for="date-get">Due Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input id="date-get" name="date_due" type="date" class="form-control">
                    <small class="form-text text-muted">You can change it later.</small>
                </div>
                <button type="submit" class="btn btn-primary">Add Project</button>
            </form>
        </div>
    </div>
</div>
MARKER;
    echo $add_project_form;
}
// ///////////////////////////////////////////////////////////////////
// ///////////////////////////////////////////////////////////////////
?>






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
?>




<?php

// DISPLAY ADD TASK FORM()
// ///////////////////////////////////////////////////////////////////
// ///////////////////////////////////////////////////////////////////
function display_add_task_form($in_e_id) {
    $add_task_form_1 =<<< MARKER
    <div class="container">
    <div class="row well">
        <div class="offset-md-1 col-md-10 toledo-dash well">
            <div id="div-to-pad-left">
                <form action="/procedure/insert_task/index.php" method="POST"> 
                    <!-- Project ID -->
                    <div class="form-group">
                        <label for="sel1">Select Project</label>
                        <br>
                        <select class="form-control" id="sel1" name="project_id">
MARKER;
    echo ($add_task_form_1);
    
    populate_projects($in_e_id);

    $add_task_form_2 =<<< MARKER
                        </select>
                    </div>
                    <!-- Task Name -->
                    <div class="form-group">
                        <label for="name-text">Task Name</label>
                        <br>
                        <input class="form-control" type="text" name="task_name" placeholder="task name">
                    </div>
                    <!-- Status ID -->
                    <div class="form-group">
                        <label for="status-select">Status</label>
                        <br>
                        <select class="form-control" id="status-select" name="status_id">
                            <option value="AS">Assigned</option>
                            <option value="CL">Closed</option>
                            <option value="IP">In Progress</option>
                            <option value="NR">Needs Review</option>
                            <option value="OP">Open</option>
                        </select>
                    </div>    
                    <!-- Size ID -->
                    <div class="form-group">
                        <label for="size-select">Size</label>
                        <br>
                        <select class="form-control" id="size-select" name="size_id">
                            <option value="XS">Extra Small</option>
                            <option value="SM">Small</option>
                            <option value="MD">Medium</option>
                            <option value="LG">Large</option>
                            <option value="XL">Extra Large</option>
                        </select>
                    </div>
                    <!-- Task Name -->
                    <div class="form-group">
                        <label for="description-text">Task Description</label>
                        <br>
                        <input type="text" class="form-control" name="description" id="description_text" placeholder="Describe the task">
                    </div>
                    <!-- Submit Button -->
                    <input type="submit" value="OK">
                </form>
            </div>
        </div>
    </div>
</div>
MARKER;
echo ($add_task_form_2);
}
// ///////////////////////////////////////////////////////////////////
// ///////////////////////////////////////////////////////////////////
?>






<?php

// DISPLAY ADD ITERATION FORM()
// ///////////////////////////////////////////////////////////////////
// ///////////////////////////////////////////////////////////////////
function display_add_iteration_form($in_e_id) {
    $add_iteration_form_1 =<<< MARKER
<div class="container">
    <div class="row well">
        <div class="offset-md-1 col-md-10 toledo-dash well">
            <div id="div-to-pad-left">
                <form action="/procedure/insert_iteration/index.php" method="POST"> 
                    <!-- Project ID -->
                    <div class="form-group">
                        <label for="sel1">Select Project</label>
                        <br>
                        <select class="form-control" id="sel1" name="project_id">
MARKER;
    echo ($add_iteration_form_1);
    
    populate_projects($in_e_id);

    $add_iteration_form_2 =<<< MARKER
                        </select>
                    </div>
                    <!-- Iteration Name -->
                    <div class="form-group">
                        <label for="name-text2">Iteration Name</label>
                        <br>
                        <input class="form-control" id="name-text2" type="text" name="iteration_name" placeholder="iteration name">
                    </div>
                    <!-- Date Start -->
                    <div class="form-group">
                        <label for="date-get">Start Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <input id="date-get" name="date_start" type="date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="date-get">End Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <input id="date-get" name="date_end" type="date" class="form-control">
                    </div>
                    <!-- Submit Button -->
                    <input type="submit" value="OK">
                </form>
            </div>
        </div>
    </div>
</div>
MARKER;
    echo ($add_iteration_form_2);
}
// ///////////////////////////////////////////////////////////////////
// ///////////////////////////////////////////////////////////////////
?>







<?php require(realpath($_SERVER["DOCUMENT_ROOT"]) . '/template/footer.php'); ?>