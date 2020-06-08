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
AND F.flightDate > CURDATE()
AND A.id = $userID");

if (isset($cancel)) {
    $_SESSION['flightIDCancel'] = $flightID;
    $_SESSION['ticketID'] = $ticketID;
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
            <div class="card">
                <h4 class="card-item">Flight ID: <span class="card-item-val"><?= $flight['flightID'] ?></span></h4>
                <h4 class="card-item">Ticket ID: <span class="card-item-val"><?= $flight['ticketID'] ?></span></h4>
                <h4 class="card-item">Aircraft: <span class="card-item-val"><?= $flight['aircraft'] ?></span></h4>
                <h4 class="card-item">Company: <span class="card-item-val"><?= $aircraft['company'] ?></span></h4>
                <h4 class="card-item">From: <span class="card-item-val"><?= $flight['src'] ?></span></h4>
                <h4 class="card-item">To: <span class="card-item-val"><?= $flight['dest'] ?></span></h4>
                <h4 class="card-item">Date: <span class="card-item-val"><?= $flight['flightDate'] ?></span></h4>
                <h4 class="card-item">Time: <span class="card-item-val"><?= $flight['flightTime'] ?></span></h4>
                <form method="POST">
                    <input type="number" value="<?= $flight['flightID'] ?>" name="flightID" hidden>
                    <input type="number" value="<?= $flight['ticketID'] ?>" name="ticketID" hidden>
                    <input class="card-button" type="submit" value="Cancel Flight" name="cancel">
                </form>
            </div>
        <?php
        }
        ?>
    </div>

    <?php include('footer.php') ?>
    <script>
        document.getElementById("navBar").classList.add("white");
        document.getElementById('myFlightsNav').firstChild.classList.add('active');
    </script>

</body>

</html>