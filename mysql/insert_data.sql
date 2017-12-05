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
values ('j.grant@company.com', '$2y$10$vPntXPmcutrOAlAvG0k0IuTydGV18Z.crlosQAcHUMOZXEIBSu9a', 1),
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
values (4, 4),
(6, 2),
(5, 1);

insert into comment
values (null, null, 1, 1, now(), 'Will the current server have enough space or should i be moved to the new one?'),
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
