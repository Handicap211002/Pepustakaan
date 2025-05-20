<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/vars.css">
    <link rel="stylesheet" href="style/koleksibacaan.css">

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
    <title>Document</title>
</head>

<body>
    <div class="beranda">
        <div class="navbar">
            <div class="nav-items">
                <a href='berandasetelahlogin.php' class="nav-link">Beranda</a>
                <a href="#" class="nav-link active">Koleksi Bacaan</a>
                <a href="#" class="nav-link">Berita Terkini</a>
                <a href="#" class="nav-link">Manajemen Buku</a>
            </div>
            <div class="nav-profile">
                <img class="logoakun" src="svg/profil.svg" alt="Logoakun" onclick="window.location.href='userakun.php'" />
            </div>
        </div>
        <div class="search-container">
            <input type="text" id="searchBox" class="rectangle-1">
            <img class="search" src="svg/search0.svg" id="searchIcon" />
            <div class="telusuri" id="placeholderText">Telusuri...</div>
        </div>

        <div class="book-grid">
            <a href="detail/timun-jelita.html" class="book-card">
                <img src="img/image0.png" alt="Timun Jelita">
                <p class="book-title">Timun Jelita</p>
                <img class="bookmark" src="svg/bookmark.svg" />
            </a>
            <a href="detail/3726-mdpl.html" class="book-card">
                <img src="img/image1.png" alt="3726 Mdpl">
                <p class="book-title">3726 Mdpl</p>
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
            <a href="detail/bisnis-online.html" class="book-card">
                <img src="img/buku9.png" alt="Bisnis Online">
                <p class="book-title">Cicilia Oday</p>
                <img class="bookmark" src="svg/bookmark.svg" />
            </a>
            <a href="detail/bisnis-online.html" class="book-card">
                <img src="img/buku10.png" alt="Bisnis Online">
                <p class="book-title">Tanpa Rencana</p>
                <img class="bookmark" src="svg/bookmark.svg" />
            </a>
            <a href="detail/bisnis-online.html" class="book-card">
                <img src="img/buku11.png" alt="Bisnis Online">
                <p class="book-title">Manusia Setengah</p>
                <img class="bookmark" src="svg/bookmark.svg" />
            </a>
            <a href="detail/bisnis-online.html" class="book-card">
                <img src="img/buku12.png" alt="Bisnis Online">
                <p class="book-title">CICA</p>
                <img class="bookmark" src="svg/bookmark.svg" />
            </a>
            <a href="detail/bisnis-online.html" class="book-card">
                <img src="img/buku13.png" alt="Bisnis Online">
                <p class="book-title">Saat Saat Jauh</p>
                <img class="bookmark" src="svg/bookmark.svg" />
            </a>
            <a href="detail/bisnis-online.html" class="book-card">
                <img src="img/buku14.png" alt="Bisnis Online">
                <p class="book-title">Saat Aku Mati Nanti</p>
                <img class="bookmark" src="svg/bookmark.svg" />
            </a>
            <a href="detail/bisnis-online.html" class="book-card">
                <img src="img/buku15.png" alt="Bisnis Online">
                <p class="book-title">Filosofi Teras</p>
                <img class="bookmark" src="svg/bookmark.svg" />
            </a>
            <a href="detail/bisnis-online.html" class="book-card">
                <img src="img/buku16.png" alt="Bisnis Online">
                <p class="book-title">CICA</p>
                <img class="bookmark" src="svg/bookmark.svg" />
            </a>

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
</body>

</html>