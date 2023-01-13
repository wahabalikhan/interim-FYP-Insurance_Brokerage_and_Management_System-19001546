<?php
    require 'dbh.inc.php';
    
    if (isset($_POST['add-consumer'])) {
        $admin_fullname = $_POST['admin_fullname'];
        $admin_email = $_POST['email_address'];
        $admin_password = $_POST['admin_password'];
        $admin_phone = $_POST['admin_phone'];
        $admin_address = $_POST['admin_address'];

        $sql = "INSERT INTO consumers (admin_fullname, email_address, admin_password, admin_phone, admin_address) VALUES ('$admin_fullname','$admin_email','$admin_password','$admin_phone','$admin_address')";
        if (!mysqli_query($conn, $sql)) {
            echo "Failed to insert record";
        } else {
            echo "Successfully inserted record";
        }
        header("refresh:1; url='../admin.php'");
    }