/*
 UPDATE_COMMENT_READ
 This procedure is used to toggle the read status of a comment
 so that it will no longer be displayed in the feed
*/
DELIMITER ??
CREATE PROCEDURE update_comment_read(IN in_emp_id SMALLINT(5), IN in_comment_id SMALLINT(5))
BEGIN
  UPDATE comment_read 
  SET read_status=1 
  WHERE emp_id=in_emp_id AND comment_id = in_comment_id;
END; ??
DELIMITER ;
