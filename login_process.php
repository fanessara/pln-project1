<?php
session_start();
include "service/database.php";

if(isset($_POST['username']) && isset($_POST['password'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
        $_SESSION['login'] = true;
        $_SESSION['username'] = $username;
        echo "success";
    } else {
        echo "error";
    }
}
?>