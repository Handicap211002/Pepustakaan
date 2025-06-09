<?php
session_start();
include 'connetdb.php';

if (!isset($_SESSION['username'])) {
  header('Location: login.php');
  exit;
}

$username = $_SESSION['username'];
$query = "SELECT * FROM akun WHERE NamaPengguna = '$username'";
$result = mysqli_query($koneksi, $query);
if (mysqli_num_rows($result) !== 1) {
  session_unset();
  session_destroy();
  header('Location: login.php?error=Akun sudah dihapus.');
  exit;
}

if (isset($_SESSION['success_message'])) {
  echo "<script>alert('" . addslashes($_SESSION['success_message']) . "');</script>";
  unset($_SESSION['success_message']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Manajemen Buku</title>
  <link rel="stylesheet" href="./vars.css" />
  <link rel="stylesheet" href="style/manajemenbuku.css" />
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    a,
    button,
    input,
    select,
    h1,
    h2,
    h3,
    h4,
    h5 {
      border: none;
      background: none;
      text-decoration: none;
    }
    menu,
    ol,
    ul {
      list-style-type: none;
    }
  </style>
</head>
<body>
  <div class="beranda">
    <div class="navbar">
      <div class="nav-items">
        <a href="berandasetelahlogin.php" class="nav-link">Beranda</a>
        <a href="koleksibacaan.php" class="nav-link">Koleksi Bacaan</a>
        <a href="beritaterkini.php" class="nav-link">Berita Terkini</a>
        <a href="#" class="nav-link active">Manajemen Buku</a>
      </div>
      <div class="nav-profile">
        <img
          class="logoakun"
          src="svg/profile.svg"
          alt="Logoakun"
          onclick="window.location.href='userakun.php'"
        />
      </div>
    </div>

    <div class="manajemen-buku">
      <div class="tab-buttons">
        <button class="tab-button active" onclick="showTab('dipinjam')">
          Sedang Dipinjam
        </button>
        <button class="tab-button" onclick="showTab('riwayat')">
          Riwayat Peminjaman
        </button>
      </div>

      <!-- Sedang Dipinjam -->
      <div id="dipinjam" class="tab-content">
        <?php
        $NamaPengguna = $_SESSION['username'];
        $query = "SELECT * FROM buku WHERE NamaPengguna = ?";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param("s", $NamaPengguna);
        $stmt->execute();
        $result = $stmt->get_result();

        setlocale(LC_TIME, 'id_ID.UTF-8'); // Pastikan sistem mendukung locale Bahasa Indonesia

        while ($row = $result->fetch_assoc()):
          if (isset($row['waktupeminjaman'])) {
            $waktuPinjam = new DateTime($row['waktupeminjaman']);
            $tenggat = clone $waktuPinjam;
            $tenggat->modify('+5 days');
            $timestamp = $tenggat->getTimestamp();
            // ID unik untuk elemen countdown
            $idCountdown = 'countdown_' . $row['id_peminjaman'];
            // Format manusiawi tenggat (optional untuk tooltip)
            $formatManusiawi = strftime('%A, %e %B %Y pukul %H:%M', $timestamp);
          } else {
            $timestamp = null;
            $idCountdown = null;
          }
        ?>
          <div class="book-card">
            <img
              src="img/<?php echo htmlspecialchars($row['fotobuku']); ?>"
              alt="<?php echo htmlspecialchars($row['namabuku']); ?>"
            />
            <div class="book-info">
              <h4><?php echo htmlspecialchars($row['namabuku']); ?></h4>
              <p><?php echo htmlspecialchars($row['penciptabuku']); ?></p>

              <?php if ($timestamp): ?>
                <p id="<?php echo $idCountdown; ?>" data-deadline="<?php echo $timestamp; ?>">
                  ⏳ Menghitung waktu tenggat...
                </p>
                <small>Tenggat pengembalian: <?php echo $formatManusiawi; ?></small>
              <?php else: ?>
                <p style="color: gray;">Tanggal peminjaman tidak tersedia.</p>
              <?php endif; ?>

              <div class="book-actions">
                <form
                  method="get"
                  action="detail/buku.php"
                  style="display:inline;"
                >
                  <input
                    type="hidden"
                    name="id"
                    value="<?php echo htmlspecialchars($row['id_peminjaman']); ?>"
                  />
                  <button type="submit">Baca</button>
                </form>
                <form
                  method="post"
                  action="kembalikan.php"
                  style="display:inline;"
                  onsubmit="return confirm('Yakin ingin mengembalikan buku ini?')"
                >
                  <input
                    type="hidden"
                    name="id"
                    value="<?php echo htmlspecialchars($row['id_peminjaman']); ?>"
                  />
                  <button type="submit">Kembalikan</button>
                </form>
              </div>
            </div>
          </div>
        <?php endwhile;
        $stmt->close();
        ?>
      </div>

      <!-- Riwayat Peminjaman -->
      <div id="riwayat" class="tab-content" style="display:none;">
        <?php
        $queryRiwayat = "SELECT * FROM peminjaman WHERE NamaPengguna = ?";
        $stmtRiwayat = $koneksi->prepare($queryRiwayat);
        $stmtRiwayat->bind_param("s", $NamaPengguna);
        $stmtRiwayat->execute();
        $resultRiwayat = $stmtRiwayat->get_result();

        while ($rowRiwayat = $resultRiwayat->fetch_assoc()):
        ?>
          <div class="book-card">
            <img
              src="img/<?php echo htmlspecialchars($rowRiwayat['fotobuku']); ?>"
              alt="<?php echo htmlspecialchars($rowRiwayat['namabuku']); ?>"
            />
            <div class="book-info">
              <h4><?php echo htmlspecialchars($rowRiwayat['namabuku']); ?></h4>
              <p><?php echo htmlspecialchars($rowRiwayat['penciptabuku']); ?></p>
              <div class="book-actions">
                <form method="get" action="detail/a.php" style="display:inline;">
                  <input
                    type="hidden"
                    name="id_peminjaman"
                    value="<?php echo htmlspecialchars($rowRiwayat['id_peminjaman']); ?>"
                  />
                  <button type="submit">Pinjam lagi</button>
                </form>
              </div>
            </div>
          </div>
        <?php endwhile;
        $stmtRiwayat->close();
        ?>
      </div>
    </div>
  </div>

  <footer class="footer">
    <div class="footer-top">
      <img src="img/logo.png" alt="Logo" class="logo-footer" />
      <div class="line"></div>
      <div class="footer-section">
        <h3>PERPUSTAKAAN ONLINE</h3>
        <p>
          Perpustakaan Merupakan Tempat Dimana Banyak Menyimpan Berbagai Macam
          Buku Ilmu Pengetahuan...
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
        <p>
          PERPUSTAKAAN ONLINE<br />
          Tanjungpinang<br />
          Indonesia
        </p>
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

  <script>
    function showTab(tabId) {
      const tabs = document.querySelectorAll('.tab-content');
      const buttons = document.querySelectorAll('.tab-button');
      tabs.forEach((tab) => (tab.style.display = 'none'));
      buttons.forEach((btn) => btn.classList.remove('active'));
      document.getElementById(tabId).style.display = 'block';
      event.target.classList.add('active');
    }

    function updateCountdown() {
      const countdowns = document.querySelectorAll('[id^="countdown_"]');

      countdowns.forEach((el) => {
        const deadline = parseInt(el.dataset.deadline) * 1000; // ke milidetik
        const now = new Date().getTime();
        const diff = deadline - now;

        if (diff <= 0) {
          el.innerHTML = '⚠️ Sudah lewat tenggat pengembalian';
          el.style.color = 'red';
        } else {
          const days = Math.floor(diff / (1000 * 60 * 60 * 24));
          const hours = Math.floor(
            (diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
          );
          const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
          const seconds = Math.floor((diff % (1000 * 60)) / 1000);

          let warna = 'black';
          if (days < 0) warna = 'red';
          else if (days <= 1) warna = 'orange';

          el.innerHTML = `⏳ Sisa waktu: ${days} hari ${hours} jam ${minutes} menit ${seconds} detik`;
          el.style.color = warna;
        }
      });
    }

    setInterval(updateCountdown, 1000);
    updateCountdown();
  </script>
</body>
</html>
<?php $koneksi->close(); ?>
