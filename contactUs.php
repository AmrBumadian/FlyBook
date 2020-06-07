<?php
session_start();
error_reporting(1);
include('connection.php');
extract($_REQUEST);
if (isset($send)) {
    mysqli_query($con, "INSERT INTO messages (name, email, msg) VALUES ('$name', '$email', '$message')");
    $msg = "<h3>Your message is successfully sent</h3>";
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include('head.php') ?>

<body class="contactUs">

    <?php include('navbar.php') ?>
    <div id="main">
        <h1 class="contactH">Contact US</h1>
        <h3>We are glad to listen from you</h3>
        <form class="formBox" method="POST" id="customerForm">
            <label>Full Name: <input type="text" id="name" placeholder="Full Name" name="name" required> </label>
            <label>Email:  <input type="text" id="email" placeholder="Email" name="email" required> </label>
            <label>Message: 
                <textarea id="message" name="message" rows="10" cols="50" maxlength="512" placeholder="Enter you message here" required>
                </textarea>
            </label>
            <input type="submit" id="send" value="Send" name="send">
        </form>
    </div>

    <?= $msg ?>

    <?php include('footer.php') ?>
    <script>
        document.getElementById("navBar").classList.add("white");
    </script>
</body>

</html>