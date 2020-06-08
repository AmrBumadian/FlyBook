<?php
session_start();
error_reporting(1);
include('../connection.php');
if ($_SESSION['admin_logged_in'] == "") {
    header("location: ../index.php");
}
extract($_REQUEST);
if (isset($add)) {
    $sql = mysqli_query($con, "SELECT * FROM flights
     WHERE aircraft = '$aircraft'
     AND flightDate = '$date'
     AND flightTime = '$time'");
    if (mysqli_num_rows($sql)) {
        $msg = "There's already a flight registered for this aircraft at the same time";
    } else {
        $sql = mysqli_query($con, "SELECT * FROM aircrafts WHERE name = '$aircraft'");
        if (mysqli_num_rows($sql)) {
            $query = "INSERT INTO flights (src, dest, flightTime, flightDate, aircraft, num) 
            VALUES ('$src', '$dest', '$time', '$date', '$aircraft', '$num')";
            if (mysqli_query($con, $query)) {
                $msg = "Flight is Added Successfully!";
            } else {
                $msg = "Couldn't Add Flight";
            }
        } else {
            $msg = "There's no aircraft registered with this name";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('head.php') ?>

<body>
    <?php include('navbar.php') ?>
    <div class="sign">
        <h2><?= $msg ?></h2>
        <h2>Add a new Flight</h2>
        <form method="POST">
            <div class="info">
                <input type="text" name="aircraft" placeholder="Aircraft name">
                <input type="text" name="src" placeholder="From" required>
                <input type="text" name="dest" placeholder="To" required>
                <label for="date">Date: </label>
                <input type="date" name="date">
                <label for="time">Time: </label>
                <input type="time" name="time">
                <label for="num">Number of seats: </label>
                <input type="number" name="num" value="200">
            </div>
            <input class="card-button" type="submit" name="add" value="Add Flight" required>
        </form>
    </div>


    <?php include('../footer.php') ?>
    <script>
        document.getElementById("navBarAdmin").classList.add("white");
        document.getElementById('addFlightNav').firstChild.classList.add('active');
    </script>

</body>

</html>