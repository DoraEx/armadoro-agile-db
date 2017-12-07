use agile_db;

create table employee (
	emp_id smallint unsigned not null auto_increment,
	first_name varchar(20) not null,
	last_name varchar(20) not null,
	primary key (emp_id)
);

create table login_credential (
	user_email varchar(50) not null,
	user_password varchar(255) not null,
	emp_id smallint unsigned not null,
	primary key (user_email, user_password),
	foreign key (emp_id) references employee(emp_id)
);

create table phone_number (
	emp_id smallint unsigned not null,
	phone char(10) not null,
	foreign key (emp_id) references employee(emp_id),
	primary key (emp_id, phone)
);

create table project_manager (
	emp_id smallint unsigned not null,
	foreign key (emp_id) references employee(emp_id)
);

create table developer (
	emp_id smallint unsigned not null,
	foreign key (emp_id) references employee(emp_id),
	primary key (emp_id)
);

create table skill (
	skill_id smallint unsigned not null auto_increment,
	skill_name varchar(20) not null,
	primary key (skill_id)
);

create table developer_skill (
	emp_id smallint unsigned not null,
	skill_id smallint unsigned not null,
	foreign key (emp_id) references developer(emp_id),
	foreign key (skill_id) references skill(skill_id),
	primary key (emp_id, skill_id)
);

create table project (
	project_id smallint unsigned not null auto_increment,
	project_manager smallint unsigned not null,
	project_name varchar(30) not null,
	date_start date not null,
	date_due date not null,
	date_complete date,
	primary key (project_id),
	foreign key (project_manager) references project_manager(emp_id)
);

CREATE TABLE iteration (
	project_id smallint unsigned NOT NULL,
	iteration_id smallint unsigned NOT NULL AUTO_INCREMENT,
	iteration_name varchar(30) NOT NULL,
	date_start DATE NOT NULL,
	date_end DATE NOT NULL,
	primary key (iteration_id),
	foreign key (project_id) references project(project_id)
);

CREATE TABLE status (
	status_id       CHAR(2),
	status_name     VARCHAR(20),
	PRIMARY KEY(status_id)
);

CREATE TABLE size (
	size_id        CHAR(2),
	size_name       VARCHAR(15),
	size_points     NUMERIC(3,0),
	PRIMARY KEY(size_id)
);

CREATE TABLE task (
	task_id   	SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
	task_name 	VARCHAR(30) NOT NULL,
	create_date 	TIMESTAMP NOT NULL,
	completed_date  TIMESTAMP NULL,
	project_id 	SMALLINT UNSIGNED NOT NULL,
	iteration_id 	SMALLINT UNSIGNED,
	status_id  	CHAR(2),
  	size_id  	CHAR(2),
	description 	TEXT,
	PRIMARY KEY(task_id),
	FOREIGN KEY(project_id) REFERENCES project(project_id),
	FOREIGN KEY(iteration_id) REFERENCES iteration(iteration_id),
	FOREIGN KEY(status_id) REFERENCES status(status_id),
	FOREIGN KEY(size_id) REFERENCES size(size_id)
);

CREATE TABLE comment (
	comment_id 		SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
	parent_comment_id 	SMALLINT UNSIGNED,
	emp_id 			SMALLINT UNSIGNED NOT NULL,
	task_id 		SMALLINT UNSIGNED NOT NULL,
	date_created 		TIMESTAMP NOT NULL,
	comment_text 		TEXT,
	PRIMARY KEY(comment_id),
	FOREIGN KEY(emp_id) REFERENCES employee(emp_id),
	FOREIGN KEY(task_id) REFERENCES task(task_id),
	FOREIGN KEY(parent_comment_id) REFERENCES comment(comment_id)
);

CREATE TABLE project_developer(
	project_id 		SMALLINT UNSIGNED NOT NULL,
	developer_emp_id 	SMALLINT UNSIGNED NOT NULL,
	PRIMARY KEY(project_id, developer_emp_id),
	FOREIGN KEY (project_id) REFERENCES project(project_id),
	FOREIGN KEY (developer_emp_id) REFERENCES developer(emp_id)
);

CREATE TABLE task_developer(
	emp_id 		SMALLINT UNSIGNED NOT NULL,
	task_id 	SMALLINT UNSIGNED NOT NULL,
	PRIMARY KEY(emp_id, task_id),
	FOREIGN KEY(emp_id) REFERENCES developer(emp_id),
	FOREIGN KEY(task_id) REFERENCES task(task_id)
);

create table project_progress(
	project_id 	smallint unsigned not null,
	time    	timestamp not null,
	total_tasks smallint unsigned not null,
	open_tasks	smallint unsigned not null,
	primary key(project_id, time, total_tasks, open_tasks),
	foreign key (project_id) references project(project_id)
);

