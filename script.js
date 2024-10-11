//nav blur
const navbar = document.getElementById('navbar');

if (navbar) {
  window.addEventListener('scroll', function () {
    if (window.scrollY > window.innerHeight) {
      navbar.classList.add('glassmorphism');
    } else {
      navbar.classList.remove('glassmorphism');
    }
  });
} else {
  console.log(new Date());
}

function countdown(element) {
  const dataDuration = element.getAttribute('data-duration');
  const targetDate = element.getAttribute('data-target');
  let target;
  if (dataDuration) {
    target = new Date().getTime() + dataDuration * 1000;
    console.log(target);
  } else {
    target = new Date(targetDate).getTime();
  }

  const hariEl = element.querySelector('.hari div');
  const jamEl = element.querySelector('.jam div');
  const menitEl = element.querySelector('.menit div');
  const detikEl = element.querySelector('.detik div');

  const interval = setInterval(() => {
    const now = new Date().getTime();
    const distance = target - now;

    if (distance < 0) {
      clearInterval(interval);
      console.log('abis ygy');
      return;
    }

    const hari = Math.floor(distance / (1000 * 60 * 60 * 24));
    const jam = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const menit = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const detik = Math.floor((distance % (1000 * 60)) / 1000);

    hariEl.textContent = hari;
    jamEl.textContent = jam;
    menitEl.textContent = menit;
    detikEl.textContent = detik;
  }, 1000);
}
document.querySelectorAll('.countdownTimer').forEach(countdown);

let slideSkarang = 0;

function lihatSlide(index) {
  const slide = document.querySelectorAll('.slide');
  const totalSlides = slide.length;

  if (index >= totalSlides) {
    slideSkarang = 0;
  } else if (index < 0) {
    slideSkarang = totalSlides - 1;
  } else {
    slideSkarang = index;
  }

  const carouselSlides = document.getElementById('slides');
  carouselSlides.style.transform = `translateX(-${slideSkarang * 100}%)`;
}

function nextSlide() {
  lihatSlide(slideSkarang + 1);
}

function prevSlide() {
  lihatSlide(slideSkarang - 1);
}

function closeForm() {
  const formData = document.getElementById('formDataDiriWrapper');
  formData.innerHTML = '';
}

function buyTicket(element) {
  const kelas = element.getAttribute('data-ticket-class');
  const konser_id = element.getAttribute('data-ticket-id');
  const harga = element.getAttribute('data-ticket-harga');

  const body = document.querySelector('#formDataDiriWrapper');
  element.addEventListener('click', function (e) {
    e.preventDefault();
    body.innerHTML = `
    <form action="backend-epim/data_diri.php" class="form-dataDiri" method="POST" id="formDataDiri">
    <h1>Lengkapi Data Diri Anda</h1>
    <a onclick="closeForm()" class="x">X</a>
    <div class="input-data">
        <label for="nama">Nama Lengkap</label>
        <input type="text" name="nama" id="nama" placeholder="Nama Lengkap" required>
        <label for="telp">Nomor Telepon</label>
        <input type="text" name="nomor_tlp" id="telp" placeholder="Nomor Telepon" required>
        <label for="email">Alamat Email</label>
        <input type="email" name="email" id="email" placeholder="Alamat Email" required>
        <label for="alamat">Alamat</label>
        <input type="text" name="alamat" id="alamat" placeholder="Alamat" required>
    </div>
    <input type="hidden" name="kelas" value="${kelas}">
    <input type="hidden" name="harga" value="${harga}">
    <input type="hidden" name="konser_id" value="${konser_id}">
    <div class="metode-pembayaran">
        <h1>Pilih Metode Pembayaran</h1>
        <select name="metode_pembayaran" id="metode_pembayaran">
            <option value="dana">Dana</option>
            <option value="paypal">Paypal</option>
            <option value="indomaret">Indomaret</option>
            <option value="alfamart">Alfamart</option>
        </select>
    </div>
    <center><button type="submit">Kirim</button></center>
</form>
    `;
  });
}

try {
  document.querySelectorAll('#buyTicket').forEach(buyTicket);
} catch (error) {
  console.log(error);
}
