<?php
session_start();
error_reporting(1);
include('../connection.php');
if ($_SESSION['admin_logged_in'] == "") {
    header("location: ../index.php");
}
extract($_REQUEST);
$aircraftName = $_SESSION['aircraftName'];
$sql = mysqli_query($con, "SELECT * FROM aircrafts WHERE name = '$aircraftName'");

if (isset($update)) {
    $query = "UPDATE aircrafts
    SET name = '$name',
    company = '$company'
    WHERE name = '$aircraftName'";
    mysqli_query($con, $query);
    $msg = "Aircraft details updated successfully";
    $aircraftName = $name;
    $_SESSION['aircraftName'] = $name;
    $sql = mysqli_query($con, "SELECT * FROM aircrafts WHERE name = '$aircraftName'");
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include('head.php') ?>

<body>
    <?php include('navbar.php') ?>

    <?php $aircraft = mysqli_fetch_assoc($sql); ?>

    <div class="sign">
        <h2 class="success"><?= $msg ?></h2>
        <form method="POST">
            <div class="info">
                <label for="name">Aircraft Name: </label>
                <input type="text" name="name" value="<?= $aircraft['name'] ?>">
                <label for="company">Aircraft Company: </label>
                <input type="text" name="company" value="<?= $aircraft['company'] ?>">
            </div>
            <input class="card-button" type="submit" value="Update Aircraft" name="update">
        </form>
    </div>
    <?php include('../footer.php') ?>
    <script>
        document.getElementById("navBar").classList.add("white");
    </script>
</body>

</html>