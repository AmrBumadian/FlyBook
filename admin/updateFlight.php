<?php
session_start();
error_reporting(1);
include('../connection.php');
if ($_SESSION['admin_logged_in'] == "") {
    header("location: ../index.php");
}
extract($_REQUEST);
$flightID = $_SESSION['flightID'];
$sql = mysqli_query($con, "SELECT * FROM flights WHERE id = '$flightID'");
$flight = mysqli_fetch_assoc($sql);

if (isset($update)) {
    $query = "UPDATE flights
        SET src = '$src',
        dest = '$dest',
        flightDate = '$date',
        flightTime = '$time'
        WHERE id = $flightID";
    if (mysqli_query($con, $query)) {
        $msg = "Flight details updated successfully";
    } else {
        $msg = "Couldn't update flight";
    }
    $sql = mysqli_query($con, "SELECT * FROM flights WHERE id = '$flightID'");
    $flight = mysqli_fetch_assoc($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include('head.php') ?>

<body>
    <?php include('navbar.php') ?>

    <div class="sign">
        <h2 class="success"><?= $msg ?></h2>
        <form method="POST">
            <div class="info">
                <label for="src">Flight Source: </label>
                <input type="text" name="src" value="<?= $flight['src'] ?>">
                <label for="dest">Flight Destination: </label>
                <input type="text" name="dest" value="<?= $flight['dest'] ?>">
                <label for="date">Flight Date: </label>
                <input type="date" name="date" value="<?= $flight['flightDate'] ?>">
                <label for="time">Flight Time: </label>
                <input type="time" name="time" value="<?= $flight['flightTime'] ?>">
            </div>
            <input class="card-button" type="submit" value="Update Flight" name="update">
        </form>
    </div>

    <?php include('../footer.php') ?>
    <script>
        document.getElementById("navBarAdmin").classList.add("white");
    </script>
</body>

</html>