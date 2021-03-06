<?php
session_start();
error_reporting(1);
include('../connection.php');
if ($_SESSION['admin_logged_in'] == "") {
    header("location: ../index.php");
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
            $count = (int) mysqli_num_rows($countQuery);
        ?>
            <div class="card">
                <h4 class="card-item">aircraft Name: <span class="card-item-val"><?= $aircraft['name'] ?></span></h4>
                <h4 class="card-item">Aircraft Company: <span class="card-item-val"><?= $aircraft['company'] ?></span></h4>
                <h4 class="card-item">Number of currently registered flights: <span class="card-item-val"><?= $count ?></span></h4>
                <form method="POST">
                    <input type="text" name="aircraftName" value="<?= $aircraft['name'] ?>" hidden>
                    <input class="card-button" type="submit" value="Update Aircraft" name="update">
                </form>
            </div>
        <?php
        }
        ?>
    </div>

    <?php include('../footer.php') ?>
    <script>
        document.getElementById("navBarAdmin").classList.add("white");
        document.getElementById('aircraftsNav').firstChild.classList.add('active');
    </script>


</body>

</html>