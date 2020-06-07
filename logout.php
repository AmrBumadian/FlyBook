<?php
session_start();
error_reporting(1);
$_SESSION['account_logged_in'] = "";
$_SESSION['admin_logged_in'] = "";
session_destroy();
header('location: index.php');
?>