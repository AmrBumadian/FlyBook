<?php
session_start();
error_reporting(1);
include('connection.php');
$flightID = $_SESSION['flightIDCancel'];
extract($_REQUEST);

if (isset($conCode)) {
    $email = $_SESSION['account_logged_in'];
    $sql = mysqli_query($con, "SELECT * FROM accounts WHERE email = '$email'");
    $userID = mysqli_fetch_assoc($sql)['id'];
    mysqli_query($con, "DELETE FROM tickets WHERE flightID = $flightID AND passengerID = $userID");
    mysqli_query($con, "UPDATE flights SET num = num + 1 WHERE id = $flightID");
    $msg = "<h2> Flight is successfully Cancelled</h2>";
    $_SESSION['flightIDCancel'] = "";
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include('head.php') ?>

<body>
    <?php include('navbar.php') ?>

    <h2>Please enter the cancellation confirmation code sent to your Email: </h2>
    <form method="POST">
        <input type="text" name="confirmationCode" placeholder="Confirmation Code" required>
        <input type="submit" value="Submit" name="conCode">
    </form>

    <?= $msg ?>

    <?php include('footer.php') ?>
</body>

</html>