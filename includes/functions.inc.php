<?php
# Code adapted from https://www.youtube.com/watch?v=gCo6JqGMi30, How To Create A Login System In PHP For Beginners | Procedural MySQLi | PHP Tutorial

# all functions that can be referenced to do something in website
function emptyInputSignup($consumer_fullname, $consumer_email, $consumer_password, $consumer_password_repeat, $consumer_phone, $consumer_address)
{
    # returns true or false statement
    $result = "";

    # empty()—check if there is data or no data that will be in function
    if (empty($consumer_fullname) || empty($consumer_email) || empty($consumer_password) || empty($consumer_password_repeat) || empty($consumer_phone) || empty($consumer_address)) {
        # if empty fields, then return true
        $result = true;
    } else {
        # no empty fields, then return false
        $result = false;
    }

    return $result;
}

function invalidEmailAddress($consumer_email)
{
    # returns true or false statement
    $result = "";

    # check if email is correct
    if (!filter_var($consumer_email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function passwordMatch($consumer_password, $consumer_password_repeat)
{
    # returns true or false statement
    $result = "";

    # check if passwords match
    if ($consumer_password !== $consumer_password_repeat) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function emailAddressExists($conn, $consumer_email)
{
    # connect to database and check if exists first, have to create SQL statement. ? is a placeholder as we are using prepared statements to connect to database—run SQL statement first and then fill vars with user data once validated
    $sql = "SELECT * FROM consumers WHERE consumer_email = ?;";

    # submit SQL statement to database using prepared statement, initialising new prepared statement—have to connect to database

    #using prepared statements to prevent users from entering malicious data e.g. code into inputs that can destroy database
    $stmt = mysqli_stmt_init($conn);

    # check if any errors in prepared/SQL statement when running in database, check if fails first—best practice for all languages
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=emailaddressalreadyexists");
        exit();
    }

    # if not failed, pass data from user
    # [prepared statement, type of data being passed, data submitted by user]
    mysqli_stmt_bind_param($stmt, "s", $consumer_email);

    # execute statement
    mysqli_stmt_execute($stmt);

    # grab data from database
    $resultData = mysqli_stmt_get_result($stmt);

    # check if result from statement, fetching data as associative array. If get result from database, return true. Using names rather index numbers for columns
    if ($row = mysqli_fetch_assoc($resultData)) {
        # if data in database with this email address, then grab this data for login function

        # return all data from database if user exists in database, can use this data to log in user—multiple purposes
        return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $consumer_fullname, $consumer_email, $consumer_password, $consumer_phone, $consumer_address)
{
    # insert data into database
    $sql = "INSERT INTO consumers (consumer_fullname, consumer_email, consumer_password, consumer_phone, consumer_address) VALUES (?, ?, ?, ?, ?);";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=createuserfailed");
        exit();
    }

    #hashing password, auto updated function to ensure security from hackers, PASSWORD_DEFAULT—using default algorithm to hash
    $consumer_hashed_password = password_hash($consumer_password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssss", $consumer_fullname, $consumer_email, $consumer_hashed_password, $consumer_phone, $consumer_address);

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../consumer_dashboard.php?error=none");
}

function emptyInputLogin($consumer_email, $consumer_password)
{
    # returns true or false statement
    $result = "";

    # empty()—check if there is data or no data that will be in function
    if (empty($consumer_email) || empty($consumer_password)) {
        # if empty fields, then return true
        $result = true;
    } else {
        # no empty fields, then return false
        $result = false;
    }
    return $result;
}

function loginUser($conn, $consumer_email, $consumer_password)
{
    $emailExists = emailAddressExists($conn, $consumer_email);

    # error handler—if returned as false, doesn't exist
    if ($emailExists === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    #check password from consumer with hashed password in database
    $password_hashed = $emailExists["consumer_password"];
    $check_password = password_verify($consumer_password, $password_hashed);

    if ($check_password === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    } else if ($check_password === true) {
        # login user through sessions, store data in session through starting session first
        session_start();
        $_SESSION["consumer_id"] = $emailExists["consumer_id"];
        $_SESSION["consumer_email"] = $emailExists["consumer_email"];
        header("location: ../consumer_dashboard.php");
        exit();
    }
}
