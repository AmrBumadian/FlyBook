<?php
session_start();
error_reporting(1);
?>
<nav>
    <ul>
        <?php
        if ($_SESSION['admin_logged_in'] != "") {
        ?>
            <li><a href="index.php">Home</a></li>
            <li><a href="addAircraft.php">Add an aircraft</a></li>
            <li><a href="aircrafts.php">All aircrafts</a></li>
            <li><a href="addFlight.php">Add a flight</a></li>
            <li><a href="flights.php">All flights</a></li>
            <li><a href="messages.php">Messages</a></li>
            <li><a href="../logout.php">Logout</a></li>
        <?php } else {
        ?>
            <li><a href="../index.php">Home</a></li>
            <li><a href="../login.php">Login</a></li>
            <li><a href="login.php">Login as admin</a></li>
        <?php } ?>
    </ul>
</nav>