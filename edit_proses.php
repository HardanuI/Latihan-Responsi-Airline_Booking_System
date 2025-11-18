<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    if (empty($_POST['id_penerbangan'])) {
        echo "<p>ERROR: id_penerbangan TIDAK TERKIRIM</p>";
        exit;
    }

    $id_penerbangan = $_POST['id_penerbangan'];
    $maskapai = $_POST['nama_maskapai'];
    $asal = $_POST['kota_keberangkatan'];
    $tujuan = $_POST['kota_kedatangan'];
    $harga = $_POST['harga'];
    $kursi_tersedia = $_POST['total_kursi'];

    // Pisah datetime
    list($tanggal_berangkat, $jam_berangkat) = explode('T', $_POST['waktu_keberangkatan']);
    list($tanggal_sampai, $jam_sampai) = explode('T', $_POST['waktu_kedatangan']);

    $sql = "
        UPDATE penerbangan SET 
            maskapai='$maskapai',
            asal='$asal',
            tujuan='$tujuan',
            harga='$harga',
            kursi_tersedia='$kursi_tersedia',
            tanggal_berangkat='$tanggal_berangkat',
            jam_berangkat='$jam_berangkat',
            tanggal_sampai='$tanggal_sampai',
            jam_sampai='$jam_sampai'
        WHERE id_penerbangan='$id_penerbangan'
    ";

    echo "<p>QUERY:</p>";
    echo "<pre>$sql</pre>";

    if ($koneksi->query($sql)) {
        header("Location: dashboard.php");
    } else {
        echo "<p>SQL ERROR:</p>";
        echo $koneksi->error;
    }

    exit;
}


?>