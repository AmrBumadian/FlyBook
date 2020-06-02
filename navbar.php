<?php 
session_start();
error_reporting(1); 
?>
<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="contactUs.php">Contact us</a></li>
        <?php
        if ($_SESSION['account_logged_in'] != "") {
        ?>
            <li><a href="profile.php">My Profile</a></li>
            <li><a href="myFlights.php">My flights</a></li>
            <li><a href="flights.php">Available flights</a></li>
            <li><a href="logout.php">Logout</a></li>
        <?php } else {
        ?>
            <li><a href="login.php">Login</a></li>
            <li><a href="admin/login.php">Login as admin</a></li>
        <?php } ?>
    </ul>
</nav>