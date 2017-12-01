<?php
    ini_set('display_errors', 1);
    //todo: move all this to a separate file.

    require("../dbconf.php");
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        //todo: hash password

        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $pass = $_POST['password'];

        $sql_id = "select emp_id from login_credential where user_email = '" . $email .  "' and user_password = '" . $pass . "'";
        $result_id = db_query($sql_id);
        $row_id = mysqli_fetch_array($result_id);

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
        header('location: ../');

    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>

<body>
    <?php include('../header.php');?>
    <form action="" method="POST">
        <label>Email</label>
        <br/>
        <input type="email" name="email"/>
        <br/>
        <br/>
        <label>Password</label>
        <br/>
        <input type="password" name="password"/>
        <br/>
        <br/>
        <input type="submit" value="Submit"/>
        <br/>
    </form>
</body>
</html>