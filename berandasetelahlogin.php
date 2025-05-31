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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/vars.css">
    <link rel="stylesheet" href="style/berandastyle.css">

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
    <title>Beranda</title>
</head>

<body>
    <div class="beranda">
        <div class="search-container">
            <input type="text" id="searchBox" class="rectangle-1">
            <img class="search" src="svg/search0.svg" id="searchIcon" />
            <div class="telusuri" id="placeholderText">Telusuri...</div>
        </div>
        <div class="rekomendasi-bacaan">Rekomendasi Bacaan</div>
        <img class="logoakun" src="svg/profile.svg" alt="Logoakun" onclick="window.location.href='userakun.php'" />
        <div class="slider-container">
            <div class="slider-track" id="sliderTrack">
                <img src="img/pngtree-library-at-noon-15184440.png" alt="Slide 1" />
                <img src="img/beranda-perpus-20.png" alt="Slide 2" />
                <img src="img/perpus-beranda-10.png" alt="Slide 3" />
            </div>
        </div>

        <div class="fitur-yang-kami-tawarkan">FITUR YANG KAMI TAWARKAN</div>
        <div class="rectangle-13" onclick="window.location.href='koleksibacaan.php'"></div>
        <div class="rectangle-14" onclick="window.location.href='beritaterkini.PHP'"></div>
        <div class="rectangle-15" onclick="window.location.href='manajemenbuku.php'"></div>
        <div class="koleksi-bacaan" onclick="window.location.href='koleksibacaan.php'">koleksi bacaan</div>
        <div class="manajemen-buku" onclick="window.location.href='manajemenbuku.php'">Manajemen Buku</div>
        <div class="berita-terkini" onclick="window.location.href='beritaterkini.PHP'">Berita Terkini</div>
        <div class="koleksi-bacaan" onclick="window.location.href='koleksibacaan.php'">koleksi bacaan</div>
        <img class="video" src="svg/video0.svg" />
        <img class="book-open" src="svg/book-open0.svg" />
        <img class="icon" src="svg/icon0.svg" />

        <div class="book-grid">
            <a href="detail/a.php" class="book-card">
                <img src="img/b1.png" alt="Timun Jelita">
                <p class="book-title">Hidden-City</p>
                <img class="bookmark" src="svg/bookmark.svg" />
            </a>
            <a href="detail/b.php" class="book-card">
                <img src="img/b2.png" alt="3726 Mdpl">
                <p class="book-title">Frequency-and-Music</p>
                <img class="bookmark" src="svg/bookmark.svg" />
            </a>
            <a href="detail/ayah-arahnya.html" class="book-card">
                <img src="img/image2.png" alt="Ayah ini arahnya ke mana ya?">
                <p class="book-title">Ayah ini arahnya ke mana ya?</p>
                <img class="bookmark" src="svg/bookmark.svg" />
            </a>
            <a href="detail/berandal-bandung.html" class="book-card">
                <img src="img/image3.png" alt="Berandal Bandung">
                <p class="book-title">Berandal Bandung</p>
                <img class="bookmark" src="svg/bookmark.svg" />
            </a>
            <a href="detail/web-programming.html" class="book-card">
                <img src="img/buku-50.png" alt="Buku Mahir Web Programming">
                <p class="book-title">Buku Mahir Web Programming</p>
                <img class="bookmark" src="svg/bookmark.svg" />
            </a>
            <a href="detail/step-by-step.html" class="book-card">
                <img src="img/buku-60.png" alt="Step by Step">
                <p class="book-title">Step by Step</p>
                <img class="bookmark" src="svg/bookmark.svg" />
            </a>
            <a href="detail/hujan-juni.html" class="book-card">
                <img src="img/buku-70.png" alt="Hujan Bulan Juni">
                <p class="book-title">Hujan Bulan Juni</p>
                <img class="bookmark" src="svg/bookmark.svg" />
            </a>
            <a href="detail/bisnis-online.html" class="book-card">
                <img src="img/buku-40.png" alt="Bisnis Online">
                <p class="book-title">Bisnis Online</p>
                <img class="bookmark" src="svg/bookmark.svg" />
            </a>
        </div>

        <div class="berita-terkini2">Berita Terkini</div>
        <div class="berita-section">
            <div class="berita-card">
                <div class="rectangle"></div>
                <img class="berita-img" src="img/image-10.png" alt="Gambar Berita 1" onclick="window.location.href='Berita1.php'" />
                <h2 class="berita-judul" onclick="window.location.href='Berita1.php'">Jaksa Agung, Ahok, dan Korupsi Pertamina</h2>
                <p class="berita-deskripsi">
                    dugaan korupsi tata kelola minyak mentah di anak perusahaan PT Pertamina, PT Pertamina Subholding dan Kontraktor Kontrak Kerja Sama (KKKS) tahun 2018-2023.
                </p>
            </div>
            <div class="berita-card">
                <div class="rectangle"></div>
                <img class="berita-img" src="img/_1307332-7200.png" alt="Gambar Berita 2" onclick="window.location.href='#'" />
                <h2 class="berita-judul" onclick="window.location.href='Berita2.php'">Kuasa Hukum Pastikan Ijazah Jokowi Tak Pernah Hilang</h2>
                <p class="berita-deskripsi">
                    Kuasa hukum Presiden Jokowi, Yusril Ihza Mahendra, menegaskan bahwa ijazah Jokowi asli dan tidak pernah hilang. Ia membantah tudingan ijazah palsu dan menyebutnya sebagai hoaks.
                </p>
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
                    <img src="svg/icon-twitter0.svg" alt="Twitter">
                    <img src="svg/icon-facebook0.svg" alt="Facebook">
                    <img src="svg/icon-instagram0.svg" alt="Instagram">
                    <img src="svg/icon-youtube0.svg" alt="YouTube">
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>Copyright <span>PERPUSTAKAAN ONLINE</span> All Rights Reserved, 2025</p>
        </div>
    </footer>

    <script>
        const filterBox = document.getElementById("searchBox");
        const items = document.querySelectorAll(".book-card");

        filterBox.addEventListener("input", function() {
            const search = this.value.toLowerCase(); // ganti innerText ke value

            items.forEach(item => {
                const title = item.querySelector(".book-title").innerText.toLowerCase();
                if (title.includes(search) || search === "") {
                    item.style.display = "";
                } else {
                    item.style.display = "none";
                }
            });
        });
    </script>

    <script>
        const placeholderText = document.getElementById("placeholderText");
        const searchIcon = document.getElementById("searchIcon");

        searchBox.addEventListener("input", function() {
            const hasText = searchBox.value.trim().length > 0;
            placeholderText.classList.toggle("hidden", hasText);
        });
    </script>

    <script>
        const track = document.getElementById("sliderTrack");
        const totalSlides = 3;
        const slideWidth = 1340 + 30; // gambar + gap
        let currentIndex = 0;

        setInterval(() => {
            currentIndex++;
            // Kalau sudah di slide terakhir, langsung reset ke awal
            if (currentIndex >= totalSlides) {
                track.style.transition = "none"; // matikan animasi sementara
                track.style.transform = "translateX(0px)";
                currentIndex = 0;
                // pakai timeout kecil agar animasi slide aktif lagi
                setTimeout(() => {
                    track.style.transition = "transform 2s ease-in-out";
                    track.style.transform = `translateX(-${slideWidth}px)`;
                    currentIndex = 1;
                }, 50);
            } else {
                track.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
            }
        }, 4000); // waktu antar slide (4 detik)
    </script>
</body>

</html>