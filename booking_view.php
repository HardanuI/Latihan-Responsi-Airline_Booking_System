<?php
session_start();
include "koneksi.php";

// Hanya user biasa yang boleh booking
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: login_view.php");
    exit;
}

// Validasi ID penerbangan
if (!isset($_GET['id'])) {
    echo "ID penerbangan tidak ditemukan.";
    exit;
}

$id = $_GET['id'];
$query = $koneksi->query("SELECT * FROM penerbangan WHERE id_penerbangan = $id");

if ($query->num_rows == 0) {
    echo "Data penerbangan tidak ditemukan.";
    exit;
}

$flight = $query->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pemesanan Tiket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

    <h2>Pemesanan Tiket Pesawat</h2>
    <hr>

    <div class="card p-3 shadow-sm mb-4">
        <h4><?= $flight['kode_penerbangan'] ?> - <?= $flight['maskapai'] ?></h4>

        <p><strong>Rute:</strong> <?= $flight['asal'] ?> → <?= $flight['tujuan'] ?></p>
        <p><strong>Keberangkatan:</strong> <?= $flight['tanggal_berangkat'] ?> <?= $flight['jam_berangkat'] ?></p>
        <p><strong>Kedatangan:</strong> <?= $flight['tanggal_sampai'] ?> <?= $flight['jam_sampai'] ?></p>
        <p><strong>Kursi Tersedia:</strong> <?= $flight['kursi_tersedia'] ?></p>
        <p><strong>Harga Tiket:</strong> Rp <?= number_format($flight['harga']) ?></p>
    </div>

    <?php if ($flight['kursi_tersedia'] > 0): ?>

    <form action="booking_proses.php" method="POST" class="card p-3 shadow-sm">

        <input type="hidden" name="id_penerbangan" value="<?= $flight['id_penerbangan'] ?>">
        <input type="hidden" name="harga" value="<?= $flight['harga'] ?>">

        <div class="mb-3">
            <label class="form-label">Jumlah Tiket</label>
            <input type="number" name="jumlah_tiket" class="form-control"
                   min="1" max="<?= $flight['kursi_tersedia'] ?>" required>
        </div>

        <button class="btn btn-primary w-100">Pesan Sekarang</button>
    </form>

    <?php else: ?>

        <div class="alert alert-danger">Maaf, kursi sudah habis!</div>

    <?php endif; ?>

    <a href="dashboard.php" class="btn btn-secondary mt-3">Kembali</a>

</div>

</body>
</html>
