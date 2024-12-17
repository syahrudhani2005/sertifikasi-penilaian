<?php 
session_start();
session_destroy();
header('location: http://localhost/drillinglsp1/login.php');
exit();
?>