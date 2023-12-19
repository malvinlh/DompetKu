<?php
include ('header.php');
if(isset($_POST['login']))
{
    $username = get_safe_value($_POST['username']);
    $password = get_safe_value($_POST['password']);

    $res = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");

    if(mysqli_num_rows($res) > 0)
    {
        $row = mysqli_fetch_assoc($res);
        $_SESSION['UID'] = $row['user_id'];     // disesuaikan dengan nama atribut tabel users
        $_SESSION['UName'] = $row['username'];  // disesuaikan dengan nama atribut tabel users
        redirect('dashboard.php');
    }
    else
    {
        echo "Please enter correct login details";
    }
}
?>

<h2>Login</h2>
<form method="post">
    <table>
        <tr>
            <td>Username:</td>
            <td><input type="text" name="username" required></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><input type="text" name="password" required></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" name="login" value="Login"></td>
        </tr>
    </table>
</form>


<?php
include('footer.php');
?>