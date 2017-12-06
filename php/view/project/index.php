<?php 
    require(realpath($_SERVER["DOCUMENT_ROOT"]).'/service/session.php');
    require(realpath($_SERVER["DOCUMENT_ROOT"])."/template/header.php");
    require(realpath($_SERVER["DOCUMENT_ROOT"])."/view/project/project.php")
?>
    <!--body content here-->


<?php
    require(realpath($_SERVER["DOCUMENT_ROOT"])."/template/footer.php");
?>