<?php
include_once 'header.php';
?>

<main>
    <h1>Sign up</h1>
    <p>This is the signup page of the IBMS</p>

    <div class="signup-form">
        <form action="includes/signup.inc.php" method="POST"> <!-- action="includes/signup.inc.php" is where user will be sent to when form submitted, using post method to hide sensitive data in URL but will still be passed-->

        <input type="text" name="consumer_fullname" placeholder="Fullname">
        <input type="text" name="consumer_email_address" placeholder="Email address">
        <input type="password" name="consumer_password" placeholder="Password">
        <input type="password" name="consumer_password_repeat" placeholder="Repeat password"> <!-- type="password" ensures that password cannot be seen when typing in-->

        <input type="text" name="consumer_phone_number" placeholder="Phone number">
        <input type="text" name="consumer_address" placeholder="Address">
        <button type="submit" name="submit">Sign up</button>
        </form>
    </div>

    <script src="assets/js/app.js"></script>
</main>

<?php
include_once 'footer.php';
?>