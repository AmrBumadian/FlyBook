<?php
session_start();
error_reporting(1);
include('../connection.php');
if ($_SESSION['admin_logged_in'] == "") {
    header("location: ../index.php");
}
extract($_REQUEST);
if (isset($add)) {
    $sql = mysqli_query($con, "SELECT * FROM aircrafts WHERE name = '$name' AND company = '$company'");
    if (mysqli_num_rows($sql)) {
        $msg = "There's already an aircraft with these details";
    } else {
        $query = "INSERT INTO aircrafts (name, company) VALUES ('$name', '$company')";
        if (mysqli_query($con, $query)) {
            $msg = "Aircraft is Added Successfully!";
        } else {
            $msg = "Couldn't Add Aircraft";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('head.php') ?>

<body>
    <?php include('navbar.php') ?>
    <div class="sign">
        <h2><?= $msg ?></h2>
        <h2>Add a new Aircraft</h2>
        <form method="POST">
            <div class="info">
                <input type="text" name="name" placeholder="Aircraft Name" required>
                <input type="text" name="company" placeholder="Aircraft Company" required>
            </div>
            <input class="card-button" type="submit" name="add" value="Add Aircraft" required>
        </form>
    </div>
    <?php include('../footer.php') ?>
    <script>
        document.getElementById("navBar").classList.add("white");
        document.getElementById('addAircraftNav').firstChild.classList.add('active');
    </script>

</body>

</html>