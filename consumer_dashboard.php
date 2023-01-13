<?php
include_once 'header.php';
require_once 'includes/functions.inc.php';

if (isConsumer()) {
    header("location: consumer_dashboard.php");
}
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