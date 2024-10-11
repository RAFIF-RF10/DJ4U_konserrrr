<?php
include("backend-epim/service/koneksi.php");

$hasilQuery = getData($conn, "SELECT * FROM konser WHERE id=1");
$hasilQuery2 = getData($conn, "SELECT * FROM konser WHERE id=2");
$hasilQuery3 = getData($conn, "SELECT * FROM konser WHERE id= 3");

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style.css" />
  <title>Buy Ticket</title>
</head>

<body>
  <a href="index.php" class="kembali"><button class="btn-biru">KEMBALI</button></a>
  <section class="seat">
    <div class="filter"></div>
    <img src="assets/image/seatmap.png" alt="" />
  </section>
  <section class="ticket-info">
    <div class="blur"></div>
    <div class="title">
      <img src="assets/icons/OrangeRicky.png" alt="">
      JAKARTA
      <img src="assets/icons/OrangeRicky.png" alt="" style="transform: rotateY(180deg) translateY(-6px);">
    </div>
    <div class="info">
      <div class="tanggal">
        <img src="assets/icons/kalender.svg" alt="" />
        14 OKTOBER 2024, 20.00 WIB
      </div>
      <div class="lokasi">
        <img src="assets/icons/lok.svg" alt="" />
        Jakarta International Stadium, Papanggo, Tanjung Priok Jakarta
      </div>
    </div>
    <div class="countdownTimer" data-target="2024-10-14T20:00:00">
      <div class="kotak hari">
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
  </section>
  <section class="ticket-list">
    <div class="ticketClass">
      <?php foreach ($hasilQuery as $result) : ?>
        <div class="classLabel"><?= $result['kelas'] ?></div>
        <div class="ticket-stock">
          <div>STOCK</div>
          <div><?= $result['jumlah_tiket'] ?></div>
        </div>
        <div class="ticket-price">
          <div>PRICE</div>
          <div><?= $result['harga'] ?></div>
        </div>
        <a href=""><button class="btn-biru" onclick="buyTicket(this)" id="buyTicket" data-ticket-harga="<?= $result['harga'] ?>" data-ticket-id="<?= $result['id'] ?>" data-ticket-class="<?= $result['kelas'] ?>">BUY TICKET</button></a>
    </div>
  <?php endforeach ?>
  <div class="ticketClass">
    <?php foreach ($hasilQuery2 as $result) : ?>
      <div class="classLabel">Class <?= $result['kelas'] ?></div>
      <div class="ticket-stock">
        <div>STOCK</div>
        <div><?= $result['jumlah_tiket'] ?></div>
      </div>
      <div class="ticket-price">
        <div>PRICE</div>
        <div><?= $result['harga'] ?></div>
      </div>
      <a href=""><button class="btn-biru" onclick="buyTicket(this)" id="buyTicket" data-ticket-harga="<?= $result['harga'] ?>" data-ticket-id="<?= $result['id'] ?>" data-ticket-class="<?= $result['kelas'] ?>">BUY TICKET</button></a>
  </div>
<?php endforeach ?>
<div class="ticketClass">
  <?php foreach ($hasilQuery3 as $result) : ?>
    <div class="classLabel">Class <?= $result['kelas'] ?></div>
    <div class="ticket-stock">
      <div>STOCK</div>
      <div><?= $result['jumlah_tiket'] ?></div>
    </div>
    <div class="ticket-price">
      <div>PRICE</div>
      <div><?= $result['harga'] ?></div>
    </div>
    <a href=""><button class="btn-biru" onclick="buyTicket(this)" id="buyTicket" data-ticket-harga="<?= $result['harga'] ?>" data-ticket-id="<?= $result['id'] ?>" data-ticket-class="<?= $result['kelas'] ?>">BUY TICKET</button></a>
</div>
<?php endforeach ?>
  </section>

  <div class="form-wrapper" id="formDataDiriWrapper">

  </div>

  <footer class="footer">
    <div class="f-ftr"></div>
    <div class="t-footer">
      <img src="http://localhost/DJ4U_konserrrr/assets/image/arrow-l.png" alt="" />
      <h1 style="margin: 10px;">DJ4U</h1>
      <img src="http://localhost/DJ4U_konserrrr/assets/image/arrow-l.png" alt="" style="transform: rotateY(180deg);" />
    </div>
    <div class="f-icons">
      <a href=""><img src="http://localhost/DJ4U_konserrrr/assets/icons/instagram.svg" alt=""></a>
      <a href=""><img src="http://localhost/DJ4U_konserrrr/assets/icons/spotify.svg" alt=""></a>
      <a href=""><img src="http://localhost/DJ4U_konserrrr/assets/icons/youtube.svg" alt=""></a>
      <a href=""><img src="http://localhost/DJ4U_konserrrr/assets/icons/twitter-x.svg" alt=""></a>
    </div>
    <div class="f-copyright">Copyright © 2024 DJ4U Indonesia </div>
  </footer>

  <script src="script.js"></script>
</body>

</html>