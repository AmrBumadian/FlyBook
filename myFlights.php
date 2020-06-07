<?php
session_start();
error_reporting(1);
include('connection.php');
if ($_SESSION['account_logged_in'] == "") {
    header("location: index.php");
}
extract($_REQUEST);

$email = $_SESSION['account_logged_in'];
$sql = mysqli_query($con, "SELECT * FROM accounts WHERE email = '$email'");
$userID = mysqli_fetch_assoc($sql)['id'];
$sql = mysqli_query($con, "SELECT F.id AS flightID, T.id AS ticketID, src, dest, flightDate, flightTime, aircraft 
FROM flights AS F, tickets AS T, accounts as A
WHERE F.id = T.flightID
AND A.id = T.passengerID
AND F.flightDate > CURDATE()");

if (isset($cancel)) {
    $_SESSION['flightIDCancel'] = $flightID; 
    header('location: cancel.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<?php include('head.php') ?>

<body>
    <?php include('navbar.php') ?>

    <?= $msg ?>

    <div class="flights">
        <?php
        while ($flight = mysqli_fetch_assoc($sql)) {
            $aircraftName = $flight['aircraft'];
            $query = mysqli_query($con, "SELECT * FROM aircrafts WHERE name = '$aircraftName'");
            $aircraft = mysqli_fetch_assoc($query);
        ?>

            <div>
                <h4>Flight ID: <?= $flight['flightID'] ?></h4>
                <h4>Ticket ID: <?= $flight['ticketID'] ?></h4>
                <h4>Aircraft: <?= $flight['aircraft'] ?></h4>
                <h4>Company: <?= $aircraft['company'] ?></h4>
                <h4>From: <?= $flight['src'] ?></h4>
                <h4>To: <?= $flight['dest'] ?></h4>
                <h4>Date: <?= $flight['flightDate'] ?></h4>
                <h4>Time: <?= $flight['flightTime'] ?></h4>
                <form method="POST">
                    <input type="number" value="<?= $flight['flightID']?>" name="flightID" hidden>
                    <input type="submit" value="Cancel Flight" name="cancel">
                </form>
            </div>
        <?php
        }
        ?>
    </div>

    <?php include('footer.php') ?>

</body>

</html>