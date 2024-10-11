<?php

require "service/koneksi.php";

if ($conn->connect_error) {
    die('koneksi error: ' . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'] ?? '';
    $nomor_tlp = $_POST['nomor_tlp'] ?? '';
    $email = $_POST['email'] ?? '';
    $alamat = $_POST['alamat'] ?? '';

    $query = "INSERT INTO data_diri (nama, nomor_tlp, email, alamat) VALUES ('$nama', '$nomor_tlp', '$email', '$alamat')";

    if ($conn->query($query) === TRUE) {
        echo "Data berhasil ditambahkan";
    }

    $metode = $_POST['metode_pembayaran'] ?? '';
    $konser_id = $_POST['konser_id'] ?? '';
    $kelas = $_POST['kelas'] ?? ''; // Pastikan kelas ada sebelum mengaksesnya
    $harga = $_POST['harga'] ?? '';

    function generateCode($panjang = 10)
    {
        $karakter = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        return substr(str_shuffle($karakter), 0, $panjang);
    }

    $codePesanan = generateCode();

    $result = $conn->query("SELECT id FROM data_diri ORDER BY id DESC LIMIT 1");
    $row = $result->fetch_assoc();
    $idTerakhir = $row['id'];

    $asasi = "INSERT INTO payment (data_diri_id, konser_id, code_pemesanan, kelas, metode_pembayaran, status, total_harga) 
              VALUES ('$idTerakhir', '$konser_id', '$codePesanan', '$kelas', '$metode', 'pending', '$harga')";

    $kurangStock = kurangiStock($konser_id);

    if ($conn->query($asasi) === TRUE) {
        echo "Data berhasil ditambahkan";
    } else {
        die("Error inserting into payment: " . $conn->error);
    }

    if ($metode === 'dana' || $metode === 'paypal') {
        header("Location: ../bayarGopay.php");
    } else if ($metode === 'indomaret' || $metode === 'alfamart') {
        header("Location: ../bayarAlfaindo.php");
    }
} else {
    echo "ERROR: " . $query . "<br>" . $conn->connect_error;
}
