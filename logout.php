<?php
session_start();
error_reporting(1);
$_SESSION['account_logged_in'] = "";
$_SESSION['admin_logged_in'] = "";
header('location: index.php');
?>