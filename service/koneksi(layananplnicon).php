<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "data_layanan_pln_icon+";

$conn_icon = mysqli_connect($host, $user, $pass, $db);

if (!$conn_icon) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

?>