<?php 
session_start();
if(!isset($_SESSION['admin'])) {
    header('location: http://localhost/lspdhani//login.php');
    exit();
}
include 'include/koneksi.php';
include 'part/header.php';
?>