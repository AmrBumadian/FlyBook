<?php
session_start();
error_reporting(1);
include('connection.php');
?>
<!DOCTYPE html>
<html lang="en">

<?php include('head.php'); ?>

<body>
    <?php include('navbar.php') ?>
    <main>
        <h2>Book your flight with us</h2>
        <p>Booking you flight from and to anywhere in the world has become much easier</p>
        <div id="album">
            <img src="" alt="">
            <img src="" alt="">
            <img src="" alt="">
        </div>
    </main>
    <?php include('footer.php') ?>
</body>

</html>