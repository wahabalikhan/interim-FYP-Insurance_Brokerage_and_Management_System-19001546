<?php
# Code adapted from https://www.youtube.com/watch?v=gCo6JqGMi30, How To Create A Login System In PHP For Beginners | Procedural MySQLi | PHP Tutorial

if (isset($_POST["admin-submit"])) {
    $admin_email = $_POST["admin_email"];
    $admin_password = $_POST["admin_password"];

    require_once 'dbh.inc.php';
    require_once 'admin.functions.inc.php';

    loginAdminUser($conn, $admin_email, $admin_password);
} else {
    header("location: ../login.php");
    exit();
}
