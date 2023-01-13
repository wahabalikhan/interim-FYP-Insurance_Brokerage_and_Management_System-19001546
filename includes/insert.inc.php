<?php
    require 'dbh.inc.php';
    
    if (isset($_POST['add-consumer'])) {
        $consumer_fullname = $_POST['consumer_fullname'];
        $consumer_email = $_POST['email_address'];
        $consumer_password = $_POST['consumer_password'];
        $consumer_phone = $_POST['consumer_phone'];
        $consumer_address = $_POST['consumer_address'];

        $sql = "INSERT INTO consumers (consumer_fullname, consumer_email, consumer_password, consumer_phone, consumer_address) VALUES ('$consumer_fullname','$consumer_email','$consumer_password','$consumer_phone','$consumer_address')";
        if (!mysqli_query($conn, $sql)) {
            echo "Failed to insert record";
        } else {
            echo "Successfully inserted record";
        }
        header("refresh:1; url='../admin.php'");
    }