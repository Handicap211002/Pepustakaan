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
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Berita Pertamina</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background-color: #162589;
      padding: 50px 20px;
    }

    .baca-berita {
      background-color: #ffffff;
      border-radius: 30px;
      max-width: 1200px;
      margin: 0 auto;
      padding: 60px 80px;
    }

    .judul-berita {
      text-align: center;
      font-size: 48px;
      font-weight: 700;
      margin-bottom: 50px;
      color: #000;
    }

    .gambar-berita {
      display: block;
      width: 100%;
      max-width: 862px;
      height: auto;
      border-radius: 28px;
      margin: 0 auto 60px auto;
    }

    .isi-berita {
      font-size: 20px;
      line-height: 1.7;
      color: #000;
      text-align: justify;
      padding: 0 20px;
    }

    .tombol-selesai {
      margin-top: 60px;
      display: flex;
      justify-content: center;
    }

    .tombol-selesai button {
      background-color: #162589;
      color: #ffffff;
      font-size: 24px;
      font-weight: 600;
      padding: 15px 40px;
      border-radius: 50px;
      cursor: pointer;
      border: none;
    }

    .tombol-selesai button:hover {
      opacity: 0.9;
    }

    .tombol-selesai a {
      background-color: #162589;
      color: #ffffff;
      font-size: 24px;
      font-weight: 600;
      padding: 15px 40px;
      border-radius: 50px;
      text-decoration: none;
      display: inline-block;
      transition: opacity 0.3s;
    }

    .tombol-selesai a:hover {
      opacity: 0.9;
    }
  </style>
</head>

<body>
  <div class="baca-berita">
    <h1 class="judul-berita">Jaksa Agung, Ahok, dan Korupsi Pertamina</h1>
    <img src="img/berita1.png" alt="Berita Pertamina" class="gambar-berita" />
    <div class="isi-berita">
      Dalam kasus korupsi tata kelola minyak mentah dan produk kilang di tubuh Pertamina yang dinyatakan oleh Jaksa
      Agung ST Burhanuddin sebagai salah satu perkara tersulit yang pernah ditangani Kejaksaan Agung karena mencakup
      periode panjang antara 2018 hingga 2023, minimnya saksi hidup, serta kesulitan menemukan bukti-bukti penting, nama
      Basuki Tjahaja Purnama atau Ahok—yang menjabat sebagai Komisaris Utama Pertamina sejak 2019—ikut mencuat ke
      permukaan bukan sebagai tersangka, melainkan sebagai saksi yang dipanggil oleh KPK untuk dimintai keterangan dalam
      kasus terpisah terkait pengadaan LNG tahun 2011–2021, yang juga menyeret mantan Direktur Utama Pertamina Karen
      Agustiawan dan menimbulkan pertanyaan besar dari publik tentang transparansi, integritas pejabat negara, serta
      seberapa dalam dan luas sebenarnya jaringan korupsi yang telah mengakar di tubuh perusahaan energi milik negara
      tersebut.
    </div>
    <div class="tombol-selesai">
      <a href="beritaterkini.php">Selesai</a>
    </div>

  </div>
</body>

</html>