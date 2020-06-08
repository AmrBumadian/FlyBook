<?php
session_start();
error_reporting(1);
include('connection.php');
if ($_SESSION['account_logged_in'] == "") {
    header("location: index.php");
}
$flightID = $_SESSION['flightIDBook'];
extract($_REQUEST);

if (isset($conCode)) {
    $email = $_SESSION['account_logged_in'];
    $sql = mysqli_query($con, "SELECT * FROM accounts WHERE email = '$email'");
    $userID = mysqli_fetch_assoc($sql)['id'];
    mysqli_query($con, "INSERT INTO tickets (flightID, passengerID) VALUES ($flightID, $userID)");
    mysqli_query($con, "UPDATE flights SET num = num - 1 WHERE id = $flightID");
    $msg = "<h2> Flight is successfully Booked</h2>";
    $_SESSION['flightIDBook'] = "";
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include('head.php') ?>

<body>
    <?php include('navbar.php') ?>

    <div class="sure">
        <h2>Please enter the booking confirmation code sent to your Email: </h2>
        <form method="POST">
            <input type="text" name="confirmationCode" placeholder="Confirmation Code" required>
            <input class="card-button" type="submit" value="Submit" name="conCode">
        </form>
        <h2><?= $msg ?></h2>   
    </div>
    

    <?php include('footer.php') ?>
    <script>
        document.getElementById("navBar").classList.add("white");
    </script>
</body>

</html>