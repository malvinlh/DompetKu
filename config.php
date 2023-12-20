<?php
// koneksi database
$db_server = "localhost";
$db_username = "root";
$db_password = "";
$db_database = "dailyexpense"; // ganti nama database di sini
$con = mysqli_connect($db_server, $db_username, $db_password, $db_database);
if (!$con) 
{
	die("Failed to connect to MySQL");
}
?>