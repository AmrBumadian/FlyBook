<?php
session_start();
error_reporting(1);
include('connection.php');
if ($_SESSION['account_logged_in'] == "") {
    header("location: index.php");
}
$email = $_SESSION['account_logged_in'];
$sql = mysqli_query($con, "SELECT * FROM accounts WHERE email = '$email'");
extract($_REQUEST);
if (isset($update)) {
    $query = "UPDATE accounts
    SET fname = '$fname',
    lname = '$lname',
    email = '$email',
    password = '$password',
    mobile = '$mobile'";
    mysqli_query($con, $query);
    $msg = "<h3> Profile Updated Successfully </h3>";
    $sql = mysqli_query($con, "SELECT * FROM accounts WHERE email = '$email'");
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('head.php') ?>

<body>
    <?php include('navbar.php') ?>
    <?php $user = mysqli_fetch_assoc($sql) ?>
    <form method="POST">
        <label for="fname">First name: </label>
        <input type="text" name="fname" value="<?= $user['fname'] ?>">
        <label for="lname">Last name: </label>
        <input type="text" name="lname" value="<?= $user['lname'] ?>">
        <label for="email">Email: </label>
        <input type="email" name="email" value="<?= $user['email'] ?>">
        <label for="password">Password: </label>
        <input type="password" name="password" value="<?= $user['password'] ?>">
        <label for="mobile">Mobile Number: </label>
        <input type="text" name="mobile" value="<?= $user['mobile'] ?>">
        <input type="submit" value="Update Pofile" name="update">
    </form>
    <?php echo $msg ?>

    <?php include('footer.php') ?>
</body>

</html>