<?php


include "koneksi.php";

if (!isset($_GET['id'])) {
    echo "ID tidak ditemukan.";
    exit;
}

$id = $_GET['id'];
$sql = "SELECT * FROM penerbangan WHERE id_penerbangan = $id";
$result = $koneksi->query($sql);

if ($result->num_rows == 0) {
    echo "Data tidak ditemukan.";
    exit;
}

$is_loggedin = isset($_SESSION['role']);
$user_role = $is_loggedin ? $_SESSION['role'] : 'guest';

$username = $is_loggedin ? $_SESSION['username'] : '';

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Film</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand " style="font-weight: bold" href="dashboard.php">Edit Penerbangan</a>
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

        <div>
            <div class="card p-2 mb-4 mx-auto" style="width: 500px">
                <h3>Edit Data Penerbangan</h3>
                <hr>
                <div class=" mb-4">
                    <div class="container mt-4">
                        <div class="row g-4">
                            <div>
                                <form method="POST" action="edit_proses.php">
                                    <input type="hidden" name="id_penerbangan" value="<?= $row['id_penerbangan'] ?>">

                                    <div class="mb-3">
                                        <label class="form-label">Nama Maskapai</label>
                                        <input type="text" class="form-control" name="nama_maskapai"
                                            value="<?= $row['maskapai'] ?>" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Kota Keberangkatan</label>
                                        <input type="text" class="form-control" name="kota_keberangkatan"
                                            value="<?= $row['asal'] ?>" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Kota Kedatangan</label>
                                        <input type="text" class="form-control" name="kota_kedatangan"
                                            value="<?= $row['tujuan'] ?>" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Waktu Keberangkatan</label>
                                        <input type="datetime-local" class="form-control" name="waktu_keberangkatan"
                                            value="<?= $row['tanggal_berangkat'] . 'T' . $row['jam_berangkat'] ?>" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Waktu Kedatangan</label>
                                        <input type="datetime-local" class="form-control" name="waktu_kedatangan"
                                            value="<?= $row['tanggal_sampai'] . 'T' . $row['jam_sampai'] ?>" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Harga Tiket</label>
                                        <input type="number" class="form-control" name="harga"
                                            value="<?= $row['harga'] ?>" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Total Kursi</label>
                                        <input type="number" class="form-control" name="total_kursi"
                                            value="<?= $row['kursi_tersedia'] ?>" required>
                                    </div>

                                    <center>
                                        <button type="submit" class="btn btn-success"
                                            style="width:250px;font-weight:bold;">
                                            Simpan Perubahan
                                        </button>
                                    </center>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

</body>

</html>