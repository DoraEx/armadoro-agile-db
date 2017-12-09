

/*
Get Current Iterations of employee (replace 1 for emp_id)
*/
SELECT DISTINCT project_id, iteration_id, iteration_name, date_start, date_end, project_manager, project_name
FROM employee_active_iterations
WHERE project_manager = 1 OR developer_emp_id = 1;



/*
Get the most recent status of the iteration (replace 1 with iteration id)
COLUMNS: project_id iteration_id time total_tasks open_tasks
*/
SELECT * FROM iteration_progress
WHERE iteration_id = 1
ORDER BY time DESC
LIMIT 1;




/*
Get all the iterations for a particular project (replace 1 with desired project id)
*/
SELECT iteration_name, date_start, date_end
FROM iteration  i
WHERE i.project_id = 1;



/*
Insertion into project table
*/
INSERT INTO `project` (`project_id`, `project_manager`, `project_name`, `date_start`, `date_due`, `date_complete`) VALUES (NULL, '1', 'Android App MADS', '2017-10-18', '2017-12-22', NULL);

INSERT INTO `task` (`task_id`, `task_name`, `create_date`, `completed_date`, `project_id`, `iteration_id`, `status_id`, `size_id`, `description`) VALUES (NULL, 'create backup', CURRENT_TIMESTAMP, NULL, '1', '2', 'OP', 'SM', 'create a backup on the cloud');



/*
Get employee's full name
*/
SELECT CONCAT(first_name, " ", last_name) AS full_name
FROM employee
WHERE emp_id=$1;



/*
Get Project's most updated stats
*/
SELECT open_tasks, total_tasks
FROM project_progress
WHERE project_id=1
ORDER BY time DESC
LIMIT 1;





/*
Get all tasks for a project
*/
SELECT t.task_name AS task_name, t.completed_date AS completed_date, t.status_id AS status_id,
        t.size_id AS size_id, i.iteration_name AS iteration_name
FROM task t
LEFT JOIN iteration i ON t.iteration_id = i.iteration_id
WHERE t.project_id = $in_project_id
ORDER BY t.create_date DESC;





/*
Get user current projects
*/
SELECT DISTINCT p.project_name AS project_name, p.project_id AS project_id
    FROM active_projects p
    JOIN project_manager m ON p.project_manager = m.emp_id
    WHERE 1 = m.emp_id

UNION

SELECT DISTINCT p2.project_name AS project_name, p2.project_id AS project_id
	  FROM active_projects p2
    JOIN project_developer d ON d.project_id = p2.project_id
    WHERE 1 = d.developer_emp_id;







/*
Get Tasks assigned to user (Change 1 to desired user id)
*/
SELECT t.task_id, task_name, create_date, completed_date, project_id, iteration_id, status_id, size_id, description
FROM task t
JOIN task_developer d ON t.task_id = d.task_id
WHERE d.emp_id = 6
ORDER BY iteration_id DESC, create_date DESC;
