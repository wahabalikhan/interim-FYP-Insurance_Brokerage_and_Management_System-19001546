<?php
include_once 'header.php';
?>

<main>
    <h1>Log in</h1>
    <p>This is the login page of the IBMS</p>

    <div class="login-form">
        <form action="includes/login.inc.php" method="post"> <!-- action="includes/login.inc.php" is where user will be sent to when form submitted, using post method to hide sensitive data in URL but will still be passed-->

        <input type="text" name="email_address" placeholder="Email address">
        <input type="password" name="password" placeholder="Password">
        <button type="submit" name="submit">Log in</button>
        </form>
    </div>

    <script src="assets/js/app.js"></script>
</main>

<?php
include_once 'footer.php';
?>