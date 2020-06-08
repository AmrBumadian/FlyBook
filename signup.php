<?php
include('connection.php');
extract($_REQUEST);
if (isset($signup)) {
    $sql = mysqli_query($con, "SELECT * FROM accounts WHERE email = '$email'");
    if (mysqli_num_rows($sql)) {
        $msg = "There's already an account with this Email";
    } else {
        $query = "INSERT INTO accounts (fname, lname, email, password, mobile) VALUES ('$fname', '$lname', '$email', '$password', '$mobile')";
        if (mysqli_query($con, $query)) {
            $msg = "Account Registered Successfully!";
            header("location: login.php");
        } else {
            $msg = "Couldn't register";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('head.php') ?>

<body class="login">
    <?php include('navbar.php') ?>
    <h2 class="success"><?= $msg ?></h2>
    <div class="sign">
        <form method="POST">
            <div class="info">
                <input type="text" name="fname" placeholder="First Name" required>
                <input type="text" name="lname" placeholder="Last Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input id="psw" type="password" name="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                <div id="message">
                    <h3>Password must contain the following:</h3>
                    <p class="invalid" id="letter">A <b>Lowercase</b> letter</p>
                    <p class="invalid" id="capital">An <b>Uppercase</b> letter</p>
                    <p class="invalid" id="number">A <b>Number</b></p>
                    <p class="invalid" id="length">Minimum <b>8 characters</b></p>
                </div>
                <input type="text" name="mobile" placeholder="Mobile Number" required>
            </div>
            <input class="card-button" type="submit" name="signup" value="Sign up" required disabled>
        </form>
    </div>

    <?php include('footer.php') ?>

    <script src="src/rsrc/scripts/script.js"></script>
</body>

</html>