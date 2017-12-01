
create trigger t1
  AFTER INSERT on task for each row
  begin
    insert into skill values (null, "Crying")
  end;


delimiter ; 

insert into project_progress 
    values(new.project_id,  
            count(select * from task where project_id = :new.project_id), 
            count(select * from task where status_id = 'OP'), 
            NOW());


