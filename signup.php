<?php
include('connection.php');
extract($_REQUEST);
if (isset($signup)) {
    $sql = mysqli_query($con, "SELECT * FROM accounts WHERE email = '$email'");
    if (mysqli_num_rows($sql)) {
        $msg = "<h1> There's already an account with this Email </h1>";
    } else {
        $query = "INSERT INTO accounts (fname, lname, email, password, mobile) VALUES ('$fname', '$lname', '$email', '$password', '$mobile')";
        if (mysqli_query($con, $query)) {
            $msg = "<h1> Account Registered Successfully! </h1>";
            header("location: login.php");
        } else {
            $msg = "<h1> Couldn't register</h1>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('head.php') ?>

<body>
    <?php include('navbar.php') ?>
    <?php echo $msg ?>
    <form method="POST">
        <input type="text" name="fname" placeholder="First Name" required>
        <input type="text" name="lname" placeholder="Last Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="text" name="mobile" placeholder="Mobile Number" required>
        <input type="submit" name="signup" value="Sign up" required>
    </form>

    <?php include('footer.php') ?>
</body>

</html>