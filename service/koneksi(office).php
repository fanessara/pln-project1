<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "data_laporan_office_365";

$conn_office = mysqli_connect($host, $user, $pass, $db);

if (!$conn_office) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

?>