create table iteration_progress(
	project_id 	smallint unsigned not null,
	iteration_id 	smallint unsigned not null,
	time  		timestamp not null,
	total_tasks smallint unsigned not null,
	open_tasks  smallint unsigned not null,
	primary key (iteration_id, time, total_tasks, open_tasks),
	foreign key (iteration_id) references iteration(iteration_id)
);


create table comment_read(
	emp_id 	    SMALLINT UNSIGNED NOT NULL,
	comment_id  SMALLINT UNSIGNED NOT NULL,
	read_status BOOLEAN  NOT NULL DEFAULT 0,
	PRIMARY KEY (emp_id, comment_id),
	foreign key (comment_id) references comment(comment_id),
	foreign key (emp_id) references employee(emp_id)
);

























/*VIEWS*/

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
select unread.emp_id as emp_id, c.comment_id as comment_id, a.emp_id as author_id, concat(a.first_name,' ', a.last_name) as author, t.task_id,
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



/*
  ACTIVE PROJECTS
  OUTPUTS COLUMNS:
  project_id, project_manager, project_name, date_start, date_due, date_complete
*/
CREATE VIEW active_projects AS
SELECT *
FROM project
WHERE date_complete IS NULL;



/*
 ACTIVE ITERATIONS
  OUTPUTS COLUMNS:
  project_id, iteration_id, iteration_name, date_start, date_end
*/
CREATE VIEW active_iterations AS
SELECT *
FROM iteration
WHERE (SELECT NOW()) BETWEEN date_start AND date_end;





/*
 EMPLOYEE_ACTIVE_ITERATIONS
*/
CREATE VIEW employee_active_iterations AS
SELECT p.project_id as project_id, iteration_id, iteration_name, i.date_start as date_start, i.date_end as date_end, project_manager, project_name, d.developer_emp_id as developer_emp_id
FROM active_iterations i
JOIN active_projects p ON i.project_id=p.project_id
JOIN project_developer d ON d.project_id=p.project_id;



























/*PROCEDURES*/

/*
 UPDATE_COMMENT_READ
 This procedure is used to toggle the read status of a comment
 so that it will no longer be displayed in the feed
*/
DELIMITER ??
CREATE PROCEDURE update_comment_read(IN in_emp_id SMALLINT(5), IN in_comment_id SMALLINT(5))
BEGIN
  UPDATE comment_read
  SET read_status=1
  WHERE emp_id=in_emp_id AND comment_id = in_comment_id;
END; ??
DELIMITER ;
















/*
TRIGGERS
*/
/*TRIGGERS****************************************************
**************************************************************/




/*AFTER INSERTING A TASK
  INSERT INTO project_progress AN ENTRY
  FOR THE CORRESPONDING PROJECT*/
delimiter $$
CREATE TRIGGER after_insert_task_trigger
AFTER INSERT ON task
FOR EACH ROW
BEGIN
INSERT INTO project_progress VALUES(
    new.project_id,
    NOW(),
    (SELECT COUNT(*) FROM task t WHERE new.project_id = t.project_id),
    (SELECT COUNT(*) FROM task t WHERE new.project_id = t.project_id AND t.status_id = 'OP'));
END;
$$
delimiter ;





/*AFTER INSERTING A TASK WITH AN iteration_id
  INSERT INTO iteration_progress AN ENTRY
  FOR THE CORRESPONDING ITERATION*/
delimiter $$
CREATE TRIGGER after_insert_task_iteration_prg_trg
AFTER INSERT ON task
FOR EACH ROW
BEGIN
  IF NEW.iteration_id IS NOT NULL THEN
    INSERT INTO iteration_progress VALUES(
      new.project_id,
      new.iteration_id,
      NOW(),
      (SELECT COUNT(*) FROM task t WHERE new.iteration_id = t.iteration_id),
      (SELECT COUNT(*) FROM task t WHERE new.iteration_id = t.iteration_id AND t.status_id = 'OP'));
  END IF;
END;
$$
delimiter ;





/*AFTER UPDATING A TASK'S iteration_id
  INSERT INTO iteration_progress AN ENTRY
  FOR THE CORRESPONDING ITERATION*/
delimiter $$
CREATE TRIGGER after_update_task_iteration_prg_trg
AFTER UPDATE ON task
FOR EACH ROW
BEGIN
  IF (NEW.iteration_id IS NOT NULL AND OLD.iteration_id IS NULL) OR (NEW.iteration_id <> OLD.iteration_id) THEN
    INSERT INTO iteration_progress VALUES(
      new.project_id,
      new.iteration_id,
      NOW(),
      (SELECT COUNT(*) FROM task t WHERE new.iteration_id = t.iteration_id),
      (SELECT COUNT(*) FROM task t WHERE new.iteration_id = t.iteration_id AND t.status_id = 'OP'));
  END IF;
END;
$$
delimiter ;





/*AFTER INSERTING A COMMENT
  INSERT INTO comment_read AN ENTRY
  FOR THE PROJECT MANAGER (IF THE COMMENT IS ROOT)
  FOR THE EMPLOYEE THAT CREATED THE PARENT COMMENT (IF THE COMMENT IS A CHILD COMMENT)*/
