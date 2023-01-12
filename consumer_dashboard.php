<?php
# Code adapted from https://www.youtube.com/watch?v=gCo6JqGMi30, How To Create A Login System In PHP For Beginners | Procedural MySQLi | PHP Tutorial
include_once 'header.php';
?>

<main>
    <div class="container">
        <?php
        # error-handling messages
        # GET to check for data we can see
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "none") {
                echo "<p>Sign up successful!</p>";
            }
        }
        ?>
        <h1>Hi <?php while ($row = mysqli_fetch_array($records)) {
                    echo $row['consumer_fullname'];
                } ?>, welcome to your dashboard</h1>
        <script src="assets/js/app.js"></script>
    </div>
</main>

<?php
include_once 'footer.php';
?>

</html>