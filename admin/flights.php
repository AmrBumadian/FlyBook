<?php
session_start();
error_reporting(1);
include('../connection.php');
extract($_REQUEST);

if (isset($update)) {
    $sql = mysqli_query($con, "SELECT * FROM flights WHERE id = '$flightID'");
    $flight = mysqli_fetch_assoc($sql);
    $bookedQuery = mysqli_query($con, "SELECT * FROM tickets WHERE flightID = '$flightID'");
    $bookedCount = (int) mysqli_num_rows($bookedQuery);
    if ($bookedCount == 0) {
        $_SESSION['flightID'] = $flightID;
        header('location: updateFlight.php');
    } else {
        $msg = "<h2>You can't update a flight that is already booked by users</h2>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<?php include('../head.php') ?>

<body>
    <?php include('navbar.php') ?>

    <?= $msg ?>

    <div class="flights">
        <?php
        $sql = mysqli_query($con, "SELECT * FROM flights");
        while ($flight = mysqli_fetch_assoc($sql)) {
            $flightID = $flight['id'];
            $bookedQuery = mysqli_query($con, "SELECT * FROM tickets WHERE flightID = '$flightID'");
            $bookedCount = (int) mysqli_num_rows($bookedQuery);
        ?>
            <div>
                <h4>Flight ID: <?= $flight['id'] ?></h4>
                <h4>Aircraft: <?= $flight['aircraft'] ?></h4>
                <h4>From: <?= $flight['src'] ?></h4>
                <h4>To: <?= $flight['dest'] ?></h4>
                <h4>Date: <?= $flight['flightDate'] ?></h4>
                <h4>Time: <?= $flight['flightTime'] ?></h4>
                <h4>Number of booked tickets: <?= $bookedCount ?></h4>
                <h4>Number of available tickets: <?= $flight['num'] ?></h4>
                <form method="POST">
                    <input type="number" value="<?= $flight['id'] ?>" name="flightID" hidden>
                    <input type="submit" value="Update Flight" name="update">
                </form>
            </div>
        <?php
        }
        ?>
    </div>

    <?php include('../footer.php') ?>

</body>

</html>