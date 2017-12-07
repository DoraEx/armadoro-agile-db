<!doctype html>
<html lang="en">
  	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        
        <!-- Custom CSS -->
        <link rel="stylesheet" type="text/css" href="/css/main.css">
  	</head>
	<body>
        <nav class="navbar navbar-dark bg-primary">
            <div class="container justify-content-between">
                <div class="dropdown show">
                    <a class="btn btn-light dropdown-toggle" href="#" role="button" id="mainDropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Menu
                    </a>
                    <div class="dropdown-menu" aria-labelledby="mainDropdownMenu">
                        <a class="dropdown-item" href="/">Dashboard</a>
                        <a class="dropdown-item" href="/view/project_selection">Projects</a>
                        <a class="dropdown-item" href="/view/task">Tasks</a>
                        <a class="dropdown-item" href="/view/comment">Comments</a>
                        <a class="dropdown-item" href="#">Statistics</a>
                        <?php addManagementConsoleOption(); ?>
                    </div>
                </div>
                <a class="navbar-brand" href="/">Agile</a>                
                <a class="navbar-brand" href="/view/profile"><?php display_name() ?></a>  
                <a class="navbar-brand" href="#"><?php display_role() ?></a>  
                <a class="btn btn-light" href="/service/logout.php">Logout</a>
            </div>
        </nav>

<?php
function display_name() {
    if (isset($_SESSION['e_name'])) { 
        echo ($_SESSION['e_name']);
    }
}

function display_role() {
    if (isset($_SESSION['e_role'])) {
        echo ('Role: ' . $_SESSION['e_role']);
    }
}

function addManagementConsoleOption() {
    if (isset($_SESSION['e_role']) && $_SESSION['e_role'] == 'PM') {
        echo ("<a class=\"dropdown-item\" href=\"/view/management_console\">Management Console</a>");
    }
}
?>

        