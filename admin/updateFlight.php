<?php
session_start();
error_reporting(1);
include('../connection.php');
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
        $msg = "<h3>Flight details updated successfully</h3>";
    } else {
        $msg = "<h3>Couldn't update flight </h3>";
    }
    mysqli_query($con, "SELECT * FROM aircrafts WHERE name = '$name'");
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include('../head.php') ?>

<body>
    <?php include('navbar.php') ?>

    <form method="POST">
        <label for="src">Flight Source: </label>
        <input type="text" name="src" value="<?= $flight['src'] ?>">
        <label for="dest">Flight Destination: </label>
        <input type="text" name="dest" value="<?= $flight['dest'] ?>">
        <label for="date">Flight Date: </label>
        <input type="date" name="date" value="<?= $flight['date'] ?>">
        <label for="time">Flight Time: </label>
        <input type="time" name="time" value="<?= $flight['time'] ?>">
        <input type="submit" value="Update Flight" name="update">
    </form>

    <?php echo $msg ?>

    <?php include('../footer.php') ?>
</body>

</html>