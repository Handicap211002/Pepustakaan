<?php
include 'connetdb.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Form Registrasi</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }

    body {
      background-color: #f5f5f5;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .registrasi {
      width: 650px;
      background-color: white;
      padding: 30px 40px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .registrasi img.logo {
      width: 120px;
      margin-bottom: 20px;
    }

    .social-buttons {
      display: flex;
      justify-content: center;
      gap: 20px;
      margin-bottom: 20px;
    }

    .social-buttons img {
      width: 100px;
      height: auto;
      border: 1px solid #000;
      padding: 4px 8px;
      border-radius: 4px;
    }

    .divider {
      height: 1px;
      background-color: #999;
      margin: 20px 0;
    }

    form {
      text-align: left;
    }

    .form-group {
      margin-bottom: 15px;
      position: relative;
    }

    .form-group label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }

    .form-group input[type="email"],
    .form-group input[type="text"],
    .form-group input[type="password"],
    .form-group input[type="date"] {
      width: 100%;
      padding: 12px 40px 12px 12px;
      border: 1px solid #ccc;
      border-radius: 6px;
      background-color: #d9d9d9;
    }

    .toggle-password {
      position: absolute;
      top: 50%;
      right: 12px;
      transform: translateY(-50%);
      cursor: pointer;
      font-size: 18px;
    }

    .form-actions {
      display: flex;
      justify-content: space-between;
      margin-top: 25px;
    }

    .form-actions button {
      background-color: #0a1d93;
      color: white;
      padding: 10px 25px;
      border: none;
      border-radius: 30px;
      cursor: pointer;
      font-size: 16px;
    }

    .form-actions button:hover {
      opacity: 0.9;
    }
  </style>
</head>

<body>

  <div class="registrasi">
    <img src="img/whats-app-image-2025-04-16-at-08-57-480.png" alt="Perpustakaan Online" class="logo" />

    <div class="social-buttons">
      <img src="img/facebook-logo-2019-svg-20.png" alt="Facebook" />
      <img src="img/twitter-logo-svg-20.png" alt="Twitter" />
      <img src="img/google-2015-logo-svg-20.png" alt="Google" />
    </div>

    <div class="divider"></div>

    <form method="POST" id="registerForm">
      <div class="form-group">
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required />
      </div>

      <div class="form-group">
        <label for="username">Nama Pengguna :</label>
        <input type="text" id="username" name="username" required />
      </div>

      <div class="form-group">
        <label for="password">Kata Sandi :</label>
        <input type="password" id="password" name="password" required />
        <span class="toggle-password" onclick="togglePassword('password', this)">👁️</span>
      </div>

      <div class="form-group">
        <label for="confirm_password">Konfirmasi Kata Sandi :</label>
        <input type="password" id="confirm_password" name="confirm_password" required />
        <span class="toggle-password" onclick="togglePassword('confirm_password', this)">👁️</span>
      </div>

      <div class="form-group">
        <label for="birthdate">Tanggal Lahir :</label>
        <input type="date" id="birthdate" name="birthdate" required />
      </div>

      <div class="form-actions">
        <button type="button" onclick="window.history.back()">Kembali</button>
        <button type="submit">Kirim</button>
      </div>
    </form>
  </div>

  <script>
    function togglePassword(id, el) {
      const input = document.getElementById(id);
      if (input.type === "password") {
        input.type = "text";
        el.textContent = "🙈";
      } else {
        input.type = "password";
        el.textContent = "👁️";
      }
    }

    document.getElementById('registerForm').addEventListener('submit', function(e) {
      const email = document.getElementById('email').value;
      const password = document.getElementById('password').value;
      const confirmPassword = document.getElementById('confirm_password').value;

      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      if (!emailRegex.test(email)) {
        alert('Format email tidak valid!');
        e.preventDefault();
        return;
      }

      if (password.length < 6) {
        alert('Kata sandi minimal harus 6 karakter!');
        e.preventDefault();
        return;
      }

      if (password !== confirmPassword) {
        alert('Konfirmasi kata sandi tidak cocok!');
        e.preventDefault();
        return;
      }
    });
  </script>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Email           = $_POST['email'];
    $NamaPengguna    = $_POST['username'];
    $KataSandi       = $_POST['password'];
    $KonfirmasiSandi = $_POST['confirm_password'];
    $TanggalLahir    = $_POST['birthdate'];

    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
      echo "<script>alert('Format email tidak valid!'); window.history.back();</script>";
      exit;
    }

    if (strlen($KataSandi) < 6) {
      echo "<script>alert('Kata sandi minimal 6 karakter!'); window.history.back();</script>";
      exit;
    }

    if ($KataSandi !== $KonfirmasiSandi) {
      echo "<script>alert('Konfirmasi kata sandi tidak cocok!'); window.history.back();</script>";
      exit;
    }

    $KataSandiHash = password_hash($KataSandi, PASSWORD_DEFAULT);

    $cek = mysqli_query($koneksi, "SELECT * FROM akun WHERE Email='$Email' OR NamaPengguna='$NamaPengguna'");
    if (mysqli_num_rows($cek) > 0) {
      echo "<script>alert('Email atau Username sudah terdaftar!'); window.history.back();</script>";
      exit;
    }

    $sql = "INSERT INTO akun (Email, NamaPengguna, KataSandi, TanggalLahir)
            VALUES ('$Email', '$NamaPengguna', '$KataSandiHash', '$TanggalLahir')";

    if (mysqli_query($koneksi, $sql)) {
      echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='login.php';</script>";
    } else {
      echo "Terjadi kesalahan: " . mysqli_error($koneksi);
    }
  }
  ?>
</body>
</html>
