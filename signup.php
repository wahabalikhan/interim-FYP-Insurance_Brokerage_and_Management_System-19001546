<?php
include_once 'header.php';
?>

<main>
    <h1>Sign up</h1>
    <p>This is the signup page of the IBMS</p>

    <div class="signup-form">
        <form action="includes/signup.inc.php" method="POST"> <!-- action="includes/signup.inc.php" is where user will be sent to when form submitted, using post method to hide sensitive data in URL but will still be passed-->

            <input type="text" name="consumer_fullname" placeholder="Fullname">
            <input type="text" name="consumer_email" placeholder="Email address">
            <input type="password" name="consumer_password" placeholder="Password">
            <input type="password" name="consumer_password_repeat" placeholder="Repeat password"> <!-- type="password" ensures that password cannot be seen when typing in-->

            <input type="text" name="consumer_phone" placeholder="Phone number">
            <input type="text" name="consumer_address" placeholder="Address">
            <button type="submit" name="submit">Sign up</button>
        </form>

        <?php
        # error-handling messages
        # GET to check for data we can see
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
                echo "<p>Sign up failed, missing fields.</p>";
            }
            if ($_GET["error"] == "invalidemailaddress") {
                echo "<p>Sign up failed, invalid email address.</p>";
            }
            if ($_GET["error"] == "passwordsdontmatch") {
                echo "<p>Sign up failed, passwords don't match.</p>";
            }
            if ($_GET["error"] == "stmtfailed") {
                echo "<p>Sign up failed, something went wrong. Try again!</p>";
            }
            if ($_GET["error"] == "emailaddressalreadyexists") {
                echo "<p>Sign up failed, email address already exists.</p>";
            }
            if ($_GET["error"] == "none") {
                echo "<p>Sign up successful!</p>";
            }
        }
        ?>
    </div>

    <script src="assets/js/app.js"></script>
</main>

<?php
include_once 'footer.php';
?>