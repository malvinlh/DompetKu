<?php
include('header.php');
checkUser();
include('user_header.php');

if (isset($_GET['type']) && $_GET['type'] == 'delete' && isset($_GET['category_id']) && $_GET['category_id'] > 0) {
    echo $id = get_safe_value($_GET['category_id']);

}

$res = mysqli_query($conn, "SELECT * FROM category");
?>

<h2>Category</h2>

<?php if (mysqli_num_rows($res) > 0) { ?>

    <table>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td></td>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($res)) { ?>
            <tr>
                <td>
                    <?php echo $row['category_id']; ?>
                </td>
                <td>
                    <?php echo $row['category_name']; ?>
                </td>
                <td>
                    <a href="">Edit</a>&nbsp;
                    <a href="type=delete&category_id=<?php echo $row['category_id']; ?>">Delete</a>
                </td>
            </tr>
            <?php
        } ?>
    </table>
<?php } else {
    echo "No data found";
} ?>

<form action="logout.php" method="post">
    <button type="submit">Logout</button>
</form>

<?php
include('footer.php');
?>