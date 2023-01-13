<?php

session_start();
define('user_level_admin', 'admin');

function loginAdminUser($conn, $admin_email, $admin_password) {
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];

    $sql = "SELECT * FROM admin WHERE admin_email=?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../login.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $admin_email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if ($row = mysqli_fetch_assoc($result)) {
            $dbPassword = $row['admin_password'];
            if ($admin_password != $dbPassword) {
                header("Location: ../login.php?error=wrongpassword");
                exit();
            } else if ($admin_password == $dbPassword) {
                session_start();
                $_SESSION["admin_id"] = $_POST['admin_id'];
                $_SESSION["admin_email"] = $_POST['admin_email'];
                $_SESSION['session_user_level'] === user_level_admin;

                header("Location: ../admin.php?login=success");
                exit();
            } else {
                header("Location: ../login.php?error=wrongpassword");
                exit();
            }
        } else {
            header("Location: ../login.php?error=nouser");
            exit();
        }
    }
}

function isAdmin() {
    if ($_SESSION['session_user_level'] == user_level_admin) {
        return true;
    } else {
        return false;
    }
}