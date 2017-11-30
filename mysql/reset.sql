drop database if exists agile_db;

create database agile_db;
use agile_db;

create user if not exists agile_db_admin;
grant all on agile_db.* to 'agile_db_admin'@'%' identified by 'defaultpass';

select 'START CREATING TABLES' AS '';
source ~/agile_db/mysql/create_tables.sql;

select 'START CREATING VIEWS' AS '';
source ~/agile_db/mysql/create_views.sql;

select 'INSERTING DATA' AS '';
source ~/agile_db/mysql/insert_data.sql;
