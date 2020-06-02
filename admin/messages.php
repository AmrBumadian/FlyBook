<?php
session_start();
error_reporting(1);
include('../connection.php');
$sql = mysqli_query($con, "SELECT * FROM messages");
?>

<!DOCTYPE html>
<html lang="en">
<?php include('../head.php') ?>

<body>
    <?php include('navbar.php') ?>

    <div class="messages">
        <?php while ($message = mysqli_fetch_assoc($sql)) {
        ?>
            <div class="message">
                <h3><b>Name:</b> <?= $message['name'] ?></h3>
                <h3><b>Email:</b> <?= $message['email'] ?></h3>
                <h3><b>Message: </b></h3>
                <p><?= $message['msg'] ?></p>
            </div>
        <?php } ?>
    </div>

    <?php include('../footer.php') ?>

</body>

</html>