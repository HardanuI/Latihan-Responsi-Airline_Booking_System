<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: login_view.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    exit("Akses tidak valid!");
}

$id_user = $_SESSION['id_user'];        
$id_penerbangan = $_POST['id_penerbangan'];
$jumlah_tiket = intval($_POST['jumlah_tiket']);
$harga = intval($_POST['harga']);
$total_harga = $jumlah_tiket * $harga;

$cek = $koneksi->query("SELECT kursi_tersedia FROM penerbangan WHERE id_penerbangan = $id_penerbangan");
$data = $cek->fetch_assoc();

if ($jumlah_tiket > $data['kursi_tersedia']) {
    echo "Jumlah tiket melebihi kapasitas!";
    exit;
}

$stmt = $koneksi->prepare("
    INSERT INTO pemesanan (id_user, id_penerbangan, jumlah_tiket, total_harga, tanggal_booking)
    VALUES (?, ?, ?, ?, NOW())
");
$stmt->bind_param("iiii", $id_user, $id_penerbangan, $jumlah_tiket, $total_harga);
$stmt->execute();

$id_pemesanan = $koneksi->insert_id;

$kode_booking = "BK" . date("Ymd") . "-" . $id_pemesanan;

$koneksi->query("UPDATE pemesanan SET kode_booking = '$kode_booking' WHERE id_pemesanan = $id_pemesanan");

$sisa_kursi = $data['kursi_tersedia'] - $jumlah_tiket;
$koneksi->query("UPDATE penerbangan SET kursi_tersedia = $sisa_kursi WHERE id_penerbangan = $id_penerbangan");

header("Location: dashboard.php?pesanan_sukses=1");
exit;
?>
