<?php
include_once 'header.php';
require_once 'includes/admin.functions.inc.php';

if (isAdmin()) {
    header("location: admin.php");
}
?>

<main>
    <div class="container">
        <h1>Hi <?php while ($row = mysqli_fetch_array($records)) {
                    echo $row['admin_fullname'];
                } ?>, welcome to the admin panel</h1>
        <h2 class="panel-heading">Consumer panel</h2>
        <p class="heading">Add user</p>
        <table>
            <tr>
                <th>Consumer fullname</th>
                <th>Consumer email</th>
                <th>Consumer password</th>
                <th>Consumer phone number</th>
                <th>Consumer address</th>
            </tr>
            <?php
            echo "<tr><form action='includes/insert.inc.php' method='POST'>
            <td><input type=text name=consumer_fullname value='" . $row["consumer_fullname"] . "'></td>
            <td><input type=text name=consumer_email value='" . $row["consumer_email"] . "'></td>
            <td><input type=text name=consumer_password value='" . $row["consumer_password"] . "'></td>
            <td><input type=text name=consumer_phone value='" . $row["consumer_phone"] . "'></td>
            <td><input type=text name=consumer_address value='" . $row["consumer_address"] . "'></td>
            <td><input type=hidden name=user_level value='" . $row["user_level"] . "'></td>
            <input type=hidden name=consumer_id value='" . $row["consumer_id"] . "'>
            <td><input type='submit' name='add-consumer' value='Add'></td>
            </form><tr>";
            ?>
        </table>
        <?php
        $sql = "SELECT * FROM consumers";
        $records = mysqli_query($conn, $sql);
        ?>
        <p class="heading">Update consumers</p>
        <table>
            <tr>
                <th>Consumer fullname</th>
                <th>Consumer email</th>
                <th>Consumer password</th>
                <th>Consumer phone number</th>
                <th>Consumer address</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_array($records)) {
                echo "<tr><form action='includes/admin.update.inc.php' method='POST'>
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
        <?php
        $sql = "SELECT * FROM consumers";
        $records = mysqli_query($conn, $sql);
        ?>
        <p class="heading">Remove users</p>
        <table>
            <tr>
                <th>Consumer fullname</th>
                <th>Consumer email</th>
                <th>Consumer password</th>
                <th>Consumer phone number</th>
                <th>Consumer address</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_array($records)) {
                echo "<tr><td>" . $row['consumer_fullname'] . "</td>
                            <td>" . $row['consumer_email'] . "</td>
                            <td>" . $row['consumer_password'] . "</td>
                            <td>" . $row['consumer_phone'] . "</td>
                            <td>" . $row['consumer_address'] . "</td>
                            <td>" . $row['user_level'] . "</td>
                            <td><a class='delete' href=includes/delete.inc.php?consumer_id=" . $row['consumer_id'] . ">Delete</a></td>
                            <tr>";
            }
            ?>
        </table>
        <script src="assets/js/app.js"></script>
    </div>
</main>

<?php
include_once 'footer.php';
?>

</html>