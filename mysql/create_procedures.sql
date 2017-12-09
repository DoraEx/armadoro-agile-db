/*
 UPDATE_COMMENT_READ
 This procedure is used to toggle the read status of a comment
 so that it will no longer be displayed in the feed
*/
DELIMITER ??
CREATE PROCEDURE update_comment_read(IN in_emp_id SMALLINT(5), IN in_comment_id SMALLINT(5))
BEGIN
  DELETE FROM unread_comment
  WHERE emp_id=in_emp_id AND comment_id = in_comment_id;
END; ??
DELIMITER ;




/*
 INSERT_PROJECT_PROC
*/
DELIMITER ??
CREATE PROCEDURE insert_project_proc(IN in_emp_id SMALLINT(5), IN in_project_name VARCHAR(30), IN in_date_due DATE)
BEGIN
  INSERT INTO project VALUES
  (
    null,
    in_emp_id,
    in_project_name,
    NOW(),
    in_date_due,
    null
  );
END; ??
DELIMITER ;





/*
GET_USER_PROJECTS
Returns project_name and project_id
*/
DELIMITER ??
CREATE PROCEDURE get_user_projects(IN in_emp_id SMALLINT(5))
BEGIN

    SELECT DISTINCT p.project_name AS project_name, p.project_id AS project_id
    FROM active_projects p
    JOIN project_manager m ON p.project_manager = m.emp_id
    WHERE in_emp_id = m.emp_id
UNION
    SELECT DISTINCT p2.project_name AS project_name, p2.project_id AS project_id
	FROM active_projects p2
    JOIN project_developer d ON d.project_id = p2.project_id
    WHERE in_emp_id = d.developer_emp_id;

END; ??
DELIMITER ;
