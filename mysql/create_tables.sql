create table employee (
	emp_id smallint unsigned not null auto_increment,
	first_name varchar(20) not null,
	last_name varchar(20) not null,
	primary key (emp_id)
);

create table login_credential (
	user_email varchar(50) not null,
	user_password varchar(30) not null,
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
	project_id smallint unsigned not null,
	iteration_id smallint unsigned not null,
	iteration_name varchar(30) not null,	
	date_start date not null,
	date_end date not null,
	primary key (project_id, iteration_id),
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
	FOREIGN KEY(project_id, iteration_id) REFERENCES iteration(project_id, iteration_id),
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
	time    	date not null,
	total_tasks smallint unsigned not null,
	open_tasks	smallint unsigned not null,
	primary key(project_id, time),
	foreign key (project_id) references project(project_id)
);

create table iteration_progress(
	project_id 	smallint unsigned not null,
	iteration_id 	smallint unsigned not null,
	time  		date not null,
	total_tasks smallint unsigned not null,
	open_tasks  smallint unsigned not null,
	primary key (project_id, iteration_id, time),
	foreign key (project_id, iteration_id) references iteration(project_id, iteration_id)
);

create table comment_read(
	emp_id 	    SMALLINT UNSIGNED NOT NULL,
	comment_id  SMALLINT UNSIGNED NOT NULL,
	read_status BOOLEAN  NOT NULL DEFAULT 0,	
	PRIMARY KEY (emp_id, comment_id),
	foreign key (comment_id) references comment(comment_id),
	foreign key (emp_id) references employee(emp_id)
);
