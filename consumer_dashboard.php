<?php
# Code adapted from https://www.youtube.com/watch?v=gCo6JqGMi30, How To Create A Login System In PHP For Beginners | Procedural MySQLi | PHP Tutorial
include_once 'header.php';
?>

<main>
<?php
        # error-handling messages
        # GET to check for data we can see
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "none") {
                echo "<p>Sign up successful!</p>";
            }
        }
        ?>
    <h1>Hi Consumer, welcome to your dashboard</h1>
    <p>This is the consumer dashboard page of the IBMS</p>
    <script src="assets/js/app.js"></script>
</main>

<?php
include_once 'footer.php';
?>

</html>