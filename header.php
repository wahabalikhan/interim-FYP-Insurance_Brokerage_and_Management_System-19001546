<?php
# Code adapted from https://www.youtube.com/watch?v=gCo6JqGMi30, How To Create A Login System In PHP For Beginners | Procedural MySQLi | PHP Tutorial
# user logged in on every page on application
session_start();
include 'includes/dbh.inc.php';

$sql = "SELECT * FROM consumers";
$records = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/img/logo.png" type="image/png">
    <title>Insurance Brokerage and Management System</title>

    <!-- Stylesheetss-->
    <link rel="stylesheet" href="assets/css/main.css">
</head>

<header>
    <div class="container">
        <li><a>IBMS</a></li>
        <ul>
            <?php
            # check if consumer logged in
            if (isset($_SESSION["consumer_email"])) {
                echo "<li><a href='consumer_dashboard.php'>Home</a></li>";
                echo "<li><a href='profile.php'>Profile</a></li>";
                echo "<li><a href='includes/logout.inc.php'>Log out</a></li>";
            } else {
                # non-registered user
                echo "<li><a href='signup.php'>Sign up</a></li>";
                echo "<li><a href='login.php'>Log in</a></li>";
            }
            ?>
        </ul>
    </div>
</header>