<?php
session_start();
include '../connetdb.php';

if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit;
}

// Validasi input
if (!isset($_POST['id_peminjaman'], $_POST['rating'], $_POST['ulasan'])) {
    $_SESSION['success_message'] = "Data tidak lengkap.";
    header("Location: ../index.php");
    exit;
}

$id_peminjaman = intval($_POST['id_peminjaman']);
$rating = intval($_POST['rating']);
$ulasan = trim($_POST['ulasan']);
$username = $_SESSION['username'];

// Cek koneksi aktif (opsional untuk debugging)
if ($koneksi->connect_error) {
    $_SESSION['success_message'] = "Koneksi database gagal: " . $koneksi->connect_error;
    header("Location: ../index.php");
    exit;
}

// Simpan ke tabel ulasan pakai prepared statement
$stmt = $koneksi->prepare("INSERT INTO ulasan (id_peminjaman, username, rating, ulasan, tanggal) 
                           VALUES (?, ?, ?, ?, NOW())");

if ($stmt) {
    $stmt->bind_param("isis", $id_peminjaman, $username, $rating, $ulasan);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Ulasan berhasil dikirim!";
    } else {
        $_SESSION['success_message'] = "Gagal menyimpan ulasan: " . $stmt->error;
    }

    $stmt->close();
} else {
    $_SESSION['success_message'] = "Query tidak dapat diproses: " . $koneksi->error;
}

// Redirect kembali ke detail buku
header("Location: a.php");
exit;
