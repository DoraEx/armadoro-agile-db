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

create view unread_comment_detail as
select unread.emp_id as emp_id, c.comment_id, a.emp_id as author_id, concat(a.first_name,' ', a.last_name) as author, t.task_id,
		 t.task_name, p.project_id, p.project_name, c.date_created, c.comment_text
from (select comment_id, emp_id 
		from comment_read
		where read_status = 0) as unread
	join (select comment_id, emp_id, task_id, date_created, comment_text
		from comment) as c
	on unread.comment_id = c.comment_id
	join (select task_id, project_id, task_name 
		from task) as t
	on c.task_id = t.task_id
	join (select project_id, project_name
		from project) as p
	on p.project_id = t.project_id
	join (select emp_id, first_name, last_name
		from employee) as a
	on a.emp_id = c.emp_id;
