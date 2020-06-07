<?php
session_start();
error_reporting(1);
include('../connection.php');
if ($_SESSION['admin_logged_in'] == "") {
    header("location: ../index.html");
}
extract($_REQUEST);

$aircrafts = mysqli_query($con, "SELECT * FROM aircrafts");


if (isset($update)) {
    $_SESSION['aircraftName'] = $aircraftName;
    header('location: updateAircraft.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<?php include('head.php') ?>

<body>
    <?php include('navbar.php') ?>

    <?= $msg ?>

    <div class="aircrafts">
        <?php
        while ($aircraft = mysqli_fetch_assoc($aircrafts)) {
            $aircraftName = $aircraft['name'];
            $countQuery = mysqli_query($con, "SELECT * FROM flights WHERE aircraft = '$aircraftName'");
            $count = (int)mysqli_num_rows($countQuery);
        ?>
            <div>
                <h4>aircraft Name: <?= $aircraft['name'] ?></h4>
                <h4>Aircraft Company: <?= $aircraft['company'] ?></h4>
                <h4>Number of currently registered flights: <?= $count ?></h4>
                <form method="POST">
                    <input type="text" name="aircraftName" value="<?= $aircraft['name'] ?>" hidden>
                    <input type="submit" value="Update Aircraft" name="update">
                </form>
            </div>
        <?php
        }
        ?>
    </div>

    <?php include('../footer.php') ?>

</body>

</html>