<?php
session_start();
error_reporting(1);
if ($_SESSION['admin_logged_in'] != "") {
    header('location: index.php');
}
include('../connection.php');
extract($_REQUEST);
if (isset($login)) {
    $sql = mysqli_query($con, "SELECT * FROM admins WHERE username = '$username' AND password = '$pass'");
    if (mysqli_num_rows($sql)) {
        $_SESSION['admin_logged_in'] = $username;
        header("location: index.php");
    } else {
        $error = "<h4 class='error'> Invalid admin username or password "
        . $username . " " . $pass . "</h4>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include('../head.php'); ?>

<body>

    <?php include('../navbar.php') ?>

    <h1>Login as an admin</h1>
    <?php echo $error ?>

    <form method="POST">
        <input type="text" placeholder="Admin username" name="username" required>
        <input type="password" name="pass" placeholder="Admin password" required>
        <input type="submit" name="login" value="Login" required>

    </form>

    <?php include('../footer.php'); ?>
</body>

</html>