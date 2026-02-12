<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "data_simcard_apn";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

?>