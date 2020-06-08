<?php 
session_start();
error_reporting(1); 
?>
<nav class="navigation" id="navBar">

    <label class="checkbtn">
        <input type="checkbox" id="check">
        <i class="fas fa-bars"></i>
    </label>
    <label class="logo">FlyBook</label>
    <ul>
        <li id="homeNav"><a href="index.php">Home</a></li>
        <li id="aboutNav"><a href="#about">About</a></li>
        <li id="contactUsNav"><a href="contactUs.php">Contact us</a></li>
        <?php
        if ($_SESSION['account_logged_in'] != "") {
            echo "<script> document.getElementById('navBar').classList.add('small'); </script>";
        ?>
            <li id="profileNav"><a href="profile.php">My Profile</a></li>
            <li id="myFlightsNav"><a href="myFlights.php">My flights</a></li>
            <li id="flightsNav"><a href="flights.php">Available flights</a></li>
            <li id=""><a href="logout.php">Logout</a></li>
            
        <?php } else {
        ?>
            <li id="loginNav"><a href="login.php">Login</a></li>
            <li id="adminLoginNav"><a href="adminLogin.php">Login as admin</a></li>
        <?php } ?>
    </ul>
</nav>