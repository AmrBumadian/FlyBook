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
        $error = "<h4 class='error'> Invalid email or password!</h4>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include('head.php'); ?>

<body class="login">

    <?php include('navbar.php') ?>

    <div class="sign">
        <h2>Login to your account</h2>
        <?php echo $error ?>
        <form method="POST">
            <div class="info">
                <input type="email" placeholder="Email" name="emailID" required>
                <input type="password" name="pass" placeholder="Password" required>
            </div>
            <input type="submit" name="login" value="Login" required>
            <a href="signup.php">Register a new Account</a>
        </form>
    </div>
    <?php include('footer.php'); ?>
    <script>
        document.getElementById('navBar').classList.add('white');
    </script>
</body>
</body>

</html>