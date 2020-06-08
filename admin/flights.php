<?php
session_start();
error_reporting(1);
include('../connection.php');
if ($_SESSION['admin_logged_in'] == "") {
    header("location: ../index.php");
}
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
        $msg = "You can't update a flight that is already booked by users";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<?php include('head.php') ?>

<body>
    <?php include('navbar.php') ?>

    <h2 class="success"><?= $msg ?></h2>

    <div class="flights">
        <?php
        $sql = mysqli_query($con, "SELECT * FROM flights");
        while ($flight = mysqli_fetch_assoc($sql)) {
            $flightID = $flight['id'];
            $bookedQuery = mysqli_query($con, "SELECT * FROM tickets WHERE flightID = '$flightID'");
            $bookedCount = (int) mysqli_num_rows($bookedQuery);
        ?>
            <div class="card">
                <h4 class="card-item">Flight ID: <span class="card-item-val"><?= $flight['id'] ?></span></h4>
                <h4 class="card-item">Aircraft: <span class="card-item-val"><?= $flight['aircraft'] ?></span></h4>
                <h4 class="card-item">From: <span class="card-item-val"><?= $flight['src'] ?></span></h4>
                <h4 class="card-item">To: <span class="card-item-val"><?= $flight['dest'] ?></span></h4>
                <h4 class="card-item">Date: <span class="card-item-val"><?= $flight['flightDate'] ?></span></h4>
                <h4 class="card-item">Time: <span class="card-item-val"><?= $flight['flightTime'] ?></span></h4>
                <h4 class="card-item">Number of booked tickets: <span class="card-item-val"><?= $bookedCount ?></span></h4>
                <h4 class="card-item">Number of available tickets: <span class="card-item-val"><?= $flight['num'] ?></span></h4>
                <form method="POST">
                    <input type="number" value="<?= $flight['id'] ?>" name="flightID" hidden>
                    <input class="card-button" type="submit" value="Update Flight" name="update">
                </form>
            </div>
        <?php
        }
        ?>
    </div>

    <?php include('../footer.php') ?>
    <script>
        document.getElementById("navBar").classList.add("white");
        document.getElementById('flightsNav').firstChild.classList.add('active');
    </script>


</body>

</html>