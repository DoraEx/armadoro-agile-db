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


