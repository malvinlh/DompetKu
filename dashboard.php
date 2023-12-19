<?php
include('header.php');
checkUser();
include('user_header.php');
?>

<h2>Dashboard</h2>

<form action="logout.php" method="post">
    <button type="submit">Logout</button>
</form>

<?php
include('footer.php');
?>