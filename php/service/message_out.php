<?php
    function displayMessages() {
        if(!empty($_SESSION['messages'])){
            foreach($_SESSION['messages'] as $message){
                echo "<div class='alert alert-primary'><p>" . array_pop($_SESSION['messages']) . "</p></div>";
            }
        }
    }
?>

<div class="container" id="messages">
    <?php displayMessages();?>
</div>