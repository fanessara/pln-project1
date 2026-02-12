<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "data_laporan_office_365";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

?>