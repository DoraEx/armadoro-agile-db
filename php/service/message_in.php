<?php
if(!isset($_SESSION['messages'])) {
    $_SESSION['messages'] = array();
}

function addMessage($message) {
    array_push($_SESSION['messages'], $message);
}

