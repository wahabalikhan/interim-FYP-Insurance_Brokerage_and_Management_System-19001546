<?php
# Code adapted from https://www.youtube.com/watch?v=gCo6JqGMi30, How To Create A Login System In PHP For Beginners | Procedural MySQLi | PHP Tutorial

# all functions that can be referenced to do something in website
function emptyInputSignup($consumer_fullname, $consumer_email_address, $consumer_password, $consumer_password_repeat, $consumer_phone_number, $consumer_address) {
    # returns true or false statement
    $result="";

    # empty()—check if there is data or no data that will be in function
    if (empty($consumer_fullname) || empty($consumer_email_address) || empty($consumer_password) || empty($consumer_password_repeat) || empty($consumer_phone_number) || empty($consumer_address)) {
        # if empty fields, then return true
        $result = true;
    } else {
        # no empty fields, then return false
        $result = false;
    }

    return $result;
}

function invalidEmailAddress($consumer_email_address) {
    # returns true or false statement
    $result="";

    # check if email is correct
    if (!filter_var($consumer_email_address, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function passwordMatch($consumer_password, $consumer_password_repeat) {
    # returns true or false statement
    $result="";

    # check if passwords match
    if ($consumer_password !== $consumer_password_repeat) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function emailAddressExists($conn, $consumer_email_address) {
    # connect to database and check if exists first, have to create SQL statement. ? is a placeholder as we are using prepared statements to connect to database—run SQL statement first and then fill vars with user data once validated
    $sql = "SELECT * FROM consumers WHERE consumer_email_address = ?;";

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
    mysqli_stmt_bind_param($stmt, "s", $consumer_email_address);

    # execute statement
    mysqli_stmt_execute($stmt);

    # grab data from database
    $resultData = mysqli_stmt_get_result($stmt);

    # check if result from statement, fetching data as associative array. If get result from database, return true
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

function createUser($conn, $consumer_fullname, $consumer_email_address, $consumer_password, $consumer_phone_number, $consumer_address) {
    # insert data into database
    $sql = "INSERT INTO consumers (consumer_fullname, consumer_email_address, consumer_password, consumer_phone_number, consumer_address) VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=createuserfailed");
        exit();
    }  
    
    #hashing password, auto updated function to ensure security from hackers, PASSWORD_DEFAULT—using default algorithm to hash
    $consumer_hashed_password = password_hash($consumer_password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssss", $consumer_fullname, $consumer_email_address, $consumer_password, $consumer_phone_number, $consumer_address);

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../consumer_dashboard.php?error=none");
}