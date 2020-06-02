<?php
include('../connection.php');
extract($_REQUEST);
if (isset($add)) {
    $sql = mysqli_query($con, "SELECT * FROM flights
     WHERE aircraft = '$aircraft'
     AND flightDate = '$date'
     AND flightTime = '$time'");
    if (mysqli_num_rows($sql)) {
        $msg = "<h1> There's already a flight registered for this aircraft at the same time </h1>";
    } else {
        $sql = mysqli_query($con, "SELECT * FROM aircrafts WHERE name = '$aircraft'");
        if (mysqli_num_rows($sql)) {
            $query = "INSERT INTO flights (src, dest, flightTime, flightDate, aircraft, num) 
            VALUES ('$src', '$dest', '$time', '$date', '$aircraft', '$num')";
            if (mysqli_query($con, $query)) {
                $msg = "<h1> Flight is Added Successfully! </h1>";
            } else {
                $msg = "<h1> Couldn't Add Flight</h1>";
            }
        }
        else {
            $msg = "<h1> There's no aircraft registered with this name </h1>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('../head.php') ?>

<body>
    <?php include('navbar.php') ?>
    <?php echo $msg ?>
    <form method="POST">
        <label for="aircraft">Aircraft Name: </label>
        <input type="text" name="aircraft" placeholder="Aircraft name">
        <label for="src">From: </label>
        <input type="text" name="src" placeholder="From" required>
        <label for="dest">To: </label>
        <input type="text" name="dest" placeholder="To" required>
        <label for="date">Date: </label>
        <input type="date" name="date">
        <label for="time">Time: </label>
        <input type="time" name="time">
        <label for="num">Number of seats: </label>
        <input type="number" name="num" value="200">
        <input type="submit" name="add" value="Add Flight" required>
    </form>

    <?php include('../footer.php') ?>
</body>

</html>