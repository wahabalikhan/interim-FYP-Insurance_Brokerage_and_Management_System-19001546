<?php
include_once 'header.php';
if (empty($_GET['status'])) {
    session_destroy();
    header('Location:index.php?status=1');
    exit;
}

?>

<main>
    <div class="container">
        <h1>Insurance Brokerage and Management System</h1>
        <p>This is the home page of the IBMS</p>
        <script src="assets/js/app.js"></script>
    </div>
</main>

<?php
include_once 'footer.php';
?>

</html>