<?php
session_start();
error_reporting(1);
if ($_SESSION['admin_logged_in'] != "") {
    header('location: admin/index.php');
}
include('connection.php');
extract($_REQUEST);
if (isset($login)) {
    $sql = mysqli_query($con, "SELECT * FROM admins WHERE username = '$username' AND password = '$pass'");
    if (mysqli_num_rows($sql)) {
        $_SESSION['admin_logged_in'] = $username;
        header("location: admin/index.php");
    } else {
        $msg = "Invalid admin username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include('head.php'); ?>

<body>

    <?php include('navbar.php') ?>

    <div class="sign">
        <h2 class="success"><?= $msg ?></h2>
        <h2>Login as an admin</h2>
        <form method="POST">
            <div class="info">
                <input type="text" placeholder="Admin username" name="username" required>
                <input type="password" name="pass" placeholder="Admin password" required>
            </div>
            <input class="card-button" type="submit" name="login" value="Login" required>
        </form>
    </div>

    <?php include('footer.php'); ?>
    <script>
        document.getElementById('navBar').classList.add('navigation');
        document.getElementById('adminLoginNav').firstChild.classList.add('active');
    </script>

</body>

</html>