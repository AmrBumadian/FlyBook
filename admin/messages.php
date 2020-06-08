<?php
session_start();
error_reporting(1);
include('../connection.php');
if ($_SESSION['admin_logged_in'] == "") {
    header("location: ../index.php");
}
$sql = mysqli_query($con, "SELECT * FROM messages");
?>

<!DOCTYPE html>
<html lang="en">
<?php include('head.php') ?>

<body>
    <?php include('navbar.php') ?>

    <div class="messages">
        <?php while ($message = mysqli_fetch_assoc($sql)) {
        ?>
            <div class="card">
                <h4 class="card-item">Name: <span class="card-item-val"><?= $message['name'] ?></span></h3>
                    <h4 class="card-item">Email: <span class="card-item-val"><?= $message['email'] ?></span></h3>
                        <h4 class="card-item">Message: <span class="card-item-val"><?= $message['msg'] ?></span></b></h3>
            </div>
        <?php } ?>
    </div>

    <?php include('../footer.php') ?>
    <script>
        document.getElementById("navBar").classList.add("white");
        document.getElementById('messagesNav').firstChild.classList.add('active');
    </script>


</body>

</html>