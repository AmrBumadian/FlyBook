<?php
session_start();
error_reporting(1);
include('../connection.php');
extract($_REQUEST);
$aircraftName = $_SESSION['aircraftName'];
$sql = mysqli_query($con, "SELECT * FROM aircrafts WHERE name = '$aircraftName'");

if (isset($update)) {
    $query = "UPDATE aircrafts
    SET name = '$name',
    company = '$company'
    WHERE name = '$aircraftName'";
    mysqli_query($con, $query);
    $msg = "<h3>Aircraft details updated successfully</h3>";
    $sql = mysqli_query($con, "SELECT * FROM aircrafts WHERE name = '$name'");
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include('../head.php') ?>

<body>
    <?php include('navbar.php') ?>

    <?php $aircraft = mysqli_fetch_assoc($sql); ?>

    <form method="POST">
        <label for="name">Aircraft Name: </label>
        <input type="text" name="name" value="<?= $aircraft['name'] ?>">
        <label for="company">Aircraft Company: </label>
        <input type="text" name="company" value="<?= $aircraft['company'] ?>">
        <input type="submit" value="Update Aircraft" name="update">
    </form>

    <?php echo $msg ?>

    <?php include('../footer.php') ?>
</body>

</html>