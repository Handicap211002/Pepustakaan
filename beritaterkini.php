<?php
session_start();
include 'connetdb.php';

// Cek apakah session username ada
if (!isset($_SESSION['username'])) {
  header('Location: login.php');
  exit;
}

// Cek apakah akun masih ada di database
$username = $_SESSION['username'];
$query = "SELECT * FROM akun WHERE NamaPengguna = '$username'";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) !== 1) {
  // Kalau akun udah gak ada di database
  session_unset(); // hapus semua session
  session_destroy(); // matikan session
  header('Location: login.php?error=Akun sudah dihapus.');
  exit;
}

// Pesan sukses
if (isset($_SESSION['success_message'])) {
  echo "<script>alert('" . addslashes($_SESSION['success_message']) . "');</script>";
  unset($_SESSION['success_message']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style/beritaterkini.css" />
  <title>Berita Terkini</title>
</head>

<body>
  <div class="beranda">
    <div class="navbar">
      <div class="nav-items">
        <a href='berandasetelahlogin.php' class="nav-link">Beranda</a>
        <a href="koleksibacaan.php" class="nav-link">Koleksi Bacaan</a>
        <a href="beritaterkini.php" class="nav-link active">Berita Terkini</a>
        <a href="manajemenbuku.php" class="nav-link">Manajemen Buku</a>
      </div>
      <div class="nav-profile">
        <img class="logoakun" src="svg/profil.svg" alt="Logoakun" onclick="window.location.href='userakun.php'" />
      </div>
    </div>

    <div class="search-container">
      <input type="text" id="searchBox" class="rectangle-1" placeholder="Telusuri..." />
      <img class="search" src="svg/search0.svg" />
    </div>

    <div class="slider-container">
      <div class="slider-wrapper" id="sliderWrapper">
        <!-- Semua berita jadi card -->

        <div class="card">
          <img src="img/berita1.png" alt="Berita 1" />
          <div class="text">
            <h4>Jaksa Agung, Ahok, dan Korupsi Pertamina</h4>
            <p>Dugaan korupsi tata kelola minyak mentah di anak perusahaan PT Pertamina, Subholding dan KKKS 2018–2023.</p>
            <a href="berita1.php">Selengkapnya...</a>
          </div>
        </div>

        <div class="card">
          <img src="img/berita2.png" alt="Berita 2" />
          <div class="text">
            <h4>Tom Lembong soal Salah Satu Hakimnya Terjerat Kasus Suap CPO</h4>
            <p>Ketua Satgas Tim Reformasi Hukum, Tom Lembong, menanggapi penahanan salah satu hakim terkait kasus suap minyak goreng (CPO)...</p>
            <a href="#">Selengkapnya...</a>
          </div>
        </div>

        <div class="card">
          <img src="img/berita3.png" alt="Berita 3" />
          <div class="text">
            <h4>Negara Kaya Minyak Jatuh dalam Krisis, Presiden Sebut Darurat Ekonomi</h4>
            <p>Presiden Kazakstan menyatakan negaranya dalam darurat ekonomi meski kaya minyak, akibat inflasi dan krisis sosial.</p>
            <a href="#">Selengkapnya...</a>
          </div>
        </div>

        <div class="card">
          <img src="img/berita4.png" alt="Berita 4" />
          <div class="text">
            <h4>Kuasa Hukum Pastikan Ijazah Jokowi Tak Pernah Hilang</h4>
            <p>Kuasa hukum Presiden Jokowi, Yusril Ihza Mahendra, menegaskan bahwa ijazah Jokowi asli dan tidak pernah hilang. Ia membantah tudingan ijazah palsu dan menyebutnya sebagai hoaks.</p>
            <a href="#">Selengkapnya...</a>
          </div>
        </div>

        <div class="card">
          <img src="img/berita5.png" alt="Berita 5" />
          <div class="text">
            <h4>PR Timnas Indonesia U-17 Sebelum Arungi Piala Dunia U-17</h4>
            <p>Timnas U-17 lolos ke Piala Dunia meski kalah 0-6 dari Korea Utara di Piala Asia. Masih banyak kekurangan yang harus dibenahi sebelum tampil di Qatar.</p>
            <a href="#">Selengkapnya...</a>
          </div>
        </div>

      </div>

      <button class="slider-btn prev-btn">&lt;</button>
      <button class="slider-btn next-btn">&gt;</button>
    </div>

    <footer class="footer">
      <div class="footer-top">
        <img src="img/logo.png" alt="Logo" class="logo-footer" />
        <div class="line"></div>
        <div class="footer-section">
          <h3>PERPUSTAKAAN ONLINE</h3>
          <p>
            Perpustakaan Merupakan Tempat Dimana Banyak Menyimpan Berbagai Macam Buku Ilmu
            Pengetahuan Yang Banyak Bermanfaat, Serta Tempat Banyak Melakukan Aktivitas Membaca
          </p>
        </div>
        <div class="footer-section usefull-links">
          <h3>Usefull Links</h3>
          <ul>
            <li>Beranda</li>
            <li>Koleksi Bacaan</li>
            <li>Berita Terkini</li>
            <li>Manajemen Buku</li>
            <li>Akun</li>
          </ul>
        </div>
        <div class="footer-section hubungi-kami">
          <h3>Hubungi Kami</h3>
          <p>PERPUSTAKAAN ONLINE<br />Tanjungpinang<br />Indonesia</p>
          <p>Phone : 081977549410</p>
          <p>Email : xxxxxxx@gmail.com</p>
          <div class="social-icons">
            <img src="svg/icon-twitter0.svg" alt="Twitter" />
            <img src="svg/icon-facebook0.svg" alt="Facebook" />
            <img src="svg/icon-instagram0.svg" alt="Instagram" />
            <img src="svg/icon-youtube0.svg" alt="YouTube" />
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <p>Copyright <span>PERPUSTAKAAN ONLINE</span> All Rights Reserved, 2025</p>
      </div>
    </footer>

  </div>

  <script>
    const sliderWrapper = document.getElementById('sliderWrapper');
    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');
    const searchBox = document.getElementById('searchBox');

    const scrollAmount = 320; // scroll per klik

    prevBtn.addEventListener('click', () => {
      sliderWrapper.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
    });

    nextBtn.addEventListener('click', () => {
      sliderWrapper.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    });

    searchBox.addEventListener('input', function () {
      const search = this.value.toLowerCase();

      const cards = sliderWrapper.querySelectorAll('.card');

      cards.forEach(card => {
        const title = card.querySelector('h4').innerText.toLowerCase();
        const paragraph = card.querySelector('p').innerText.toLowerCase();
        const combinedText = title + ' ' + paragraph;

        card.style.display = combinedText.includes(search) || search === '' ? '' : 'none';
      });
    });
  </script>
</body>

</html>
