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



