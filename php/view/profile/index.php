<?php 
require(realpath($_SERVER["DOCUMENT_ROOT"]).'/service/session.php');
require(realpath($_SERVER["DOCUMENT_ROOT"])."/template/header.php");
require(realpath($_SERVER["DOCUMENT_ROOT"])."/view/profile/profile.php");
?>
<!--body content here-->
<div class="container">
<?php getEmployeeInfo(); ?>
</div>

<?php
require(realpath($_SERVER["DOCUMENT_ROOT"])."/template/footer.php");
?>