<?php
    ini_set('display_errors', 1);
    require(realpath($_SERVER["DOCUMENT_ROOT"])."/service/queries.php");
    require(realpath($_SERVER["DOCUMENT_ROOT"])."/service/wrappers.php");    
    
    if(!isset($_GET['profile_id'])){
      header('location: /');
    } else {   
        function getEmployeeInfo() {
            $sql = "SELECT * FROM employee_detail WHERE emp_id = "
                . $_GET['profile_id'];
            $result = db_query($sql);
            $row = mysqli_fetch_array($result);

            if($_SESSION['e_role'] == "PM") {
              $role = "Project Manager";
            } else {
              $role = "Developer";
            }
            if(!$row['phone']) {
              $phone = "";
            } else {$phone = "<li>".$row['phone'] ."</li>";}

            echo "<h2>".$row['employee']."</h2>";
            echo "<ul>
                  <li>Role: $role</li>
                  <li>Email: ".$row['email'] ."</li>$phone</ul>";

            if($_SESSION['e_role'] == "PM") {
              $role = "Project Manager";
            } else {
              $role = "Developer";
            }

            echo "<h3>Current projects</h3>";
            $projects = get_dev_projects($_GET['profile_id']);
                
            while ($project = mysqli_fetch_array($projects)) {
                echo get_project_link($project['project_id'], $project['project_name']);
            }
          
            echo "<h3>Skills</h3>";
            $skills = get_developer_skills($_GET['profile_id']);
          
            echo "<ul>";
            while($skill = mysqli_fetch_array($skills)) {
                echo "<li>".$skill['skill_name']."</li>";
            }
            echo "</ul>";    
        }  
    }
?>