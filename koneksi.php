<?php

$hostname = "localhost";
$port = "3306";
$username = "root";
$password = "";
$database = "latres";

$koneksi = null;
try{
    $koneksi = new mysqli($hostname, $username, $password, $database, $port);
}catch(mysqli_sql_exception $e){
    die("Koneksi gagal: " . $e->getMessage());
}

?>

