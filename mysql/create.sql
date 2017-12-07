create database agile_db;
use agile_db;

create user if not exists agile_db_admin identified by 'defaultpass';
grant all on agile_db.* to 'agile_db_admin'@'%' identified by 'defaultpass';

select 'START CREATING TABLES' AS '';
source ~/armadoro-agile-db/mysql/create_tables.sql;

select 'START CREATING VIEWS' AS '';
source ~/armadoro-agile-db/mysql/create_views.sql;

select 'START CREATING TRIGGERS' AS '';
source ~/armadoro-agile-db/mysql/create_triggers.sql;

select 'INSERTING DATA' AS '';
source ~/armadoro-agile-db/mysql/insert_data.sql;
