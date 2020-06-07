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
        $msg = "<h1> There's already an aircraft with these details </h1>";
    } else {
        $query = "INSERT INTO aircrafts (name, company) VALUES ('$name', '$company')";
        if (mysqli_query($con, $query)) {
            $msg = "<h1> Aircraft is Added Successfully! </h1>";
        } else {
            $msg = "<h1> Couldn't Add Aircraft</h1>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('head.php') ?>

<body>
    <?php include('navbar.php') ?>
    <?php echo $msg ?>
    <form method="POST">
        <input type="text" name="name" placeholder="Aircraft Name" required>
        <input type="text" name="company" placeholder="Aircraft Company" required>
        <input type="submit" name="add" value="Add Aircraft" required>
    </form>

    <?php include('../footer.php') ?>
</body>

</html>