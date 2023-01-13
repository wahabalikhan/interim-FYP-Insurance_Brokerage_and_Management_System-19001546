<?php
# Code adapted from https://www.youtube.com/watch?v=gCo6JqGMi30, How To Create A Login System In PHP For Beginners | Procedural MySQLi | PHP Tutorial
include_once 'header.php';
require_once 'includes/functions.inc.php';

if (isConsumer()) {
    header("location: profile.php");
}

?>

<main>
    <div class="container">
        <h1>Hi <?php while ($row = mysqli_fetch_array($records)) {
                    echo $row['consumer_fullname'];
                } ?>, welcome to your profile page</h1>
        <br>
        <p>Your current details</p>
        <br>
        <p>Update personal details</p>
        <br>
        <?php
        $sql = "SELECT * FROM consumers";
        $records = mysqli_query($conn, $sql);
        ?>
        <p class="heading">Update users</p>
        <table>
            <tr>
                <th>Fullname</th>
                <th>Email address</th>
                <th>Password</th>
                <th>Phone number</th>
                <th>Address</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_array($records)) {
                echo "<tr><form action='includes/update.consumer.inc.php' method='POST'>
                            <td><input type=text name=consumer_fullname value='" . $row["consumer_fullname"] . "'></td>
                            <td><input type=text name=consumer_email value='" . $row["consumer_email"] . "'></td>
                            <td><input type=text name=consumer_password value='" . $row["consumer_password"] . "'></td>
                            <td><input type=text name=consumer_phone value='" . $row["consumer_phone"] . "'></td>
                            <td><input type=text name=consumer_address value='" . $row["consumer_address"] . "'></td>
                            <td><input type=hidden name=user_level value='" . $row["user_level"] . "'></td>
                            <input type=hidden name=consumer_id value='" . $row["consumer_id"] . "'>
                            <td><input type='submit' value='Update'></td>
                            </form><tr>";
            }
            ?>
        </table>
    </div>
</main>

<script src="assets/js/app.js"></script>

<?php
include_once 'footer.php';
?>