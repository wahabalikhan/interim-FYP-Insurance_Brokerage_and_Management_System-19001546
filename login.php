<?php
include_once 'header.php';
require_once 'includes/functions.inc.php';

if (isNone()) {
    header("location: login.php");
}
?>

<main>
    <div class="container">
        <h1>Log in</h1>
        <h2>This is the login page of the IBMS</h2>
        
        <p>consumer login</p>
        <div class="login-form">
            <form action="includes/login.inc.php" method="post"> <!-- action="includes/login.inc.php" is where user will be sent to when form submitted, using post method to hide sensitive data in URL but will still be passed-->

                <input type="text" name="consumer_email" placeholder="Email address">
                <input type="password" name="consumer_password" placeholder="Password">
                <button type="submit" name="submit">Log in</button>
            </form>
        </div>
        <br>
        <p>admin login</p>
        <div class="admin-login-form">
            <form action="includes/admin.login.inc.php" method="post">
                <input type="text" name="admin_email" placeholder="Email address">
                <input type="password" name="admin_password" placeholder="Password">
                <button type="submit" name="admin-submit">Log in</button>
            </form>
        </div>

        <?php
        # error-handling messages
        # GET to check for data we can see
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
                echo "<p>Sign up failed, missing fields.</p>";
            }
            if ($_GET["error"] == "wronglogin") {
                echo "<p>Log in failed, incorrect login credentials.</p>";
            }
        }
        ?>

        <script src="assets/js/app.js"></script>
    </div>
</main>

<?php
include_once 'footer.php';
?>