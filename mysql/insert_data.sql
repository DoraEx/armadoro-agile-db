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
values ('j.grant@company.com', 'password1', 1),
('m.fullman@company.com', 'password2', 2),
('a.mcrow@company.com', 'password3', 3),
('a.jenkins@company.com', 'password4', 4),
('m.salvador@company.com', 'password5', 5),
('m.clearwater@company.com', 'password6', 6),
('c.chapman@company.com', 'password7', 7),
('s.berkshire@company.com', 'password8', 8);

insert into project_manager
values (1), (2), (3);

insert into developer
values (4), (5), (6), (7), (8);

insert into project 
values (null, 1, 'Kitchen Emporium Site', '2017-12-01', '2018-03-01', null);

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
values (4, 9),
(6, 7),
(5, 6);

insert into comment
values (null, null, 1, 1, now(), 'Will the current server have enough space or should it be moved to the new one?'),
(null, 1, 5, 1, now(), 'Let\'s move to the new one to be safe'),
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
values (1, 1, 1);
