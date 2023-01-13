<?php

require 'dbh.inc.php';

    $sql = "UPDATE consumers SET consumer_fullname='$_POST[consumer_fullname]', consumer_email='$_POST[consumer_email]', consumer_password='$_POST[consumer_password]', consumer_phone='$_POST[consumer_phone]', consumer_address='$_POST[consumer_address]',user_level ='$_POST[user_level]' WHERE consumer_id='$_POST[consumer_id]'";
    if (mysqli_query($conn, $sql)) {
        echo "Successfully updated record";
    } else {
        echo "Failed to update record ";
    }
    header("refresh:1; url='../admin.php'");