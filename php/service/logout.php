<?php 
session_start();

$_SESSION = array();
if(isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 360000);
}
session_destroy();

header('location: ../login/');
?>