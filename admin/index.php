<?php
session_start();
error_reporting(1);
include('../connection.php');
?>
<!DOCTYPE html>
<html lang="en">

<?php include('../head.php'); ?>

<body>
    <?php include('navbar.php') ?>
    <main>
        <h2>Welcome to the Admin panel</h2>
    </main>
    <?php include('../footer.php') ?>
</body>

</html>