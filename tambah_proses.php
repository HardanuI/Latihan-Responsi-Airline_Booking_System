<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $kode = $_POST['kode_penerbangan'];
    $maskapai = $_POST['maskapai'];
    $asal = $_POST['asal'];
    $tujuan = $_POST['tujuan'];
    $harga = $_POST['harga'];
    $kursi = $_POST['kursi_tersedia'];

    // memisah datetime-local (tanggal dan jam)
    $parts_berangkat = explode('T', $_POST['waktu_berangkat']);
    $tanggal_berangkat = $parts_berangkat[0];
    $jam_berangkat = $parts_berangkat[1];

    $parts_sampai = explode('T', $_POST['waktu_sampai']);
    $tanggal_sampai = $parts_sampai[0];
    $jam_sampai = $parts_sampai[1];

    $sql = "INSERT INTO penerbangan 
    (kode_penerbangan, maskapai, asal, tujuan, harga, kursi_tersedia, 
     tanggal_berangkat, jam_berangkat, tanggal_sampai, jam_sampai)
    VALUES (
        '$kode', '$maskapai', '$asal', '$tujuan', '$harga', '$kursi',
        '$tanggal_berangkat', '$jam_berangkat', '$tanggal_sampai', '$jam_sampai'
    )";

    if ($koneksi->query($sql)) {
        header("Location: dashboard.php");
        exit;
    } else {
        echo "SQL ERROR: " . $koneksi->error;
    }
}
?>
