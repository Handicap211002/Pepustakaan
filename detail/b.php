<?php
session_start();
include '../connetdb.php';

if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit;
}

if (isset($_SESSION['success_message'])) {
    echo "<script>alert('" . addslashes($_SESSION['success_message']) . "');</script>";
    unset($_SESSION['success_message']);
}
$query = "SELECT u.username, u.rating, u.ulasan, u.tanggal, a.FotoProfil
          FROM ulasan u
          JOIN akun a ON u.username = a.NamaPengguna
          ORDER BY u.tanggal DESC";

$result = mysqli_query($koneksi, $query);

// Cek jika query gagal
if (!$result) {
    die("Query gagal: " . mysqli_error($koneksi));
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./vars.css">
    <link rel="stylesheet" href="../style/detail.css">
    <style>
        a,
        button,
        input,
        select,
        h1,
        h2,
        h3,
        h4,
        h5,
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            border: none;
            text-decoration: none;
            background: none;
            -webkit-font-smoothing: antialiased;
        }

        menu,
        ol,
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
    </style>
    <title>Detail</title>
</head>

<body>
    <div class="beranda">
        <div class="navbar">
            <div class="nav-items">
                <a href='../berandasetelahlogin.php' class="nav-link">Beranda</a>
                <a href="../koleksibacaan.php" class="nav-link">Koleksi Bacaan</a>
                <a href="../beritaterkini.php" class="nav-link">Berita Terkini</a>
                <a href="../manajemenbuku.php" class="nav-link">Manajemen Buku</a>
            </div>
            <div class="nav-profile">
                <img class="logoakun" src="../svg/profil.svg" alt="Logoakun" onclick="window.location.href='../userakun.php'" />
            </div>
        </div> <!-- Tutup navbar -->

        <div class="book-detail">
            <div class="book-card">
                <img src="../img/b2.png" alt="Sampul Buku Timun Jelita" class="cover-img" />
                <h2>Frequency-and-Music</h2>
                <p class="author">Douglas L. Jones, Catherine Schmidt-Jones</p>

                <div class="book-meta">
                    <div class="rating">
                        ⭐ <span>4.0</span>
                    </div>
                    <div class="pages">
                        📄 <span>62 lembar</span>
                    </div>
                    <div class="size">
                        💾 <span>1,2mb</span>
                    </div>
                </div>
            </div>

            <div class="detail-section">
                <h3>Detail Buku</h3>
                <p><strong>Tahun Terbit:</strong> 21 Februari 2006</p>
                <p><strong>Penerbit:</strong> Rice University</p>

                <h3>Sinopsis</h3>
                <p>
                    Buku ini membahas hubungan antara frekuensi (gelombang suara) dan musik, menjelaskan bagaimana suara terbentuk, bagaimana gelombang berdiri (standing waves) menciptakan nada dalam alat musik, serta bagaimana teori musik seperti harmonik, oktaf, dan sistem penyeteman (tuning) didasarkan pada prinsip fisika. Ditujukan sebagai pengantar musik teori yang berbasis ilmiah, buku ini sangat cocok untuk musisi dan siswa yang ingin memahami aspek ilmiah dari musik.
                </p>

                <div class="button-group">
                    <button class="btn-baca" onclick="window.location.href='../koleksibacaan.php';">Kembali</button>
                    <form method="POST" action="pinjam_buku.php">
                        <input type="hidden" name="namabuku" value="Frequency-and-Music">
                        <input type="hidden" name="penciptabuku" value="Douglas L. Jones, Catherine Schmidt-Jones">
                        <input type="hidden" name="fotobuku" value="../img/b2.png">
                        <input type="hidden" name="tahunterbit" value="21 Februari 2006">
                        <input type="hidden" name="penerbit" value="Rice University">
                        <input type="hidden" name="halaman" value="62 lembar">
                        <input type="hidden" name="redirect_to" value="buku1.php">
                        <button type="submit" class="btn-pinjam">Pinjam</button>
                    </form>
                </div>

                <h3>Ulasan</h3>
                <div class="review">
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <div class="review-user">
                            <img src="../<?= htmlspecialchars($row['FotoProfil']) ?>" alt="<?= htmlspecialchars($row['username']) ?>" class="user-img">
                            <div class="review-content">
                                <p class="username"><?= htmlspecialchars($row['username']) ?></p>
                                <p class="comment"><?= nl2br(htmlspecialchars($row['ulasan'])) ?></p>
                                <p class="rating-date">⭐ <?= htmlspecialchars($row['rating']) ?> - <?= date('d/m/Y', strtotime($row['tanggal'])) ?></p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>


    </div> <!-- Tutup beranda -->

    <footer class="footer">
        <div class="footer-top">
            <img src="../img/logo.png" alt="Logo" class="logo-footer" />
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
                <p>PERPUSTAKAAN ONLINE<br>Tanjungpinang<br>Indonesia</p>
                <p>Phone : 081977549410</p>
                <p>Email : xxxxxxx@gmail.com</p>
                <div class="social-icons">
                    <img src="../svg/icon-twitter0.svg" alt="Twitter">
                    <img src="../svg/icon-facebook0.svg" alt="Facebook">
                    <img src="../svg/icon-instagram0.svg" alt="Instagram">
                    <img src="../svg/icon-youtube0.svg" alt="YouTube">
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>Copyright <span>PERPUSTAKAAN ONLINE</span> All Rights Reserved, 2025</p>
        </div>
    </footer>
</body>

</html>