<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tambah Penerbangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    body {
        margin: 0;
        padding: 0;
    }

    .back {
        background: grey;
        width: 100%;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .form-wrapper {
        width: 450px;
        background: white;
        padding: 20px 25px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        max-height: 90vh;
        overflow-y: auto; 
    }
</style>


<body>


    <div class="back">

    <div class="form-wrapper">
        <h2>Tambah Data Penerbangan</h2>
        <hr>

        <form action="tambah_proses.php" method="POST">

            <div class="mb-3">
                <label class="form-label">Kode Penerbangan</label>
                <input type="text" name="kode_penerbangan" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Maskapai</label>
                <input type="text" name="maskapai" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Kota Keberangkatan</label>
                <input type="text" name="asal" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Kota Kedatangan</label>
                <input type="text" name="tujuan" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Harga Tiket</label>
                <input type="number" name="harga" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Kursi Tersedia</label>
                <input type="number" name="kursi_tersedia" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Waktu Keberangkatan</label>
                <input type="datetime-local" name="waktu_berangkat" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Waktu Kedatangan</label>
                <input type="datetime-local" name="waktu_sampai" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success w-100 mb-2">Simpan</button>
            <a href="dashboard.php" class="btn btn-secondary w-100">Kembali</a>
        </form>
    </div>

</div>




</body>

</html>