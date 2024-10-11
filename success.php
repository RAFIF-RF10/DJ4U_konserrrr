<?php

require_once("backend-epim/service/koneksi.php");

$wery = $conn->query("SELECT id FROM payment ORDER BY id DESC LIMIT 1");
$row = $wery->fetch_assoc();
$lastid = $row['id'];

$hasilQuery = getData($conn, "SELECT * FROM payment WHERE id = '$lastid'");
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
    <img src="assets/icons/suksesygy.svg" alt="" style="padding-top: 50px;">
    <h1 style="color: #fff;">SUKSES</h1>
    <div class="payment-info">
      <div class="left">
        <?php foreach ($hasilQuery as $result) : ?>
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
        <p>12 Juni 2024</p>
      </div>
    <?php endforeach ?>
    </div>
    <h1 style="color: #fff;">Ticket Sudah Dikirim ke Email Anda</h1>
    <div class="button-payment">
      <button><a href="buy-ticket.php">Kembali</a></button>
    </div>
  </section>

  <script src="script.js"></script>
</body>

</html>