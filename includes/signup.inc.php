<?php
# Code adapted from https://www.youtube.com/watch?v=gCo6JqGMi30, How To Create A Login System In PHP For Beginners | Procedural MySQLi | PHP Tutorial

# If user submitted data through form, then run php script as it is—else if they didn't, send back to sign up page. PHP fucntion isset=if set specific piece of data is in URL, then user is able to access page

if (isset($_POST["submit"])) {

    #Get data from URL
    $consumer_fullname = $_POST["consumer_fullname"];
    $consumer_email = $_POST["consumer_email"];
    $consumer_password = $_POST["consumer_password"];
    $consumer_password_repeat = $_POST["consumer_password_repeat"];
    $consumer_phone = $_POST["consumer_phone"];
    $consumer_address = $_POST["consumer_address"];

    # error handling—catch any errors user makes when passing data
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    # catch errors—empty inputs
    if (emptyInputSignup($consumer_fullname, $consumer_email, $consumer_password, $consumer_password_repeat, $consumer_phone, $consumer_address) !== false) {
        header("location: ../signup.php?error=emptyinput");
        # stop script from running
        exit();
    }

    # catch errors—invalid email address
    if (invalidEmailAddress($consumer_email) !== false) {
        header("location: ../signup.php?error=invalidemailaddress");
        # stop script from running
        exit();
    }

    # catch errors—passwords not the same
    if (passwordMatch($consumer_password, $consumer_password_repeat) !== false) {
        header("location: ../signup.php?error=passwordsdontmatch");
        # stop script from running
        exit();
    }

    # catch errors—email address already exists. Using $conn to check database if data exists
    if (emailAddressExists($conn, $consumer_email) !== false) {
        header("location: ../signup.php?error=emailaddressalreadyexists");
        # stop script from running
        exit();
    }

    # if no errors made, then create record into database
    createUser($conn, $consumer_fullname, $consumer_email, $consumer_password, $consumer_phone, $consumer_address);
} else {
    header("location: ../signup.php");
    exit();
}
