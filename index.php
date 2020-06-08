<?php
session_start();
error_reporting(1);
include('connection.php');
if ($_SESSION['account_logged_in'] != "") {
    $email = $_SESSION['account_logged_in'];
    $sql = mysqli_query($con, "SELECT * FROM accounts WHERE email = '$email'");
    $fname = mysqli_fetch_assoc($sql)['fname'];
} else {
    $fname = "";
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include('head.php'); ?>

<body class="home">
    <?php include('navbar.php') ?>
    <section>
        <?php if ($fname != "") {
        ?>
            <h2 class="hello">Hello <?= $fname ?></h2>
        <?php } ?>
        <h2>Book your flight with FlyBook</h2>
        <p>Booking your flight from and to anywhere in the world has become much easier</p>
    </section>
    <?php include('footer.php') ?>
    <script>
        document.getElementById('homeNav').firstChild.classList.add('active');
    </script>

</body>

</html>