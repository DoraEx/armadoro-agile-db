delimiter $$ 
CREATE TRIGGER after_insert_task_trigger
AFTER INSERT ON task 
FOR EACH ROW 
BEGIN 
INSERT INTO project_progress VALUES(
    new.project_id, 
    NOW(), 
    (SELECT COUNT(*) FROM task WHERE new.project_id = project_id),
    (SELECT COUNT(*) FROM task WHERE new.project_id = project_id AND task.status_id = 'OP'),
    20); 
END;
$$
delimiter ;


