



create view project_details as
select p.project_name, e.first_name, e.last_name, p.date_start, p.date_due, p.date_complete
from employee e
 	join project_manager pm 
 	on e.emp_id = pm.emp_id
 	join project p 
 	on pm.emp_id = p.project_manager;





create view task_details as
select task_name, create_date, completed_date, project_name, iteration_name, status_name, size_name
from task t
 	join project p 
 	on p.project_id = t.project_id
 	join iteration i
	join status st
	on t.status_id = st.status_id
	join size s
 	on s.size_id = t.size_id;





create view comment_details as
select comment_text, first_name, last_name, task_name, date_created
from comment c
 	join employee e
 	on e.emp_id = c.emp_id
 	join task t
 	on c.task_id = t.task_id;





create view developer_capacity as
select first_name, last_name, count(*)
from employee e
	join task_developer t
	on e.emp_id = t.emp_id
group by first_name, last_name;





/*ACTIVE PROJECTS*/
CREATE VIEW active_projects AS 
SELECT * 
FROM project 
WHERE date_complete IS NULL; 




/*ACTIVE ITERATIONS*/
CREATE VIEW active_iterations AS
SELECT *
FROM iteration
WHERE (SELECT NOW()) BETWEEN date_start AND date_end;








