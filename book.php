<?php
session_start();
error_reporting(1);
include('connection.php');
$flightID = $_SESSION['flightIDBook'];
extract($_REQUEST);

if (isset($submit)) {
    if ($book == 'yes') {
        header('location: confirmationEmail.php');
    } else {
        header('location: flights.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('head.php'); ?>

<body>
    <?php include('navbar.php'); ?>
    
    <h2>Are you sure you want to book flight <?= $flightID ?></h2>
    <form method="POST">
        <label for="book">Yes</label>
        <input type="checkbox" value="yes" name="book">
        <label for="book">No</label>
        <input type="checkbox" value="no" name="book">
        <input type="submit" value="Submit" name="submit">
    </form>

    <?php include('footer.php'); ?>

</body>

</html>