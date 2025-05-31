<?php
session_start();
include 'connetdb.php';

// Cek login
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$username = $_SESSION['username'];
$query = "SELECT * FROM akun WHERE NamaPengguna = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, 's', $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    session_destroy();
    header('Location: login.php?error=Akun sudah dihapus.');
    exit;
}

// Update data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['NamaPengguna'];
    $email = $_POST['Email'];
    $alamat = $_POST['Alamat'];
    $passwordBaru = $_POST['PasswordBaru'];

    $query = "UPDATE akun SET NamaPengguna=?, Email=?, Alamat=?";
    $params = [$nama, $email, $alamat];
    $types = "sss";

    if (!empty($passwordBaru)) {
        $hash = password_hash($passwordBaru, PASSWORD_DEFAULT);
        $query .= ", KataSandi=?";
        $params[] = $hash;
        $types .= "s";
    }

    if (isset($_FILES['FotoProfil']) && $_FILES['FotoProfil']['error'] === 0) {
        $ext = pathinfo($_FILES['FotoProfil']['name'], PATHINFO_EXTENSION);
        $namaFile = uniqid('profil_', true) . "." . $ext;
        $target = "profileakun/" . $namaFile;

        if (move_uploaded_file($_FILES['FotoProfil']['tmp_name'], $target)) {
            $query .= ", FotoProfil=?";
            $params[] = $target;
            $types .= "s";
        }
    }

    $query .= " WHERE id=?";
    $params[] = $user['id'];
    $types .= "i";

    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, $types, ...$params);
    mysqli_stmt_execute($stmt);

    $_SESSION['username'] = $nama;
    $_SESSION['success_message'] = "Profil berhasil diperbarui.";
    header("Location: userakun.php");
    exit;
}

// Tampilkan pesan sukses
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
    <link rel="stylesheet" href="./vars.css">
    <link rel="stylesheet" href="style/akun.css">


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
    <title>Akun</title>
</head>

<body>
    <div class="beranda">
        <div class="navbar">
            <div class="nav-items">
                <a href='berandasetelahlogin.php' class="nav-link">Beranda</a>
                <a href="koleksibacaan.php" class="nav-link">Koleksi Bacaan</a>
                <a href="beritaterkini.php" class="nav-link">Berita Terkini</a>
                <a href="manajemenbuku.php" class="nav-link">Manajemen Buku</a>
            </div>
            <div class="nav-profile">
                <img class="logoakun" src="svg/profil.svg" alt="Logoakun" onclick="window.location.href='userakun.php'" />
            </div>
        </div>
        <form method="POST" enctype="multipart/form-data" style="display:none;" id="form-profil">
            <input type="hidden" name="NamaPengguna" id="nama">
            <input type="hidden" name="Email" id="email">
            <input type="hidden" name="Alamat" id="alamat">
            <input type="password" name="PasswordBaru" id="sandi" style="display:none;">
            <input type="file" name="FotoProfil" id="foto" style="display:none;">
        </form>

        <div class="profile-container">
            <!-- Sidebar -->
            <div class="profile-left">
                <div class="profile-button">
                    <img src="svg/profile.svg" class="profile-icon" />
                    <span class="profile-label">Akun Saya</span>
                </div>
                <div class="vertical-line"></div>
            </div>

            <!-- Content -->
            <div class="profile-right">
                <div class="profile-header">
                    <img src="<?php echo $user['FotoProfil'] ?: 'profileakun/profile.jpg'; ?>" alt="Foto Profil" class="profile-picture">
                    <div>
                        <h3>Akun Saya</h3>
                        <a href="#" class="upload-btn">Unggah Foto</a>
                    </div>
                </div>

                <div class="profile-section">
                    <div class="profile-field">
                        <span class="field-label">Nama Lengkap:</span>
                        <span class="field-value"><?php echo htmlspecialchars($user['NamaPengguna']); ?></span>
                        <a href="#" class="edit-btn">Edit</a>
                    </div>
                    <div class="profile-field">
                        <span class="field-label">Alamat Email:</span>
                        <span class="field-value"><?php echo htmlspecialchars($user['Email']); ?></span>
                        <a href="#" class="edit-btn">Edit</a>
                    </div>
                    <div class="profile-field">
                        <span class="field-label">Kata Sandi:</span>
                        <span class="field-value">•••••••••••</span>
                        <a href="#" class="edit-btn">Ganti Kata Sandi</a>
                    </div>
                    <div class="profile-field">
                        <span class="field-label">Alamat Saya:</span>
                        <span class="field-value"><?php echo htmlspecialchars($user['Alamat']); ?></span>
                        <a href="#" class="edit-btn">Ubah Alamat</a>
                    </div>
                </div>
                <a href="logout.php" class="logout-btn">Keluar</a>
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
            // Set data awal ke input hidden saat halaman pertama kali dimuat
            document.getElementById('nama').value = "<?php echo htmlspecialchars($user['NamaPengguna'], ENT_QUOTES); ?>";
            document.getElementById('email').value = "<?php echo htmlspecialchars($user['Email'], ENT_QUOTES); ?>";
            document.getElementById('alamat').value = "<?php echo htmlspecialchars($user['Alamat'], ENT_QUOTES); ?>";


            document.querySelectorAll('.edit-btn').forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    let label = this.previousElementSibling.previousElementSibling.innerText.trim();
                    let valueEl = this.previousElementSibling;
                    let value = prompt(`Edit ${label}`, valueEl.innerText);
                    if (value !== null) {
                        valueEl.innerText = value;
                        if (label.includes("Nama")) document.getElementById('nama').value = value;
                        else if (label.includes("Email")) document.getElementById('email').value = value;
                        else if (label.includes("Alamat")) document.getElementById('alamat').value = value;
                        document.getElementById('form-profil').submit();
                    }
                });
            });

            document.querySelector('.upload-btn').addEventListener('click', function(e) {
                e.preventDefault();
                document.getElementById('foto').click();
            });

            document.getElementById('foto').addEventListener('change', function() {
                document.getElementById('form-profil').submit();
            });

            document.querySelectorAll('.edit-btn').forEach(function(btn) {
                if (btn.innerText.includes("Kata Sandi")) {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        let newPass = prompt("Masukkan kata sandi baru:");
                        if (newPass) {
                            document.getElementById('sandi').value = newPass;
                            document.getElementById('form-profil').submit();
                        }
                    });
                }
            });
        </script>

</body>

</html>