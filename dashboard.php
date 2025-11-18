<?php
session_start();

include 'koneksi.php';
$flights = $koneksi->query("SELECT * FROM penerbangan ORDER BY tanggal_berangkat ASC");

if (!$flights) {
    die("SQL Error: " . $koneksi->error);
}



$is_loggedin = isset($_SESSION['role']);
$user_role = $is_loggedin ? $_SESSION['role'] : 'guest';

$username = $is_loggedin ? $_SESSION['username'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard | Airline Booking System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <style>
        .container {
            margin-top: 20px;
        }

        .alert-access {
            margin-top: 15px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand " style="font-weight: bold" href="dashboard.php">Airline Booking System</a>
            <div class="d-flex">
                <?php if ($is_loggedin): ?>
                    <span class="navbar-text me-3">
                        Halo, <?php echo $username; ?> (<?php echo ($user_role); ?>)
                    </span>
                    <a href="logout.php" class="btn btn-light">Logout</a>
                <?php else: ?>
                    <a href="login_view.php" class="btn btn-light">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="container">

        <?php if ($user_role === 'admin'): ?>

            <div class="card p-3 mb-4">
                <h3>Manajemen Penerbangan</h3>
                <hr>
                <a href="tambah_view.php" class="btn btn-success my-3" style="width: fit-content;">+Tambah Penerbangan</a>
                <div class=" mb-4">
                    <div class="container mt-4">
                        <div class="row g-4">

                            <?php while ($row = $flights->fetch_assoc()): ?>

                                <div class="col-md-4">
                                    <div class="card shadow-sm border-1 mb-5 bg-body-secondary">
                                        <div class="card-body">

                                            <h5 class="fw-bold">
                                                <?= $row['kode_penerbangan'] ?> - <?= $row['maskapai'] ?>
                                            </h5>

                                            <p class="mb-1"><strong>Rute:</strong> <?= $row['asal'] ?> → <?= $row['tujuan'] ?>
                                            </p>
                                            <p class="mb-1"><strong>Keberangkatan:</strong> <?= $row['tanggal_berangkat'] ?>
                                                <?= $row['jam_berangkat'] ?>
                                            </p>
                                            <p class="mb-1"><strong>Kedatangan:</strong> <?= $row['tanggal_sampai'] ?>
                                                <?= $row['jam_sampai'] ?>
                                            </p>
                                            <p class="mb-1"><strong>Kursi Tersedia:</strong> <?= $row['kursi_tersedia'] ?></p>
                                            <p class="mb-2"><strong>Harga:</strong> Rp <?= number_format($row['harga']) ?></p>
                                            <div class="d-flex justify-content-between gap-2">
                                                <a href="edit_view.php?id=<?= $row['id_penerbangan'] ?>"
                                                    class="btn btn-primary w-50">
                                                    Edit
                                                </a>

                                                <a href="hapus.php?id=<?= $row['id_penerbangan'] ?>"
                                                    class="btn btn-danger w-50"
                                                    onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                    Hapus
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            <?php endwhile; ?>

                        </div>
                    </div>
                </div>
            </div>

            <div class="card p-3">
                <h3>Semua Pemesanan</h3>
                <hr>
                <?php
                $queryAdmin = $koneksi->query("SELECT p.*, u.username, f.kode_penerbangan, f.maskapai, f.asal, f.tujuan,
                            f.tanggal_berangkat, f.jam_berangkat FROM pemesanan p JOIN users u ON p.id_user = u.id_user
                            JOIN penerbangan f ON p.id_penerbangan = f.id_penerbangan
                            ORDER BY p.tanggal_booking DESC");

                if ($queryAdmin->num_rows == 0) {
                    echo "<p class='text-muted'>Belum ada pemesanan.</p>";
                } else {
                    ?>

                    <table class="table table-bordered mt-3">
                        <thead class="table-primary">
                            <tr>
                                <th>Kode Booking</th>
                                <th>Username</th>
                                <th>Penerbangan</th>
                                <th>Rute</th>
                                <th>Keberangkatan</th>
                                <th>Jumlah Tiket</th>
                                <th>Total Harga</th>
                                <th>Tanggal Booking</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($psn = $queryAdmin->fetch_assoc()): ?>
                                <tr>
                                    <td><?= $psn['kode_booking'] ?></td>
                                    <td><?= $psn['username'] ?></td>
                                    <td><?= $psn['kode_penerbangan'] ?> - <?= $psn['maskapai'] ?></td>
                                    <td><?= $psn['asal'] ?> → <?= $psn['tujuan'] ?></td>
                                    <td><?= $psn['tanggal_berangkat'] . " " . $psn['jam_berangkat'] ?></td>
                                    <td><?= $psn['jumlah_tiket'] ?></td>
                                    <td>Rp <?= number_format($psn['total_harga']) ?></td>
                                    <td><?= $psn['tanggal_booking'] ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>

                <?php } ?>


            </div>


        <?php elseif ($user_role === 'user'): ?>

            <div class="card p-3 mb-4">
                <h3>Pesan Tiket Pesawat</h3>
                <hr>
                <div class="container mt-4">
                    <div class="row g-4">

                        <?php while ($row = $flights->fetch_assoc()): ?>

                            <div class="col-md-4">
                                <div class="card shadow-sm border-1 mb-5 bg-body-secondary">
                                    <div class="card-body">

                                        <h5 class="fw-bold">
                                            <?= $row['kode_penerbangan'] ?> - <?= $row['maskapai'] ?>
                                        </h5>

                                        <p class="mb-1"><strong>Rute:</strong> <?= $row['asal'] ?> → <?= $row['tujuan'] ?>
                                        </p>
                                        <p class="mb-1"><strong>Keberangkatan:</strong> <?= $row['tanggal_berangkat'] ?>
                                            <?= $row['jam_berangkat'] ?>
                                        </p>
                                        <p class="mb-1"><strong>Kedatangan:</strong> <?= $row['tanggal_sampai'] ?>
                                            <?= $row['jam_sampai'] ?>
                                        </p>
                                        <p class="mb-1"><strong>Kursi Tersedia:</strong> <?= $row['kursi_tersedia'] ?></p>
                                        <p class="mb-2"><strong>Harga:</strong> Rp <?= number_format($row['harga']) ?></p>

                                        <a href="booking_view.php?id=<?= $row['id_penerbangan'] ?>"
                                            class="btn btn-primary w-100">
                                            Pesan Tiket
                                        </a>

                                    </div>
                                </div>
                            </div>

                        <?php endwhile; ?>

                    </div>
                </div>
            </div>




            <div class="card p-3">
                <h3>Pemesanan Saya</h3>
                <hr>
                <?php
                $id_user = $_SESSION['id_user'];

                $queryPemesanan = $koneksi->query("SELECT p.*, f.kode_penerbangan, f.maskapai, f.asal, f.tujuan, 
                                f.tanggal_berangkat, f.jam_berangkat FROM pemesanan p
                                JOIN penerbangan f ON p.id_penerbangan = f.id_penerbangan
                                WHERE p.id_user = $id_user
                                ORDER BY p.tanggal_booking DESC");

                if ($queryPemesanan->num_rows == 0) {
                    echo "<p class='text-muted'>Belum ada pemesanan.</p>";
                } else {
                    ?>

                    <table class="table table-bordered mt-3">
                        <thead class="table-primary">
                            <tr>
                                <th>Kode Booking</th>
                                <th>Penerbangan</th>
                                <th>Rute</th>
                                <th>Keberangkatan</th>
                                <th>Jumlah Tiket</th>
                                <th>Total Harga</th>
                                <th>Tanggal Booking</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php while ($psn = $queryPemesanan->fetch_assoc()): ?>
                                <tr>
                                    <td><?= $psn['kode_booking'] ?></td>
                                    <td><?= $psn['kode_penerbangan'] ?> - <?= $psn['maskapai'] ?></td>
                                    <td><?= $psn['asal'] ?> → <?= $psn['tujuan'] ?></td>
                                    <td><?= $psn['tanggal_berangkat'] . " " . $psn['jam_berangkat'] ?></td>
                                    <td><?= $psn['jumlah_tiket'] ?></td>
                                    <td>Rp <?= number_format($psn['total_harga']) ?></td>
                                    <td><?= $psn['tanggal_booking'] ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>

                <?php } ?>

            </div>

        <?php else: ?>

            <h2 class="mb-4">Selamat Datang di Airline Booking System</h2>
            <div class="alert alert-info">
                Anda saat ini mengakses sebagai tamu. Silakan <a href="login_view.php">Login</a> untuk mulai memesan
                tiket.
            </div>

            <div class="card p-3">
                <h3>Daftar Penerbangan Tersedia</h3>
                <p>Daftar Penerbangan (tanpa tombol pesan)</p>
            </div>

        <?php endif; ?>

</body>

</html>