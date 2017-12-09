<?php

function get_pm_projects($id) {
    $get_projects = <<<MARKER
        select project_id, project_name 
        from project 
        where project_manager=$id;
MARKER;
    return db_query($get_projects);
}

function get_dev_projects($id) {
    $get_projects = <<<MARKER
        select p.project_id, p.project_name  
        from project_developer 
        join project p 
        where developer_emp_id = $id;
MARKER;
    return db_query($get_projects);
}

function get_developer_skills($id) {
    $get_skills = <<<MARKER
    SELECT skill_name
    FROM developer_skill d
        JOIN skill s
        ON d.skill_id = s.skill_id
    WHERE d.emp_id =$id;
MARKER;
    return db_query($get_skills);
}

function get_task_details($id) {
    $get_task = <<<MARKER
    SELECT *
    FROM task_detail
    WHERE task_id =$id;
MARKER;
    return db_query($get_task);
}

function get_task_comments($id) {
    $get_comments = <<<MARKER
    select c.*, concat(e.first_name, ' ', e.last_name) as author
    from comment c
    join employee e
    on c.emp_id = e.emp_id
    where task_id = $id;
MARKER;
    return db_query($get_comments);
}
function get_child_comments($id) {
    $get_comments = <<<MARKER
    select c.*, concat(e.first_name, ' ', e.last_name) as author
    from comment c
    join employee e
    on c.emp_id = e.emp_id
    where c.parent_comment_id = $id;
MARKER;
    return db_query($get_comments);
}
?>