delimiter $$
CREATE TRIGGER after_insert_comment_trg
AFTER INSERT ON comment
FOR EACH ROW
BEGIN
	IF NEW.parent_comment_id IS NOT NULL THEN
		INSERT INTO comment_read VALUES(
    		(SELECT p.emp_id FROM comment p
             JOIN comment c
             ON c.parent_comment_id = p.comment_id),
   			NEW.comment_id,
    		0);
	END IF;

    IF NEW.parent_comment_id IS NULL THEN
      INSERT INTO comment_read VALUES(
          (SELECT project_manager FROM project p
           JOIN task t
           ON p.project_id = t.project_id
           WHERE t.task_id = NEW.task_id),
          NEW.comment_id,
          0);
    END IF;
END;
$$
delimiter ;
























/*INSERT DATA*/

insert into employee
values (null, 'Janice', 'Grant'),
(null, 'Matt', 'Fullman'),
(null, 'Alicia', 'McRow'),
(null, 'Alan', 'Jenkins'),
(null, 'Maurice', 'Salvador'),
(null, 'Megan', 'Clearwater'),
(null, 'Christine', 'Chapman'),
(null, 'Steven','Berkshire');

insert into login_credential
values ('j.grant@company.com', '$2y$10$7Nj5qlcktW9wsmMn0Pc12OE4rIQ2m5rULMBx684eVHjBiGMlEL1PG', 1),
('m.fullman@company.com', '$2y$10$aIZRIFP6kTys/Vu52H8gGOY1V.8e7A5XHFIsm7TSfniffg6zM.TQW', 2),
('a.mcrow@company.com', '$2y$10$NzzvgE3jqjoXWovGI6q1P.7LhuzahA8WAIxgQC7tvVyT0EnUNijDq', 3),
('a.jenkins@company.com', '$2y$10$p6/N6e5MQLJ.A5Ay.jgFiujZzKBebqqFLLxyYXE2T8rzLN5eTygzO', 4),
('m.salvador@company.com', '$2y$10$Y3uyTa8SbBoeFjkek3C9k.z.jPYjQDVOnbtCyAKrEAw79JUkbqVIq', 5),
('m.clearwater@company.com', '$2y$10$DLDeH31frl4zfW8XC/14JO1y8bRfxesi/bj2MFrdHz4rqo9fECr0y', 6),
('c.chapman@company.com', '$2y$10$hFuIYLP8OT126DxTZYEvu.gvgI1G.urMjm6RtkW1mZiaktdxChZGK', 7),
('s.berkshire@company.com', '$2y$10$diNQgNhNA9E4OC1z4IGnze2ObAnPVbHoXtNjAgOUyVwSqOnX2cv1S', 8);

insert into project_manager
values (1), (2), (3);

insert into developer
values (4), (5), (6), (7), (8);

insert into project
values (null, 1, 'Kitchen Emporium Site', '2017-12-01', '2018-03-01', null),
(NULL, '1', 'Android App MADS', '2017-10-18', '2017-12-22', NULL);

insert into status
values ('OP', 'Open'),
('AS', 'Assigned'),
('IP', 'In Progress'),
('NR', 'Needs Review'),
('CL', 'Closed');

insert into size
values ('XS', 'Extra Small', 1),
('SM', 'Small', 3),
('MD', 'Medium', 5),
('LG', 'Large', 7),
('XL', 'Extra Large', 9);

insert into project_developer
values (1, 4),
(1,6),
(1,8);

insert into iteration
values (1, 1, 'Iteration 1 - Setup', '2017-12-04', '2017-12-15');

insert into task
values (null, 'Create database', NOW(), null, 1, 1, 'OP', 'XL', null),
(null, 'Main Navigation', NOW(), null, 1, 1, 'OP', 'LG', null),
(null, 'Home Page Template', NOW(), null, 1, null, 'OP', 'SM', null),
(null, 'Site-Wide Style Guide', NOW(), null, 1, 1, 'OP', 'LG', null);

insert into task_developer
values (4, 4),
(6, 2),
(5, 1);

insert into comment
values (null, null, 1, 1, now(), 'Will the current server have enough space or should i be moved to the new one?'),
(null, 1, 5, 1, now(), "Let's move to the new one to be safe"),
(null, null, 6, 2, now(), 'Are we doing hover or click menu?');

insert into phone_number
values (1, '8041234567'),
(2, '8041234568'),
(3, '8041234576'),
(4, '8041234566');

insert into skill
values (null, 'HTML/HTML5'),
(null, 'CSS'),
(null, 'JavaScript'),
(null, 'Photoshop'),
(null, 'SQL/MySQL,OracleSQL'),
(null, 'PHP');

insert into developer_skill
values (4,1), (4,2), (4,4), (5,1), (5,5), (5,6), (6,1), (6,2), (6,3);

insert into comment_read
values (1, 2, 0),
(5, 1, 0),
(1, 3, 0);
