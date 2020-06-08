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

            <div class="card">
                <h4 class="card-item">Flight ID: <span class="card-item-val"><?= $flight['id'] ?></span></h4>
                <h4 class="card-item">Aircraft: <span class="card-item-val"><?= $flight['aircraft'] ?></span></h4>
                <h4 class="card-item">Company: <span class="card-item-val"><?= $aircraft['company'] ?></span></h4>
                <h4 class="card-item">From: <span class="card-item-val"><?= $flight['src'] ?></span></h4>
                <h4 class="card-item">To: <span class="card-item-val"><?= $flight['dest'] ?></span></h4>
                <h4 class="card-item">Date: <span class="card-item-val"><?= $flight['flightDate'] ?></span></h4>
                <h4 class="card-item">Time: <span class="card-item-val" <?= $flight['flightTime'] ?>></span></h4>
                <h4 class="card-item">Number of tickets available: <span class="card-item-val"><?= $flight['num'] ?></span></h4>
                <form method="POST">
                    <input type="number" value="<?= $flight['id'] ?>" name="flightID" hidden>
                    <input class="card-button" type="submit" value="Book Flight" name="book">
                </form>
            </div>
        <?php
        }
        ?>
    </div>

    <?php include('footer.php') ?>
    <script>
        document.getElementById("navBar").classList.add("white");
        document.getElementById('flightsNav').firstChild.classList.add('active');
    </script>


</body>

</html>