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

    <div class="sure">
        <h2>Are you sure you want to cancel flight <?= $flightID ?> with ticket ID <?= $_SESSION['ticketID'] ?> ?</h2>
        <form method="POST">
            <label for="cancel">Yes</label>
            <input type="radio" value="yes" name="cancel">
            <label for="cancel">No</label>
            <input type="radio" value="no" name="cancel">
            <input class="card-button" type="submit" value="Submit" name="submit">
        </form>
    </div>


    <?php include('footer.php'); ?>
    <script>
        document.getElementById("navBar").classList.add("white");
    </script>
</body>

</html>