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



