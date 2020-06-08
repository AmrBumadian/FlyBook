<?php
session_start();
error_reporting(1);
if ($_SESSION['account_logged_in'] != "") {
    header('location: index.php');
}
include('connection.php');
extract($_REQUEST);
if (isset($login)) {
    $sql = mysqli_query($con, "SELECT * FROM accounts WHERE email = '$emailID' AND password = '$pass'");
    if (mysqli_num_rows($sql)) {
        $_SESSION['account_logged_in'] = $emailID;
        header("location: index.php");
    } else {
        $msg = "Invalid email or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include('head.php'); ?>

<body class="login">

    <?php include('navbar.php') ?>

    <div class="sign">
        <h2 class="success"><?= $msg ?></h2>
        <h2>Login to your account</h2>
        <form method="POST">
            <div class="info">
                <input type="email" placeholder="Email" name="emailID" required>
                <input type="password" name="pass" placeholder="Password" required>
            </div>
            <input class="card-button" type="submit" name="login" value="Login" required>
            <a href="signup.php">Register a new Account</a>
        </form>
    </div>
    <?php include('footer.php'); ?>
    <script>
        document.getElementById('navBar').classList.add('white');
        document.getElementById('loginNav').firstChild.classList.add('active');
    </script>

</body>
</body>

</html>