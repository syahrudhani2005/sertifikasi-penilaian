<?php 
session_start();
session_destroy();
header('location: http://localhost/lspdhani/login.php')
?>