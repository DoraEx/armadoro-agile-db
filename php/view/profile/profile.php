<?php
    ini_set('display_errors', 1);
    
    if(!isset($_SESSION['e_id'])){
        header('location: ../');
    }
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        echo $_POST['profile_id'];
    }
?>