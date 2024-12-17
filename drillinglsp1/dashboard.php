<?php 
session_start();
if(!isset($_SESSION['admin'])) {
    header('location: http://localhost/drillinglsp1//login.php');
    exit();
}
include 'include/koneksi.php';
include 'include/function.php';
include 'part/header.php';
?>

