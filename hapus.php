<?php
include "koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = $koneksi->prepare("DELETE FROM penerbangan WHERE id_penerbangan = ?");
    $query->bind_param("i", $id);
    $query->execute();

    header("Location: dashboard.php");
    exit;
} else {
    echo "ID tidak ditemukan.";
}
?>
