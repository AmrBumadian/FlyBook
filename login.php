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
        $error = "<h4 class='error'> Invalid email or password</h4>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include('head.php'); ?>

<body>

    <?php include('navbar.php') ?>

    <h1>Login to your account</h1>
    <?php echo $error ?>

    <form method="POST">
        <input type="email" placeholder="Email" name="emailID" required>
        <input type="password" name="pass" placeholder="Password" required>
        <input type="submit" name="login" value="Login" required>

        <a href="signup.php">Register a new Account</a>
    </form>

    <?php include('footer.php'); ?>
</body>

</html>