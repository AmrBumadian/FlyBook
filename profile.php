<?php
session_start();
error_reporting(1);
include('connection.php');
if ($_SESSION['account_logged_in'] == "") {
    header("location: index.php");
}
$userEmail = $_SESSION['account_logged_in'];
$sql = mysqli_query($con, "SELECT * FROM accounts WHERE email = '$userEmail'");
extract($_REQUEST);
if (isset($update)) {
    $sql2 = mysqli_query($con, "SELECT * FROM accounts WHERE email = '$email'");
    if (mysqli_num_rows($sql2) && $email != mysqli_fetch_assoc($sql2)['email']) {
        $msg = "This Email is already registered";
    } else {
        $query = "UPDATE accounts
        SET fname = '$fname',
        lname = '$lname',
        email = '$email',
        password = '$password',
        mobile = '$mobile'
        WHERE email = '$userEmail'";
        mysqli_query($con, $query);
        $userEmail = $email;
        $_SESSION['account_logged_in'] = $email;
        $msg = "Profile Updated Successfully";
        $sql = mysqli_query($con, "SELECT * FROM accounts WHERE email = '$email'");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('head.php') ?>

<body class="myprofile">
    <?php include('navbar.php') ?>
    <?php $user = mysqli_fetch_assoc($sql) ?>
    <h2 class="success"><?php echo $msg ?></h2>
    <form method="POST">
        <div class="profile">
            <div class="profile-item">
                <label for="fname">First name: </label>
                <input type="text" name="fname" value="<?= $user['fname'] ?>">
            </div>
            <div class="profile-item">
                <label for="lname">Last name: </label>
                <input type="text" name="lname" value="<?= $user['lname'] ?>">
            </div>
            <div class="profile-item">
                <label for="email">Email: </label>
                <input type="email" name="email" value="<?= $user['email'] ?>">
            </div>
            <div class="profile-item">
                <label for="password">Password: </label>
                <input id="psw" type="password" name="password" value="<?= $user['password'] ?>">
                <div id="message">
                    <h3>Password must contain the following:</h3>
                    <p class="invalid" id="letter">A <b>Lowercase</b> letter</p>
                    <p class="invalid" id="capital">An <b>Uppercase</b> letter</p>
                    <p class="invalid" id="number">A <b>Number</b></p>
                    <p class="invalid" id="length">Minimum <b>8 characters</b></p>
                </div>
            </div>
            <div class="profile-item">
                <label for="mobile">Mobile Number: </label>
                <input type="text" name="mobile" value="<?= $user['mobile'] ?>">
            </div>
        </div>
        <input class="card-button" type="submit" value="Update Pofile" name="update">
    </form>
    <?php include('footer.php') ?>
    <script>
        document.getElementById("navBar").classList.add("white");
        document.getElementById('profileNav').firstChild.classList.add('active');
    </script>
    <script src="src/rsrc/scripts/script.js"></script>
</body>

</html>