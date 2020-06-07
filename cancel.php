<?php
session_start();
error_reporting(1);
include('connection.php');
if ($_SESSION['account_logged_in'] == "") {
    header("location: index.php");
}
$flightID = $_SESSION['flightIDCancel'];
extract($_REQUEST);

if (isset($submit)) {
    if ($cancel == 'yes') {
        header('location: cancellationEmail.php');
    } else {
        header('location: myFlights.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('head.php'); ?>

<body>
    <?php include('navbar.php'); ?>
    
    <h2>Are you sure you want to cancel flight <?= $flightID ?></h2>
    <form method="POST">
        <label for="cancel">Yes</label>
        <input type="checkbox" value="yes" name="cancel">
        <label for="cancel">No</label>
        <input type="checkbox" value="no" name="cancel">
        <input type="submit" value="Submit" name="submit">
    </form>

    <?php include('footer.php'); ?>

</body>

</html>