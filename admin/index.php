<?php
session_start();
error_reporting(1);
include('../connection.php');
if ($_SESSION['admin_logged_in'] == "") {
    header("location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include('head.php'); ?>

<body class="home">
    <?php include('navbar.php') ?>
    <section>
        <h2>Welcome to the admin panel</h2>
    </section>
    <?php include('../footer.php') ?>
    <script>document.getElementById('homeNav').firstChild.classList.add('active');</script>

</body>

</html>