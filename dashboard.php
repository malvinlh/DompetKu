<?php
include ('header.php');
checkUser();
?>

<h2>Dashboard</h2>

<form action="logout.php" method="post">
    <button type="submit">Logout</button>
</form>

<?php
include('footer.php');
?>