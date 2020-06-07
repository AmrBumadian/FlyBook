<?php
session_start();
error_reporting(1);
include('connection.php');
if ($_SESSION['account_logged_in'] == "") {
    header("location: index.php");
}
extract($_REQUEST);

if (isset($book)) {
    $_SESSION['flightIDBook'] = $flightID;
    header('location: book.php');
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
        $sql = mysqli_query($con, "SELECT * FROM flights WHERE num > 0 AND flightDate > CURDATE()");
        while ($flight = mysqli_fetch_assoc($sql)) {
            $aircraftName = $flight['aircraft'];
            $query = mysqli_query($con, "SELECT * FROM aircrafts WHERE name = '$aircraftName'");
            $aircraft = mysqli_fetch_assoc($query);
        ?>

            <div>
                <h4>Flight ID: <?= $flight['id'] ?></h4>
                <h4>Aircraft: <?= $flight['aircraft'] ?></h4>
                <h4>Company: <?= $aircraft['company'] ?></h4>
                <h4>From: <?= $flight['src'] ?></h4>
                <h4>To: <?= $flight['dest'] ?></h4>
                <h4>Date: <?= $flight['flightDate'] ?></h4>
                <h4>Time: <?= $flight['flightTime'] ?></h4>
                <h4>Number of tickets available: <?= $flight['num'] ?></h4>
                <form method="POST">
                    <input type="number" value="<?=$flight['id']?>" name="flightID" hidden>
                    <input type="submit" value="Book Flight" name="book">
                </form>
            </div>
        <?php
        }
        ?>
    </div>

    <?php include('footer.php') ?>

</body>

</html>