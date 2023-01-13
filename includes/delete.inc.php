<?php
    require 'dbh.inc.php';

    $userSql = "DELETE FROM consumers WHERE consumer_id='$_GET[consumer_id]'";
    if (mysqli_query($conn, $userSql)) {
        echo "Successfully deleted record";
    } else {
        echo "Failed to delete record";
    }
    header("refresh:1; url='../admin.php'");