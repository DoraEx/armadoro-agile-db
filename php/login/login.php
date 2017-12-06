<?php
    ini_set('display_errors', 1);
    require("../service/dbconf.php");

    session_start();
    include("../service/message_in.php");

    if(isset($_SESSION['e_id'])){
        header('location: ../');
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        //todo: hash password

        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $pass = $_POST['password'];

        $sql_id = "select emp_id, user_email, user_password from login_credential where user_email = '" . $email . "'";
        $result_id = db_query($sql_id);
        $row_id = mysqli_fetch_array($result_id);
	$db_password = isset($row_id['user_password']) ? $row_id['user_password'] : 'YOU FAILED';
	if(password_verify($pass, $db_password)) {
		//error_log("\n\nshould login\n\n", 3, "/home/ubuntu/php_log.log");
	}
	else {
		error_log("\n" . "USER ENTERED PASSWORD" . $pass . "\n" . "DATABASE_PASSWORD" . $db_password . "\n", 3,"/home/ubuntu/php_log.log");
	}
  
	if(password_verify($pass, $db_password)) {
	    $sql_name = "select first_name from employee where emp_id ='" . $row_id[0] . "'";
            $result_name = db_query($sql_name);
            $row_name = mysqli_fetch_array($result_name);

            $sql_role = "select * from project_manager where emp_id ='" . $row_id[0] . "'";
            $result_role = db_query($sql_role);
            $row_role = mysqli_fetch_array($result_role);

            //todo: better check for results
            $_SESSION['e_id'] = $row_id[0]; 
            $_SESSION['e_name'] = $row_name[0];
            $_SESSION['e_role'] = $row_role[0] ? "PM" : "DEV";

            addMessage("Welcome, " . $e_name);
            header('location: ../');
	} 
	else {
	    addMessage("Invalid email or password. Try again.");
	}
    }
?>
