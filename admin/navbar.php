<?php
session_start();
error_reporting(1);
?>
<nav class="navigation" id="navBarAdmin">
    <label class="checkbtn">
        <input type="checkbox" id="check">
        <i class="fas fa-bars"></i>
    </label>
    <label class="logo">FlyBook</label>
    <ul>
        <?php
        if ($_SESSION['admin_logged_in'] != "") {
            echo "<script> document.getElementById('navBarAdmin').classList.add('small'); </script>";
        ?>
            <li id="homeNav"><a href="index.php">Home</a></li>
            <li id="addAircraftNav"><a href="addAircraft.php">Add an aircraft</a></li>
            <li id="aircraftsNav"><a href="aircrafts.php">All aircrafts</a></li>
            <li id="addFlightNav"><a href="addFlight.php">Add a flight</a></li>
            <li id="flightsNav"><a href="flights.php">All flights</a></li>
            <li id="messagesNav"><a href="messages.php">Messages</a></li>
            <li id=""><a href="../logout.php">Logout</a></li>
        <?php } else {
        ?>
            <li id="homeNav"><a href="../index.php">Home</a></li>
            <li id="loginNav"><a href="../login.php">Login</a></li>
            <li id="adminLoginNav"><a href="login.php">Login as admin</a></li>
        <?php } ?>
    </ul>
</nav>