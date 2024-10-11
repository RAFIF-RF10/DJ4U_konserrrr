<?php

require_once("backend-epim/service/koneksi.php");

$wery = $conn->query("SELECT id FROM payment ORDER BY id DESC LIMIT 1");
$row = $wery->fetch_assoc();
$lastid = $row['id'];

$hasilQuery = getData($conn, "SELECT * FROM payment WHERE id = '$lastid'");

if (isset($_POST["submit"])) {

  var_dump($_POST);

  $query = "UPDATE payment SET status = 'success' WHERE id = '$lastid'";

  if ($conn->query($query) === TRUE) {
    return true;
  }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>BELUM BAYAR</title>
</head>

<body>
  <section class="payment">
    <div class="filter"></div>
    <h1>BELUM BAYAR</h1>
    <p>Selesaikan Pembayaran Terlebih Dahulu Sebelum Waktu Habis, Tunjukkan laptop ke Kasir</p>
    <div class="countdownTimer" data-duration="28802">
      <div class="kotak hari" style="display: none;">
        <div>0</div>
        <p>HARI</p>
      </div>
      <div class="kotak jam">
        <div>0</div>
        <p>JAM</p>
      </div>
      <div class="kotak menit">
        <div>0</div>
        <p>MENIT</p>
      </div>
      <div class="kotak detik">
        <div>0</div>
        <p>DETIK</p>
      </div>
    </div>
    <?php foreach ($hasilQuery as $result) : ?>
      <form action="" method="POST">
        <div class="payment-info">
          <div class="left">
            <span>Tanggal Pembelian</span>
            <p id="tanggalges">01/07/2024</p>
            <span>Nomor Pesanan</span>
            <p><?= $result['kelas'] ?>-<?= $result['code_pemesanan'] ?></p>
            <span>Metode Pembayaran</span>
            <p><?= $result['metode_pembayaran'] ?></p>
            <span>Status Pembayaran</span>
            <p><?= $result['status'] ?></p>
          </div>
          <div class="mid"></div>
          <div class="right">
            <span>Ticket</span>
            <p>DJ4U JIS 2024</p>
            <span>Kelas</span>
            <p><?= $result['kelas'] ?></p>
            <span>Harga</span>
            <p>Rp. <?= $result['total_harga'] ?></p>
            <span>Tanggal Konser</span>
            <p><?= $lastid ?></p>
          </div>
        </div>
        <div class="button-payment">
          <button type="submit"><a href="success.php">Lanjutkan Pembayaran</a></button>
          <button><a href="buy-ticket.php">Kembali</a></button>
        </div>
      </form>
    <?php endforeach ?>
  </section>

  <script src="script.js"></script>
  <script>
    document.getElementById('tanggalges').textContent = new Date().getDate() + ' / ' + (new Date().getMonth() + 1) + ' / ' + new Date().getFullYear();
  </script>
</body>

</html>