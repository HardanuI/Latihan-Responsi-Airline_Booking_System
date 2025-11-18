<?php
session_start();
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($koneksi, 
        "SELECT * FROM users WHERE username='$username' AND password='$password'"
    );

    if (mysqli_num_rows($query) == 1) {

        $user = mysqli_fetch_assoc($query);

        $_SESSION['id_user']  = $user['id_user'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role']     = $user['role'];

        header("Location: dashboard.php");
        exit();
    } else {
        echo "<script>alert('Username atau password salah'); window.location='login_view.php';</script>";
    }
}
?>
