<?php
include 'connetdb.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    }

    .form-group label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }

    .form-group input {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 6px;
      background-color: #d9d9d9;
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
    <!-- Logo -->
    <img src="img/whats-app-image-2025-04-16-at-08-57-480.png" alt="Perpustakaan Online" class="logo">

    <!-- Tombol Sosial Media -->
    <div class="social-buttons">
      <img src="img/facebook-logo-2019-svg-20.png" alt="Facebook">
      <img src="img/twitter-logo-svg-20.png" alt="Twitter">
      <img src="img/google-2015-logo-svg-20.png" alt="Google">
    </div>

    <!-- Garis pemisah -->
    <div class="divider"></div>

    <!-- Formulir -->
    <form method="POST">
      <div class="form-group">
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>
      </div>

      <div class="form-group">
        <label for="username">Nama Pengguna :</label>
        <input type="text" id="username" name="username" required>
      </div>

      <div class="form-group">
        <label for="password">Kata Sandi :</label>
        <input type="password" id="password" name="password" required>
      </div>

      <div class="form-group">
        <label for="birthdate">Tanggal Lahir :</label>
        <input type="date" id="birthdate" name="birthdate" required>
      </div>

      <!-- Tombol Aksi -->
      <div class="form-actions">
        <button type="button" onclick="window.history.back()">Kembali</button>
        <button type="submit">Kirim</button>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $Email           = $_POST['email'];
          $NamaPengguna    = $_POST['username'];
          $KataSandi       = $_POST['password'];
          $TanggalLahir    = $_POST['birthdate'];

          $KataSandiHash = password_hash($KataSandi, PASSWORD_DEFAULT);

          // Cek duplikat
          $cek = mysqli_query($koneksi, "SELECT * FROM akun WHERE Email='$Email' OR NamaPengguna='$NamaPengguna'");
          if (mysqli_num_rows($cek) > 0) {
            echo "<script>alert('Email atau Username sudah terdaftar!'); window.history.back();</script>";
            exit;
          }

          // Simpan ke database
          $sql = "INSERT INTO akun (Email, NamaPengguna, KataSandi, TanggalLahir)
          VALUES ('$Email', '$NamaPengguna', '$KataSandiHash', '$TanggalLahir')";

          if (mysqli_query($koneksi, $sql)) {
            echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='login.php';</script>";
          } else {
            echo "Terjadi kesalahan: " . mysqli_error($koneksi);
          }
        }
        ?>




      </div>
    </form>
  </div>

</body>

</html>