<?php
require_once("koneksi.php");

if (!isset($conn) || !$conn instanceof mysqli) {
    die("koneksi database gagal");
}

function generateCode($lenght = 10)
{
    $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWYXZ0123456789';
    return substr(str_shuffle($karakter), 0, $lenght);
}

$nama  = $_POST["nama"];
$nomor_tlp  = $_POST["nomor_tlp"];
$email  = $_POST["email"];
$alamat  = $_POST["alamat"];
$metode_pembayaran  = $_POST["metode_pembayaran"];
$konser_id  = $_POST["konser_id"];
$harga  = $_POST["harga"];
$codePesan  = generateCode();

if (is_null($konser_id)) {
    die('Data konser_id harus diisi.');
}


mysqli_query($conn, "INSERT INTO data_diri VALUES ('', '$nama', '$nomor_tlp', '$email', '$alamat')");


if (mysqli_affected_rows($conn) > 0) {
    echo 'Berhasil Membuat data';
}


$idTerakhir = getData($conn, "SELECT id FROM data_diri ORDER BY id DESC LIMIT 1");
$idTerakhir = $idTerakhir[0]["id"];

mysqli_query($conn, "INSERT INTO payment VALUES  ('','$idTerakhir','$codePesan', '$metode_pembayaran','$konser_id','pending','$harga')  ");


header("Location: ../metode_pembayaran.php?order_id=$codePesan");
if (mysqli_affected_rows($conn) > 0) {
    // BERHasil//
}
