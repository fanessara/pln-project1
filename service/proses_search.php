<?php

$resultData = null;
$errorSearch = "";

if (isset($_GET['cari'])) {

    $search = trim($_GET['search_ba']);

    if ($search == "") {
        $errorSearch = "Nomor BA tidak boleh kosong!";
    } else {

        $search = mysqli_real_escape_string($conn, $search);

        $queryData = "SELECT * FROM user 
                      WHERE no_ba LIKE '%$search%' 
                      ORDER BY id DESC";

        $resultData = mysqli_query($conn, $queryData);
    }
}