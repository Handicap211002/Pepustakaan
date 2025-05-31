<?php
session_start();
include 'connetdb.php';

$error = "";

// Proses login saat tombol login ditekan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Cek apakah username ada
  $query = "SELECT * FROM akun WHERE NamaPengguna = '$username'";
  $result = mysqli_query($koneksi, $query);

  if (mysqli_num_rows($result) === 1) {
    $data = mysqli_fetch_assoc($result);

    // Verifikasi password
    if (password_verify($password, $data['KataSandi'])) {
      $_SESSION['username'] = $data['NamaPengguna'];
      $_SESSION['email'] = $data['Email'];
      $_SESSION['success_message'] = "Selamat datang, " . $data['NamaPengguna'] . "!";
      header("Location: Berandasetelahlogin.php");
      exit;
    } else {
      $error = "Password salah!";
    }
  } else {
    $error = "Username tidak ditemukan!";
  }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
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

    .container {
      width: 550px;
      background-color: white;
      padding: 30px 40px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .container img.logo {
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

    .form-links {
      display: flex;
      justify-content: flex-end;
      margin-top: 5px;
      font-size: 14px;
    }

    .form-links a {
      color: black;
      text-decoration: none;
    }

    .login-button {
      display: flex;
      justify-content: center;
      margin-top: 20px;
    }

    .login-button button {
      background-color: #0a1d93;
      color: white;
      padding: 10px 30px;
      border: none;
      border-radius: 30px;
      cursor: pointer;
      font-size: 16px;
    }

    .bottom-text {
      margin-top: 20px;
      font-size: 14px;
      text-align: center;
    }

    .bottom-text a {
      color: black;
      text-decoration: none;
      font-weight: bold;
    }
  </style>
</head>

<body>

  <div class="container">
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

    <!-- Form Login -->
    <form method="POST">
      <div class="form-group">
        <label for="username">Nama Pengguna :</label>
        <input type="text" id="username" name="username" required>
      </div>

      <div class="form-group">
        <label for="password">Kata Sandi :</label>
        <input type="password" id="password" name="password" required>
      </div>

      <div class="form-links">
        <a href="#">Lupa Kata Sandi</a>
      </div>

      <div class="login-button">
        <button type="submit">LOGIN</button>
      </div>

      <div class="bottom-text">
        tidak punya akun? <a href="register.php">daftar</a>
      </div>
    </form>
  </div>

  <?php if (!empty($error)) : ?>
    <script>
      alert('<?php echo $error; ?>');
    </script>
  <?php endif; ?>

</body>

</html>