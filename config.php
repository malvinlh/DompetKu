<?php
// koneksi database
$db_server = "localhost";
$db_username = "root";
$db_password = "";
$db_database = "fp_pweb"; // ganti nama database di sini
$conn = mysqli_connect($db_server, $db_username, $db_password, $db_database);
if (!$conn) {
	die("koneksi error");
}
session_start()
?>