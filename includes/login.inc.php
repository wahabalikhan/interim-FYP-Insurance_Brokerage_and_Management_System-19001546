<?php
# Code adapted from https://www.youtube.com/watch?v=gCo6JqGMi30, How To Create A Login System In PHP For Beginners | Procedural MySQLi | PHP Tutorial

if (isset($_POST["submit"])) {
    $consumer_email = $_POST["consumer_email"];
    $consumer_password = $_POST["consumer_password"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputLogin($consumer_email, $consumer_password) !== false) {
        header("location: ../login.php?error=emptyinput");
        exit();
    }

    loginUser($conn, $consumer_email, $consumer_password);
} else {
    header("location: ../login.php");
    exit();
}
